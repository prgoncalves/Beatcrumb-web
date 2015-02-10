<?php
class Email_library {
	private $CI;
	private $email;
	function __constructor($params = null){
		$this->email = $this->load->library('email');
	}
	private function _sendMail($to,$from,$subject,$message){
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$result =  $this->email->send();
//		echo $this->CI->email->print_debugger();
		return $result;
	}
	function sendEmailView($to,$from,$subject,$data,$view){
		$this->CI =& get_instance();
		$message = $this->CI->load->view($view,$data,TRUE);
		return $this->_sendMail($to, $from, $subject, $message);
	}
	function sendEmail($to,$from,$subject,$message){
		return $this->_sendMail($to, $from, $subject, $message);
	}
}
