<?php

namespace core;

use PDO;
use PDOException;

/**
 * CFD
 * create
 * find
 * delete
 */
class ActiveRecord extends DataBase
{

    public function save()
    {
        $queryData = get_object_vars($this);
        $query = $this->getSqlQuery($queryData);
        $data = $this->prepareDataForQuery($queryData);
        return self::runQuery($query, $data);
    }

    public static function find()
    {
        return new QueryBuilder(get_called_class());
    }

    public function delete()
    {
        $deleteRecord = property_exists($this, 'id');
        if ($deleteRecord) {
            $queryData = get_object_vars($this);
            $table = $this::tableName();
            $queryString = "DELETE FROM `$table` WHERE `id` = :id";
            $data = $this->prepareDataForQuery($queryData);
            $recordID = array_slice($data, -1, 1);
            self::runQuery($queryString, $recordID);
        }
    }

    private function getSqlQuery($queryData)
    {
        $updateRecord = property_exists($this, 'id');
        $table = $this::tableName();

        if ($updateRecord) {
            unset($queryData['id']);
            $setString = '';
            foreach ($queryData as $field => $value) {
                if ($value == null) {
                    continue;
                }
                $setString .= "`$field` = :$field,";
            }
            $setString = substr($setString, 0, -1);
            return "UPDATE $table SET $setString WHERE `id` = :id";
        } else {
            $values = '';
            $fields = '';
            foreach ($queryData as $field => $value) {
                if ($value == null) continue;
                $fields .= "`$field`,";
                $values .= ":$field,";
            }
            $values = substr($values, 0, -1);
            $fields = substr($fields, 0, -1);
            return "INSERT INTO `$table`($fields) VALUES ($values)";
        }
    }

    private function prepareDataForQuery($queryData)
    {
        $new_arr = [];
        foreach ($queryData as $field => $value) {
            if ($value == null) continue;
            $new_arr[':' . $field] = $value;
        }
        return $new_arr;
    }

}