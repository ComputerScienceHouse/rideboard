<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 2/5/11
 * Time: 8:12 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_model.php');
class Event_Model extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        $data['date_created'] = time();
        $data['event_id'] = $this->generate_event_id();

        try
        {
            $this->event_collection->insert($data, true);

            return true;
        }
        catch(MongoCursorException $e)
        {
            return false;
        }
    }

    public function get_events()
    {
        $results = $this->event_collection->find()->sort(array('event_date' => -1));

        if($results->count() > 0)
        {
            $events = array();

            foreach($results as $res)
            {
                $events[] = $res;
            }

            return $events;
        }
        else
        {
            return array();
        }
    }

    public function get_current_events()
    {
        $results = $this->event_collection->find(array('event_date' => array('$gte' => time())))->sort(array('event_date' => -1));

        if($results->count() > 0)
        {
            $events = array();

            foreach($results as $res)
            {
                $events[] = $res;
            }

            return $events;
        }
        else
        {
            return array();
        }

    }

    public function get_event_for_id($id)
    {
        $results = $this->event_collection->find(array('event_id' => $id));

        if($results != NULL)
        {

            $event = null;
            foreach($results as $res)
            {
                $event = $res;
            }

            return $event;
        }
        else
        {
            return array();
        }

    }

    private function generate_event_id()
    {
         $id = '';
         for($i = 0; $i < 9; $i++)
         {
             $id .= rand(0, 10);
         }

         $result = $this->get_event_for_id($id);

         if(!empty($result))
         {
             // if it already exists, run it again
             return $this->generate_event_id();
         }
         else
         {
             return $id;
         }
    }
}