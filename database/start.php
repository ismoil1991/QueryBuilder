<?php
include __DIR__ . "/../database/QueryBuilder.php";
include __DIR__ . "/../database/Connection.php";

return new QueryBuilder(
    Connection::make('mysql:host=localhost;','components;','utf8;','root','root')
);