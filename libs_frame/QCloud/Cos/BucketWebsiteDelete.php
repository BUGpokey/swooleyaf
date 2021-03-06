<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use QCloud\CloudBaseCos;

/**
 * 删除存储桶的静态网站配置
 * @package QCloud\Cos
 */
class BucketWebsiteDelete extends CloudBaseCos {
    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_DELETE);
        $this->reqUri = '/?website';
        $this->signParams['website'] = '';
    }

    private function __clone(){
    }

    public function getDetail() : array {
        return $this->getContent();
    }
}