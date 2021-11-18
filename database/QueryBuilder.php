<?php


class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll($table)
    {
        return $this->doSelect('SELECT', $table, null);
    }

    public function create($table, $data)
    {
        return $this->doInsert('UPDATE', $table, $data);
    }

    public function getOne($table, $id)
    {
        return $this->doSelect('SELECT', $table, $id);
    }

    public function update($table, $id, $data)
    {
        return $this->doUpdate('UPDATE', $table, $id, $data);
    }

    public function delete($table, $id)
    {
        return $this->doDelete('DELETE', $table, $id);
    }

    public function doSelect($action, $table, $id)
    {
        if (empty($id)) {
            $sql = "{$action} * FROM {$table}";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "{$action} * FROM {$table} WHERE id=:id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute(['id' => $id]);

            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function doInsert($action, $table, $data)
    {
        $keys = implode(',', array_keys($data));
        $tags = ":" . implode(', :', array_keys($data));
        $sql = "{$action} INTO {$table} ({$keys}) VALUES ({$tags})";
        $statement = $this->pdo->prepare($sql);

        return $statement->execute($data);
    }

    public function doUpdate($action, $table, $id, $data)
    {
        $keys = array_keys($data);
        $str = '';
        foreach ($keys as $key) {
            $str .= $key . '=:' . $key . ',';
        }
        $keys = rtrim($str, ",");
        $data['id'] = $id;
        $sql = "{$action} {$table} SET {$keys} WHERE id=:id";
        $statement = $this->pdo->prepare($sql);

        return $statement->execute($data);
    }

    public function doDelete($action, $table, $id)
    {
        if (empty($id)) {
            $sql = "{$action} * FROM {$table}";
            $statement = $this->pdo->prepare($sql);

            return $statement->execute();
        } else {
            $sql = "{$action} * FROM {$table} WHERE id=:id";
            $statement = $this->pdo->prepare($sql);

            return $statement->execute(['id' => $id]);
        }
    }

}