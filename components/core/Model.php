<?php

/* 
 * Copyright (C) 2021 themhz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace swaf\components\core;
use swaf\components\handlers\Database;

class Model
{

    protected $__tablename;

    public function __construct(string $tablename)
    {
        $this->__tablename = $tablename;
    }

    public function loadData($data)
    {

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if(isset($value)){
                    $this->{$key} = $value;
                }                
            }
        }
    }

    public function select(array $params = []): array
    {
        $first = true;
        $db = Database::getInstance();
        $sql = "select * from $this->__tablename ";
        foreach ($params  as $key => $value) {
            if ($first == true) {
                $first = false;
                $sql .= " where $key ";
            } else {

                $sql .= " $key ";
            }

            if (is_numeric($value)) {
                $sql .= $value;
            } else {
                $sql .= "'" . $value . "'";
            }
        }
             
        $sth = $db->dbh->prepare($sql);
        $sth->execute();
        $results = $sth->fetchAll(\PDO::FETCH_OBJ);

        return $results;
    }

    public function update(): array
    {
        $db = Database::getInstance();
        $sql = "update $this->__tablename set ";

        $params = array();
        $first = true;
        foreach ($this as $key => $value) {
            if (!empty($value) && $key != 'id' && $key != '__tablename') {
                $params += [$key => $value];

                if ($first == true) {
                    $sql .= "$key = :$key ";
                    $first = false;
                } else {
                    $sql .= ",$key = :$key ";
                }
            }
        }

        if (empty($this->id)) {
            return ['result' => false];
        }
        $params['id'] = $this->id;
        $sql .= "where id = :id ";

        $sth = $db->dbh->prepare($sql);

        $sth->execute($params);

        $count = $sth->rowCount();

        if ($count == '0') {
            return ['result' => false];
        } else {
            return ['result' => true];
        }
    }

    public function insert(): int
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO $this->__tablename (";
        $sqlValues = " values (";

        $params = array();
        $first = true;
        foreach ($this as $key => $value) {
            if (!empty($value) && $key != 'id' && $key != '__tablename') {
                $params += [$key => $value];

                if ($first == true) {
                    $sql .= "$key ";
                    $sqlValues .= ":$key ";
                    $first = false;
                } else {
                    $sql .= ",$key";
                    $sqlValues .= ",:$key ";
                }
            }
        }
        $sql .= ', regdate)';
        $sqlValues .= ' , :regdate)';
        $sql = $sql . $sqlValues;
        
        $sth = $db->dbh->prepare($sql);
        $params['regdate'] = date("Y-m-d H:i:s");

        $sth->execute($params);

        return $db->dbh->lastInsertId();
    }
}
