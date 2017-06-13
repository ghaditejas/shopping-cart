<?php

/**
 * Login Model
 *
 * PHP Version 5.6
 * It contains login functionality definition of admin
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
     * Verify admin login credentials
     * 
     * @method  login
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function login($email, $password) {
        $this->db->where('status', 1);
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}

?>
