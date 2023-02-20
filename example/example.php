<?php

require_once 'vendor/autoload.php';

use Sukuangyun\Payment\Client;
use Sukuangyun\Payment\Config;
use Sukuangyun\Payment\Exception\ReqException;

$config = new Config('gxcc', 'WrkFaLR7zTCUBj9webtMHzBXwSSGiaBN', 'http://localhost:8000');
$client = new Client($config);
try {
    $resp = $client->req('api/pay', [
        'trade_type' => 'WECHAT_JS_API',
        'merchant_account' => 'test',
        'order_sn' => '12345678910',
        'total_amount' => 1,
        'description' => '1分钱测试订单',
        'notify_url' => 'http://localhost:8000/api/pay/notify',
        'time_expire' => '',
        'payer' => [
            'wechat_open_id' => 'oAtdR59LDl_CC4LzVrBzxEQ6bQE8',
            'name' => '',
            'id_card_no' => '532724199206011234'
        ],
        'goods_detail' => [
            [
                'goods_id' => 'goods123',
                'goods_name' => '测试商品',
                'quantity' => 1,
                'price' => 1,
                'show_url' => 'http://localhost:8000/gooods/show'
            ]
        ]
    ]);
} catch (ReqException $e) {
    echo $e->getMessage();
    return;
}
var_dump($resp);