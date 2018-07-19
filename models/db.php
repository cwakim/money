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

    /**
     *
     * Inserts an associative data array into a table
     *
     * @param  string $table The table to insert into
     * @param  array $data Associative data array
     * @return  int|array
     *
     */
    public function insert($table, $data)
    {
        $link = $this->connect();

        $query = 'INSERT INTO '. $table .' (';
        $count = 1;
        foreach ($data as $key => $value) {
            $query .= "`". $key . "`";
            if ($count < sizeof($data))
            {
                $query .= ',';
            }
            $count++;
        }
        $query .= ') VALUES (';
        $count = 1;
        foreach ($data as $key => $value) {
            $query .= "'". $value ."'";
            if ($count < sizeof($data))
            {
                $query .= ',';
            }
            $count++;
        }
        $query .= ')';

        $result = mysqli_query($link, $query);
        $id = mysqli_insert_id($link);
        $this->close($link);

        if (!$result)
        {
            return mysql_error();
        }

        return $id;
    }

    /**
     *
     * Selects an item using the id label and id
     *
     * @param  string $table The table to insert into
     * @param  string $idLabel The id label
     * @param  string $id The id
     * @return  int|array
     *
     */
    public function select($table, $idLabel, $id)
    {
        $link = $this->connect();

        $query = 'SELECT * FROM '. $table .' WHERE '. $idLabel .' = '. $id;
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) < 0)
        {
            $this->close($link);
            return false;
        }

        $result = mysqli_fetch_assoc($result);
        $this->close($link);

        return $result;
    }

    /**
     *
     * Perform a raw query on the db
     *
     * @param  string $table The table to insert into
     * @param  string $idLabel The id label
     * @param  string $id The id
     * @return  int|array
     *
     */
    public function query($query)
    {
        $link = $this->connect();

        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) < 0)
        {
            $this->close($link);
            return false;
        }

        $resultArray = array (
            'count' => mysqli_num_rows($result),
            'items' => array()
        );

        while($row = mysqli_fetch_assoc($result))
        {
            $resultArray['items'][] = $row;
        };
        $this->close($link);

        return $resultArray;
    }

}
