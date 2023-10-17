<?php

class JSONDatabase extends Database
{
    public $file = "";
    public $data = [];
    public function __construct($file)
    {
        $this->file = $file;
    }

    public function open(){
        try {
            $this->data = json_decode(file_get_contents($this->file), true);

        }
        catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function save(){
        file_put_contents($this->file, json_encode($this->data));
    }

    public function add($object){
        $dbObject = new DatabaseObject();
        $dbObject->object = $object;
        echo !isset($this->data[$object::class]);
        $dbObject->id=!isset($this->data[$object::class]) ? 0 : count($this->data[$object::class]);
        $valueToWrite = json_decode(json_encode($object, true), true);
        $valueToWrite["id"] = $dbObject->id;
        $this->data[$object::class][] = $valueToWrite;

    }

    public function edit($object){

    }

    public function get($object, $where){
        try{
            $listOfValues = array_values(array_filter($this->data[$object::class], $where));
            return array_map(function ($value) use ($object){
                $object = new $object();
                foreach ($value as $key => $item){
                    $object->{$key} = $item;
                }
                return $object;
            }, $listOfValues);

        }
        catch (Error $e){
            return [];
        }
    }

    public function deleteWhere($object, $where){
        try{

            $this->data[$object::class] = array_filter($this->data[$object::class], function ($object) use ($where){
                return !$where($object);
            });
        }
        catch (Error $e){
        }
    }

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