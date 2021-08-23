<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getGroupName()
 */
class InsertDeployGroup extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/deploy_group';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupName($value)
    {
        $this->data['GroupName'] = $value;
        $this->options['query']['GroupName'] = $value;

        return $this;
    }
}
