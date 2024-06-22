<?php

namespace App\Models;
use PDO;
class Model
{
    protected $connect;
    protected $query;

    public function __construct() {
        $this->connect = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
            DB_USER,
            DB_PASSWORD,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

            )
        );
    }
    public function select(array | string $columns, string $get_table) {
        $select_columns = is_array($columns) ? implode(',', $columns) : $columns;
        return $this->query = 'SELECT ' . $select_columns . ' FROM ' . $get_table;
    }

    public function get($column, $table) {
        return $this->connect->query($this->select($column, $table));
    }

    public function where(string $key, string $operation, string $value) {
        return $this->query . "$key $operation $value";
    }

    public function custom_query($sql) {
        return $this->connect->query($sql)->fetchAll();
    }

    public function getCountRows($table, $where = "") {
        $data = $this->connect->query("SELECT * FROM $table WHERE $where");
        return $data->rowCount();
    }

    public function find($id, $table) {
        return $this->connect->query("SELECT * FROM $table WHERE $id")->fetch();
    }

    public function user_exists($email, $table = 'users') {
        $stmt = $this->connect->prepare("SELECT * FROM $table WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() == 1;
    }

    public function create(array | string $columns, array | string $values, $table) {

        $cols = is_array($columns) ? implode(',', $columns) : $columns;
        $fields = [];
        for($i = 0; $i < count($columns); $i++) {
            array_push($fields, "?");
        }
        $fields = implode(',', $fields);
        $stmt = $this->connect->prepare("INSERT INTO $table ($cols) VALUES ($fields)");
        $stmt->execute($values);
        return true;
    }
}