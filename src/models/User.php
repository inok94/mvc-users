<?php
/**
 * Created by PhpStorm.
 * User: Inok94
 * Date: 7/11/2019
 * Time: 4:09 PM
 */

namespace App\src\models;

use DateTime;
use DateTimeZone;
use App\src\core\Model;

class User extends Model
{
    public $error;
    public $msg;

    /*public function contactValidate($post) {
        $nameLen = iconv_strlen($post['name']);
        $textLen = iconv_strlen($post['text']);
        if ($nameLen < 3 || $nameLen > 20) {
            $this->error = 'Имя должно содержать от 3 до 20 символов';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'E-mail указан неверно';
            return false;
        } elseif ($textLen < 10 or $textLen > 500) {
            $this->error = 'Сообщение должно содержать от 10 до 500 символов';
            return false;
        }
        return true;
    }*/
    public function usersCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM users');
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $cpassword
     * @return string
     */
    public function createUser(string $username, string $email, string $password, string $cpassword): string
    {
        $checkEmail = $this->db->rowCount("SELECT 1 FROM users WHERE email = '$email'");
        if ((int)$checkEmail > 0) {
            $this->msg = '<div class="alert alert-danger" role="alert">Email already exists</div>';
        } elseif ($password != $cpassword) {
            $this->msg = "<div class='alert alert-danger' role='alert'>Passwords doesn't match</div>";
        } else {
            $date = new DateTime("now", new DateTimeZone('Europe/Moscow'));
            $params = [
                'username' => $username,
                'email' => $email,
                'password' => md5($password),
                'create_at' => $date->getTimestamp(),
            ];
            $result = $this->db->query("INSERT INTO `users` (username, email, pass, create_at) 
                                            VALUES (:username,:email, MD5(:password), :create_at)", $params);
            if ($result) {
                $this->msg = '<div class="alert alert-success" role="alert">User Created Successfully.</div>>';
            }
        }
        return $this->msg;
    }

    /**
     * @param $id
     * @return array
     */
    public function getUserDataById(int $id)
    {
        $params = [
            'userId' => $id
        ];
        try {
            return $this->db->row("SELECT id, username, email, pass FROM users WHERE id = :userId", $params);
        } catch (\Exception $e) {
            $e->getMessage("User not found.");
        }
    }

    public function editUser(int $userId, string $username, string $email): string
    {
        $checkEmail = $this->db->rowCount("SELECT 1 FROM users WHERE email = '$email'");
        if ((int)$checkEmail > 0) {
            $this->msg = '<div class="alert alert-danger" role="alert">Email already exists</div>';
        }
        $date = new DateTime("now", new DateTimeZone('Europe/Moscow'));
        $params = [
            'userId' => $userId,
            'username' => $username,
            'email' => $email,
            'edit' => $date->getTimestamp(),
        ];
        $result = $this->db->query(
            "UPDATE users SET username = :username , email = :email,  edit_at = :edit WHERE id = :userId",
            $params);
        if($result) {
            $this->msg = '<div class="alert alert-success" role="alert">User update successfully.</div>';
        }
        return $this->msg;
    }

    public function editUserPassword(int $userId, string $password, string $cpassword):string
    {
        if ($password != $cpassword) {
            $this->msg = "<div class='alert alert-danger' role='alert'>Passwords doesn't match</div>";
            return $this->msg;
        }
        $date = new DateTime("now", new DateTimeZone('Europe/Moscow'));
        $params = [
            'userId' => $userId,
            'password' => md5($password),
            'edit' => $date->getTimestamp(),
        ];
        $result = $this->db->query("UPDATE users SET  pass = MD5(:password), edit_at = :edit WHERE id = :userId", $params);
        if ($result) {
            $this->msg = '<div class="alert alert-success" role="alert">User Created Successfully.</div>';
        }
        return $this->msg;
    }


    public function deleteUser(int $id)
    {
        $params = [
            'id' => $id
        ];
        return $this->db->column('DELETE * FROM users WHERE id = :id', $params);
    }

    private function quote($var)
    {
        $this->db->quote($var);
    }

    public function loginUser(string $email, string $pass): bool
    {
        try {
            $params = [
                'email' => $email,
                'password' => md5($pass),
            ];
            $this->db->query("SELECT * FROM users WHERE email = :email AND pass= :password", $params);
            throw new \Exception("User not found.");
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function usersList($route)
    {
        $maxRows = 10;
        $start = ((($route['page'] ?? 1) - 1) * $maxRows);
        $params = [
            'maxRows' => $maxRows,
            'start' => ((($route['page'] ?? 1) - 1) * $maxRows),
        ];
        $usersList = $this->db->row("SELECT * FROM users ORDER BY id ASC LIMIT {$start}, {$maxRows}");
        return $usersList;
    }
}