<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/30/11
 * Time: 9:45 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_controller.php');
class Login extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->page->render('loginIndex_view', '');
    }

    public function create_user()
    {
        $this->user_model->create_user();
    }

    public function process_login()
    {
        $post_list = array('username', 'password');

        $post = array();
        $errors = false;

        foreach($post_list as $item)
        {
            $post[$item] = $this->input->post($item);

            if($post[$item] == '')
            {
                $errors = true;
            }
        }

        if($errors == true)
        {
            redirect(site_url('login'));
        }
        else
        {
            $user = $this->user_model->auth_user($post['username'], $post['password']);
            //Util::printr($user);
            if($user != false)
            {
                $_SESSION['loggedIn'] = $user;

                redirect(site_url('main'));

            }
            else
            {
                redirect(site_url('login'));
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['loggedIn']);
        session_destroy();

        redirect(site_url('main'));
    }
}
