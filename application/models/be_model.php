<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Be_model extends CI_Model {
	
	public function logged_in() {
		if($this->session->userdata('logged_in')) {
			return $this->session->userdata('logged_in');
		} else {
			return false;
		}
	}
	
	// Usage : $this->be_model->form_group($username, 'Username', 'john123', true, false, 'in lowercase');
	public function form_group($input_data = array(), $input_label = '', $input_placeholder = '', $required = false, $input_type = false, $label_tip = '') {
		$input_data['class'] = 'form-control';
		if(!empty($input_placeholder)) $input_data['placeholder'] = $input_placeholder;
		/* echo '
		<div class="form-group">';
		if(!$input_type) {
			echo '
	        <label for="'.$input_data['id'].'" class="control-label col-xs-2 col-xs-offset-1">
			' . $input_label .
			($required == true ? ' *' : '') .
			(!empty($label_tip) ? '<br><span class="be-font-light-grey be-font-s11">' . $label_tip . '</span>' : '') . '
			</label>';
		} else if($input_type == 'select') {
			echo '
			<label class="control-label col-xs-2 col-xs-offset-1">
			' . $input_label . ($required == true ? ' *' : '') . (!empty($label_tip) ? '<br><span class="be-font-light-grey be-font-s11">' . $label_tip . '</span>' : '') . '
			</label>';
		} */
		
		echo '
		<div class="form-group">
			<div class="controls">
				<div class="row">
					<div class="col-md-4 margin-0">';
						if(!$input_type) {
							echo '
					        <label for="'.$input_data['id'].'" class="control-label" style="text-align:left !important;">
							' . $input_label .
							($required == true ? ' *' : '') .
							(!empty($label_tip) ? '<br><span class="be-font-light-grey be-font-s11 pull-left">' . $label_tip . '</span>' : '') . '
							</label>';
						} else if($input_type == 'select') {
							echo '
							<label class="control-label" style="text-align:left !important;">
							' . $input_label . ($required == true ? ' *' : '') . (!empty($label_tip) ? '<br><span class="be-font-light-grey be-font-s11">' . $label_tip . '</span>' : '') . '
							</label>';
						}
					echo '
					</div>
					<div class="col-md-8">';
					switch($input_type) {
			        	case 'select':
			        		$dropdown_css = 'class = "form-control"';
			        		echo form_dropdown($input_data['name'], $input_data['list'], $input_data['value'], $dropdown_css);
			        		break;
			        	case 'checkbox':
			        		echo '
			        		<div class="checkbox">
				                <label>' . form_input($input_data) . ' ' . $input_label .
				                ($required == true ? ' *' : '') .
				                (!empty($label_tip) ? ' <span class="be-font-light-grey be-font-s11">' . $label_tip . '</span>' : '') . '
				                </label>
				            </div>';
			        		break;
			        	default:
			        		echo form_input($input_data);
			        		break;
			        }
					echo '
					</div>
				</div>
			</div>
		</div>
		';
		
		/* echo '
	        <div class="col-xs-8' . (($input_type && $input_type != 'select') ? ' col-xs-offset-3' : '') . '">';
	        switch($input_type) {
	        	case 'select':
	        		$dropdown_css = 'class = "form-control"';
	        		echo form_dropdown($input_data['name'], $input_data['list'], $input_data['value'], $dropdown_css);
	        		break;
	        	case 'checkbox':
	        		echo '
	        		<div class="checkbox">
		                <label>' . form_input($input_data) . ' ' . $input_label .
		                ($required == true ? ' *' : '') .
		                (!empty($label_tip) ? ' <span class="be-font-light-grey be-font-s11">' . $label_tip . '</span>' : '') . '
		                </label>
		            </div>';
	        		break;
	        	default:
	        		echo form_input($input_data);
	        		break;
	        }
	        echo '
	        </div>
	    </div>'; */
	}
}