<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/16/11
 * Time: 9:52 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_model.php');
class Group_Model extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_groups()
    {
        $results = $this->groups_collection->find()->sort(array('group_name', 1));

        if($results != NULL)
        {
            $groups = array();

            foreach($results as $result)
            {
                $groups[] = $result;
            }

            return $groups;
        }
        else
        {
            return false;
        }
    }

    public function get_group_for_id($id)
    {
        $results = $this->groups_collection->find(array('group_id' => $id));

        if($results != NULL)
        {
            $group = array();

            foreach($results as $result)
            {
                $group = $result;
            }

            return $group;
        }
        else
        {
            return false;
        }
    }

    public function create_group($data)
    {
        $data['group_id'] = $this->generate_group_id();

        try
        {
            $this->groups_collection->insert($data, true);
        }
        catch(MongoCursorException $e)
        {
            // handle error
            return false;
        }

        return true;
    }

    private function generate_group_id()
    {
         $id = '';
         for($i = 0; $i < 9; $i++)
         {
             $id .= rand(0, 10);
         }

         $result = $this->get_group_for_id($id);

         if($result != false)
         {
             // if it already exists, run it again
             return $this->generate_group_id();
         }
         else
         {
             return $id;
         }
    }


}
?>
 
