<?php

namespace Controller;

/**
* Controller of Profile page
*/
class Profile extends S_Base
{
	private $layout;
	private $p_customer;
	private $data_flag = true;
	private $msg = '';

	public function onInput()
	{
		parent::onInput();
		if ( isset($this->customer) && !empty($this->customer) ) {
			$this->p_customer = $this->customer;
			// validate necessary data for orders and warn users
			if ( empty($this->p_customer['address']) ) {
				$this->p_customer['address'] = 'Довьте пожалуйста адресс в разделе "Изменить данные"';
				$this->data_flag = false;
			}
			if ( empty($this->p_customer['phone']) ) {
				$this->p_customer['phone'] = 'Довьте пожалуйста телефон в разделе "Изменить	 данные"';
				$this->data_flag = false;
			}
			// choose menu point of profile page
			if ( isset($_GET['menu_point']) ) {

				$menu_point = \Model\Functions::clearData($_GET['menu_point']);
				if( !empty($menu_point) ) {
					switch ($menu_point) {
						case 'cur_orders':
							$this->layout = 'View/pages/profile_cur_orders.php';
							break;
						case 'old_orders':
							$this->layout = 'View/pages/profile_old_orders.php';
							break;
						case 'change_data':
							if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
								$this->msg = \Model\Customer::profile_change_data();
							}
							$this->layout = 'View/pages/profile_change_data.php';
							break;
						case 'change_pass':
							if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
								$this->msg = \Model\Customer::profile_change_pass();
							}
							$this->layout = 'View/pages/profile_change_pass.php';
							break;
						default:
							$this->layout = 'View/pages/profile.php';
							break;
					}
				}

			} else {
				$this->layout = 'View/pages/profile.php';
			}

		} else {
			$this->layout = 'View/pages/access_denied.php';
		}

	}

	public function onOutput()
	{
		$this->content = $this->Template($this->layout, ['p_customer' => $this->p_customer, 'data_flag' => $this->data_flag]);
		parent::onOutput();
	}
}