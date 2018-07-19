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

    /**
     *
     * Add points to a user
     *
     * @param  int $userId User Id
     * @param  int $amount The table to insert into
     * @return  int|array
     *
     */
    public function addUserPoint($userId, $amount)
    {
        return $this->db->insert(
            'user_point',
            array(
                'user_id' => $userId,
                'amount' => $amount
            )
        );
    }

}
