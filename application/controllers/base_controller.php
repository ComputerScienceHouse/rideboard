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

        $this->page->load_javascript(site_url('js/simplemodal.min.js'));
        $this->page->load_javascript(site_url('js/create-new-post.js'));

        //TEMPORARY
        if(!isset($_SESSION['loggedIn']))
        {
            $_SESSION['loggedIn'] = array('username' => 'mcg1sean',
                                          'user_id' => '123456789',
                                          'full_name' => 'Sean McGary');
        }
    }
}
