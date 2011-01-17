<?php
class Main extends Controller
{
    
    public $page;

    public function  __construct()
    {
        parent::__construct();

        $this->page = new Page_Framework();
        $this->load->model('posts_model');

    }

    public function index()
    {
        $this->page->render('mainIndex_view', '', null);

    }

    public function test()
    {
        echo 'Testing';

        $test_post = array('post_title' => 'second child to original root',
                           'post_content' => 'This is some content for my first post.',
                           'username' => 'mcg1sean',
                           'group_id' => 1,
                           'parent_id' => '739883978',
                           );

        //$this->posts_model->insert($test_post);
        //$this->posts_model->add_child('131473086', $test_post);
        echo '<hr>';
        //Util::printr($this->posts_model->get_all_posts());

        Util::printr($this->posts_model->get_posts_threaded());

    }
}
?>
