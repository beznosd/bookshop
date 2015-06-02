<div class="col-lg-3">
	<div class="list-group">
		<a href="http://localhost/bookshop/?r=site/profile" class="list-group-item active">
		    <i class="glyphicon glyphicon-user"></i>Мои данные
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=cur_orders" class="list-group-item">
		  	<i class="glyphicon glyphicon-list-alt"></i>Текущие заказы
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=old_orders" class="list-group-item">
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
<div class="col-lg-9">
	<p>Имя: <b><?=$p_customer['name']?></b></p>
	<p>Фамилия: <b><?=$p_customer['surname']?></b></p>
	<p>Почта: <b><?=$p_customer['email']?></b></p>
	<p>Адресс: <b><?=$p_customer['address']?></b></p>
	<p>Телефон: <b><?=$p_customer['phone']?></b></p>
	<?php if ( !$data_flag ): ?>
		<h4><span class="label label-warning">Без адреса или телефона вы не сможете оформить заказ.</span></h4>
	<?php endif; ?>
</div>