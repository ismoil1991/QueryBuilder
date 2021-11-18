# Подключаем БД

```php
include "database/Connection.php";
QueryBuilder(
  Connection::make('mysql:host=localhost;','components;','utf8;','root','root')
);
```
# В точке входа
```php
$db = include 'database/start.php';
```
# Использовать
```php
$posts = $db->getAll('posts');

$db->create('posts', [
    'title' => 'title'
]);

$post = $db->getOne('posts',1);

$post = $db->update('posts', [
    'title' => 'title',
    'id' => 1
]);
```
