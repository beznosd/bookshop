<?php

namespace Model;

class AjaxHandler
{
	private $output = [];
	private $db_link;

	function __construct($action, $db_link)
	{
		$this->db_link = $db_link;

		$action = \Model\Functions::clearData($action);
		if ( $action != '' ) {
			$this->output['action'] = $action;
			switch ($action) {
				case 'to_cart':
					$this->add_to_cart();
					break;
				case 'registration_form':
					$this->registration();
					break;
				case 'authorization_form':
					$this->authorization();
					break;
				case 'exit':
					$this->logout();
					break;
				case 'change_item_count_form':
					$this->change_item_count_form();
					break;
				case 'drop_cart':
					$this->drop_from_cart();
					break;
				case 'make_order':
					$this->make_order();
					break;
				default:
					echo "No such action";
					break;
			}
		}

		die();
	}

	private function add_to_cart()
	{
		$id_book = mysqli_real_escape_string( $this->db_link, \Model\Functions::clearData($_GET['id_book']) );
		if ( $id_book ) {
			$book = \Model\MySQLi_Query::select($this->db_link, 
										'SELECT title, author, cover, pages, price, category FROM books WHERE id_book = \''.$id_book.'\'',
										'assoc');

			$cart_item = \Model\MySQLi_Query::select($this->db_link,
											'SELECT count FROM cart WHERE id_book = \''.$id_book.'\' AND sid = \''.SID.'\'',
											'assoc');

			if( empty($cart_item) ) {
				$book_to_ins = [
					'id_book' => $id_book,
					'title' => $book[0]['title'],
					'author' => $book[0]['author'],
					'cover' => $book[0]['cover'],
					'pages' => $book[0]['pages'],
					'price' => $book[0]['price'],
					'category' => $book[0]['category'],
					'sid' => SID,
					'count' => 1
				];

				$result = \Model\MySQLi_Query::insert($this->db_link, 'cart', $book_to_ins);
				if ( $result != -1 )
					$this->output['success'] = true;
				else
					$this->output['success'] = false;
			} else {
				$count = $cart_item[0]['count'] + 1;
				$item['count'] = $count;
				$t = "id_book = '%s' AND sid = '%s'";
				$where = sprintf($t, mysqli_real_escape_string($this->db_link, $id_book), mysqli_real_escape_string($this->db_link, SID));
				$result = \Model\MySQLi_Query::update($this->db_link, 'cart', $item, $where);

				if ( $result != -1 )
					$this->output['success'] = true;
				else 
					$this->output['success'] = false;
			}

			if( $this->output['success'] = true ) {
				//Получаем кол-во книг из базы, для смены в шапке возле корзины
				$cart_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT SUM(count) FROM cart WHERE sid = \''.SID.'\'', 'array');
				$this->output['cart_count'] = $cart_count[0][0];
			}
		}
		else {
			$this->output['success'] = false;
		}

