<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getSecurityGroupId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 */
class ModifyInstanceVpcAttribute extends Rpc
{
    /**
     * @return $this
     */
    public function withSecurityGroupId(array $securityGroupId)
    {
        $this->data['SecurityGroupId'] = $securityGroupId;
        foreach ($securityGroupId as $i => $iValue) {
            $this->options['query']['SecurityGroupId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
