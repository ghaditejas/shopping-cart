<?php

/**
 * User Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of banner
 *
 * @category User
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to get list of users
     * 
     * @method  get_users
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_users($offset, $limit, $search) {
        $this->db->select('roles.role_id,user.firstname,user.lastname,user.email,GROUP_CONCAT(roles.role_name) AS role,user.status,user.user_id');
        $this->db->from('user');
        $this->db->join('user_role', 'user.user_id = user_role.user_id');
        $this->db->join('roles', 'roles.role_id=user_role.role_id');
        if (!empty($search)) {
            $this->db->like('firstname', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('email', $search);
        }
        $this->db->group_by('user.user_id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Used to get total count of users
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count($search) {
        if (!empty($search)) {
            $this->db->like('firstname', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('email', $search);
        }
        $this->db->select('COUNT(user_id) AS cnt');
        $query = $this->db->get('user')->row();
        return $query->cnt;
    }

    /**
     * Used to insert new user
     * 
     * @method  insert_user
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_user($data) {
        $this->db->insert('user', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Used to get roles of user
     * 
     * @method  get_roles
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_roles() {
        $this->db->where('role_id!=', 5);
        $query = $this->db->get('roles');
        return $query->result_array();
    }

    /**
     * Used to insert new user role
     * 
     * @method  insert_roles
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_roles($role_array) {
        $this->db->insert_batch('user_role', $role_array);
        if ($this->db->insert_id()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get details of user
     * 
     * @method  get_user
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_user($id) {
        $this->db->select('user.user_id,user.firstname,user.lastname,user.email,user.status,GROUP_CONCAT(user_role.role_id) AS roless');
        $this->db->from('user');
        $this->db->join('user_role', 'user.user_id = user_role.user_id');
        $this->db->join('roles', 'roles.role_id=user_role.role_id');
        $this->db->where('user_role.role_id!=', 5);
        $this->db->where('user.user_id', $id);
        $this->db->group_by('user.user_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Used to update user
     * 
     * @method  update_user
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_user($id, $data) {
        $this->db->where('user_id', $id);
        $query = $this->db->update('user', $data);
        return true;
    }

    /**
     * Used to get email of user
     * 
     * @method  get_email
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_email($email, $id) {
        $this->db->where('user_id!=',$id);
        $this->db->where('email',$email);
        $query = $this->db->get('user')->row_array();
        return $query;
    }

}
?>

