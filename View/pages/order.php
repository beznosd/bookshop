<div id="order_container" class="col-lg-10">
	<div class="page-header">
		<h3>Оформление заказа</h3>
	</div>
	<div id="order_info">
		<?php if(!$items_count): ?>
			Что бы оформить заказ, в корзине должны быть книги.
		<?php else: ?>
			<p>Имя: <b><?=$o_customer['name']?></b></p>
			<p>Фамилия: <b><?=$o_customer['surname']?></b></p>
			<p>Почта: <b><?=$o_customer['email']?></b></p>
			<p>Адресс: <b><?=$o_customer['address']?></b></p>
			<p>Телефон: <b><?=$o_customer['phone']?></b></p>
			<p>Книги: </p>
			<hr/>
			<?php for ($i = 0; $i < $items_count; $i++): ?>
				<p><b><?=$items[$i]['title']?></b></p>
				<p><b><?=$items[$i]['author']?></b></p>
				<h5><span class="label label-default"><?=$items[$i]['count']?> x <?=$items[$i]['price']?> грн</span></h5>
				<hr/>
			<?php endfor; ?>
			<p>Общая сумма заказа: <b><?=$items_summ?></b> грн.</p>
			<?php if($o_customer['address'] != '' || $o_customer['phone'] != ''): ?>
				<button id="make_order" class="btn btn-success">Подтвердить</button>
			<?php else: ?>
				<div class="alert alert-danger alert-visible" role="alert">
					Заполните пожалуйста адресс и(или) телефон в своем профиле.<br/>
					Затем вы сможете подтвердить заказ.
				</div>
				<button class="btn btn-success disabled">Подтвердить</button>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
<div id="cart_side" class="col-lg-2">
	<h4>На данный момент</h4>
	<p>В корзине: <b id="cart_count_side"><?=$all_items_count?></b> книг</p>
	<p>На сумму: <b id="cart_summ_side"><?=$items_summ?></b> грн.</p>
	<p><a href="http://localhost/bookshop/?r=site/cart" class="btn btn-warning btn-block">Вернуться в корзину</a></p>
</div>
