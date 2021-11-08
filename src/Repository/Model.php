<?php

namespace App\Repository;

use Core\Database;
use PDO;
use PropertyNotFoundException;

class Model
{
    private $table;
    private $object;
    protected $database;

    public function __construct($table, $object, $datasource)
    {
        $this->table = $table;
        $this->object = $object;
        $this->database = Database::getInstance($datasource);
    }

    /**
     * Get everything from a specific table by id
     * 
     * @param int $id
     * 
     * @return mixed
     */
    public function getById($id)
    {
        $req = $this->database->prepare("SELECT * FROM " . $this->table . " WHERE id = ?");
        $req->execute(array($id));
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->obj);
        return $req->fetch();
    }

    /**
     * Get everything from a specific table
     * 
     * @return mixed
     */
    public function getAll()
    {
        $req = $this->database->prepare("SELECT * FROM " . $this->table);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->obj);
        return $req->fetch();
    }

    /**
     * Creates an object 
     * 
     * @param mixed $obj
     * @param mixed $param
     * 
     * @throws PropertyNotFoundException
     * 
     * @return void
     */
    public function create($obj, $param): void
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

    /**
     * Updates a specific objects
     * 
     * @param mixed $obj
     * @param mixed $param 
     * 
     * @throws PropertyNotFoundException
     * 
     * @return void
     */
    public function update($obj, $param): void
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

    /**
     * Deletes a specific object
     * 
     * @param mixed $obj
     * 
     * @throws PropertyNotFoundException
     * 
     * @return mixed
     */
    public function delete($obj)
    {
        if (property_exists($obj, 'id'))
        {
            $req = $this->database->prepare("DELETE * FROM " . $this->table . " WHERE id = ?");
            return $req->execute(array($obj->id));
        }
        else
        {
            throw new PropertyNotFoundException($this->object, "id");
        }
    }
}