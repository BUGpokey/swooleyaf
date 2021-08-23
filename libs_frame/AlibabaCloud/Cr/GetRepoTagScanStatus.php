<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getRepoName()
 * @method $this withRepoName($value)
 * @method string getTag()
 * @method $this withTag($value)
 */
class GetRepoTagScanStatus extends Roa
{
    /** @var string */
    public $pathPattern = '/repos/[RepoNamespace]/[RepoName]/tags/[Tag]/scanStatus';
}
