<?php

class Forget_password extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('login_model', 'login');
        $this->load->library('email');
    }

    public function verification() {
        $email = $this->input->post('email_address');
        $verify = $this->login->verify($email);
        if ($verify) {
            return $verify['user_id'];
        } else {
            return false;
        }
    }

    public function sent_email($user_id, $tokken) {
//        $message = "<a href='" . base_url() . "home/login/reset/" . $user_id . "/" . $tokken . "'>Click Here to Reset Password <a>";
//        echo $message;
//        $this->email->from('tejaisbest@gmail.com', 'Tejas');
//        $this->email->to('tejaisbest');
//        $this->email->subject('Email Test');
//        $this->email->message($message);
//         if($this->email->send()) 
//        echo "sent";
        require 'PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'tejaisbest@gmail.com';          // SMTP username
        $mail->Password = ''; // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                          // TCP port to connect to

        $mail->setFrom('info@example.com', 'CodexWorld');
        $mail->addReplyTo('info@example.com', 'CodexWorld');
        $mail->addAddress('john@gmail.com');   // Add a recipient
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        $mail->isHTML(true);  // Set email format to HTML

        $bodyContent = '<h1>How to Send Email using PHP in Localhost by CodexWorld</h1>';
        $bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>CodexWorld</b></p>';

        $mail->Subject = 'Email from Localhost by CodexWorld';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        exit;
    }

    public function check() {
        $data["error"] = "";
        $data['forget_error'] = "";
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $data['forget'] = "forget_password";
            $data['page'] = "home/login";
            $this->load->view('home_template', $data);
        } else {
            $user_id = $this->verification();
            if (!$user_id) {
                $data['forget_error'] = "Email address not found";
                $data['forget'] = "forget_password";
                $data['page'] = "home/login";
                $this->load->view('home_template', $data);
            } else {
                $tokken = md5(date('y-m-d H:i:s'));
                $data = array(
                    'user_id' => $user_id,
                    'tokken' => $tokken,
                    'email' => $this->input->post('email_address'),
                    'created_on' => date('y-m-d H:i:s'),
                );
//                $result = $this->login->add_forget($data);
                if (true) {
                    $sent = $this->sent_email($user_id, $tokken);
                    if ($sent) {
                        $this->session->set_flashdata('success', 'MAIL HAS BEEN SENT TO YOUR EMAIL ADDRESS ');
                    } else {
                        $this->session->set_flashdata('error', 'ERROR WHILE SENDING MAIL PLEASE TRY AGAIN');
                    }
                    $data['page'] = "home/login";
                    $this->load->view('home_template', $data);
                } else {
                    $this->session->set_flashdata('error', 'ERROR WHILE ADDING YOUR TOKKEN');
                    $data['page'] = "home/login";
                    $this->load->view('home_template', $data);
                }
            }
        }
    }

}

?>
