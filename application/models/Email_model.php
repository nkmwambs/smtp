<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function account_opening_email($account_type = '' , $email = '')
	{
		$system_name	=	'toolkit';//$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		
		$email_msg		=	"Welcome to ".$system_name."<br />";
		$email_msg		.=	"Your account type : ".$account_type."<br />";
		//$email_msg		.=	"Your login password : ".$this->db->get_where($account_type , array('email' => $email))->row()->password."<br />";
		$email_msg		.=	"Login Here : ".base_url()."<br />";
		
		$email_sub		=	"Account opening email";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}
	
	function password_reset_email($new_password = '' , $email = '', $account_type='')
	{
		$query			=	$this->db->get_where('users' , array('email' => $email));
		if($query->num_rows() > 0)
		{
			
			$email_msg	=	"Your account type is : ".$account_type."<br />";
			$email_msg	.=	"Your password is : ".$new_password."<br />";
			
			$email_sub	=	"Password reset request";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	
	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		
		$config = array();
        $config['useragent']	= "Toolkit";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
		//$config['smtp_timeout']='30';
		//$config['smtp_auth'] = TRUE;
      //  $config['smtp_host']	= "smtp.office365.com";

		$config['smtp_host']	= "smtp.gmail.com";

        $config['smtp_port']	= "587";//
		$config['smtp_crypto'] = 'tls';
		// $config['smtp_user']='afrstaffrecognition@ke.ci.org';
		// $config['smtp_pass']	= "@Compassion123";

		$config['smtp_user']='gtsafrdevteam@gmail.com';
		$config['smtp_pass']	= "@Compassion123";

        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;
		
/////////////////////
        $this->load->library('email');

        $this->email->initialize($config);

		$this->email->set_newline("\r\n");

		$system_name	='toolkit';	//$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		if($from == NULL)
			//$from		=	'afrstaffrecognition@ke.ci.org';//$this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;

			$from		=	'gtsafrdevteam@gmail.com';//$this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;
		
		//$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);
		
		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://codecanyon.net/item/fps-school-management-system-pro/6087521?ref=joyontaroy\">&copy; 2013 FPS School Management System Pro</a></center>";
		$this->email->message($msg);
		
		$this->email->send();

		
		
		echo $this->email->print_debugger();
	}
}

