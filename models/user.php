<?php
/**
 *
 * User model
 *
 */
require_once 'models/db.php';

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    /**
     *
     * Creates a new user
     *
     * @param  string $username Username
     * @param  string $password Password
     * @param  string $fullname User fulll name
     * @return  int|boolean
     *
     */
    public function createUser($username, $password, $fullname)
    {
        return $this->db->insert(
            'user',
            array(
                'username' => $username,
                'password' => $password,
                'fullname' => $fullname
            )
        );
    }

}
