<?php

/**
 * Banner Controller
 *
 * PHP Version 5.6
 * It contains crud functionality definition of banner
 *
 * @category Banner
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cron_model', 'cron');
    }

    /**
     * Used to send mail of all the placed order in a day
     * 
     * @method  placed_order
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function placed_order() {
        $orders = $this->cron->get_placed_order(date('Y-m-d'));
        $body = '<p>Hello Sir,</p>Following are the ids of the order placed : ';
        foreach ($orders as $order) {
            $body = $body . $order['id'].'<br>';
        }
        $to = 'tejasg2607@gmail.com';
        $subject = "Order Placed";
        send_mail($to, $subject, $body);
    }

    /**
     * Used to send mail of wishlist of a week
     * 
     * @method  weekly_wishlist
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function weekly_wishlist() {
        $week = date('d-m-Y', strtotime("-1 week"));
        $wishlists = $this->cron->get_wishlist(date('Y-m-d'),$week);
        $body = '<p>Hello Sir,</p>Following are the ids of the wishlist : ';
        foreach ($wishlists as $wishlist) {
            $body = $body . $wishlist['id'].'<br>';
        }
        $to = 'tejasg2607@gmail.com';
        $subject = "Wishlist of the week";
        send_mail($to, $subject, $body);
    }

}
?>

