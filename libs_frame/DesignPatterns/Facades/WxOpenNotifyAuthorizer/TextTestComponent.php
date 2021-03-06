<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:50
 */
namespace DesignPatterns\Facades\WxOpenNotifyAuthorizer;

use DesignPatterns\Facades\WxOpenNotifyAuthorizerFacade;
use Traits\SimpleFacadeTrait;

class TextTestComponent extends WxOpenNotifyAuthorizerFacade {
    use SimpleFacadeTrait;

    protected static function responseNotify(array $data) : array {
        return [
            'ToUserName' => $data['FromUserName'],
            'FromUserName' => $data['ToUserName'],
            'CreateTime' => $data['CreateTime'],
            'MsgType' => 'text',
            'Content' => 'TESTCOMPONENT_MSG_TYPE_TEXT_callback',
        ];
    }
}