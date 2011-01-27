<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/26/11
 * Time: 5:55 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class Config extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->page->render('configIndex_view', '');
    }
}

?>
