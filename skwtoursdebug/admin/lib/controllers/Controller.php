<?php
class Controller{
    protected $db = null;
    protected $log = null;
    public function __construct($db, $logger)
    {

    	
        $this->db = $db;
        $this->log = $logger;
    }
}