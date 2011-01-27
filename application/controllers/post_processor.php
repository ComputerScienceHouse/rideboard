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

    public function new_post()
    {
        $post_list  = array('post_title', 'post_content', 'groups');

        $post = array();

        foreach($post_list as $item)
        {
            $post[$item] = $this->input->post($item);
        }

        $post['group_id'] = $post['groups'];
        unset($post['groups']);


        $error = false;

        foreach($post as $p)
        {
            if($p == '')
            {
                $error = true;
            }
        }

        if($error == false)
        {
            if($this->posts_model->insert($post))
            {
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
}