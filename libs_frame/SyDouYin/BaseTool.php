<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:38
 */

namespace SyDouYin;

/**
 * Class BaseTool
 *
 * @package SyDouYin
 */
abstract class BaseTool extends Base
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
    }
}
