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

    private function format_threaded_posts($posts)
    {
        $ret_string = '';

        foreach($posts as $post)
        {
            $tmp_string = '';
            $tmp_string .= '<div class="post">
                                <div class="title">
                                    '.$post['post_title'].'
                                </div>
                                <div class="content">
                                    '.$post['post_content'].'
                                </div>';

            if(!empty($post['children']))
            {
                $tmp_string .= $this->format_threaded_posts($post['children']);
            }

            // close the post tag and add it to the ret_string;
            $tmp_string .= '</div>';

            $ret_string .= $tmp_string;
        }

        return $ret_string;
    }
}
?>
