<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 2/5/11
 * Time: 9:15 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_model.php');
class Vehicle_Model extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_vehicle_for_user($user_id)
    {
        $results = $this->vehicle_collection->find(array('user_id' => $user_id))->limit(1);

        if($results->count() > 0)
        {
            $vehicle = array();
            foreach($results as $res)
            {
                $vehicle = $res;
            }

            return $vehicle;
        }
        else
        {
            return false;
        }
    }

    public function insert($data)
    {
        $data['date_created'] = time();
        $data['vehicle_id'] = $this->generate_vehicle_id();

        try
        {
            $this->vehicle_collection->insert($data, true);

            return true;
        }
        catch(MongoCursorException $e)
        {
            return false;
        }
    }
    

    public function get_vehicle_for_id($id)
    {
        $results = $this->vehicle_collection->find(array('vehicle_id' => $id));

        if($results != NULL)
        {

            $vehicle = null;
            foreach($results as $res)
            {
                $vehicle = $res;
            }
        }
    }

    public function delete_user_vehicle($user_id)
    {
        $user_vehicle = $this->get_vehicle_for_user($user_id);
        try
        {
            $this->vehicle_collection->remove(array('vehicle_id' => $user_vehicle['vehicle_id']));
            $this->event_vehicles->remove(array('vehicle_id' => $user_vehicle['vehicle_id']));
            return true;
        }
        catch(MongoCursorException $e)
        {
            return $e;
        }
    }

    private function generate_vehicle_id()
    {
         $id = '';
         for($i = 0; $i < 9; $i++)
         {
             $id .= rand(0, 10);
         }

         $result = $this->get_vehicle_for_id($id);

         if($result != null)
         {
             // if it already exists, run it again
             return $this->generate_vehicle_id();
         }
         else
         {
             return $id;
         }
    }
}
