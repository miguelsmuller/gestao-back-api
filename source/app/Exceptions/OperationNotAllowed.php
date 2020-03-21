<?php

namespace App\Exceptions;

use Exception;

class OperationNotAllowed extends Exception
{
    public function __construct(string $resume, string $details, string $code) {
        $this->resume  = $resume;
        $this->details = $details;
        $this->code    = $code;

        parent::__construct();
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report()
    {
        //\Log::debug('User not found');
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'error' => [
                'resume'  => $this->resume,
                'details' => $this->details
            ]
        ], $this->code);
    }
}

