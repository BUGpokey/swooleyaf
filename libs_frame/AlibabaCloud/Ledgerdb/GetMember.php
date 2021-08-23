<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getLedgerId()
 * @method $this withLedgerId($value)
 * @method string getMemberId()
 * @method $this withMemberId($value)
 */
class GetMember extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
