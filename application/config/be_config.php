<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// User System
$config['user_role'] = array(
	'salon' => array('name' => 'salon', 'val' => 50),
	'customer' => array('name' => 'customer', 'val' => 100),
	'admin'=> array('name' => 'admin', 'val' => 1)
);
$config['users_salon_ownership'] = array(
	1 => 'Sole Proprietor', 2 => 'Partnership', 3 => 'Corporation', 4 => 'LLC'
);
$config['users_salon_user_type'] = array(
	1 => 'Owner', 2 => 'Officer'
);
$config['users_salon_account_type'] = array(
	'C' => 'Checking', 'S' => 'Savings'
);
$config['static_pages'] = array(
	'about' => array('title' => 'About Us', 'login_needed' => false),
	'salon_owners' => array('title' => 'Salon Owners', 'login_needed' => false),
	'features' => array('title' => 'App Features', 'login_needed' => false),
	'faqs' => array('title' => 'FAQs', 'login_needed' => false),
	'return_policy' => array('title' => 'Return Policy', 'login_needed' => false),
	'privacy_policy' => array('title' => 'Privacy Policy', 'login_needed' => false),
	'contact' => array('title' => 'Contact Us', 'login_needed' => false)
);