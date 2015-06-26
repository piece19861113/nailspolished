<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function page() {
		$user_data = $this->be_model->logged_in();
		if(!$user_data) {
			redirect('/');
			return false;
		} else {
			$this->data['title'] = 'Dashboard';
			$this->be_page->generate(true, 'dashboard/'.$user_data['user_role_name'], $this->data);
		}
	}
}