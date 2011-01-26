<?php

class Base_Model extends CI_Model
{

    public $mongodb_conn;
    public $mongodb;
    private $database;

    public $groups_collection;
    public $posts_collection;
    public $user_collection;

    public function  __construct()
    {
        parent::__construct();

        $conf = Spyc::YAMLLoad(APPPATH.'config/mongo_config.yml');
        $full_host = '';
        if($conf['username'] != '' && $conf['password'] != '')
        {
            $full_host = $conf['username'].':'.$conf['passowrd'].'@'.$conf['hostname'];

        }
        else
        {
            $full_host = $conf['hostname'];
        }
        
        $this->database = $conf['database'];
        $this->mongodb_conn = new Mongo('mongodb://'.$full_host);
        $this->mongodb = $this->mongodb_conn->selectDB($this->database);

        $this->groups_collection = $this->mongodb->{"groups"};
        $this->posts_collection = $this->mongodb->{"posts"};
        $this->user_collection = $this->mongodb->{"users"};
    }


}

?>
