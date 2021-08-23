<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getInstanceId()
 * @method string getProtectedFromScaleIn()
 * @method $this withProtectedFromScaleIn($value)
 */
class SetInstancesProtection extends Rpc
{
    /**
     * @return $this
     */
    public function withInstanceId(array $instanceId)
    {
        $this->data['InstanceId'] = $instanceId;
        foreach ($instanceId as $i => $iValue) {
            $this->options['query']['InstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
