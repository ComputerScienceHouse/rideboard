<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/30/11
 * Time: 9:40 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class Account extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->page->render('accountIndex_view', '');
    }
}