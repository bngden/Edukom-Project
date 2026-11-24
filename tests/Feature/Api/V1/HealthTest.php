<?php

use Illuminate\Support\Str;

beforeEach(fn () => $this->withHeaders(spaHeaders()));

it('mengembalikan status ok tanpa login beserta header X-Request-Id', function () {
    $response = $this->getJson('/api/v1/health');

    $response->assertOk()
        ->assertJsonPath('status', 'ok')
        ->assertHeader('X-Request-Id');

    expect(Str::isUlid($response->headers->get('X-Request-Id')))->toBeTrue()
        ->and($response->json('time'))->toEndWith('+07:00');
});

it('memakai X-Request-Id dari klien bila formatnya aman', function () {
    $this->withHeader('X-Request-Id', 'req-abc12345')
        ->getJson('/api/v1/health')
        ->assertHeader('X-Request-Id', 'req-abc12345');
});

it('mengembalikan 404 berformat standar untuk route yang tidak ada', function () {
    $this->getJson('/api/v1/tidak-ada')
        ->assertNotFound()
        ->assertHeader('X-Request-Id')
        ->assertExactJson([
            'message' => 'Alamat atau data tidak ditemukan.',
            'code' => 'NOT_FOUND',
            'errors' => [],
        ]);
});
