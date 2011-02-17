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

    public function select_seat()
    {
        $data = json_decode($this->input->post('data'), true);
        $user_vehicle = $this->event_vehicles->get_user_vehicle_for_event($data['event_id'], $_SESSION['loggedIn']['user_id']);
        // if user doesnt have a vehicle on the board, then they can sign up
        if($user_vehicle == false)
        {
            // get the vehicle
            $selected_vehicle = $this->event_vehicles->get_vehicle_for_id($data['car_id'], $data['event_id']);
            $seats = $selected_vehicle['seats'];
            //$user_in_other_car = $this->event_vehicles->user_already_attending();
            if($selected_vehicle != false && ($seats[$data['seat_num']] == "VIP" || $seats[$data['seat_num']] == "" || $seats[$data['seat_num']] == "Bitch"))
            {
                $selected_vehicle['seats'][$data['seat_num']] = $_SESSION['loggedIn']['full_name'];

                $res = $this->event_vehicles->add_person_to_vehicle($selected_vehicle);

                if($res == true)
                {
                    $event_vehicles = $this->event_vehicles($data['event_id']);
                    echo json_encode(array('status' => 'true', 'event_vehicles' => $event_vehicles));
                }
                else
                {
                    echo json_encode(array('status' => 'false', 'msg' => $res));
                }
            }
        }
        else
        {
            echo json_encode(array('status' => 'false', 'msg' => 'Youre already driving you retard'));
        }
    }

    public function delete_vehicle()
    {
        $data = json_decode($this->input->post('data'), true);



        $resp = $this->event_vehicles->delete_vehicle_from_event($data['event_id'], $data['vehicle_id']);

        if($resp == true)
        {
            $event_vehicles = $this->event_vehicles($data['event_id']);

            $user_vehicle = $this->event_vehicles->get_user_vehicle_for_event($data['event_id'], $_SESSION['loggedIn']['user_id']);
            $car_button = $this->load->view('presenters/event/left_col', array('user_vehicle' => $user_vehicle), true);

            echo json_encode(array('status' => 'true', 'event_vehicles' => $event_vehicles, 'car_button' => $car_button));
        }
        else
        {
            echo json_encode(array('status' => 'false', 'msg' => 'Error removing your car'));
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
            $event_vehicles = $this->event_vehicles($event_id);

            $user_vehicle = $this->event_vehicles->get_user_vehicle_for_event($event_id, $_SESSION['loggedIn']['user_id']);
            $car_button = $this->load->view('presenters/event/left_col', array('user_vehicle' => $user_vehicle), true);

            echo json_encode(array('status' => 'true', 'event_vehicles' => $event_vehicles, 'car_button' => $car_button));
        }
        else
        {
            echo json_encode(array('status' => 'false'));
        }
    }

    private function event_vehicles($event_id)
    {
        $event_vehicles = $this->event_vehicles->get_vehicles_for_event($event_id);
        $event_vehicles = $this->load->view('presenters/event/event_vehicles', array('vehicles' => $event_vehicles), true);

        return $event_vehicles;
    }


}