		echo json_encode($this->output);
	}

	private function registration()
	{
		$name = \Model\Functions::clearData($_POST['name']);
		$surname = \Model\Functions::clearData($_POST['surname']);
		$email = \Model\Functions::clearData($_POST['email']);
		$password1 = \Model\Functions::clearData($_POST['password1']);
		$password2 = \Model\Functions::clearData($_POST['password2']);

		if ( !empty($name) && !empty($surname) && !empty($email) && !empty($password1) && !empty($password2) ) {
			if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
				$this->output['err']['err_num'][] = 1;
				$this->output['err']['err_text'][] = 'Введите корректный email.';
				$this->output['success'] = false;
			}
			if ( $password1 !== $password2) {
				$this->output['err']['err_num'][] = 2;
				$this->output['err']['err_text'][] = 'Пароли не совпадают. Введите еще раз.';
				$this->output['success'] = false;		
			}
			if ( !isset( $this->output['success'] ) ) {
				$email = mysqli_real_escape_string( $this->db_link, $email );
				$user_count = \Model\MySQLi_Query::select($this->db_link, 
					'SELECT COUNT(*) FROM customers WHERE email = \''.$email.'\'', 'array');
					if ( $user_count[0][0] == 0) {
						$password = md5(md5($password1).'22');
						$user_to_ins = [
							'name' => $name,
							'surname' => $surname,
							'email' => $email,
							'address' => '',
							'phone' => '',
							'pass' => $password
						];

						$result = \Model\MySQLi_Query::insert($this->db_link, 'customers', $user_to_ins);
						if ( $result != -1 ){
							$this->output['success'] = true;
							$this->output['msg'] = 'Поздравляем, вы успешно зарегистрированны!';
						}
						else{
							$this->output['success'] = false;
							$this->output['err']['err_num'][] = 4;
							$this->output['err']['err_text'][] = 'Извините. Произошла ошибка при регистрации. Попробуте позже.';
						}						
					}
					else {
						$this->output['err']['err_num'][] = 3;
						$this->output['err']['err_text'][] = 'Пользователь с таким email уже существует.';
						$this->output['success'] = false;
					}
			}
		}
		else{
			$this->output['err']['err_num'][] = 0;
			$this->output['err']['err_text'][] = 'Заполните пжалуйста все поля.';
			$this->output['success'] = false;
		}
		//$this->output['success'] = true;
		echo json_encode($this->output);
	}

	private function authorization()
	{
		$email = \Model\Functions::clearData($_POST['email']);
		$pass = \Model\Functions::clearData($_POST['password']);

		if( !empty($email) && !empty($pass) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {
			$email = mysqli_real_escape_string( $this->db_link, $email );
			$pass = mysqli_real_escape_string( $this->db_link, $pass );
			$email_bd = \Model\MySQLi_Query::select($this->db_link, 'SELECT email FROM customers WHERE email = \''.$email.'\'', 'assoc');
			$pass_bd = \Model\MySQLi_Query::select($this->db_link, 'SELECT pass FROM customers	 WHERE email = \''.$email.'\'', 'assoc');
			
			$pass = md5(md5($pass).'22');

			if ( !empty($email_bd) && !empty($pass_bd) && ($email_bd[0]['email'] === $email) && ($pass === $pass_bd[0]['pass']) ) {
				$customer = \Model\Customer::Instance($this->db_link);
				if( $customer->setSession($email) ) {
					$this->output['success'] = true;
					$this->output['msg'] = SITE_URL;
				}
				else {
					$this->output['err']['err_num'][] = 1;
					$this->output['err']['err_text'][] = 'Неполучилось установить для вас сессию';
					$this->output['success'] = false;
				}
			} else {
				$this->output['err']['err_num'][] = 0;
				$this->output['err']['err_text'][] = 'Неправильный логин или пароль. Попоробуйте еще раз.';
				$this->output['success'] = false;
			}
		}
		else {
			$this->output['err']['err_num'][] = 0;
			$this->output['err']['err_text'][] = 'Неправильный логин или пароль. Попоробуйте еще раз.';
			$this->output['success'] = false;
		}

		echo json_encode($this->output);
	}

	private function logout()
	{
		$customer = \Model\Customer::Instance($this->db_link);
		$customer->deleteSession();
		$this->output['success'] = true;
		$this->output['msg'] = SITE_URL;

		echo json_encode($this->output);
	}

	private function change_item_count_form()
	{
		$id_book = \Model\Functions::clearData($_POST['id'], 'i');
		$value = \Model\Functions::clearData($_POST['value'], 'i');

		if(!empty($id_book) && !empty($value) && $value > 0) {
			$count_of = \Model\MySQLi_Query::select($this->db_link, 'SELECT count_of FROM books WHERE id_book = \''.$id_book.'\'', 'assoc');
			$count_of = $count_of[0]['count_of'];
			if ($count_of > $value) {
				$item['count'] = $value;
				$t = "id_book = '%s' AND sid = '%s'";
				$where = sprintf($t, mysqli_real_escape_string($this->db_link, $id_book), mysqli_real_escape_string($this->db_link, SID));
				$result = \Model\MySQLi_Query::update($this->db_link, 'cart', $item, $where);

				if ( $result != -1 ) {
					//get count of items in cart and price of all items to return and change on the site in ajax callback
					$cart_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT SUM(count) FROM cart WHERE sid = \''.SID.'\'', 'array');
					$price_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT price, count FROM cart WHERE sid = \''.SID.'\'', 'assoc');
					$items_summ = 0;
					foreach ($price_count as $key) {
						$items_summ += $key['price'] * $key['count']; 
					}
					$this->output['success'] = true;
					$this->output['items_summ'] = $items_summ;
					$this->output['cart_count'] = $cart_count[0][0];
				}
				else {
					$this->output['success'] = false;
					$this->output['err'] = 'При изменении произошла ошибка. Попробуйте позже';
				}
			}
			else {
				$this->output['success'] = false;
				$this->output['err'] = 'Количество книг на складе: ' . $count_of;
			}
		}
		else {
			$this->output['success'] = false;
			$this->output['err'] = 'Переданное значение некорректно.';
		}

		echo json_encode($this->output);
	}

	private function drop_from_cart()
	{
		$id_book = mysqli_real_escape_string( $this->db_link, \Model\Functions::clearData($_GET['id_book']) );

		if ( $id_book ) {
			$t = "id_book = '%s' AND sid = '%s'";
			$where = sprintf($t, mysqli_real_escape_string($this->db_link, $id_book), mysqli_real_escape_string($this->db_link, SID));
			$result = \Model\MySQLi_Query::delete($this->db_link, 'cart', $where);

			if ( $result != -1 ) {
				//get count of items in cart and price of all items to return and change on the site in ajax callback
				$cart_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT SUM(count) FROM cart WHERE sid = \''.SID.'\'', 'array');
				$price_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT price, count FROM cart WHERE sid = \''.SID.'\'', 'assoc');
				$items_summ = 0;
				foreach ($price_count as $key) {
					$items_summ += $key['price'] * $key['count']; 
				}
				$this->output['success'] = true;
				$this->output['id_book'] = $id_book;
				$this->output['items_summ'] = $items_summ;
				$this->output['cart_count'] = $cart_count[0][0];
			} else {
				$this->output['success'] = false;
			}
		}

		echo json_encode($this->output);
	}

	private function make_order()
	{
		$customer = \Model\Customer::Instance($this->db_link)->getCustomer()[0];

		$cart_items = \Model\MySQLi_Query::select($this->db_link,
											'SELECT id_book, title, author, cover, pages, price, category, count 
											FROM cart WHERE sid = \''.SID.'\'',
											'assoc');
		$order_summ = 0;
		foreach ($cart_items as $key) {
			$order_summ += $key['price'] * $key['count']; 
		}
		$date = time();
		$order = [
					'id_customer' => $customer['id_customer'],
					'date' => $date,
					'state' => 0,
					'order_summ' => $order_summ
				];

		$result = \Model\MySQLi_Query::insert($this->db_link, 'orders', $order);

		if ( $result != -1 ) {
			$id_order = \Model\MySQLi_Query::select($this->db_link,
												'SELECT id_order FROM orders WHERE 
												id_customer = \''.$customer['id_customer'].'\' AND date = \''.$date.'\' AND order_summ = \''.$order_summ.'\'',
												'assoc');

			$result_arr = [];
			foreach ($cart_items as $key) {
				$summ = $key['count'] * $key['price'];
				$book_order = [
						'id_book' => $key['id_book'],
						'id_order' => $id_order[0]['id_order'],
						'count' => $key['count'],
						'summ' => $summ
					];
				$result_arr[] = \Model\MySQLi_Query::insert($this->db_link, 'book_order', $book_order);
			}

			foreach ($result_arr as $key) {
				if ($key == -1) {
					$this->output['success'] = false;
					break;
				}
			}

			if( !isset($this->output['success']) ) {
				$t = "sid = '%s'";
				$where = sprintf($t, mysqli_real_escape_string($this->db_link, SID));
				$res = \Model\MySQLi_Query::delete($this->db_link, 'cart', $where);
				if ( $res != -1 ) {
					$this->output['success'] = true;
				} else {
					$this->output['success'] = false;
				}
			}


		}
		else {
			$this->output['success'] = false;
		}

		echo json_encode($this->output);
	}
}