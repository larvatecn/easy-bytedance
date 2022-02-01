<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace EasyBytedance;

/**
 * Class Factory.
 *
 * @method static \EasyBytedance\MiniProgram\Application miniProgram(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array  $config
     *
     * @return \Larva\EasySDK\ServiceContainer
     */
    public static function make($name, array $config)
    {
        $namespace = \Larva\EasySDK\Support\Str::studly($name);
        $application = "\\EasyBytedance\\{$namespace}\\Application";
        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}