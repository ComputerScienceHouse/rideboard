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
        $this->load->model('event_vehicles');

        $this->page->load_javascript(site_url('js/simplemodal.min.js'));
        $this->page->load_javascript(site_url('js/create-new-event.js'));
        //Util::printr($GLOBALS);
        if(array_key_exists('WEBAUTH_USER', $_SERVER))
        {
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
        else
        {
            $username = $this->input->post('username');
            if(!isset($_SESSION['loggedIn']))
            {
                

                $user = $this->user_model->user_exists($username);

                if($user == false)
                {
                    $got_user = $this->cross_db_request($username);
                    
                    $user = $this->user_model->create_user($got_user);

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

    private function cross_db_request($username)
    {
        $connection = new Mongo('mongodb://mcg1sean:summertimerave@localhost:27017/csh_members');
        $mdb = $connection->selectDB('csh_members');

        $user_collection = $mdb->{"users"};

        $results = $user_collection->find(array('uid' => $username))->limit(1);

        if($results->count() > 0)
        {
            $user = array();
            foreach($results as $res)
            {
                $user = $res;
            }

            $u['username'] = $username;
            $u['full_name'] = $user['cn'];

            return $u;
        }
        else
        {
            return false;
        }

    }

    
}
