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

# Вывести всех постов
```php
$posts = $db->getAll('posts');
```
# Добавить пост
```php
$db->create('posts', [
    'title' => 'title'
]);
```
# Выводить поста
```php
$post = $db->getOne('posts',1);
```

# Изменить пост
```php
$post = $db->update('posts', [
    'title' => 'title',
    'id' => 1
]);
```
