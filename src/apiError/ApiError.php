<?php

namespace lycecho\meituan\apiError;

use Stringable;

class ApiError extends \Exception implements Stringable
{
    protected   $code;
    private string $msg;
    private string $traceId;

    public function __construct(string $code, string $msg, string $traceId)
    {
        parent::__construct($msg);
        $this->code = $code;
        $this->msg = $msg;
        $this->traceId = $traceId;
    }

    public function getTraceId(): string
    {
        return $this->traceId;
    }

    public function __toString(): string
    {
        return sprintf("code=%s, msg=%s, traceId=%s", $this->code, $this->msg, $this->traceId);
    }
}
