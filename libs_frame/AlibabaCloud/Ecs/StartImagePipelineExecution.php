<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getImagePipelineId()
 * @method $this withImagePipelineId($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getTemplateTag()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class StartImagePipelineExecution extends Rpc
{
    /**
     * @return $this
     */
    public function withTemplateTag(array $templateTag)
    {
        $this->data['TemplateTag'] = $templateTag;
        foreach ($templateTag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Key'])) {
                $this->options['query']['TemplateTag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['TemplateTag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }
}
