<?php

require_once 'Medoo.php';

use Medoo\Medoo;

class TblUsers
{

    public function connect()
    {
        $database = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => 'sitenv2',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '',
        ]);
        return $database;
    }

    public function getUsers()
    {
        $result = $this->connect()->select('users', '*');
        return $result;
    }

    public function getUserById($id)
    {
        $result = $this->connect()->get('users', '*', ['id' => $id]);
        return $result;
    }

    public function verifyAccess($email, $password)
    {
        $result = $this->connect()->get('users', '*', [
            "email" => $email
        ]);
        var_dump($result['id']);
        $access = password_verify($password, $result["password"]);
        return $access;
    }

    public function insertUser($user)
    {
        $this->connect()->insert('users', [
            'lname' => $user["lname"],
            'fname' => $user["fname"],
            'email' => $user["email"],
            'password' => $user["password"],
            'status' => $user["status"],
        ]);
    }

    public function deleteUserById($id)
    {
        $this->connect()->delete('users', [
            'id' => $id
        ]);
    }

    public function updateUserAtId($user, $id)
    {
        $data = [
            'lname' => $user["lname"],
            'fname' => $user["fname"],
            'email' => $user["email"],
            'password' => $user["password"],
            'status' => $user["status"],
        ];

        if (empty($user['password'])) {
            unset($data['password']);
        };

        $this->connect()->update('users', $data, ['id' => $id]);
    }
}
