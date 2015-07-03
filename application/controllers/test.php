<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('api/Customer_model');
	}
	public function index() {
		$this->data['title'] = 'Test';
		$this->data['params'] = array(
				'customer_id', 'salon_id', 'time_created', 'image_str', 'comment'
			);
		
		if($this->input->post('submit')) {
			$result = $this->Customer_model->upload_salon_gallery($this->input->post());
			$this->data['result'] = $result;
		}
		$this->be_page->generate(true, 'test', $this->data);
	}
}
?>