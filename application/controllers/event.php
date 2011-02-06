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
        if($this->uri->total_segments() == 2)
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
        $this->page->render('eventViewEvent_view', $data, 'leftColEvent_view');
    }
}