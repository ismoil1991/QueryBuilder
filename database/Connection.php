<?php


class Connection
{
    public static function make($host, $dbname, $charset, $username, $password)
    {
        return new PDO("$host dbname={$dbname} $charset", "$username", "$password");
    }
}