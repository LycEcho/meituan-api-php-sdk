<?php

namespace Meituan\ApiError;

use Stringable;

class ApiError extends \Exception implements Stringable
{
    private string $code;
    private string $msg;
    private string $traceId;

    public function __construct(string $code, string $msg, string $traceId)
    {
        parent::__construct($msg);
        $this->code = $code;
        $this->msg = $msg;
        $this->traceId = $traceId;
    }

    public function getCode(): string
    {
        return $this->code;
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
