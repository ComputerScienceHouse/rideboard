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
    }
}
