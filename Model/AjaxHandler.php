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
			switch ($action) {
				case 'to_cart':
					$this->add_to_cart($action);
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
		$this->output['action'] = $action;
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
}