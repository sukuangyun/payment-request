<?php

namespace Sukuangyun\Payment;

class Config
{
    /**
     * 网关
     *
     * @var string
     */
    protected $gateway;

    /**
     * appId
     *
     * @var string
     */
    protected $appId;

    /**
     * appSecret
     *
     * @var string
     */
    protected $appSecret;

    /**
     * 初始化配置
     *
     * @param string $appId
     * @param string $appSecret
     * @param string $gateway
     */
    public function __construct(string $appId, string $appSecret, string $gateway)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->gateway = rtrim($gateway, '/');
    }

    /**
     * 获取appid
     *
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * 获取AppSecret
     *
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * 获取网关
     *
     * @return string
     */
    public function getGateway(): string
    {
        return $this->gateway;
    }
}