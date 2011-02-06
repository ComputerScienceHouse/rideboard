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



        if($data['vehicle'] != false)
        {
            $data['exists'] = true;
            $data['view_vehicle'] = $this->load->view($this->presenter.'view_vehicle', array('vehicle' => $data['vehicle']), true);
        }
        else
        {
            $data['exists'] = false;
            $data['create'] = $this->load->view($this->presenter.'create_vehicle', '', true);
        }

        $this->page->render('myCarIndex_view', $data);
    }
}