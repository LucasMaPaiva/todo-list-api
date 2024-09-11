<?php

namespace App\Base\Traits;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

trait Response {

    /**
     * @param mixed $data
     * @param string|null $message
     * @param int|null $status_code
     * @return JsonResponse
     */
    public static function successResponse(
        mixed       $data = null,
        string|null $message = 'Requisição processada com sucesso.',
        int|null    $status_code = 200
    ): JsonResponse {
        $response = self::defineResponseData(
            response: self::defineResponseBase(success: true, message: $message),
            data_error: false,
            data: $data
        );

        return response()->json($response, $status_code);
    }

    /**
     * @param Exception $exception
     * @param string|null $message
     * @return JsonResponse
     */
    public static function internalServerErrorResponse(
        Exception   $exception,
        string|null $message = 'Não foi possível processar a requisição. Tente novamente mais tarde.',
    ): JsonResponse {
        $response = self::defineResponseData(
            response: self::defineResponseBase(success: false, message: $message),
            data_error: true,
            data: $exception->getMessage()
        );

        return response()->json($response, 500);
    }

    /**
     * @param ModelNotFoundException $modelNotFoundException
     * @param string|null $message
     * @return JsonResponse
     */
    public static function modelNotFoundResponse(
        ModelNotFoundException $modelNotFoundException,
        string|null            $message = null
    ): JsonResponse {
        $response = self::defineResponseData(
            response: self::defineResponseBase(success: false, message: $message ?? $modelNotFoundException->getMessage()),
            data_error: true,
            data: $modelNotFoundException->getMessage()
        );
        return response()->json($response, 404);
    }

    /**
     * @param InvalidArgumentException $invalidArgumentException
     * @param string|null $message
     * @param int|null $statusCode
     * @return JsonResponse
     */
    public static function invalidArgumentResponse(
        InvalidArgumentException $invalidArgumentException,
        string|null              $message = null,
        int|null                 $statusCode = 400,
    ): JsonResponse {
        $response = self::defineResponseData(
            response: self::defineResponseBase(success: false, message: $message ?? $invalidArgumentException->getMessage()),
            data_error: true,
            data: $invalidArgumentException->getMessage()
        );

        return response()->json($response, $statusCode);
    }

    /**
     * @param HttpResponseException $httpResponseException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function httpResponseException(HttpResponseException $httpResponseException): \Symfony\Component\HttpFoundation\Response {
        return $httpResponseException->getResponse();
    }

    /**
     * @param $validator
     * @return mixed
     */
    public static function failedValidationResponse($validator): mixed {
        $response = self::defineResponseData(
            response: self::defineResponseBase(success: false, message: 'Por favor verifique os campos preenchidos.'),
            data_error: true,
            data: $validator->errors(),
            error_key: 'errors',
            validator_error: true
        );

        throw new HttpResponseException(
            response()->json($response, 422)
        );
    }

    /**
     * @param array $response
     * @param bool $data_error
     * @param mixed $data
     * @param string|null $error_key
     * @param bool $validator_error
     * @return array
     */
    private static function defineResponseData(
        array $response,
        bool  $data_error,
        mixed $data,
        ?string $error_key = 'message_error',
        bool $validator_error = false
    ): array {
        if ($data_error && !config('params.config.show_error_message') && !$validator_error) {
            return $response;
        }

        if ($data_error) {
            $response['data'] = [
                $error_key => $data
            ];

            return $response;
        }

        if ($data) {
            $response['data'] = $data;
        }

        return $response;
    }

    /**
     * @param bool $success
     * @param $message
     * @return array
     */
    private static function defineResponseBase(bool $success, $message): array {
        return [
            'success' => $success,
            'message' => $message
        ];
    }

    public static function notAuthorizeExceptionResponse(
        string $message = 'Não autorizado.'
    ) {
        return throw new HttpResponseException(response()->json([
            'success' => false,
            'data' => ['errors' => $message],
            'message' => $message
        ], 401));
    }
}
