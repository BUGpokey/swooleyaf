<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers;

use SyConstant\Project;
use SyMessageHandler\ConsumerBase;
use SyMessageHandler\ConsumerInterface;

/**
 * Class SmsYun253
 * @package SyMessageHandler\Consumers
 */
class SmsYun253 extends ConsumerBase implements ConsumerInterface
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_SMS_YUN253);
    }
}
