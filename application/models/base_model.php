<?php

class Base_Model extends CI_Model
{

    public $mongodb_conn;
    public $mongodb;
    private $database;

    public $user_collection;
    public $vehicle_collection;
    public $event_collection;
    public $event_vehicles;
    

    public function  __construct()
    {
        parent::__construct();

        $conf = Spyc::YAMLLoad(APPPATH.'config/mongo_config.yml');
        $full_host = '';
        if($conf['username'] != '' && $conf['password'] != '')
        {
            $full_host = $conf['username'].':'.$conf['password'].'@'.$conf['hostname'].'/'.$conf['database'];

        }
        else
        {
            $full_host = $conf['hostname'];
        }
        
        $this->database = $conf['database'];
        $this->mongodb_conn = new Mongo('mongodb://'.$full_host);
        $this->mongodb = $this->mongodb_conn->selectDB($this->database);

        $this->user_collection = $this->mongodb->{'users'};
        $this->vehicle_collection = $this->mongodb->{'vehicles'};
        $this->event_collection = $this->mongodb->{'events'};
        $this->event_vehicles = $this->mongodb->{'event_vehicles'};
        

    }


}

?>
