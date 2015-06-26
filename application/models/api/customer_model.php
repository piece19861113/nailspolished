<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function __construct() {
		
	}
	
	public function search() {
		$result = array();
		
		$this->db->select('name');
		$query = $this->db->get('services');
		foreach($query->result_array() as $row) {
			if(!empty($row['name'])) $services[] = $row['name'];
		}
		asort($services);
		
		$this->db->select('business_name');
		$query = $this->db->get_where('users', array('user_role' => element('val', element('salon', config_item('user_role')))));
		foreach($query->result_array() as $row) {
			if(!empty($row['business_name'])) $salons[] = $row['business_name'];
		}
		asort($salons);
		
		$result = array_unique(array_merge($services, $salons));
		
		$sortedResult = array();
		foreach ($result as $key => $val) {
			$sortedResult[] = $val;
		}
		
		return count($sortedResult) ? $sortedResult : false;
	}
	public function search_salons($params) {
		$result = array();
		
		/* Category Search */
		$salon_ids_services = array();
		$query_services = $this->db->select('salon_id')
			->like('name', $params['category'])
			->get('services');
		foreach($query_services->result_array() as $row) {
			$salon_ids_services[] = $row['salon_id'];
		}
		$salon_ids_users = array();
		$query_users = $this->db->select('salon_id')
			->like('business_name', $params['category'])
			->where('user_role', element('val', element('salon', config_item('user_role'))))
			->get('users');
		foreach($query_users->result_array() as $row) {
			$salon_ids_users[] = $row['salon_id'];
		}
		$salon_ids_category = array_unique(array_merge(array(), $salon_ids_services, $salon_ids_users));
				
		/* Location Search */
		$salon_ids_cities = array();
		$query_cities = $this->db->select('salon_id, mailing_city, mailing_state')
			->where('user_role', element('val', element('salon', config_item('user_role'))))
			->get('users');
		foreach($query_cities->result_array() as $row) {
			if((strpos(strtolower($params['location']), strtolower($row['mailing_city'])) !== false) ||
					(strpos(strtolower($params['location']), strtolower($row['mailing_state'])) !== false))
				$salon_ids_cities[] = $row['salon_id'];
		}
		$salon_ids_address = array();
		$query_address = $this->db->select('salon_id')
			->where('user_role', element('val', element('salon', config_item('user_role'))))
			->like('mailing_address', $params['location'])
			->or_like('mailing_address2', $params['location'])
			->get('users');
		foreach($query_address->result_array() as $row) {
			$salon_ids_address[] = $row['salon_id'];
		}
		$salon_ids_location = array_unique(array_merge(array(), $salon_ids_cities, $salon_ids_address));
		
		$salon_ids = array_unique(array_intersect($salon_ids_category, $salon_ids_location));
		
		if(count($salon_ids) > 0) {
			$query = $this->db->select('users.salon_id, business_name as salon_name, mailing_address as salon_address, mailing_address2 as salon_address2, mailing_city as salon_city, mailing_state as salon_state, mailing_zip as salon_zipcode, salon_latitude, salon_longitude, photo_url as salon_photo_url, avg_score as salon_rating, rating_number as salon_rating_count')
				->where_in('users.salon_id', $salon_ids)
				->join('salon_rating', 'salon_rating.salon_id = users.salon_id')
				->get('users');
			if(isset($params['customer_id'])) {
				foreach($query->result_array() as $row) {
					$query = $this->db->get_where('favorites', array('salon_id' => $row['salon_id'], 'customer_id' => $params['customer_id']));
					if($query -> num_rows() > 0) {
						$row_additional = array('is_favorite' => 1);
					} else {
						$row_additional = array('is_favorite' => 0);
					}
					$result[] = array_merge($row, $row_additional);
				}
			} else {
				$result = $query->result_array();
			}
			return count($result) ? $result : false;
		} else {
			return false;
		}
	}
	
	public function salon_detail($params) {
		$result = array();
		
		// Services
		$query = $this->db->select('id, salon_id, name, price, duration')
			->where('salon_id', $params['salon_id'])
			->get('services');
		$services = $query->result_array();
		foreach($services as $key => $row) {
			$query = $this->db->select('staffs.id, staffs.name, staffs.salon_id, staffs.photo_url, staff_job.name as job_name')
				->where('service_staff.service_id', $row['id'])
				->join('service_staff', 'service_staff.staff_id = staffs.id')
				->join('staff_job', 'staff_job.id = staffs.job_id')
				->get('staffs');
			$services[$key]['staffs'] = $query->result_array();
		}
		$result['services'] = $services;
		
		// Reviews
		$query = $this->db->select(array('reviews.id', 'reviews.salon_id', 'reviews.customer_id', 'CONCAT( first_name , " ", last_name ) as `customer_name`', 'users.photo_url as customer_photo_url', 'reviews.score', 'reviews.comment', 'reviews.date_created'))
			->where('reviews.salon_id', $params['salon_id'])
			->join('users', 'users.id = reviews.customer_id')
			->get('reviews');
		$reviews = $query->result_array();
		usort($reviews, function($a, $b) {
			if ($a['date_created'] == $b['date_created']) return 0;
			return (strtotime($a['date_created']) < strtotime($b['date_created'])) ? 1 : -1;
		});
		$result['reviews'] = $reviews;
		
		// Hours
		$query = $this->db->select('id, salon_id, weekday, from, to, is_available')
			->where('salon_id', $params['salon_id'])
			->get('week_hour');
		$hours = $query->result_array();
		foreach($hours as $key => $row) {
			$query = $this->db->select('staff_id, from, to, is_available')
				->where('weekday', $row['weekday'])
				->where('salon_id', $params['salon_id'])
				->get('staff_week_hour');
			$hours[$key]['staffs'] = $query->result_array();
		}
		$result['hours'] = $hours;
		
		// Staffs
		$query = $this->db->select('staffs.id, staffs.name, staffs.salon_id, staffs.photo_url, staff_job.name as job_name')
			->where('salon_id', $params['salon_id'])
			->join('staff_job', 'staff_job.id = staffs.job_id')
			->get('staffs');
		$staffs = $query->result_array();
		$result['staffs'] = $staffs;
		
		// Specials
		$query = $this->db->select('id, salon_id, name, amount, type, is_available')
			->where('salon_id', $params['salon_id'])
			->get('specials');
		$specials = $query->result_array();
		$result['specials'] = $specials;
		
		// Gallery
		$query = $this->db->select(array('salon_gallery.id', 'salon_gallery.comment', 'salon_gallery.image_url', 'salon_gallery.customer_id', 'CONCAT( users.first_name , " ", users.last_name ) as `customer_name`', 'salon_gallery.time_created'))
			->where('salon_gallery.salon_id', $params['salon_id'])
			->join('users', 'users.id = salon_gallery.customer_id')
			->order_by('salon_gallery.time_created', 'desc')
			->get('salon_gallery');
		$gallery = $query->result_array();
		$result['gallery'] = $gallery;
		
		return count($result) ? $result : false;
	}
	
	public function give_rating($params) {
		$request_fields = array('customer_id', 'salon_id', 'score', 'comment', 'date_created');
		$query = $this->db->insert('reviews', elements($request_fields, $params));
		$new_review_id = $this->db->insert_id();
		$this->update_salons_avg_score($params['salon_id']);
		return ($new_review_id > 0) ? array('new_review_id' => $new_review_id) : false;
	}
	
	public function update_salons_avg_score($salon_id) {
		$query = $this->db->select('avg(score) as avg_score, count(id) as rating_number')
			->where('salon_id', $salon_id)
			->get('reviews');
		$avg_score = element('avg_score', $query->row_array());
		$rating_number = element('rating_number', $query->row_array());
		$this->db->update('salon_rating', array('avg_score' => $avg_score, 'rating_number' => $rating_number), array('salon_id' => $salon_id));
	}
	
	public function favorite_toggle($params) {
		$request_fields = array('customer_id', 'salon_id');
		if($params['flag'] == '1') {
			$this->db->insert('favorites', elements($request_fields, $params));
		} else {
			$this->db->delete('favorites', elements($request_fields, $params));
		}
		return array('customer_id' => $params['customer_id']);
	}
	
	public function search_favorite_salons($params) {
		$result = array();
	
		$salon_ids = array();
		$query = $this->db->select('salon_id')
			->where('customer_id', $params['customer_id'])
			->get('favorites');
		foreach($query->result_array() as $row) {
			$salon_ids[] = $row['salon_id'];
		}
		$query = $this->db->select('users.salon_id, business_name as salon_name, mailing_address as salon_address, mailing_address2 as salon_address2, mailing_city as salon_city, mailing_state as salon_state, mailing_zip as salon_zipcode, salon_latitude, salon_longitude, photo_url as salon_photo_url, avg_score as salon_rating, rating_number as salon_rating_count')
			->where_in('users.salon_id', $salon_ids)
			->join('salon_rating', 'salon_rating.salon_id = users.salon_id')
			->get('users');
		$favorite_salons = array();
		foreach($query->result_array() as $row) {
			$favorite_salons[] = array_merge($row, array('is_favorite' => 1));
		}
		$result['salons'] = $favorite_salons;
		
		return count($result) ? $result : false;
	}
	
	public function book_appt($params) {
		$request_fields = array('customer_id', 'salon_id', 'service_id', 'staff_id');
		
		$query_customers = $this->db->select('customer_verified')->get_where('users', array('id' => $params['customer_id']));
		$query_services = $this->db->select('price, duration')->get_where('services', array('id' => $params['service_id']));
		
		$appt_params = array_merge(elements($request_fields, $params), $query_customers->row_array(), $query_services->row_array());
		
		$appt_times = explode(',', $params['appt_time']);
		foreach($appt_times as $appt_time) {
			$appt_params['appt_time'] = $appt_time;
			$query = $this->db->insert('appointments', $appt_params);
		}
		
		$new_appt_id = $this->db->insert_id();
		
		return ($new_appt_id > 0) ? array('new_appt_id' => $new_appt_id) : false;
	}
	
	public function cancel_appt($params) {
		$request_fields = array('customer_id', 'appointment_id');
		$this->db->delete('appointments', array('id' => $params['appointment_id']));
		return array('cancelled_appt_id' => $params['appointment_id']);
	}
	
	public function get_appts($params) {
		$result = array();
		$query = $this->db->select('appointments.id, appointments.salon_id, appointments.customer_id, appointments.service_id, appointments.price, appointments.duration, appointments.staff_id, appointments.appt_time, appointments.customer_verified, appointments.is_finished, appointments.is_paid, users.business_name as salon_name, services.name as service_name, staffs.name as staff_name')
			->where('appointments.customer_id', $params['customer_id'])
			->join('users', 'appointments.salon_id = users.salon_id')
			->join('services', 'appointments.service_id = services.id')
			->join('staffs', 'appointments.staff_id = staffs.id')
			->order_by('appointments.appt_time', 'asc')
			->get('appointments');
		$result['appointments'] = $query->result_array();
	
		return count($result) ? $result : false;
	}
	
	public function upload_salon_gallery($params) {
		
		$msg = '';
		$query = $this->db->get_where('appointments', array('salon_id' => $params['salon_id'], 'customer_id' => $params['customer_id'], 'is_finished' => 1, 'is_paid' => 1));
		$finished_appts = $query->num_rows();
		if($finished_appts > 0) {
			$query = $this->db->get_where('salon_gallery', array('salon_id' => $params['salon_id'], 'customer_id' => $params['customer_id']));
			$uploaded_images = $query->num_rows();
			if($uploaded_images >= (int)$finished_appts*2) {
				$msg = 'You cannot upload more than 2 images per each finished appointment. Currently, your finished appointment numbers are ' . $finished_appts . ' and number of uploaded images are ' . $uploaded_images . '.';
			}
		} else {
			$msg = 'You cannot upload to this salon\'s gallery, because you do not have any finished appointments with this salon.';
		}
		
		if(empty($msg)) {
			$image_path = "assets/media/salon_gallery/";
			$image_name = time() . '.jpg';
			$image_url = $image_path . $image_name;
	
			$base = $params['image_str'];
			$binary = base64_decode($base);
			header('Content-Type: bitmap; charset=utf-8');
			$file = fopen($image_url, 'w');
			if($file) {
				fwrite($file, $binary);
			}
			fclose($file);
			
			if (!$file) {
				return array('status' => 2);
			} else {
				$request_fields = array('customer_id', 'salon_id', 'time_created', 'comment');
				$full_image_url = base_url() . $image_url;
				$new_params = array_merge(elements($request_fields, $params), array('image_url' => $full_image_url));
				$this->db->insert('salon_gallery', $new_params);
				$new_id = $this->db->insert_id();
				if($new_id > 0) {
					$query = $this->db->select(array('salon_gallery.id', 'salon_gallery.comment', 'salon_gallery.image_url', 'salon_gallery.customer_id', 'CONCAT( users.first_name , " ", users.last_name ) as `customer_name`', 'salon_gallery.time_created'))
						->where('salon_gallery.id', $new_id)
						->join('users', 'users.id = salon_gallery.customer_id')
						->limit(1)
						->get('salon_gallery');
					$result['gallery'] = $query->row_array();
					$result['status'] = 1;
					return count($result) ? $result : array('status' => 2);
				} else {
					return array('status' => 2);
				}
			}
		} else {
			return array('status' => 3, 'msg' => $msg);
		}
	}
	
	public function verify_cc($params) {
		$request_fields = array('card_name', 'card_number', 'card_exp', 'cvv2', 'dba_name', 'dba_address', 'dba_address2', 'dba_city', 'dba_state', 'dba_zip', 'dba_country', 'dba_email', 'dba_phone');
		$verify_params = elements($request_fields, $params);
		
		$data = $params;
		$order_id = md5(time() . $data['customer_id']);
		$cim_ref_num = md5(time() . $data['dba_email']);
		$xml_post_fields = array(
				'transaction_center_id' => '81009',
				'gateway_id' => '8331ed1e-873b-4328-b16b-8258d464f357',
				'operation_type' => 'auth',
				'order_id' => $order_id,
				
				'Processor' => 'sandbox',
				'MID' => '5256162849',
				'TID' => '001',
				
				'total' => '1.00',
				'card_name' => $data['card_name'],
				'card_number' => $data['card_number'],
				'card_exp' => $data['card_exp'],
				'cvv2' => $data['cvv2'],
				
				'owner_name' => $data['dba_name'],
				'owner_phone' => $data['dba_phone'],
				'owner_email' => $data['dba_email'],
		
				'owner_street' => $data['dba_address'],
				'owner_street2' => $data['dba_address2'],
				'owner_city' => $data['dba_city'],
				'owner_state' => $data['dba_state'],
				'owner_zip' => $data['dba_zip'],
				'owner_country' => 'US',
				
				'cim_ref_num' => $cim_ref_num,
				'shipping_zip' => '92835',
				'shipping_name' => 'bob tester',
				'shipping_street' => '123 test rd',
				'remote_ip_address' => '127.0.0.1'
		);
		
		$result = false;
		$xml_string_data = '<?xml version="1.0"?><TRANSACTION><FIELDS>';
		foreach($xml_post_fields as $key => $value) {
			$xml_string_data .= '<FIELD KEY="'.$key.'">'.$value.'</FIELD>';
		}
		$xml_string_data .= '</FIELDS></TRANSACTION>';
		$url = "https://secure.goemerchant.com/secure/gateway/xmlgateway.aspx";
		$ch = curl_init($url);
		//curl_setopt($ch, CURLOPT_MUTE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_string_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/html'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$xml_obj = simplexml_load_string($output);
		
		$result = 0;
		$error = '';
		$fields = $xml_obj->FIELDS->FIELD;
		foreach($fields as $field) {
			$field_att_arr = $field->attributes();
			if($field_att_arr[0][0] == 'status') {
				$result = (int)$field;
			}
			if($field_att_arr[0][0] == 'error') {
				$error = strval($field);
			}
		}
		if(!$result) {
			return array('status' => 2, 'msg' => $error);
		} else {
			$verify_params = array_merge($verify_params, array('customer_verified' => 1, 'order_id' => $order_id, 'cim_ref_num' => $cim_ref_num));
			$this->db->update('users', $verify_params, array('id' => $params['customer_id']));
			
			$query = $this->db->get_where('users', array('id' => $params['customer_id']));
			return array('status' => 1, 'user' => $query->row_array());
		}
	}
}