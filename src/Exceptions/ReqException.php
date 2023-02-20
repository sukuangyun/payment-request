<?php

namespace Sukuangyun\Payment\Exception;

use Exception;
use Throwable;

class ReqException extends Exception
{
    /**
     * 请求参数
     *
     * @var array
     */
    protected $params;

    /**
     * 请求地址
     *
     * @var string
     */
    protected $url;

    public function __construct($message = "", $code = 0, Throwable $previous = null, string $url = '', array $params = [])
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * 获取请求参数
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * 获取请求地址
     *
     * @return string
     */
    public function url(): string
    {
        return $this->url;
    }
}