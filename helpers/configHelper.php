<?php
/**
 *
 * Config helper class
 *
 */
class configHelper
{
    const CONFIG_PATH = "config/local.json";

    /**
     *
     * Returns the configuration from the JSON file per the key requested
     *
     * @param   string  $key The key to retrieve from the config
     * @throws  Exception If no config or key exists
     * @return  array
     *
     */
    public function getConfig($key)
    {
        if (!file_exists(self::CONFIG_PATH))
        {
            throw new Exception('Config File does not exists');
        }

        $config = json_decode(file_get_contents(self::CONFIG_PATH), true);

        if (!array_key_exists($key, $config))
        {
            throw new Exception('Config '. $key .' does not exists');
        }

        return $config[$key];
    }

}
