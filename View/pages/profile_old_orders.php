<div class="col-lg-3">
	<div class="list-group">
		<a href="http://localhost/bookshop/?r=site/profile" class="list-group-item">
		    <i class="glyphicon glyphicon-user"></i>Мои данные
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=cur_orders" class="list-group-item">
		  	<i class="glyphicon glyphicon-list-alt"></i>Текущие заказы
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=old_orders" class="list-group-item active">
			<i class="glyphicon glyphicon-ok"></i>История заказов
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=change_data" class="list-group-item">
			<i class="glyphicon glyphicon-wrench"></i>Изменить данные
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=change_pass" class="list-group-item">
			<i class="glyphicon glyphicon-lock"></i>Сменить пароль
		</a>
	</div>
</div>
<div class="col-lg-9 order_info_block">
	<?php $c_orders = count($orders_info); $c_orders_book = count($orders_book_info); ?>
	<?php for ($i = 0; $i < $c_orders; $i++): ?>
		<?php if($orders_info[$i]['state'] == 2): ?>
		<p>
			Номер заказа: <b>#<?=$orders_info[$i]['id_order']?></b> 
		</p>
		<p>Дата оформления: <b><?=@date('d.m.Y H:i:s', $orders_info[$i]['date'] + 60 * 60 * 3)?></b></p>
		<p>Книги: </p>
		<?php for ($j = 0; $j < $c_orders_book; $j++): ?>
			<?php if ($orders_info[$i]['id_order'] == $orders_book_info[$j]['id_order']): ?>
				<p><b><?=$orders_book_info[$j]['title']?></b></p>
				<h5><span class="label label-default"><?=$orders_book_info[$j]['count']?> x <?=$orders_book_info[$j]['price']?> грн</span></h5>
			<?php endif; ?>
		<?php endfor; ?>
		<p>Сумма заказа: <b><?=$orders_info[$i]['order_summ']?></b></p>
		<hr/>
	<?php endif; ?>
	<?php endfor; ?>
	<?php if($c_orders == 0): ?>
		История заказов пуста.
	<?php endif; ?>
</div>