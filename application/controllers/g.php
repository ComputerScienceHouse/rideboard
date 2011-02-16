<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/27/11
 * Time: 1:36 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class G extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function _remap()
    {
        if($this->uri->total_segments() == 2)
        {
            $this->index($this->uri->segment(2));
        }
        else if($this->uri->total_segments() == 4)
        {
            $this->view_post($this->uri->segment(4));
        }
        else
        {
            show_404();
        }
    }

    public function index($group_name)
    {
        $posts = $this->posts_model->get_flat_posts_by_group_name($group_name);
        //Util::printr($posts);
        $data['posts'] = $this->load->view('presenters/main/flat_posts', array('posts' => $posts), true);
        //$data['posts'] = $this->format_threaded_posts($posts);

        $this->page->render('mainIndex_view', $data);
        
    }

    public function view_post($post_id)
    {
        $this->page->load_javascript(site_url('js/g/reply-top.js'));
        $this->page->load_javascript(site_url('js/g/local-reply.js'));
        $posts = $this->posts_model->get_posts_threaded('none', $post_id);
        $data['post'] = $posts[0];
        //Util::printr($data['post']);
        $data['replies'] = $this->format_threaded_posts($data['post']['children']);
        //Util::printr($data);
        $this->page->render('gViewPost_view', $data);
    }
}
