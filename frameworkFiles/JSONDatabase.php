<?php

/**
 * JSONDatabase is a class that implements the Database abstract class
 * @var string $file: the file to store the database
 * @var array $data: the data in the database
 */
class JSONDatabase extends Database
{
    /**
     * @var string $file The file where the database is JSON file path
     */
    public $file = "";
    public $data = [];

    /**
     * Constructor
     * @param $file: the file to store the database
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Opens the database
     */
    public function open(){
        try {
            $this->data = json_decode(file_get_contents($this->file), true);

        }
        catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Saves the database
     */
    public function save(){
        file_put_contents($this->file, json_encode($this->data));
    }


    /**
     * Adds an object to the database
     * @param $object: the object to add
     */
    public function add($object){
        $dbObject = new DatabaseObject();
        $dbObject->object = $object;
//        echo !isset($this->data[$object::class]);
        $dbObject->id=!isset($this->data[$object::class]) ? 0 : count($this->data[$object::class]);
        $valueToWrite = json_decode(json_encode($object, true), true);
        $valueToWrite["id"] = $dbObject->id;
        $this->data[$object::class][] = $valueToWrite;
        $object->id = $dbObject->id;
        return $object;

    }
    /**
     * Edits an object in the database
     * @param $object: the object to edit
     * @param $key: the key to edit
     * @param $value: the value to edit
     */
    public function edit($object, $key, $value){
        $this->data[$object::class][$object->id][$key] = $value;
    }

    /**
     * Gets an object from the database
     * @param $object: the object to get
     * @param $where: the where clause
     */
    public function get($object, $where){
        try{
            $listOfValues = array_values(array_filter($this->data[$object::class], $where));
            return array_map(function ($value) use ($object){
                $object = new $object();
                foreach ($value as $key => $item){
                    $object->$key = $item;
                }
                return $object;
            }, $listOfValues);

        }
        catch (Error $e){
            return [];
        }
    }

    /**
     * Deletes an object from the database
     * @param $object: the object to delete
     * @param $where: the where clause
     */
    public function deleteWhere($object, $where){
        try{

            $this->data[$object::class] = array_filter($this->data[$object::class], function ($object) use ($where){
                return !$where($object);
            });
        }
        catch (Error $e){
        }
    }

    /**
     * Deletes an object from the database
     * @param $object: the object to delete
     */
    public function delete($object){
        try{
            $this->data[$object::class] = array_filter($this->data[$object::class], function ($objectInDatabase) use ($object){
                return $objectInDatabase["id"] != $object->id;
            });
        }
        catch (Error $e){
        }
    }



}