<?php

/**
 * Login_model Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of Checkout 
 *
 * @category Login
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to check user login credentials
     * 
     * @method  login
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function login($email,$password) {
        $this->db->where('status',1);
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $query=$this->db->get('user');
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }
    
    /**
     * Used to get user details by verifying tokken
     * 
     * @method  check_user
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function check_user($tokken,$api){
        $this->db->select('user_id,firstname,lastname,email');
        if($api=='Google'){
            $this->db->where('google_token',$tokken);
        }else if($api == 'twitter'){
            $this->db->where('twitter_token',$tokken);
        }
        $query = $this->db->get('user')->row_array();
        return $query;
    }
    
    /**
     * Used to insert user details
     * 
     * @method  insert_user
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_user($data){
        $this->db->insert('user', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    /**
     * Used to insert user role
     * 
     * @method  insert_roles
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_roles($data) {
        $this->db->insert_batch('user_role', $data);
        if($this->db->insert_id()) {
           return true; 
        }else{
            return false;
        }
    }
    
    /**
     * Used to verify  if the email exist in database 
     * 
     * @method  verify
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function verify($search){
        $this->db->select('user_id');
        $this->db->where('email',$search);
        $query=$this->db->get('user');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
    }
    
    /**
     * Used to insert reset password generated tokken
     * 
     * @method  add_forget
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function add_forget($data){
    $this->db->insert('forgot_password',$data);
    if($this->db->insert_id()){
        return true;
    }else{
        return false;
    }
    }
    
    /**
     * Used to get created on date of the reset password tokken 
     * 
     * @method  get_date
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_date($id,$tokken){
        $this->db->select('created_on');
        $this->db->where('user_id',$id);
        $this->db->where('is_verified',0);
        $this->db->where('tokken',$tokken);
        $query=$this->db->get('forgot_password');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
        
    }
    
    /**
     * Used to update user password
     * 
     * @method  update_user
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_user($id,$data) {
        $this->db->where('user_id',$id);
        $this->db->update('user',$data);
        return true;
    }
    
    /**
     * Used to update status of the reset password tokken
     * 
     * @method  update_status
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_status($tokken) {
        $data=array('is_verified'=>1);
        $this->db->where('tokken',$tokken);
        $this->db->update('forgot_password',$data);
        return true;
    }
}
?>
