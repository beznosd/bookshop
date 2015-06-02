<div class="col-lg-3">
	<div class="list-group">
		<a href="http://localhost/bookshop/?r=site/profile" class="list-group-item">
		    <i class="glyphicon glyphicon-user"></i>Мои данные
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=cur_orders" class="list-group-item">
		  	<i class="glyphicon glyphicon-list-alt"></i>Текущие заказы
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=old_orders" class="list-group-item">
			<i class="glyphicon glyphicon-ok"></i>История заказов
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=change_data" class="list-group-item active">
			<i class="glyphicon glyphicon-wrench"></i>Изменить данные
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=change_pass" class="list-group-item">
			<i class="glyphicon glyphicon-lock"></i>Сменить пароль
		</a>
	</div>
</div>
<div class="col-lg-9">
	<form method="POST" action="">
		<div class="form-group">
			<label for="name">Имя</label>
			<input type="text" class="form-control" id="name" placeholder="<?=$p_customer['name']?>">
		</div>
		<div class="form-group">
			<label for="name">Фамилия</label>
			<input type="text" class="form-control" id="surname" placeholder="<?=$p_customer['surname']?>">
		</div>
		<div class="form-group">
			<label for="name">Email</label>
			<input type="email" class="form-control" id="email" placeholder="<?=$p_customer['email']?>">
		</div>
		<div class="form-group">
			<label for="name">Телефон</label>
			<?php if ( !$data_flag ): ?>
				<input type="email" class="form-control" id="email" placeholder="Введите ваш номер телефона">
			<?php else: ?>
				<input type="email" class="form-control" id="email" placeholder="<?=$p_customer['phone']?>">
			<?php endif; ?>
		</div>
		<div class="form-group">
			<label for="name">Адресс</label>
			<?php if ( !$data_flag ): ?>
				<input type="email" class="form-control" id="email" placeholder="Введите ваш адресс">
			<?php else: ?>
				<input type="email" class="form-control" id="email" placeholder="<?=$p_customer['address']?>">
			<?php endif; ?>
		</div>
		<button type="submit" class="btn btn-success">Подтвердить</button>
	</form>
</div>