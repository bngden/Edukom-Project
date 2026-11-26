<?php

use App\Domain\Access\Actions\RecordAccessDenial;
use App\Exceptions\ApiException;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\RequestId;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * Bentuk galat standar API: { "message", "code", "errors" }.
 *
 * @param  array<string, mixed>  $errors
 * @param  array<string, string>  $headers
 */
$apiError = static fn (int $status, string $code, string $message, array $errors = [], array $headers = []): JsonResponse => response()->json([
    'message' => $message,
    'code' => $code,
    'errors' => (object) $errors,
], $status, $headers);

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api/v1',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->prepend(RequestId::class);
        $middleware->statefulApi();
        $middleware->alias(['role' => EnsureUserHasRole::class]);
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(fn () => route('beranda'));
    })
    ->withExceptions(function (Exceptions $exceptions) use ($apiError): void {
        $isApi = static fn (Request $request): bool => $request->is('api/*') || $request->expectsJson();

        $exceptions->shouldRenderJsonWhen(fn (Request $request) => $isApi($request));

        // Galat bisnis (salah password, akun terkunci, dsb.) bukan error aplikasi; jangan masuk laravel.log.
        $exceptions->dontReport([ApiException::class]);

        // AuthorizationException dari middleware role maupun Policy/Gate sudah diubah Laravel menjadi
        // AccessDeniedHttpException sebelum callback ini. Galat bisnis 403 (ApiException) tidak dicatat.
        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            app(RecordAccessDenial::class)->handle($request);

            return null;
        });

        $exceptions->render(function (ThrottleRequestsException $e, Request $request) use ($isApi) {
            if ($isApi($request) || ! $request->routeIs('login.store')) {
                return null;
            }

            return back()
                ->withErrors(['auth' => 'Terlalu banyak percobaan masuk. Coba lagi dalam '.($e->getHeaders()['Retry-After'] ?? 60).' detik.'])
                ->onlyInput('email');
        });

        // Halaman web: galat bisnis (409, 422, 423) kembali ke form sebelumnya sebagai pesan galat.
        $exceptions->render(function (ApiException $e, Request $request) use ($isApi) {
            if ($isApi($request) || $request->isMethod('GET')) {
                return null;
            }

            // Form dengan error bag sendiri mengirim field tersembunyi _bag (sama dengan $errorBag FormRequest-nya).
            return back()->withInput()->withErrors($e->errors ?: ['general' => $e->getMessage()], (string) $request->input('_bag', 'default'));
        });

        $exceptions->render(function (Throwable $e, Request $request) use ($isApi, $apiError) {
            if (! $isApi($request)) {
                return null;
            }

            return match (true) {
                $e instanceof ApiException => $apiError($e->status, $e->errorCode, $e->getMessage(), $e->errors),
                $e instanceof ValidationException => $apiError(422, 'VALIDATION_ERROR', 'Data yang dikirim tidak valid.', $e->errors()),
                $e instanceof AuthenticationException => $apiError(401, 'UNAUTHENTICATED', 'Anda belum login atau sesi telah berakhir.'),
                $e instanceof AuthorizationException => $apiError(403, 'FORBIDDEN', 'Anda tidak memiliki akses untuk tindakan ini.'),
                $e instanceof ModelNotFoundException => $apiError(404, 'NOT_FOUND', 'Data tidak ditemukan.'),
                $e instanceof TokenMismatchException => $apiError(419, 'CSRF_TOKEN_MISMATCH', 'Sesi keamanan kedaluwarsa. Muat ulang halaman lalu coba lagi.'),
                $e instanceof ThrottleRequestsException => $apiError(
                    429,
                    'TOO_MANY_REQUESTS',
                    'Terlalu banyak percobaan. Coba lagi dalam '.($e->getHeaders()['Retry-After'] ?? 60).' detik.',
                    [],
                    $e->getHeaders(),
                ),
                $e instanceof HttpExceptionInterface => match ($e->getStatusCode()) {
                    401 => $apiError(401, 'UNAUTHENTICATED', 'Anda belum login atau sesi telah berakhir.'),
                    403 => $apiError(403, 'FORBIDDEN', 'Anda tidak memiliki akses untuk tindakan ini.'),
                    404 => $apiError(404, 'NOT_FOUND', 'Alamat atau data tidak ditemukan.'),
                    405 => $apiError(405, 'METHOD_NOT_ALLOWED', 'Metode permintaan tidak didukung.'),
                    409 => $apiError(409, 'CONFLICT', 'Data bentrok dengan perubahan lain.'),
                    423 => $apiError(423, 'LOCKED', 'Data sedang terkunci.'),
                    default => $apiError($e->getStatusCode(), 'HTTP_ERROR', 'Permintaan tidak dapat diproses.', [], $e->getHeaders()),
                },
                // Detail teknis tidak pernah dikirim ke klien; tetap tercatat di log lewat report().
                default => $apiError(500, 'SERVER_ERROR', 'Terjadi kesalahan pada server. Silakan coba lagi.'),
            };
        });
    })->create();
