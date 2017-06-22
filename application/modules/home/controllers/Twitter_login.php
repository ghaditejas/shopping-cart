<?php

/**
 * Twitter Login Controller
 *
 * PHP Version 5.6
 * It contains login functionality using twitter
 *
 * @category Twitter Login 
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Twitter_login extends CI_Controller {

    private $connection;

    function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->load->library('twitteroauth');
        $this->config->load('twitter');      
        if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'), $this->session->userdata('access_token_secret'));
        } elseif ($this->session->userdata('request_token') && $this->session->userdata('request_token_secret')) {
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
        } else {
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
        }
    }
    
    /**
     * Used to call twitter login page
     * 
     * @method  auth
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function auth() {
        if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
            redirect(base_url('/'));
        } else {
            $request_token = $this->connection->getRequestToken(base_url('home/twitter_login/callback'));
            $this->session->set_userdata('request_token', $request_token['oauth_token']);
            $this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);          
            if ($this->connection->http_code == 200) {
                $url = $this->connection->getAuthorizeURL($request_token);
                //pr($this->session->All_userdata());
               redirect($url);
            } else {                
                redirect(base_url('/'));
            }
        }
    }

    /**
     * Used to unset variables in session requiried while logging in
     * 
     * @method  banner_view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function callback() {
        if (!$this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')) {
            $this->reset_session();
            redirect(base_url('home/twitter_login/auth'));
        } else {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));            
            if ($this->connection->http_code == 200) {
                $this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');
                $this->set_userdata($access_token);
                redirect(base_url('/'));
            } else {
                echo 'Error while logging in';
            }
        }
    }
    
    /**
     * Used to logout a user
     * 
     * @method  reset_session
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    private function reset_session() {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('access_token_secret');
        $this->session->unset_userdata('request_token');
        $this->session->unset_userdata('request_token_secret');
        $this->session->unset_userdata('twitter_user_id');
        $this->session->unset_userdata('twitter_screen_name');
    }

    /**
     * Used to set login session and add user details in database
     * 
     * @method  set_userdata
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function set_userdata($data){
        $role = 5;
        $role_array = array();
        $user = $this->login->check_user($data['user_id'], 'twitter');
        if ($user) {
            $this->session->set_userdata('loggedin', 1);
            $this->session->set_userdata('userig', $user['user_id']);
            $this->session->set_userdata('fname', $user['firstname']);
            $this->session->set_userdata('lname', $user['lastname']);
            $this->session->set_userdata('email_id', $user['email']);
        } else {
            $user_data=array(
                'firstname'=>$data['screen_name'],
                'lastname' =>$data['screen_name'],
                'twitter_token' =>$data['user_id']
            );
            $userId = $this->login->insert_user($user_data);
            $role_array[] = array('user_id' => $userId, 'role_id' => $role);
            $result_ins = $this->login->insert_roles($role_array);
            if ($result_ins) {
                $this->session->set_userdata('loggedin', 1);
                $this->session->set_userdata('userig', $userId);
                $this->session->set_userdata('fname', $data['screen_name']);
                $this->session->set_userdata('lname', $data['screen_name']);
                $this->session->set_userdata('email_id', '');
            }
        }
        redirect();
    }
}