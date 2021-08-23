<?php

namespace AlibabaCloud\Green;

/**
 * @method string getClientInfo()
 */
class AddVideoDnaGroup extends Roa
{
    /** @var string */
    public $pathPattern = '/green/video/dna/group/add';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientInfo($value)
    {
        $this->data['ClientInfo'] = $value;
        $this->options['query']['ClientInfo'] = $value;

        return $this;
    }
}
