<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/26/11
 * Time: 6:01 PM
 * To change this template use File | Settings | File Templates.
 */
class Base_Controller extends Controller
{
    public $page;

    public function __construct()
    {
        parent::__construct();

        $this->page = new Page_Framework();
        $this->load->model('posts_model');
        $this->load->model('group_model');
        $this->load->model('user_model');

        $this->page->load_javascript(site_url('js/simplemodal.min.js'));
        $this->page->load_javascript(site_url('js/create-new-post.js'));


    }

    protected function format_threaded_posts($posts, $color = 'gray', $left_border = '', $left_margin = "")
    {
        $ret_string = '';
        //Util::printr($posts);
        foreach($posts as $post)
        {
            //Util::printr($post);
            $tmp_string = '';
            $tmp_string .= '<div class="post '.$color.' '.$left_border.' '.$left_margin.'">
                                <div class="post-info">
                                    <a href="#">'.$post['username'].'</a> - '.timespan($post['date_posted']).' ago
                                </div>
                                <div class="content">
                                    '.Markdown($post['post_content']).'
                                </div>
                                <div class="actions">
                                    <a href="#">permalink</a> | <a href="#" value="'.$post['post_id'].'" class="toggle-reply">reply</a>
                                </div>
                                <div class="local-reply" id="reply_'.$post['post_id'].'">
                                    <form class="local-reply-form" name="local-reply-form" id="local-reply-form-'.$post['post_id'].'" value="'.$post['post_id'].'">
                                        <div class="div-row">
                                            <textarea name="reply_content" id="reply_content"></textarea>
                                        </div>
                                        <div class="div-row clearboth">
                                            <input type="submit" class="button-blue-small" value="Reply">
                                        </div>
                                    </form>
                                </div>';

            if(!empty($post['children']))
            {
                $new_color = $color;

                if($color == 'gray')
                {
                    $new_color = 'white';
                }
                else
                {
                    $new_color = 'gray';
                }

                $new_left_border = $left_border;

                if($left_border == "")
                {
                    $new_left_border = 'left-border';
                }

                $new_left_margin = $left_margin;

                if($left_margin == "")
                {
                    $new_left_margin = "left-margin";
                }

                $tmp_string .= $this->format_threaded_posts($post['children'], $new_color, $new_left_border, $new_left_margin);

            }

            // close the post tag and add it to the ret_string;
            $tmp_string .= '</div>';

            $ret_string .= $tmp_string;
        }

        return $ret_string;
    }
}
