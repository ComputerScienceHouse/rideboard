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
        $this->load->model('user_model');
        $this->load->model('event_model');
        $this->load->model('vehicle_model');

        $this->page->load_javascript(site_url('js/simplemodal.min.js'));
        $this->page->load_javascript(site_url('js/create-new-event.js'));

        if(!isset($_SESSION['loggedIn']))
        {
            $user = $this->user_model->user_exists($_SERVER['WEBAUTH_USER']);

            if($user == false)
            {
                $insert_user = array('username' => $_SERVER['WEBAUTH_USER'],
                                     'full_name' => $_SERVER['WEBAUTH_LDAP_CN']
                                     );
                $user = $this->user_model->create_user($insert_user);

                if($user != false)
                {
                    $_SESSION['loggedIn'] = $user;
                }
                else
                {
                    echo 'Exception thrown creating user';
                }
            }
            else
            {
                $_SESSION['loggedIn'] = $user;
            }
        }
    }

    
}
