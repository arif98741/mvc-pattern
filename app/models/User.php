<?php

namespace app\models;

use app\core\libraries\Database;

class User extends Database
{
    public function getUsers()
    {
        $this->select();
    }
}