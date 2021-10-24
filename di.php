<?php

class Database
{
    protected $adapter;
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }
}

interface Adapter
{

}

class MysqlAdapter implements Adapter
{

}

class MongoAdapter implements Adapter
{

}