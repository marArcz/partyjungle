<?php

declare(strict_types=1);
const USER_SESSION_NAME = "party_jungle_user";

session_start();
include_once './conn/conn.php';
class Session
{
    public static function redirectTo(string $url)
    {
        return header("location: $url");
    }
    public static function insertSession(string $key, string $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function hasSession(string $key)

    {
        return isset($_SESSION[$key]);
    }
    public static function insertSuccess(string $message)
    {
        self::insertSession("success",$message);
    }


    public static function saveUserSession(int $userId)
    {
        $_SESSION[USER_SESSION_NAME] = $userId;
    }

    public static function getUser()
    {
        if (!isset($_SESSION[USER_SESSION_NAME])) {
            return null;
        }
        global $con;
        //get user
        $user_id = $_SESSION[USER_SESSION_NAME];
        $query = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id");

        if ($query->num_rows == 0) {
            //if no user found
            return null;
        } else {
            $user = $query->fetch_assoc();
            return $user;
        }
    }

    public static function insertError(string $message = "Something went wrong, please try again later!")
    {
        self::insertSession("error",$message);
    }

    public static function getSession(string $key, bool $remove = true)
    {
        $val = $_SESSION[$key];
        if ($remove) {
            unset($_SESSION[$key]);
        }

        return $val;
    }

    public static function getSuccess(bool $remove = true)
    {
        return self::getSession("success", $remove);
    }

    public static function getError(bool $remove = true)
    {
        return self::getSession("error", $remove);
    }


    public static function removeSession(string $key){
        unset($_SESSION[$key]);
    }

    public static function destroyUserSession(){
        if(self::getUser() !== null){
            self::removeSession(USER_SESSION_NAME);
        }
    }
}
