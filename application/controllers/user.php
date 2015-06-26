<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library("form_validation");
	}
	public function index() {
		
	}
	function login() {
		//This method will have the credentials validation
		$input_total_data = array(
			array('name' => 'email', 'label' => 'Email', 'maxlength' => 80, 'required' => true),
			array('name' => 'password', 'label' => 'Password', 'maxlength' => 60, 'type' => 'password', 'required' => true)
		);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		foreach($input_total_data as $item) {
			$this->data[$item['name']] = array(
				'name'	=> $item['name'],
				'id'	=> 'be-user-login-salon-' . $item['name'],
				'type'	=> (isset($item['type']) ? $item['type'] : 'text'),
				'maxlength'	=> (isset($item['maxlength']) ? $item['maxlength'] : 150),
				'value'	=> $this->input->post($item['name'])
			);
		}
		if ($this->form_validation->run() == true) {
			if($this->login_check($this->data['email']['value'], $this->data['password']['value'])) {
				//print_r($this->login_check($this->data['username']['value'], $this->data['password']['value']));
				redirect('dashboard/page', 'refresh');
			} else {
				$this->data['title'] = 'User Log In';
				$this->data['message'] = 'Invalid email or password';
				// Field validation failed.  User redirected to login page
				$this->be_page->generate(false, 'user/login', $this->data);
			}
		} else {
			$this->data['title'] = 'User Log In';
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->session->flashdata('message')));
			// Field validation failed.  User redirected to login page
			$this->be_page->generate(false, 'user/login', $this->data);
		}
	}
	function login_check($email, $password) {
		$result = $this->user_model->login($email, $password);
		if($result == false) {
			return false;
		} else {
			$result['full_name'] = $result['first_name'] . ' ' . $result['last_name'];
			foreach(config_item('user_role') as $user_role_key => $user_role) {
				if($user_role['val'] == $result['user_role']) {
					$result['user_role_name'] = $user_role_key;
					break;
				}
			}
			$this->session->set_userdata('logged_in', $result);
			return true;
		}
	}
 	public function logout() {
 		$this->session->unset_userdata('logged_in');
  		redirect('/', 'refresh');
 	}
	public function register($user_role = null) {
		//load the registration helper under helper folder
		$this->load->helper('registration');
		$this->data['title'] = "Register User";
		switch($user_role) {
			case element('name', element('salon', config_item('user_role'))):
				$input_text_data = array(
					array('name' => 'first_name', 'label' => 'First Name', 'maxlength' => 60, 'required' => true),
					array('name' => 'last_name', 'label' => 'Last Name', 'maxlength' => 60, 'required' => true),
				
					array('name' => 'email', 'label' => 'Email', 'maxlength' => 80, 'required' => true, 'type' => 'email', 'is_unique' => 'users.email', 'valid_email' => true),
					array('name' => 'password', 'label' => 'Password', 'maxlength' => 60, 'type' => 'password', 'required' => true, 'password_confirm' => true),
					array('name' => 'password_confirm', 'label' => 'Password Confirm', 'maxlength' => 60, 'type' => 'password', 'form_only' => true, 'required' => true),
					array('name' => 'tax_id', 'label' => 'Tax ID', 'maxlength' => 100, 'required' => true),
					array('name' => 'phone', 'label' => 'Phone', 'maxlength' => 50, 'required' => true),
					
					array('name' => 'dba_name', 'label' => 'DBA Name', 'maxlength' => 100, 'required' => true),
					array('name' => 'dba_phone', 'label' => 'DBA Phone', 'maxlength' => 50, 'required' => true),
					//array('name' => 'dba_address', 'label' => 'DBA Address', 'maxlength' => 50, 'required' => true),
					//array('name' => 'dba_address2', 'label' => 'DBA Address2', 'maxlength' => 50),
					//array('name' => 'dba_city', 'label' => 'DBA City', 'maxlength' => 50, 'required' => true),
					//array('name' => 'dba_state', 'label' => 'DBA State', 'maxlength' => 50, 'required' => true),
					//array('name' => 'dba_zip', 'label' => 'DBA Zip', 'maxlength' => 32, 'required' => true),
					
					array('name' => 'business_name', 'label' => 'Business Name', 'maxlength' => 100, 'required' => true),
					array('name' => 'business_phone', 'label' => 'Business Phone', 'maxlength' => 50, 'required' => true),
					array('name' => 'business_email', 'label' => 'Business Email', 'maxlength' => 100, 'type' => 'email', 'required' => true, 'valid_email' => true, 'is_unique' => 'users.business_email'),
					
					array('name' => 'mailing_address', 'label' => 'Mailing Address', 'maxlength' => 50, 'required' => true),
					array('name' => 'mailing_city', 'label' => 'Mailing City', 'maxlength' => 50, 'required' => true),
					array('name' => 'mailing_state', 'label' => 'Mailing State', 'maxlength' => 50, 'required' => true),
					array('name' => 'mailing_zip', 'label' => 'Mailing Zip', 'maxlength' => 32, 'required' => true, 'numeric' => true),
					
					array('name' => 'billing_address', 'label' => 'Billing Address', 'maxlength' => 50, 'required' => true),
					array('name' => 'billing_city', 'label' => 'Billing City', 'maxlength' => 50, 'required' => true),
					array('name' => 'billing_state', 'label' => 'Billing State', 'maxlength' => 50, 'required' => true),
					array('name' => 'billing_zip', 'label' => 'Billing Zip', 'maxlength' => 32, 'required' => true, 'numeric' => true),
					
					
					array('name' => 'bank_name', 'label' => 'Bank Name', 'maxlength' => 100, 'required' => true),
					array('name' => 'account_nickname', 'label' => 'Account Nickname', 'maxlength' => 60, 'required' => true),
					//array('name' => 'bank_routing_number', 'label' => 'Bank Routing Number', 'maxlength' => 9, 'required' => true, 'numeric' => true, 'exact_length' => 9, 'is_unique' => 'users.bank_routing_number'),
					array('name' => 'bank_routing_number', 'label' => 'Bank Routing Number', 'maxlength' => 9, 'required' => true, 'numeric' => true, 'exact_length' => 9),
					array('name' => 'account_number', 'label' => 'Account Number', 'maxlength' => 60, 'required' => true, 'numeric' => true)
				);
				$input_select_data = array(
					array('name' => 'ownership', 'label' => 'Type Ownership', 'list' => config_item('users_salon_ownership'), 'required' => true),
					array('name' => 'user_type', 'label' => 'User Type', 'list' => config_item('users_salon_user_type'), 'required' => true),
					array('name' => 'account_type', 'label' => 'Account Type', 'list' => config_item('users_salon_account_type'), 'required' => true)
				);
				$input_total_data = array_merge($input_text_data, $input_select_data);
				break;
			case element('name', element('customer', config_item('user_role'))):
				$input_total_data = array(
					array('name' => 'first_name', 'label' => 'First Name', 'maxlength' => 60, 'required' => true),
					array('name' => 'last_name', 'label' => 'Last Name', 'maxlength' => 60),
					array('name' => 'email', 'label' => 'Email', 'maxlength' => 80, 'required' => true, 'type' => 'email', 'valid_email' => true, 'is_unique' => 'users.email'),
					array('name' => 'password', 'label' => 'Password', 'maxlength' => 60, 'type' => 'password', 'required' => true, 'password_confirm' => true),
					array('name' => 'password_confirm', 'label' => 'Password Confirm', 'maxlength' => 60, 'type' => 'password', 'form_only' => true, 'required' => true),
				);
				break;
			case 'customer_verify':
				$input_total_data = array(
					array('name' => 'first_name', 'label' => 'First Name', 'maxlength' => 60, 'required' => true),
					array('name' => 'last_name', 'label' => 'Last Name', 'maxlength' => 60),
					array('name' => 'email', 'label' => 'Email', 'maxlength' => 80, 'required' => true, 'type' => 'email', 'valid_email' => true, 'is_unique' => 'users.email'),
					array('name' => 'password', 'label' => 'Password', 'maxlength' => 60, 'type' => 'password', 'required' => true, 'password_confirm' => true),
					array('name' => 'password_confirm', 'label' => 'Password Confirm', 'maxlength' => 60, 'type' => 'password', 'form_only' => true, 'required' => true),
				);
				break;
			case element('name', element('admin', config_item('user_role'))):
				$input_total_data = array();
				break;
			default:
				$input_total_data = array();
				break;
		}
		// validate form input
		foreach($input_total_data as $item) {
			$rule = 'xss_clean';
			if(isset($item['required'])) $rule .= '|required';
			if(isset($item['valid_email'])) $rule .= '|valid_email';
			if(isset($item['password_confirm'])) $rule .= '|matches[password_confirm]';
			if(isset($item['numeric'])) $rule .= '|numeric';
			if(isset($item['exact_length'])) $rule .= '|exact_length['.$item['exact_length'].']';
			if(isset($item['is_unique'])) $rule .= '|is_unique['.$item['is_unique'].']';
			$this->form_validation->set_rules($item['name'], $item['label'], $rule);
		}
		$register_success = 0;
		if($this->form_validation->run() == true) {
			//$data = elements(array('id', 'title', 'content'), $this->input->post);
			foreach($input_total_data as $item) {
				if(!isset($item['form_only']))
					$data[$item['name']] = $this->input->post($item['name']);
			}
			$data['password'] = md5($data['password']);
			$data['group_id'] = element('val', element($user_role, config_item('user_role')));
			$data['user_role'] = element('val', element($user_role, config_item('user_role')));
			$data['date_created'] = date('Y-m-d h:i:s');
			$data['customer_verified'] = 0;
			$register_success ++;
		}
		if($register_success == 1 && $this->user_model->ach_integrate($data, $user_role)) {
			$register_success ++;
		}
		if($register_success == 2 && $this->user_model->register($data, $user_role)) {
			$register_success ++;
		}
		if($register_success == 3) { 
			redirect('user/register_success/' . $user_role);
		} else {
			if(isset($user_role)) {
				//set the flash data error message if there is one
				if($register_success == 0)
					$this->data['message'] = validation_errors();
				else if($register_success == 1)
					$this->data['message'] = $this->session->flashdata('message');
				
				switch($user_role) {
					case element('name', element('salon', config_item('user_role'))):
						foreach($input_text_data as $item) {
							$this->data[$item['name']] = array(
								'name'	=> $item['name'],
								'id'	=> 'be-user-register-salon-' . $item['name'],
								'type'	=> (isset($item['type']) ? $item['type'] : 'text'),
								'maxlength'	=> (isset($item['maxlength']) ? $item['maxlength'] : 150),
								'value'	=> $this->form_validation->set_value($item['name'])
							);
						}
						foreach($input_select_data as $item) {
							$this->data[$item['name']] = array(
								'name'	=> $item['name'],
								'list'	=> $item['list'],
								'value'	=> $this->input->post($item['name'])
							);
						}
						$this->data['page_user_role'] = $user_role;
						break;
					case element('name', element('customer', config_item('user_role'))):
						foreach($input_total_data as $item) {
							$this->data[$item['name']] = array(
								'name'	=> $item['name'],
								'id'	=> 'be-user-register-customer-' . $item['name'],
								'type'	=> (isset($item['type']) ? $item['type'] : 'text'),
								'maxlength'	=> (isset($item['maxlength']) ? $item['maxlength'] : 150),
								'value'	=> $this->form_validation->set_value($item['name'])
							);
						}
						$this->data['page_user_role'] = $user_role;
						break;
					case element('name', element('admin', config_item('user_role'))):
						$this->data['page_user_role'] = $user_role;
						break;
					default:
						$this->data['page_user_role'] = 'main';
						break;
				}
			} else {
				$this->data['page_user_role'] = 'main';
			}
			$this->be_page->generate(false, 'user/register_' . $this->data['page_user_role'], $this->data);
		}
	}
	public function register_success($user_role = null) {
		$this->data['user_role'] = isset($user_role) ? $user_role : '';
		$this->be_page->generate(false, 'user/register_success', $this->data);
	}
}
?>