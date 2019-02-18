<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use Constant\ErrorCode;
use Constant\Project;
use Constant\Server;
use Exception\Validator\ValidatorException;
use SyServer\BaseServer;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringSyToken extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_SY_TOKEN;
    }

    private function __clone() {
    }

    public function validator($data, $compareData) : string {
        $checkRes = true;
        if (in_array(SY_SERVER_TYPE, [Server::SERVER_TYPE_API_GATE, Server::SERVER_TYPE_FRONT_GATE])) {
            $expireTime = BaseServer::getServerConfig('token_etime', 0);
            if (time() >= $expireTime) {
                $checkRes = false;
            }
        }

        if ($checkRes) {
            return '';
        } else {
            throw new ValidatorException('令牌已过期', ErrorCode::COMMON_SERVER_TOKEN_EXPIRE);
        }
    }
}