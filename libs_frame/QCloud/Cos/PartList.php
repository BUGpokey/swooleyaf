<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use Constant\ErrorCode;
use Exception\QCloud\CosException;
use QCloud\CloudBaseCos;

/**
 * 获取特定上传事件中已上传的块
 * @package QCloud\Cos
 */
class PartList extends CloudBaseCos {
    /**
     * 对象名称
     * @var string
     */
    private $objectKey = '';
    /**
     * 上传ID
     * @var string
     */
    private $uploadId = '';
    /**
     * 起始索引
     * @var int
     */
    private $startIndex = 0;
    /**
     * 条目数
     * @var int
     */
    private $limit = 0;

    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->reqData['encoding-type'] = 'url';
        $this->reqData['part-number-marker'] = 0;
        $this->reqData['max-parts'] = 20;
    }

    private function __clone(){
    }

    /**
     * @param string $objectKey
     * @throws \Exception\QCloud\CosException
     */
    public function setObjectKey(string $objectKey){
        if(strlen($objectKey) > 0){
            $this->reqUri = '/' . $objectKey;
            $this->objectKey = $objectKey;
        } else {
            throw new CosException('对象名称不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $uploadId
     * @throws \Exception\QCloud\CosException
     */
    public function setUploadId(string $uploadId){
        if(strlen($uploadId) > 0){
            $this->signParams['uploadid'] = $uploadId;
            $this->reqData['uploadId'] = $uploadId;
        } else {
            throw new CosException('上传ID不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $startIndex
     * @throws \Exception\QCloud\CosException
     */
    public function setStartIndex(int $startIndex){
        $this->startIndex = $startIndex;
        if($startIndex > 0){
            $this->reqData['part-number-marker'] = $startIndex;
        } else {
            throw new CosException('起始索引不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \Exception\QCloud\CosException
     */
    public function setLimit(int $limit){
        if(($limit > 0) && ($limit <= 1000)){
            $this->reqData['max-parts'] = $limit;
        } else {
            throw new CosException('条目数不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(strlen($this->objectKey) == 0){
            throw new CosException('对象名称不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if(!isset($this->reqData['uploadId'])){
            throw new CosException('上传ID不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $this->setReqQuery($this->reqData);

        return $this->getContent();
    }
}