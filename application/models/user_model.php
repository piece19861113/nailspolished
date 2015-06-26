<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct() {
		
	}
	function login($email, $password) {
		$this->db->select('id, group_id, email, customer_verified, user_role, first_name, last_name');
		$query = $this->db->get_where('users', array('email' => $email, 'password' => md5($password)));
		if($query -> num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
	}
	public function register($data, $user_role = null)	{
		$this->db->insert('users', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function ach_integrate($data, $user_role = null)	{
		if(!isset($user_role)) return false;
		if($user_role == 'customer') return true;
		$xml_post_fields = array();
		switch($user_role) {
			case 'salon':
				$xml_post_fields = array(
						'transaction_center_id' => '81009',
						'gateway_id' => '8331ed1e-873b-4328-b16b-8258d464f357',
						'operation_type' => 'ach_debit',
						'order_id' => md5(time() . $data['username']),
						'Processor' => 'sandbox_echeck',
						'MID' => '5256162849',
						
						'total' => '1.00',
						
						'ach_name' => $data['bank_name'],
						'aba' => $data['bank_routing_number'],
						'dda' => $data['account_number'],
						'ach_account_type' => $data['account_type'],
						'ach_category_text' => 'Membership Fee',
						'close_date' => '12/31/2099',
						
						'owner_name' => $data['business_name'],
						'owner_phone' => $data['business_phone'],
						'owner_email' => $data['business_email'],
						
						'owner_street' => $data['mailing_address'],
						'owner_street2' => '',
						'owner_city' => $data['mailing_city'],
						'owner_state' => $data['mailing_state'],
						'owner_zip' => $data['mailing_zip'],
						'owner_country' => 'US',
						
						'remote_ip_address' => '127.0.0.1'
					);
				break;
			case 'customer':
				/*
				<FIELD KEY="transaction_center_id">81009</FIELD>
				<FIELD KEY="gateway_id">8331ed1e-873b-4328-b16b-8258d464f357</FIELD>
				<FIELD KEY="operation_type">cim_insert</FIELD>
				<FIELD KEY="cim_ref_num">100232</FIELD>
				<FIELD KEY="shipping_name">Bob Tester</FIELD>
				<FIELD KEY="shipping_street">123 Test Rd.</FIELD>
				<FIELD KEY="shipping_street2"></FIELD>
				<FIELD KEY="shipping_city">Cityville</FIELD>
				<FIELD KEY="shipping_state">NJ</FIELD>
				<FIELD KEY="shipping_zip">08035</FIELD>
				<FIELD KEY="shipping_country">US</FIELD>
				<FIELD KEY="shipping_email"></FIELD>
				<FIELD KEY="shipping_phone">555-555-5555</FIELD>
				<FIELD KEY="shipping_method">UPS</FIELD>
				<FIELD KEY="card_name">Visa</FIELD>
				<FIELD KEY="card_number">4111111111111111</FIELD>
				<FIELD KEY="card_exp">1018</FIELD>
				<FIELD KEY="owner_name">Bob Tester</FIELD>
				<FIELD KEY="owner_street">123 Test Rd.</FIELD>
				<FIELD KEY="owner_street2"></FIELD>
				<FIELD KEY="owner_city">Cityville</FIELD>
				<FIELD KEY="owner_state">NJ</FIELD>
				<FIELD KEY="owner_zip">08035</FIELD>
				<FIELD KEY="owner_country">US</FIELD>
				<FIELD KEY="owner_email"></FIELD>
				<FIELD KEY="owner_phone">555-555-5555</FIELD>
				<FIELD KEY="aba">031200213</FIELD>
				<FIELD KEY="dda">7596321546</FIELD>
				<FIELD KEY="ach_account_type">C</FIELD>
				<FIELD KEY="ach_name">Citibank</FIELD>
				 */
				$xml_post_fields = array(
						'transaction_center_id' => '81009',
						'gateway_id' => '8331ed1e-873b-4328-b16b-8258d464f357',
						'operation_type' => 'cim_insert',
						'order_id' => md5(time() . $data['username']),
						'Processor' => 'sandbox_echeck',
						'MID' => '5256162849',
				
						'total' => '1.00',
				
						'ach_name' => $data['bank_name'],
						'aba' => $data['bank_routing_number'],
						'dda' => $data['account_number'],
						'ach_account_type' => $data['account_type'],
						'ach_category_text' => 'Membership Fee',
						'close_date' => '12/31/2099',
				
						'owner_name' => $data['business_name'],
						'owner_phone' => $data['business_phone'],
						'owner_email' => $data['business_email'],
				
						'owner_street' => $data['mailing_address'],
						'owner_street2' => '',
						'owner_city' => $data['mailing_city'],
						'owner_state' => $data['mailing_state'],
						'owner_zip' => $data['mailing_zip'],
						'owner_country' => 'US',
				
						'remote_ip_address' => '127.0.0.1'
					);
				break;
			default:
				return false;
				break;
		}
		
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
		if(!$result) $this->session->set_flashdata('message', $error);
		return !!$result;
	}
}