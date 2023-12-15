<?php

declare(strict_types=1);

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ResponseHelper
{
    public static function sendJsonResponse(bool $status, int $statusCode, array $errors = [], array $data = []): JsonResponse
    {
        return new JsonResponse(
            self::responsePrams($status, $data, $errors),
            $statusCode
        );
    }

    public static function success(array $data = []): JsonResponse
    {
        return self::sendJsonResponse(true, Response::HTTP_OK, [], $data);
    }

    public static function notFound(array $data = []): JsonResponse
    {
        return self::sendJsonResponse(false, Response::HTTP_NOT_FOUND, ['error' => 'Not found'], $data);
    }

    public static function unauthorized(): JsonResponse
    {
        return self::sendJsonResponse(false, Response::HTTP_UNAUTHORIZED, ['error' => 'Unauthorized'], []);
    }

    public static function badRequest(array $errors = []): JsonResponse
    {
        return self::sendJsonResponse(false, Response::HTTP_BAD_REQUEST, $errors, []);
    }

    public static function forbidden(array $errors = []): JsonResponse
    {
        return self::sendJsonResponse(false, Response::HTTP_FORBIDDEN, $errors, []);
    }

    public static function conflict(array $errors = []): JsonResponse
    {
        return self::sendJsonResponse(false, Response::HTTP_CONFLICT, $errors, []);
    }

    public static function created(array $data = []): JsonResponse
    {
        return self::sendJsonResponse(true, Response::HTTP_CREATED, [], $data);
    }

    public static function noContent(): JsonResponse
    {
        return self::sendJsonResponse(true, Response::HTTP_NO_CONTENT, [], []);
    }

    private static function responsePrams($status, $errors = [], $data = []): array
    {
        return [
            'status' => $status,
            'errors' => $errors,
            'data' => $data,
        ];
    }
}
