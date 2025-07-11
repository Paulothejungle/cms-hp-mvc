<?php

require_once '../config/config.php';

class Database {
    private $dbh;   // database handler
    private $stmt;  // statement

    public function __construct() {
        $this->dbh = getDBConnection();
    }

    // Query SQL
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Binding data
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value): $type = PDO::PARAM_INT; break;
                case is_bool($value): $type = PDO::PARAM_BOOL; break;
                case is_null($value): $type = PDO::PARAM_NULL; break;
                default: $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Eksekusi query
    public function execute() {
        return $this->stmt->execute();
    }

    // Ambil semua data
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu data
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Hitung baris
    public function rowCount() {
        return $this->stmt->rowCount();
    }

    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }

    public function commit()
    {
        $this->dbh->commit();
    }

    public function rollBack()
    {
        $this->dbh->rollBack();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}
