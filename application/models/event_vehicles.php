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