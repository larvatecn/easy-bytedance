<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace EasyBytedance\MiniProgram\QRCode;

use EasyBytedance\MiniProgram\BaseClient;

/**
 * Class Client
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Client extends BaseClient
{

    /**
     * 创建二维码
     * @param array $params
     * @return array|\Larva\EasySDK\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Larva\EasySDK\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $params = [])
    {
        return $this->asJson()->acceptJson()->post('/api/apps/qrcode',$params);
    }
}