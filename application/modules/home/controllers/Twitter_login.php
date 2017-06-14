<?php

/**
 * Twitter OAuth library.
 * Sample controller.
 * Requirements: enabled Session library, enabled URL helper
 * Please note that this sample controller is just an example of how you can use the library.
 */
class Twitter_login extends CI_Controller {

    /**
     * TwitterOauth class instance.
     */
    private $connection;

    /**
     * Controller constructor
     */
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
     * Here comes authentication process begin.
     * @access	public
     * @return	void
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
     * Callback function, landing page for twitter.
     * @access	public
     * @return	void
     */
    public function callback() {
        if (!$this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')) {
            $this->reset_session();
            redirect(base_url('/twitter/auth'));
        } else {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));            
            if ($this->connection->http_code == 200) {
                $this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');
                $this->set_userdata($access_token);
                redirect(base_url('/'));
            } else {
                // An error occured. Add your notification code here.
                echo '<br>callback else - http_code error'; 
               // redirect(base_url('/'));
            }
        }
    }

    public function post($in_reply_to) {
        $message = $this->input->post('message');
        if (!$message || mb_strlen($message) > 140 || mb_strlen($message) < 1) {
            // Restrictions error. Notification here.
            redirect(base_url('/'));
        } else {
            if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
                $content = $this->connection->get('account/verify_credentials');
                if (isset($content->errors)) {
                    // Most probably, authentication problems. Begin authentication process again.
                    $this->reset_session();
                    redirect(base_url('/twitter/auth'));
                } else {
                    $data = array(
                        'status' => $message,
                        'in_reply_to_status_id' => $in_reply_to
                    );
                    $result = $this->connection->post('statuses/update', $data);

                    if (!isset($result->errors)) {
                        // Everything is OK
                        redirect(base_url('/'));
                    } else {
                        // Error, message hasn't been published
                        redirect(base_url('/'));
                    }
                }
            } else {
                // User is not authenticated.
                redirect(base_url('/Twitter_login/auth'));
            }
        }
    }

    /**
     * Reset session data
     * @access	private
     * @return	void
     */
    private function reset_session() {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('access_token_secret');
        $this->session->unset_userdata('request_token');
        $this->session->unset_userdata('request_token_secret');
        $this->session->unset_userdata('twitter_user_id');
        $this->session->unset_userdata('twitter_screen_name');
    }

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