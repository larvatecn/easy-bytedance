<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace EasyBytedance\MiniProgram\Auth;

use Larva\EasySDK\AccessToken as BaseAccessToken;
use Psr\Http\Message\RequestInterface;

/**
 * Class AccessToken
 * @author Tongle Xu <xutongle@gmail.com>
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected $endpointToGetToken = 'https://developer.toutiao.com/api/apps/token';

    /**
     * {@inheritdoc}
     */
    protected function getCredentials(): array
    {
        return [
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['app_secret'],
            'grant_type' => 'client_credential',
        ];
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array $requestOptions
     * @return \Psr\Http\Message\RequestInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Larva\EasySDK\Exceptions\HttpException
     * @throws \Larva\EasySDK\Exceptions\InvalidArgumentException
     * @throws \Larva\EasySDK\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function applyToRequest(RequestInterface $request, array $requestOptions = []): RequestInterface
    {
        if ($request->getMethod() == 'POST') {
            if (($params = $this->isJson($request->getBody()->getContents())) != false) {
                $params = \GuzzleHttp\Utils::jsonEncode(array_merge($this->getQuery(), $params),JSON_UNESCAPED_UNICODE);
                return \GuzzleHttp\Utils::modifyRequest($request, ['body' => $params]);
            }
            parse_str($request->getBody()->getContents(), $params);
            $params = array_merge($this->getQuery(), $params);
            return modify_request($request, ['body' => $params]);
        } else {
            return parent::applyToRequest($request, $requestOptions);
        }
    }

    /**
     * ???????????????????????? Json ??????
     *
     * @param string $data Json ?????????
     * @param bool $assoc ?????????????????????????????????????????????
     *
     * @return array|bool|object ?????????????????????????????????????????????????????? false
     */
    protected function isJson($data = '', $assoc = true)
    {
        $data = json_decode($data, $assoc);
        if ($data && is_array($data)) {
            return $data;
        }
        return false;
    }

}