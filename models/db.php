<?php
/**
 *
 * Handles the connection to the database
 *
 */
require_once 'helpers/configHelper.php';

class DB
{
    protected $configHelper;

    public function __construct()
    {
        $configHelper = new configHelper();
        $this->configHelper = $configHelper->getConfig('db');
    }

    /**
     *
     * Connects to the database
     *
     * @throws  Exception If a mysql error occured
     * @return  mysqli_connect
     *
     */
    protected function connect()
    {
        $link = mysqli_connect(
            $this->configHelper['hostname'],
            $this->configHelper['username'],
            $this->configHelper['password'],
            $this->configHelper['db_name'],
            $this->configHelper['port']
        );

        if (!$link)
        {
            throw new Exception(mysqli_connect_error());
        }

        return $link;
    }

    /**
     *
     * Closes the connection to the database
     *
     * @param  mysqli_connect $link The mysql link to close
     * @return  boolean
     *
     */
    protected function close($link)
    {
        return mysqli_close($link);
    }

}
