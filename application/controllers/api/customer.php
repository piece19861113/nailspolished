<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
	var $data;
	public function __construct() {
		parent::__construct();
		if(isset($_POST['tag']) && $_POST['tag'] != '') {
			$this->data = $_POST;
		} else {
			$this->data = array();
			echo "Invalid Request";
		}
		$this->load->model('api/Customer_model');
	}
	
	public function search() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'all_categories') {
				$result = $this->Customer_model->search();
				if ($result != false) {
					$response['names'] = $result;
					$response['result'] = 1;
					$response['report']['status'] = 1;
					$response['report']['msg'] = 'Search List Data fetch success';
				} else {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = 'Search List Data fetch failed';
				}
				echo json_encode($response);
			} else {
				echo 'Invalid Request';
			}
		} else {
			echo 'Access Denied';
		}
	}
	
	public function search_salons() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'search_salons') {
				if(empty($this->data['location'])) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else {
					if(!isset($this->data['category']) || !isset($this->data['location'])) {
						$response['result'] = 0;
						$response['report']['status'] = 0;
						$response['report']['msg'] = 'Please fill the form correctly';
					} else {
						$result = $this->Customer_model->search_salons($this->data);
						if ($result != false) {
							$response['salons'] = $result;
							$response['result'] = 1;
							$response['report']['status'] = 1;
							$response['report']['msg'] = 'Data fetching success';
						} else {
							$response['result'] = 0;
							$response['report']['status'] = 2;
							$response['report']['msg'] = 'Data fetching failed';
						}
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
	
	public function salon_detail() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'salon_detail') {
				if(!isset($this->data['salon_id'])) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else {
					$result = $this->Customer_model->salon_detail($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Data fetching success';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Data fetching failed';
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
	
	public function give_rating() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'give_rating') {
				$request_fields = array('customer_id', 'salon_id', 'score', 'comment', 'date_created');
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
					$result = $this->Customer_model->give_rating($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Rating Update success';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Rating Update failed';
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
	
	public function favorite_toggle() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'favorite_toggle') {
				$request_fields = array('customer_id', 'salon_id', 'flag');
				$request_form_success = true;
				foreach($request_fields as $request_field) {
					if(!isset($this->data[$request_field]) || (($request_field != 'flag') && ($this->data[$request_field] <= 0))) {
						//echo $request_field . "," . $this->data[$request_field];
						$request_form_success = false;
						break;
					}
				}
				if(!$request_form_success) {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = 'Please fill the form correctly';
				} else {
					$result = $this->Customer_model->favorite_toggle($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Update success';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Update failed';
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
	
	public function search_favorite_salons() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'favorite') {
				$request_fields = array('customer_id');
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
					$result = $this->Customer_model->search_favorite_salons($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Update success';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Update failed';
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
	
	public function book_appt() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'book') {
				$request_fields = array('customer_id', 'salon_id', 'service_id', 'staff_id', 'appt_time');
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
					$result = $this->Customer_model->book_appt($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Booking Appointment success';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Booking Appointment failed';
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
	
	public function cancel_appt() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'cancel_appointment') {
				$request_fields = array('appointment_id');
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
					$result = $this->Customer_model->cancel_appt($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Appointment cancelled';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Operation failed';
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
	
	public function get_appts() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'appointments') {
				$request_fields = array('customer_id');
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
					$result = $this->Customer_model->get_appts($this->data);
					if ($result != false) {
						$response = $result;
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Update success';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Update failed';
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
	
	
	public function verify_cc() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'verify_cc') {
				$request_fields = array('customer_id', 'card_name', 'card_number', 'card_exp', 'cvv2', 'dba_name', 'dba_address', 'dba_address2', 'dba_city', 'dba_state', 'dba_zip', 'dba_country', 'dba_email', 'dba_phone');
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
					$result = $this->Customer_model->verify_cc($this->data);
					if ($result['status'] == 1) {
						$response = $result;
						$response['user']['uid'] = $result['user']['id'];
						foreach(config_item('user_role') as $user_role_key => $user_role) {
							if($user_role['val'] == $result['user']['user_role']) {
								$response['user']['user_role_name'] = $user_role_key;
								break;
							}
						}
						
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Your profile is verified successfully.';
					} else {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Your authorization is failed. ' . $result['msg'];
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
	
	public function upload_salon_gallery() {
		if(count($this->data)) {
			$response = array();
			if($this->data['tag'] == 'upload_salon_gallery') {
				$request_fields = array('customer_id', 'salon_id', 'time_created', 'image_str', 'comment');
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
					$result = $this->Customer_model->upload_salon_gallery($this->data);
					if ($result['status'] == 2) {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Upload failed';
					} else if ($result['status'] == 3) {
						$response['result'] = 0;
						$response['report']['status'] = 3;
						$response['report']['msg'] = $result['msg'];
					} else {
						$response['gallery'] = $result['gallery'];
						$response['result'] = 1;
						$response['report']['status'] = 1;
						$response['report']['msg'] = 'Upload success';
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