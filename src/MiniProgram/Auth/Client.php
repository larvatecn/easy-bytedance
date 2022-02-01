<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace EasyBytedance\MiniProgram\Auth;

use EasyBytedance\MiniProgram\BaseClient;

/**
 * Class Client
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Client extends BaseClient
{

    /**
     * Get session info by code.
     *
     * @param string $code
     * @param string|null $anonymous_code
     * @return \Psr\Http\Message\ResponseInterface|\Larva\EasySDK\Support\Collection|array|object|string
     * @throws \Larva\EasySDK\Exceptions\ConnectionException
     */
    public function session(string $code,string $anonymous_code = null)
    {
        $params = [
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['app_secret'],
            'code' => $code,
            'anonymous_code' => $anonymous_code
        ];
        return $this->acceptJson()->get('/api/apps/jscode2session', $params);
    }
}