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
					$this->add_to_cart($action);
					break;
				case 'registration_form':
					$this->registration($action);
					break;
				default:
					echo "No such action";
					break;
			}
		}

		die();
	}

	private function add_to_cart($action)
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
			if ( $result == -1 )
				$this->output['success'] = false;
			else
				$this->output['success'] = true;

			//Получаем кол-во книг из базы, для смены в шапке возле корзины
			$cart_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT COUNT(*) FROM cart WHERE sid = \''.SID.'\'', 'array');
			$this->output['cart_count'] = $cart_count[0][0];
		}
		else {
			$this->output['success'] = false;
		}

		echo json_encode($this->output);
	}

	private function registration($action)
	{
		$name = \Model\Functions::clearData($_POST['name']);
		$surname = \Model\Functions::clearData($_POST['surname']);
		$email = \Model\Functions::clearData($_POST['email']);
		$password1 = \Model\Functions::clearData($_POST['password1']);
		$password2 = \Model\Functions::clearData($_POST['password2']);

		if ( !empty($name) && !empty($surname) && !empty($email) && !empty($password1) && !empty($password2) ) {
			if ( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
				if ( $password1 === $password2) {
					$user_count = \Model\MySQLi_Query::select($this->db_link, 
					'SELECT COUNT(*) FROM customers WHERE email = \''.$email.'\'', 'array');
					if ( $user_count[0][0] == 0) {
						//code to insert data to database
						$this->output['success'] = true;
					}
					else {
						$this->output['error'] = 'Пользователь с таким email уже существует.';
						$this->output['success'] = false;
					}
				} else {
					$this->output['error'] = 'Пароли не совпадают. Введите еще раз.';
					$this->output['success'] = false;
				}
			}
			else {
				$this->output['error'] = 'Введите корректный email.';
				$this->output['success'] = false;
			}
		}
		else{
			$this->output['error'] = 'Заполните пожалуйста все поля.';
			$this->output['success'] = false;
		}
		//$this->output['success'] = true;
		echo json_encode($this->output);

		
	}
}