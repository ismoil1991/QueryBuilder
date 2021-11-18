1. Подключаем БД
include "database/Connection.php";
QueryBuilder(
  Connection::make('mysql:host=localhost;','components;','utf8;','root','root')
);

2. В точке входа
$db = include 'database/start.php';

$posts = $db->getAll('posts');
