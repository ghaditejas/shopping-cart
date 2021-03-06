 <?php

 /**
 * Order Manage Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of order management 
 *
 * @category Order Manage
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Order_manage_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to update status of order
     * 
     * @method  update_order
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_order($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('user_order', $data);
        return true;
    }

    /**
     * Used to get total count of Orders
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count($search) {
        $this->db->select('COUNT(id) AS cnt');
        $query = $this->db->get('user_order')->row();
        return $query->cnt;
    }

    /**
     * Used to get list of orders
     * 
     * @method  get_order_list
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_order_list($offset, $limit, $search, $sort) {
        $this->db->select('u.firstname,u.lastname,uo.*,pg.name');
        $this->db->from('user_order as uo');
        $this->db->join('user as u', 'u.user_id=uo.user_id');
        $this->db->join('payment_gateway as pg', 'pg.id=uo.payment_gateway_id');
        if (!empty($search)) {
            $this->db->like('uo.id', $search);
        }
        $this->db->order_by('uo.created_on', $sort);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Used to get details of orders
     * 
     * @method  get_user_order
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_user_order($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('user_order')->row_array();
        return $query;
    }

    /**
     * Used to get order details
     * 
     * @method  get_order_details
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_order_details($id) {
        $this->db->where('order_id', $id);
        $query = $this->db->get('order_details')->result_array();
        return $query;
    }

    /**
     * Used to get details of product
     * 
     * @method  get_product
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product($product_id) {
        $this->db->select('p.id,p.name,p.price');
        $this->db->from('product as p');
        $this->db->where('p.id', $product_id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    /**
     * Used to get order details for graph 
     * 
     * @method  get_graph_data
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_graph_data() {
        $this->db->select('SUM( grand_total ) as sale , MONTHNAME( STR_TO_DATE( DATE_FORMAT( created_on,  "%m" ) ,"%m" ) ) as month');
        $this->db->group_by('DATE_FORMAT( created_on,  "%m" )');
        $query = $this->db->get('user_order')->result_array();
        return $query;
    }

    /**
     * Used to get email id on which order is placed
     * 
     * @method  get_email_id
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_email_id($id) {
        $this->db->select('billing_email');
        $this->db->where('id',$id);
        $query = $this->db->get('user_order')->row_array();
        return $query['billing_email'];
    }
}

?>
