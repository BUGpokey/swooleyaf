<?php
/**
 * 获取标准存储的文件数量
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 10:29
 */
namespace QiNiu\Kodo\Statistics;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;
use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class StandardFileCount extends QiNiuBaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucket = '';
    /**
     * 起始时间戳
     * @var int
     */
    private $begin = 0;
    /**
     * 结束时间戳
     * @var int
     */
    private $end = 0;
    /**
     * 时间粒度
     * @var string
     */
    private $g = '';
    /**
     * 存储区域
     * @var string
     */
    private $region = '';

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('api.qiniu.com');
        $this->reqData = [
            'g' => 'day',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucket
     * @throws \SyException\QiNiu\KodoException
     */
    public function setBucket(string $bucket)
    {
        if (ctype_alnum($bucket)) {
            $this->reqData['bucket'] = $bucket;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $begin
     * @throws \SyException\QiNiu\KodoException
     */
    public function setBeginTime(int $begin)
    {
        if ($begin > 1000000000) {
            $this->reqData['begin'] = date('YmdHis', $begin);
        } else {
            throw new KodoException('起始时间不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $end
     * @throws \SyException\QiNiu\KodoException
     */
    public function setEndTime(int $end)
    {
        if ($end > 1000000000) {
            $this->reqData['end'] = date('YmdHis', $end);
        } else {
            throw new KodoException('结束时间不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $region
     * @throws \SyException\QiNiu\KodoException
     */
    public function setRegion(string $region)
    {
        if (isset(self::$totalRegionType[$region])) {
            $this->reqData['region'] = $region;
        } else {
            throw new KodoException('存储区域不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['begin'])) {
            throw new KodoException('起始时间不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['end'])) {
            throw new KodoException('结束时间不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/v6/count?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
