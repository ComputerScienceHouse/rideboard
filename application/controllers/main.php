<?php
require_once('base_controller.php');

class Main extends Base_Controller
{

    public function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $posts = $this->posts_model->get_flat_posts_by_date();
        $data['posts'] = $this->load->view('presenters/main/flat_posts', array('posts' => $posts), true);
        //$data['posts'] = $this->format_threaded_posts($posts);
        $this->page->render('mainIndex_view', $data);

    }
}
?>
