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