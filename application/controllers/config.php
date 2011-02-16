<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/26/11
 * Time: 5:55 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class Config extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->page->load_javascript(site_url('js/config/config.js'));
        $groups = $this->group_model->get_groups();
        $data['groups_table'] = $this->load->view('presenters/config/groups-table', array('groups' => $groups), true);
        $this->page->render('configIndex_view', $data);
    }

    public function create_group()
    {
        $post_list = array('group_name');

        $post = array();
        foreach($post_list as $item)
        {
            $post[$item] = $this->input->post($item);
        }

        if($post['group_name'] != '')
        {
            $post['status'] = 'public';
            if($this->group_model->create_group($post))
            {
                $groups = $this->group_model->get_groups();
                $groups = $this->load->view('presenters/config/groups-table', array('groups' => $groups), true);

                echo json_encode(array('status' => 'true', 'msg' => 'Success', 'groups' => $groups));
            }
            else
            {
                echo json_encode(array('status' => 'false', 'msg' => 'Group name already exists'));
            }
        }
        else
        {
            echo json_encode(array('status' => 'false', 'msg' => 'Please enter a group name'));
        }
    }
}

?>
