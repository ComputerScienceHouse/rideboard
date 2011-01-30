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
        $post['parent_id'] = 'none';
        $post['username'] = $_SESSION['loggedIn']['username'];


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
                $posts = $this->posts_model->get_flat_posts_by_date();
                $posts = $this->load->view('presenters/main/flat_posts', array('posts' => $posts), true);

                echo json_encode(array('status' => 'true', 'msg' => 'Post added!', 'posts' => $posts));
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

    public function post_reply()
    {
        $post_list = array('parent_id', 'reply_content', 'parent_id', 'group_id', 'root_post_id', 'post_title');



        $post = array();
        $error = false;
        foreach($post_list as $item)
        {
            $tmp = $this->input->post($item);
            if($tmp == '')
            {
                $error = true;
            }
            $post[$item] = $tmp;
        }

        //Util::printr($post);

        $post['username'] = $_SESSION['loggedIn']['username'];
        $post['post_content'] = $post['reply_content'];
        unset($post['reply_content']);
        if($error == false)
        {
            if($this->posts_model->insert($post))
            {
                //$posts = $this->posts_model->get_posts_threaded('none', $post_id);
                //$data['post'] = $posts[0];

                //$data['replies'] = $this->format_threaded_posts($data['post']['children']);
                $posts = $this->posts_model->get_posts_threaded('none', $post['root_post_id']);
                $posts = $posts[0];
                //Util::printr($data['post']);
                $replies = $this->format_threaded_posts($posts['children']);
                echo json_encode(array('status' => 'true', 'msg' => 'Post added!', 'replies' => $replies));
            }
            else
            {
                echo json_encode(array('status' => 'false', 'msg' => 'Error creating post'));
            }
        }
        else
        {
            echo json_encode(array('status' => 'false', 'msg' => 'Please enter a reply'));
        }


    }
}