<?php

namespace App\Services;

abstract class BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->setRepository();
    }

    /*
     * Get Repository which need implement in each Repository
     * 
     *  @return void
     */
    abstract public function getRepository();

    /*
     * Set Repository
     * 
     * @return void
     */
    public function setRepository()
    {
        $this->repository = app()->make(
            $this->getRepository()
        );
    }

    
}
?>