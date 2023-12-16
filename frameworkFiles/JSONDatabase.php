<?php

class JSONDatabase extends Database
{
    /**
     * JSONDatabase is a class that implements the Database abstract class
     * @var string $file: the file to store the database
     * @var array $data: the data in the database
     */
    public $file = "";
    public $data = [];
    public function __construct($file)
    {
        /**
         * Constructor
         * @param $file: the file to store the database
         */
        $this->file = $file;
    }

    public function open(){
        /**
         * Opens the database
         */
        try {
            $this->data = json_decode(file_get_contents($this->file), true);

        }
        catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function save(){
        /**
         * Saves the database
         */
        file_put_contents($this->file, json_encode($this->data));
    }

    public function add($object){
        /**
         * Adds an object to the database
         * @param $object: the object to add
         */
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

    public function edit($object){

    }

    public function get($object, $where){
        /**
         * Gets an object from the database
         * @param $object: the object to get
         * @param $where: the where clause
         */
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

    public function deleteWhere($object, $where){
        /**
         * Deletes an object from the database
         * @param $object: the object to delete
         * @param $where: the where clause
         */
        try{

            $this->data[$object::class] = array_filter($this->data[$object::class], function ($object) use ($where){
                return !$where($object);
            });
        }
        catch (Error $e){
        }
    }

    public function delete($object){
        /**
         * Deletes an object from the database
         * @param $object: the object to delete
         */
        try{
            $this->data[$object::class] = array_filter($this->data[$object::class], function ($objectInDatabase) use ($object){
                return $objectInDatabase["id"] != $object->id;
            });
        }
        catch (Error $e){
        }
    }



}