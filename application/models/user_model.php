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

    public function user_exists($username)
    {
        $results = $this->user_collection->find(array('username' => $username))->limit(1);

        $user = array();
        if($results->count() > 0)
        {
            foreach($results as $res)
            {
                $user = $res;
            }

            return $user;
        }
        else
        {
            return false;
        }
    }


    public function create_user($user_data)
    {
        $user_data['date_created'] = time();
        $user_data['user_id'] = $this->generate_user_id();

        try
        {
            $this->user_collection->insert($user_data, true);

            return $this->get_user_for_id($user_data['user_id']);
        }
        catch(MongoCursorException $e)
        {
            echo $e;
            return false;
        }
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