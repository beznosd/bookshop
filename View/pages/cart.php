<div id="cart_container" class="col-lg-10">
	<div class="page-header">
		<h3>Ваша корзина</h3>
	</div>
	<?php if(!$items_count): ?>
		К сожалению вы еще не добавили ни одной книги.
	<?php endif; ?>
	<?php for ($i = 0; $i < $items_count; $i++): ?>
		<div id="<?=$items[$i]['id_book']?>_book_row" class="row">
			<div class="col-lg-2">
				<a href="http://localhost/bookshop/?r=site/single&id_book=<?=$items[$i]['id_book']?>">
					<img src="images/books/<?=$items[$i]['cover']?>" />
				</a>
			</div>
			<div class="col-lg-10 info_block">
				<a href="http://localhost/bookshop/?r=site/single&id_book=<?=$items[$i]['id_book']?>"><h4><?=$items[$i]['title']?></h4></a>
				<p>Автор(а): <b><?=$items[$i]['author']?></b></p>
				<p>Количество страниц: <b><?=$items[$i]['pages']?></b></p>
				<p>Цена: <b><?=$items[$i]['price']?></b> грн.</p>
				<p>Категория: <b><?=$items[$i]['category']?></b></p>
				<form class="form-inline change_item_count_form">
				  <div class="form-group">
				    <label for="item_count">В корзине штук:</label>
				    <input form="change_item_count_form" type="text" class="form-control item_count" id="<?=$items[$i]['id_book']?>_item_count" name="item_count" value="<?=$items[$i]['count']?>">
				  </div>
				</form>
				<p><a class="btn btn-danger btn-sm ajax_link" href="<?=SITE_URL.'&action=drop_cart&id_book='.$items[$i]['id_book']?>">Удалить из корзины</a></p>
			</div>
		</div>
	<?php endfor; ?>
</div>
<div id="cart_side" class="col-lg-2">
	<h4>На данный момент</h4>
	<p>В корзине: <b id="cart_count_side"><?=$all_items_count?></b> книг</p>
	<p>На сумму: <b id="cart_summ_side"><?=$items_summ?></b> грн.</p>
	<p><a href="http://localhost/bookshop/?r=site/order" class="btn btn-warning btn-block">Оформить заказ</a></p>
</div>
