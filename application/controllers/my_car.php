<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 2/5/11
 * Time: 7:30 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class My_Car extends Base_Controller
{
    public $presenter;

    public function __construct()
    {
        parent::__construct();

        $this->presenter = 'presenters/my_car/';
    }

    public function index()
    {
        $this->page->load_javascript(site_url('js/create-vehicle.js'));

        $data['vehicle'] = $this->vehicle_model->get_vehicle_for_user($_SESSION['loggedIn']['user_id']);

        $car_exists = false;

        if($data['vehicle'] != false)
        {
            $data['exists'] = true;
            $data['view_vehicle'] = $this->load->view($this->presenter.'view_vehicle', array('vehicle' => $data['vehicle']), true);
            $car_exists = true;
        }
        else
        {
            $data['exists'] = false;
            $data['create'] = $this->load->view($this->presenter.'create_vehicle', '', true);
        }

        $remove_button = $this->remove_vehicle_button();
        $this->page->render('myCarIndex_view', $data, 'leftColMyCar_view', array('car_exists' => $car_exists, 'remove_button' => $remove_button));
    }

    public function remove_vehicle_button()
    {
        $button = '
            <div class="new-post" id="delete-vehicle">
                <a href="#" id="delete-my-car">Delete Vehicle</a>
            </div>';

        return $button;
    }

    public function delete_car()
    {
        $res = $this->vehicle_model->delete_user_vehicle($_SESSION['loggedIn']['user_id']);

        if($res != false)
        {
            $create = $this->load->view($this->presenter.'create_vehicle', '', true);
            echo json_encode(array('status' => 'true', 'create_form' => $create));
        }
    }
}