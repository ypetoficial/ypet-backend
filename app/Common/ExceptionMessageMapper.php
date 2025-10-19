<?php

namespace App\Common;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionMessageMapper
{
    /**
     * Mensagem padrão quando não é possível identificar o erro
     */
    const DEFAULT_ERROR_MESSAGE = 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.';

    /**
     * Mapeia uma exceção para uma mensagem amigável
     *
     * @return array ['message' => string, 'status' => int, 'show' => bool]
     */
    public static function map(\Throwable $exception): array
    {
        if ($exception instanceof ValidationException) {
            return [
                'message' => $exception->validator->getMessageBag()->first(),
                'status' => 422,
                'show' => true,
                'errors' => $exception->validator->errors()->toArray(),
            ];
        }

        if ($exception instanceof AuthenticationException) {
            return [
                'message' => 'Você precisa estar autenticado para acessar este recurso.',
                'status' => 401,
                'show' => true,
            ];
        }

        if ($exception instanceof NotFoundHttpException) {
            return [
                'message' => 'O recurso solicitado não foi encontrado.',
                'status' => 404,
                'show' => true,
            ];
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return [
                'message' => 'Método não permitido para esta requisição.',
                'status' => 405,
                'show' => true,
            ];
        }

        if ($exception instanceof AccessDeniedHttpException) {
            return [
                'message' => 'Você não tem permissão para acessar este recurso.',
                'status' => 403,
                'show' => true,
            ];
        }

        if ($exception instanceof HttpException) {
            return [
                'message' => $exception->getMessage() ?: self::DEFAULT_ERROR_MESSAGE,
                'status' => $exception->getStatusCode(),
                'show' => true,
            ];
        }

        if ($exception instanceof QueryException) {
            return self::mapDatabaseException($exception);
        }
        if ($exception instanceof \Exception && $exception->getCode() >= 400 && $exception->getCode() < 600) {
            $message = $exception->getMessage();

            if (self::isFriendlyMessage($message)) {
                return [
                    'message' => $message,
                    'status' => $exception->getCode(),
                    'show' => true,
                ];
            }
        }

        if ($exception instanceof \Exception) {
            $message = $exception->getMessage();

            if (self::isFriendlyMessage($message)) {
                return [
                    'message' => $message,
                    'status' => $exception->getCode() ?: 500,
                    'show' => true,
                ];
            }
        }

        return [
            'message' => self::DEFAULT_ERROR_MESSAGE,
            'status' => 500,
            'show' => true,
        ];
    }

    /**
     * Mapeia exceções de banco de dados para mensagens amigáveis
     */
    private static function mapDatabaseException(QueryException $exception): array
    {
        $errorCode = $exception->errorInfo[1] ?? null;
        $errorMessage = $exception->errorInfo[2] ?? '';

        if ($errorCode === 1062) {
            preg_match("/for key '(.+?)'/", $errorMessage, $matches);
            $field = $matches[1] ?? 'registro';

            return [
                'message' => 'Este registro já existe no sistema. Por favor, verifique os dados informados.',
                'status' => 422,
                'show' => true,
            ];
        }

        if ($errorCode === 1451) {
            return [
                'message' => 'Não é possível excluir este registro pois existem outros dados vinculados a ele.',
                'status' => 422,
                'show' => true,
            ];
        }

        if ($errorCode === 1452) {
            return [
                'message' => 'Os dados informados são inválidos. Verifique se todos os campos estão corretos.',
                'status' => 422,
                'show' => true,
            ];
        }

        if ($errorCode === 1048) {
            preg_match("/Column '(.+?)'/", $errorMessage, $matches);
            $field = $matches[1] ?? 'campo';

            return [
                'message' => 'O campo é obrigatório e não pode estar vazio.',
                'status' => 422,
                'show' => true,
            ];
        }

        if ($errorCode === 1406) {
            return [
                'message' => 'Um dos campos contém um valor muito longo. Por favor, reduza o tamanho.',
                'status' => 422,
                'show' => true,
            ];
        }

        if ($errorCode === 1146) {
            return [
                'message' => self::DEFAULT_ERROR_MESSAGE,
                'status' => 500,
                'show' => true,
            ];
        }

        if ($errorCode === 1054) {
            return [
                'message' => self::DEFAULT_ERROR_MESSAGE,
                'status' => 500,
                'show' => true,
            ];
        }

        if (in_array($errorCode, [2002, 2003, 2006, 2013])) {
            return [
                'message' => 'Não foi possível conectar ao banco de dados. Por favor, tente novamente.',
                'status' => 503,
                'show' => true,
            ];
        }

        return [
            'message' => 'Ocorreu um erro ao processar sua solicitação. Por favor, tente novamente.',
            'status' => 500,
            'show' => true,
        ];
    }

    /**
     * Verifica se uma mensagem parece ser amigável para o usuário
     * (não contém termos técnicos ou SQL)
     */
    private static function isFriendlyMessage(string $message): bool
    {
        if (empty($message)) {
            return false;
        }

        $technicalTerms = [
            'SQL',
            'SQLSTATE',
            'PDOException',
            'QueryException',
            'Integrity constraint',
            'foreign key',
            'FOREIGN KEY',
            'Duplicate entry',
            'Column',
            'Table',
            'Database',
            'Undefined',
            'Call to',
            'Class',
            'Method',
            'Function',
            'Syntax error',
            'syntax error',
            'Exception',
            'Error in',
            'Stack trace',
            'vendor/',
            'app/',
            '.php',
            '::',
            'Illuminate\\',
            'App\\',
        ];

        foreach ($technicalTerms as $term) {
            if (stripos($message, $term) !== false) {
                return false;
            }
        }

        return true;
    }
}
