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

}
