<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException){
            return $this->errorResponse("Usuário não Autenticado", 401);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse('Sem permissão para executar esta ação', 403);
        }

        if ($exception instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("{$modelName} não encontrado", 404);
        }

        if ($exception instanceof NotFoundHttpException){
            return $this->errorResponse("URL não encontrada", 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse("Médodo não permitido", 405);
        }

        if ($exception instanceof RelationNotFoundException){
            return $this->errorResponse("Relacionamento não encontrado", 409);
        }

        if ($exception instanceof QueryException){
            $errorCode = $exception->errorInfo[1];

            if ($errorCode == 1451){
                return $this->errorResponse('Exclusão não permitida em virtude de registros vinculantes', 409);
            }
        }

        if ($exception instanceof HttpException){
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        //return parent::render($request, $exception); PADRÃO DO LARAVEL SUBSTITUIDO PELAS LINHAS ABAIXO
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }
        return $this->errorResponse("Erro inesperado. Por favor, tente novamente mais tarde", 500);
    }

    protected function errorResponse($message, $code){
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}
