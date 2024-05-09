<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.crm.objectmeta.customer.describe request
 *
 * @author auto create
 *
 * @since 1.0, 2021.11.22
 */
class ObjectMetaCustomerDescribeRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectmeta.customer.describe';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
