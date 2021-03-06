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
 * 复制对象的分块内容
 * @package QCloud\Cos
 */
class PartCopyUpload extends CloudBaseCos {
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
     * 上传编号
     * @var int
     */
    private $partNumber = 0;

    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
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
            $this->uploadId = $uploadId;
            $this->signParams['uploadid'] = $uploadId;
        } else {
            throw new CosException('上传ID不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $partNumber
     * @throws \Exception\QCloud\CosException
     */
    public function setPartNumber(int $partNumber){
        if(($partNumber > 0) && ($partNumber <= 10000)){
            $this->partNumber = $partNumber;
        } else {
            throw new CosException('上传编号不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(strlen($this->objectKey) == 0){
            throw new CosException('对象名称不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if(strlen($this->uploadId) == 0){
            throw new CosException('上传ID不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if($this->partNumber == 0){
            throw new CosException('上传编号不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if(!isset($this->reqHeader['x-cos-copy-source'])){
            throw new CosException('源对象URL路径不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $this->setReqQuery([
            'uploadId' => $this->uploadId,
            'partNumber' => $this->partNumber,
        ]);

        return $this->getContent();
    }
}