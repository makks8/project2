<?php

namespace core;

use PDO;

class QueryBuilder extends DataBase
{
    private $model;
    private $select = 'SELECT * ';
    private $queryData = [];
    private $where = '';

    public function getWhere(): string
    {
        return $this->where;
    }

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->getStatement()->fetchAll();
    }

    private function execute()
    {
        $tableName = $this->model::tableName();
        $from = " FROM `$tableName`";
        $queryString = $this->select . $from . $this->where;
        return self::runQuery($queryString, $this->queryData);
    }

    private function getStatement()
    {
        $stmt = $this->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->model);
        return $stmt;
    }

    public function one()
    {
        return $this->getStatement()->fetch();
    }

    public function select($select)
    {
        $this->select = 'SELECT ';
        foreach ($select as $field) {
            $this->select .= "`$field`,";
        }
        $this->select = substr($this->select, 0, -1);
        return $this;
    }

    public function where($queryData)
    {
        $this->where = ' WHERE ';
        $this->queryData = $queryData;
        foreach ($this->queryData as $field => $value) {
            $this->where .= "`$field` = :$field AND ";
        }
        $this->where = substr($this->where, 0, -5);
        return $this;
    }

}