<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 2/13/11
 * Time: 5:01 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_model.php');
class Event_Vehicles extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_vehicle_to_event($vehicle, $event_id)
    {
        unset($vehicle['_id']);
        $vehicle['event_id'] = $event_id;

        try
        {
            $this->event_vehicles->update(array('vehicle_id' => $vehicle['vehicle_id'], 'event_id' => $event_id), $vehicle, true);

            return true;
        }
        catch(MongoCursorException $e)
        {
            return false;
        }
    }

    public function delete_vehicle_from_event($event_id, $vehicle_id)
    {
        try
        {
            $this->event_vehicles->remove(array('event_id' => $event_id, 'vehicle_id' => $vehicle_id));
            return true;
        }
        catch(MongoCursorException $e)
        {
            return $e;
        }
    }

    public function get_user_vehicle_for_event($event_id, $user_id)
    {
        $results = $this->event_vehicles->find(array('event_id' => $event_id, 'user_id' => $user_id));

        if($results->count() > 0)
        {
            $cars = array();
            foreach($results as $res)
            {
                $cars[] = $res;
            }

            return $cars;
        }
        else
        {
            return false;
        }
    }

    public function delete_from_vehicle()
    {
        
    }

    public function find_person_in_vehicle($full_name)
    {
        $results = $this->event_vehicles->find(array('seats' => $full_name));

        if($results->count() > 0)
        {
            $vehicle = array();
            foreach($results as $res)
            {
                $vehicle[] = $res;
            }
            return $vehicle;
        }
        else
        {
            return false;
        }
        
    }

    public function add_person_to_vehicle($vehicle_data)
    {
        try
        {
            $this->event_vehicles->update(array('event_id' => $vehicle_data['event_id'], 'vehicle_id' => $vehicle_data['vehicle_id']), $vehicle_data, true);

            return true;
        }
        catch(MongoCursorException $e)
        {
            return $e;
        }
    }

    public function get_vehicle_for_id($vehicle_id, $event_id)
    {
        $results = $this->event_vehicles->find(array('event_id' => $event_id, 'vehicle_id' => $vehicle_id));

        if($results->count() > 0)
        {
            $car = array();
            foreach($results as $res)
            {
                $car = $res;
            }

            return $car;
        }
        else
        {
            return false;
        }
    }

    public function get_vehicles_for_event($event_id)
    {
        $results = $this->event_vehicles->find(array('event_id' => $event_id));

        if($results->count() > 0)
        {
            $cars = array();
            foreach($results as $res)
            {
                $cars[] = $res;
            }

            return $cars;
        }
        else
        {
            return array();
        }
    }
}