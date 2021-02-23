<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:30
 */
namespace SyException\Logistics;

use SyException\BaseException;

class AliMarketAliException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '阿里云市场阿里物流异常';
    }
}
