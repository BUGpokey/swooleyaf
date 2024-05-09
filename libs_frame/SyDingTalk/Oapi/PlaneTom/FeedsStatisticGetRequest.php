<?php

namespace SyDingTalk\Oapi\PlaneTom;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.planetom.feeds.statistic.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.26
 */
class FeedsStatisticGetRequest extends BaseRequest
{
    /**
     * 主播在对应组织的id(staffId)
     */
    private $anchorId;
    /**
     * 课程id
     */
    private $feedId;

    public function setAnchorId($anchorId)
    {
        $this->anchorId = $anchorId;
        $this->apiParas['anchor_id'] = $anchorId;
    }

    public function getAnchorId()
    {
        return $this->anchorId;
    }

    public function setFeedId($feedId)
    {
        $this->feedId = $feedId;
        $this->apiParas['feed_id'] = $feedId;
    }

    public function getFeedId()
    {
        return $this->feedId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.planetom.feeds.statistic.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->anchorId, 'anchorId');
        RequestCheckUtil::checkNotNull($this->feedId, 'feedId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
