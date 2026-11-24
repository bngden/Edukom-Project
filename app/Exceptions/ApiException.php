<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * Galat bisnis yang dikembalikan ke klien dengan format standar
 * { "message", "code", "errors" }.
 */
class ApiException extends RuntimeException
{
    /**
     * @param  array<string, list<string>>  $errors
     */
    public function __construct(
        string $message,
        public readonly string $errorCode,
        public readonly int $status,
        public readonly array $errors = [],
    ) {
        parent::__construct($message);
    }

    public static function forbidden(string $message, string $code = 'FORBIDDEN'): self
    {
        return new self($message, $code, 403);
    }

    public static function locked(string $message, string $code = 'LOCKED'): self
    {
        return new self($message, $code, 423);
    }

    /**
     * @param  array<string, list<string>>  $errors
     */
    public static function validation(string $message, array $errors = []): self
    {
        return new self($message, 'VALIDATION_ERROR', 422, $errors);
    }
}
