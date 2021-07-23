<?php

namespace App\Repository;

use Core\Database;
use PDO;
use PropertyNotFoundException;

class Model
{
    // Méthodes getBy() et getAll() pour récupérer les posts et les commentaires create, update et delete (CRUD) pour gérer les posts et les commentaires

    private $table;
    private $object;
    protected $database;

    public function __construct($table, $object, $datasource)
    {
        $this->table = $table;
        $this->object = $object;
        $this->database = Database::getInstance($datasource);
    }

    public function getById($id)
    {
        $req = $this->database->prepare("SELECT * FROM " . $this->table . " WHERE id=?");
        $req->execute(array($id));
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->obj);
        return $req->fetch();
    }

    public function getAll()
    {
        $req = $this->database->prepare("SELECT * FROM " . $this->table);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->obj);
        return $req->fetch();
    }

    public function create($obj, $param)
    {
        $paramNumber = count($param);
        $valueArray = array_fill(1, $paramNumber, "?");
        $valueString = implode(", ", $valueArray);
        $sql = "INSERT INTO " . $this->_table . "(" . implode(", ", $param) . ") VALUES(" . $valueString . ")";
        $req = $this->database->prepare($sql);
        $boundParam = array();
        foreach ($param as $paramName) 
        {
            if (property_exists($obj, $paramName))
            {
                $boundParam[$paramName] = $obj->$paramName;
            }
            else {
                throw new PropertyNotFoundException($this->object, $paramName);
            }
        }
        $req->execute($boundParam);
    }

    public function update($obj, $param)
    {
        $sql = "UPDATE " . $this->table . " SET ";
        foreach ($param as $paramName)
        {
            $sql = $sql . $paramName . " = ?, ";
        }
        $sql = $sql . " WHERE id = ? ";
        $req = $this->database->prepare($sql);
        $boundParam = array();
        foreach ($param as $paramName)
        {
            if (property_exists($obj, $paramName))
            {
                $boundParam[$paramName] = $obj->$paramName;
            }
            else {
                throw new PropertyNotFoundException($this->object, $paramName);
            }
        }
        $req->executed($boundParam);
        
    }

    public function delete($obj)
    {
        if (property_exists($obj, 'id'))
        {
            $req = $this->database->prepare("DELETE * FROM " . $this->table . " WHERE id=?");
            return $req->execute(array($obj->id));
        }
        else
        {
            throw new PropertyNotFoundException($this->object, "id");
        }
    }
}