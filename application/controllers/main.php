<?php
require_once('base_controller.php');

class Main extends Base_Controller
{
    public $presenter;

    public function  __construct()
    {
        parent::__construct();
        $this->presenter = 'presenters/main/';
    }

    public function index()
    {
        $data['events'] = $this->event_model->get_events();
        //Util::printr($data);
        $render_data['event_list'] = $this->load->view($this->presenter.'list_events', $data, true);
        $this->page->render('mainIndex_view', $render_data);

    }
}
?>
