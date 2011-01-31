<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/17/11
 * Time: 1:43 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_model.php');
class User_Model extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create_user()
    {
        $data = array('username' => 'mcg1sean',
                      'user_id' => '123456789',
                      'full_name' => 'Sean McGary',
                      'password' => 'cf140b49ef7c487d32279fa7191df3b250c7904a',
                      'date_created' => time());

        try
        {
            $this->user_collection->insert($data, true);
        }
        catch(MongoCursorException $e)
        {
            echo $e;
        }
    }

    public function auth_user($username, $password)
    {
        $password = sha1($password);

        $results = $this->user_collection->find(array('username' => $username, 'password' => $password))->limit(1);

        if($results->count() > 0)
        {
            $user = array();
            foreach($results as $res)
            {
                $user = $res;
            }

            return $user;
        }

        return false;
    }

    public function get_user_for_id($id)
    {
        $results = $this->user_collection->find(array('user_id' => $id));

        if($results != NULL)
        {

            $user = null;
            foreach($results as $res)
            {
                $user = $res;
            }
        }
    }

    private function generate_user_id()
    {
         $id = '';
         for($i = 0; $i < 9; $i++)
         {
             $id .= rand(0, 10);
         }

         $result = $this->get_user_for_id($id);

         if($result != null)
         {
             // if it already exists, run it again
             return $this->generate_user_id();
         }
         else
         {
             return $id;
         }
    }
}