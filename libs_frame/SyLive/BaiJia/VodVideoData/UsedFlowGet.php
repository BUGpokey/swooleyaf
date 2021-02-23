<?php
/**
 * 查询指定ID视频一段时间内使用的流量
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace SyLive\BaiJia\VodVideoData;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class UsedFlowGet
 * @package SyLive\BaiJia\VodVideoData
 */
class UsedFlowGet extends BaseBaiJia
{
    /**
     * 视频ID
     * @var int
     */
    private $video_id = 0;
    /**
     * 开始日期
     * @var string
     */
    private $start_date = '';
    /**
     * 结束日期
     * @var string
     */
    private $end_date = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_data/getUsedFlow';
    }

    private function __clone()
    {
    }

    /**
     * @param int $videoId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setVideoId(int $videoId)
    {
        if ($videoId > 0) {
            $this->reqData['video_id'] = $videoId;
        } else {
            throw new BaiJiaException('视频ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setDate(int $startTime, int $endTime)
    {
        if ($startTime <= 0) {
            throw new BaiJiaException('开始时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($startTime > $endTime) {
            throw new BaiJiaException('开始时间不能大于结束时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['start_date'] = date('Y-m-d', $startTime);
        $this->reqData['end_date'] = date('Y-m-d', $endTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['video_id'])) {
            throw new BaiJiaException('视频ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_date'])) {
            throw new BaiJiaException('开始时间不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
