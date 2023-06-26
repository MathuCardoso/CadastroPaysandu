<?php


class Connection
{
    private static $conn = null;


    public static function getConnection()
    {
        if (self::$conn == null) {
            $opcoes = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            self::$conn = new PDO(
                "mysql:host=localhost;dbname=dbplayer",
                "root",
                "",
                $opcoes
            );
        }

        return self::$conn;
    }
}
