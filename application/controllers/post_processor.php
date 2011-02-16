<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/27/11
 * Time: 2:45 AM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class Post_Processor extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
    }



    public function new_event()
    {
        $post_list  = array('event_name', 'event_date', 'event_location', 'event_desc');

        $post = array();

        foreach($post_list as $item)
        {
            $post[$item] = $this->input->post($item);
        }

        //Util::printr($post);

        $post['user'] = $_SESSION['loggedIn'];

        $error = false;

        if($post['event_name'] =='' || $post['event_date'] == '')
        {
            $error = true;
        }


        
        if($error == false)
        {
            $post['event_date'] = strtotime($post['event_date']);
            $insert_res = $this->event_model->insert($post);
            if($insert_res)
            {
                //$redirect = site_url('g/'.$insert_res['group']['group_name'].'/post/'.$insert_res['post_id']);

                echo json_encode(array('status' => 'true', 'msg' => 'Post added!'));
            }
            else
            {
                echo json_encode(array('status' => 'false', 'msg' => 'Error creating post'));
            }
        }
        else
        {
            echo json_encode(array('status' => 'false', 'msg' => 'Please fill out all fields'));
        }
    }

    public function create_vehicle()
    {
        $vehicle_data = $this->input->post('vehicle_data');
        $vehicle_data = json_decode($vehicle_data, true);

        $vehicle_data['user_id'] = $_SESSION['loggedIn']['user_id'];

        $vehicle = $this->vehicle_model->insert($vehicle_data);

        if($vehicle)
        {
            $vehicle = $this->vehicle_model->get_vehicle_for_user($_SESSION['loggedIn']['user_id']);
            $view = $this->load->view('presenters/my_car/view_vehicle', array('vehicle' => $vehicle), true);
            echo json_encode(array('status' => 'true', 'vehicles' => $view));
        }
        else
        {
            echo json_encode(array('status' => 'false', 'msg' => 'Error adding vehicle'));
        }
    }

    public function add_vechicle()
    {
        $vehicle_id = $this->input->post('vehicle_id');
        $event_id = $this->input->post('event_id');
        $seats = json_decode($this->input->post('seats'), true);

        //Util::printr($seats);

        $user_vehicle = $this->vehicle_model->get_vehicle_for_user($_SESSION['loggedIn']['user_id']);

        $user_vehicle['seats'] = $seats;

        //Util::printr($user_vehicle);

        $insert = $this->event_vehicles->add_vehicle_to_event($user_vehicle, $event_id);
        if($insert)
        {
            $event_vehicles = $this->event_vehicles->get_vehicles_for_event($event_id);
            $event_vehicles = $this->load->view('presenters/event/event_vehicles', array('vehicles' => $event_vehicles), true);
            echo json_encode(array('status' => 'true', 'event_vehicles' => $event_vehicles));
        }
        else
        {
            echo json_encode(array('status' => 'false'));
        }


    }


}