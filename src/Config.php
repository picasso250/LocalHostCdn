<?php

class Config
{
    public static function get($key)
    {
        static $config;
        if ($config === null) {
            $config = self::loadConfig();
        }
        $chain = explode('.', $key);
        $i = 0;
        $c = $config;
        while (isset($chain[$i])) {
            $k = $chain[$i];
            if (isset($c[$k])) {
                $c = $c[$k];
            } else {
                return null;
            }
        }
        return $c;
    }

    public static function loadConfig()
    {
        $config = json_decode(file_get_contents('config.default.json'), true);
        $file = 'config.user.json';
        if (file_exists($file)) {
            $user_config = json_decode(file_get_contents($file), true);
            $config = array_merge($config, $user_config);
        }
        return $config;
    }
}
