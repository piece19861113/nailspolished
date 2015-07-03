<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	var $data;
	public function __construct() {
		parent::__construct();
		if(isset($_POST['tag']) && $_POST['tag'] != '') {
			$this->data = $_POST;
		} else {
			$this->data = array();
			echo "Invalid Request";
		}
		$this->load->model('api/User_model');
	}
	
	public function login() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'login') {
				$request_fields = array('email', 'password');
				$request_form_success = true;
				foreach($request_fields as $request_field) {
					if(!isset($this->data[$request_field])) {
						$request_form_success = false;
						break;
					}
				}
				if(!$request_form_success) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else {
					$result = $this->User_model->login($this->data);
					if ($result != false) {
						//$fields = array('first_name', 'last_name', 'email', 'date_created', 'facebook_id', 'photo_url', 'salon_id', 'gcm_id', 'apns_id');
						$response['user'] = $result;
						$response['user']['uid'] = $result['id'];
						foreach(config_item('user_role') as $user_role_key => $user_role) {
							if($user_role['val'] == $result['user_role']) {
								$response['user']['user_role_name'] = $user_role_key;
								break;
							}
						}
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Login authorized';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Incorrect email or password';
					}
				}
				echo json_encode($response);
			} else {
				echo 'Invalid Request';
			}
		} else {
			echo 'Access Denied';
		}
	}
	
	public function register() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'register' || $this->data['tag'] == 'fb_register' || $this->data['tag'] == 'salon_register') {
				$is_fb = !!($this->data['tag'] == 'fb_register');
				$is_salon = !!($this->data['tag'] == 'salon_register');
				if(!$is_fb)
					$fields = array('first_name', 'last_name', 'email', 'password', 'salon_id', 'gcm_id', 'apns_id');
				else
					$fields = array('facebook_id', 'first_name', 'last_name', 'email', 'photo_url', 'gcm_id', 'apns_id');
				$register_data = elements($fields, $this->data);
				if(!$is_fb && (!isset($register_data['first_name']) || !isset($register_data['email']) || !isset($register_data['password']))) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else if($is_fb && (!isset($register_data['first_name']) || !isset($register_data['email']) || !isset($register_data['facebook_id']))) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					//$response['report']['msg'] = 'test'.$register_data['first_name'].' ' .$register_data['email'].' '.$register_data['facebook_id'];
					$response['report']['msg'] = 'Facebook user profile data is not enough';
				} else {
					$user_role_name = $is_salon ? 'salon' : 'customer';
					$result = $this->User_model->register($register_data, $user_role_name, $is_fb);
					if($result == -1) {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Your email is already registered';
					} else if($result == 0) {
						$response['result'] = 0;
						$response['report']['status'] = 3;
						$response['report']['msg'] = 'Error occured in Registartion';
					} else {
						//$fields = array('first_name', 'last_name', 'email', 'date_created', 'facebook_id', 'photo_url', 'salon_id', 'gcm_id', 'apns_id');
						$response['user'] = $result;
						$response['user']['uid'] = $result['id'];
						foreach(config_item('user_role') as $user_role_key => $user_role) {
							if($user_role['val'] == $result['user_role']) {
								$response['user']['user_role_name'] = $user_role_key;
								break;
							}
						}
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Register success';
					}
				}
				echo json_encode($response);
			} else {
				echo 'Invalid Request';
			}
		} else {
			echo 'Access Denied';
		}
	}
	
	public function forgot_password() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'forgot_password') {
				if(issset($this->data['email'])) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else {
					$result = $this->User_model->reset_password($this->data['email']);
					$response = array();
					if ($result > 0) {
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Password is reset';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Failed to send an email... ' . $result;
					}
				}
				echo json_encode($response);
			} else {
				echo 'Invalid Request';
			}
		} else {
			echo 'Access Denied';
		}
	}
	
	public function delete_user() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'delete_user') {
				if(!isset($this->data['customer_id'])) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else {
					$result = $this->User_model->delete_user($this->data['customer_id']);
					$response = array();
					if ($result) {
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'User Account Deleted';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Failed to delete account';
					}
				}
				echo json_encode($response);
			} else {
				echo 'Invalid Request';
			}
		} else {
			echo 'Access Denied';
		}
	}
	
	public function change_password() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'change_password') {
				$request_fields = array('customer_id', 'password');
				$request_form_success = true;
				foreach($request_fields as $request_field) {
					if(!isset($this->data[$request_field])) {
						$request_form_success = false;
						break;
					}
				}
				if(!$request_form_success) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else {
					$result = $this->User_model->change_password($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Password Change success';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Password Change failed';
					}
				}
				echo json_encode($response);
			} else {
				echo 'Invalid Request';
			}
		} else {
			echo 'Access Denied';
		}
	}
}