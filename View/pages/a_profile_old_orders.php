<div class="col-lg-3">
	<div class="list-group">
		<a href="http://localhost/bookshop/?r=site/profile" class="list-group-item">
		    <i class="glyphicon glyphicon-user"></i>Мои данные
		</a>
		<!-- Тут админ связывается с клиентом и подтверждает либо отменяет заказ -->
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=new_orders" class="list-group-item">
		  	<i class="glyphicon glyphicon-download"></i>Новые заказы
		  	<?php if($new_orders_count != 0): ?>
			  	<span class="badge">
			  		<?=$new_orders_count?>
			  	</span>
		  	<?php endif; ?>
		</a>
		<!-- Тут заказ доставляется и т.д-->
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=cur_orders" class="list-group-item">
			<i class="glyphicon glyphicon-cog"></i>Заказы в обработке
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
		<div id="a_profile_cur_order_bloc_<?=$orders_info[$i]['id_order']?>">
			<p>
				Номер заказа: <b>#<?=$orders_info[$i]['id_order']?></b> 
				<!-- <span class="label label-warning">
					<?php if($orders_info[$i]['state'] == 0): ?>
						Ожидает подтверждения
					<?php elseif($orders_info[$i]['state'] == 1): ?>
						В обработке
					<?php endif; ?>
				</span> -->
			</p>
			<p>Дата оформления: <b><?=@date('d.m.Y H:i:s', $orders_info[$i]['date'] + 60 * 60 * 3)?></b></p>
			<p>Клиент: <b><?=$orders_info[$i]['name']?> <?=$orders_info[$i]['surname']?></b></p>
			<p>Телефон: <b><?=$orders_info[$i]['phone']?></b></p>
			<p>Email: <b><?=$orders_info[$i]['email']?></b></p>
			<p>Книги: </p>
			<?php for ($j = 0; $j < $c_orders_book; $j++): ?>
				<?php if ($orders_info[$i]['id_order'] == $orders_book_info[$j]['id_order']): ?>
					<p><b><?=$orders_book_info[$j]['title']?></b></p>
					<h5><span class="label label-default"><?=$orders_book_info[$j]['count']?> x <?=$orders_book_info[$j]['price']?> грн</span></h5>
				<?php endif; ?>
			<?php endfor; ?>
			<p>Сумма заказа: <b><?=$orders_info[$i]['order_summ']?></b></p>
			<hr/>
		</div>
	<?php endfor; ?>
	<?php if($c_orders == 0): ?>
		История заказов пуста.
	<?php endif; ?>
</div>