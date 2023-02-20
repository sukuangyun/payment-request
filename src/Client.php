<?php

namespace Sukuangyun\Payment;

use GuzzleHttp\Exception\GuzzleException;
use Sukuangyun\Payment\Exception\ReqException;

class Client
{
    /**
     * 加密模式
     *
     * @var string
     */
    protected static $cipherAlgo = 'AES-256-CBC';

    /**
     * 配置
     *
     * @var Config
     */
    protected $config;

    /**
     * 初始化方法
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 发起请求
     *
     * @param string $url
     * @param array $params
     * @return array
     * @throws ReqException
     */
    public function req(string $url, array $params = []): array
    {
        $cli = new \GuzzleHttp\Client([
            'base_uri' => $this->config->getGateway(),
            'timeout' => 20
        ]);

        $params = [
            '_encrypted_data' => $this->encrypt(json_encode($params))
        ];
        try {
            $resp = $cli->post($url, [
                'json' => $params,
                'headers' => [
                    'App-Id' => $this->config->getAppId()
                ]
            ]);
        } catch (GuzzleException $e) {
            throw new ReqException('请求' . $url . '失败', 0, $e, $url, $params);
        }
        $content = $resp->getBody()->getContents();

        $data = json_decode($content, true);
        if (isset($data['data'])){
            $data['data'] = json_decode($this->decrypt($data['data']), true);
        }
        return $data;
    }

    /**
     * 加密
     *
     * @param string $encrypted
     * @return false|string
     */
    protected function decrypt(string $encrypted)
    {
        $key = $this->config->getAppSecret();
        $iv = substr($key, 0, 16);
        return openssl_decrypt($encrypted, self::$cipherAlgo, $key, 0, $iv);
    }

    /**
     * 解密
     *
     * @param string $str
     * @return false|string
     */
    protected function encrypt(string $str)
    {
        $key = $this->config->getAppSecret();
        $iv = substr($key, 0, 16);
        return openssl_encrypt($str, self::$cipherAlgo, $key, 0, $iv);
    }
}