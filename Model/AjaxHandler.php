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
										'SELECT title, author, cover, pages, price, category FROM books WHERE id_book = '.$id_book.'',
										'assoc');
			$book_to_ins = [
				'id_book' => $id_book,
				'title' => $book[0]['title'],
				'author' => $book[0]['author'],
				'cover' => $book[0]['cover'],
				'pages' => $book[0]['pages'],
				'price' => $book[0]['price'],
				'category' => $book[0]['category'],
				'sid' => SID
			];

			$result = \Model\MySQLi_Query::insert($this->db_link, 'cart', $book_to_ins);
			if ( $result != -1 )
				$this->output['success'] = true;
			else
				$this->output['success'] = false;

			//Получаем кол-во книг из базы, для смены в шапке возле корзины
			$cart_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT COUNT(*) FROM cart WHERE sid = \''.SID.'\'', 'array');
			$this->output['cart_count'] = $cart_count[0][0];
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
		$this->output['success'] = true;
		$this->output['yes'] = 'yes';
		echo json_encode($this->output);
	}
}