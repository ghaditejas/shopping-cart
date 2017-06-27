<?php

class Permission_model extends CI_Model {

    public function permission($user_id, $module) {

        $this->db->select('rp.*');
        $this->db->from('permission AS p');
        $this->db->join('role_permission AS rp', 'rp.permission_id = p.permission_id');
        $this->db->join('user_role as ur', 'ur.role_id = rp.role_id');
        $this->db->where('p.modules', $module);
        $this->db->where('ur.user_id', $user_id);
        $data = $this->db->get()->result();
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_currency($currency) {
        $this->db->select('v.config_value,t.config_type');
        $this->db->from('configuration_value as v');
        $this->db->join('configuration_type as t', 'v.config_type_id=t.config_type_id');
        $this->db->where('t.config_type', $currency);
        $query = $this->db->get()->row_array();
        return $query['config_value'];
    }

}

//$this->db->where('modules', $module);
//        $permission = $this->db->get('permission')->row_array();
//        if (!empty($permission)) {
//            $this->db->select('role_id');
//            $this->db->where('user_id', $user_id);
//            $roles = $this->db->get("user_role")->result_array();
//            $permission_id = $permission['permission_id'];
//            $role_ids = [];
//            foreach ($roles as $role) {
//                $role_ids[] = $role['role_id'];
//            }
//
//            $this->db->where('permission_id', $permission_id);
//            $this->db->where_in('role_id', $role_ids);
//            $data = $this->db->get('role_permission')->result_array();
//            $this->db->select('user_role. *,role_permission. *');
//            $this->db->from('user_role');
//            $this->db->join('role_permission', 'user_role.role_id=role_permission.role_id');
//            $this->db->where('user_id', $id);
//            $this->db->where('permission_id', $permission_id);
//            $query = $this->db->get();
//            $result1 = $query->row_array();
?>