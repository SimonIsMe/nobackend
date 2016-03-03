<?php namespace nobackend;

class Config
{
    private static $_cached = [];

    private function __construct()
    {
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public static function get(string $key)
    {
        $parts = explode('.', $key);
        if (false == isset(self::$_cached[$parts[0]])) {
            self::$_cached[$parts[0]] = require __DIR__ . '/../../Configs/' . $parts[0] . '.php';
        }

        return self::_getRecursive($parts, self::$_cached);
    }

    /**
     * @param array $parts
     * @param array &$arrayConfig
     *
     * @return mixed
     */
    private static function _getRecursive(array $parts, array &$arrayConfig)
    {
        if (empty($parts)) {
            return null;
        }

        if (1 == count($parts)) {
            if (isset($arrayConfig[$parts[0]])) {
                return $arrayConfig[$parts[0]];
            }
            return null;
        }

        $firstPart = array_shift($parts);
        return self::_getRecursive($parts, $arrayConfig[$firstPart]);
    }
}