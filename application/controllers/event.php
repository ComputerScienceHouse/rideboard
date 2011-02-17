<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 2/5/11
 * Time: 8:57 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class Event extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function _remap()
    {
        //Util::printr($this->uri->segment_array());

        if($this->uri->segment(2) == 'add_vehicle')
        {
            $this->add_vechicle();
        }
        else if($this->uri->total_segments() == 2 )
        {
            $this->view_event($this->uri->segment(2));
        }

        else
        {
            echo "FFFFFUUUUUUU";
        }
    }

    public function view_event($event_id)
    {
        $data['event'] = $this->event_model->get_event_for_id($event_id);

        $user_vehicle = $this->vehicle_model->get_vehicle_for_user($_SESSION['loggedIn']['user_id']);
        //Util::printr($user_vehicle);
        $data['user_vehicle'] = $this->load->view('presenters/my_car/event_vehicle', array('vehicle' => $user_vehicle), true);
        $data['user_vehicle_data'] = $user_vehicle;

        $event_vehicles = $this->event_vehicles->get_vehicles_for_event($event_id);
        $data['event_vehicles'] = $this->load->view('presenters/event/event_vehicles', array('vehicles' => $event_vehicles), true);

        $data['add_car_modal'] = $this->load->view('presenters/event/add-car-modal', $data, true);


        $user_vehicle = $this->event_vehicles->get_user_vehicle_for_event($event_id, $_SESSION['loggedIn']['user_id']);
        $left_data['left_col'] = $this->load->view('presenters/event/left_col', array('user_vehicle' => $user_vehicle), true);

        $this->page->load_javascript(site_url('js/add-car-to-event.js'));
        $this->page->render('eventViewEvent_view', $data, 'leftColEvent_view', $left_data);
    }
}