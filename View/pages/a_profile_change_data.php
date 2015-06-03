<div class="col-lg-3">
	<div class="list-group">
		<a href="http://localhost/bookshop/?r=site/profile" class="list-group-item">
		    <i class="glyphicon glyphicon-user"></i>Мои данные
		</a>
		<!-- Тут админ связывается с клиентом и подтверждает либо отменяет заказ -->
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=new_orders" class="list-group-item">
		  	<i class="glyphicon glyphicon-download"></i>Новые заказы
		</a>
		<!-- Тут заказ доставляется и т.д-->
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=cur_orders" class="list-group-item">
			<i class="glyphicon glyphicon-cog"></i>Заказы в обработке
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
	<?php if ( $msg == 'success' ): ?>
		<div class="alert alert-success alert-visible" role="alert">Данные успешно изменены</div>
	<?php elseif ( $msg != 'success' && $msg != ''): ?>
		<div class="alert alert-danger alert-visible" role="alert"><?=$msg?></div>
	<?php endif; ?>
	<form method="POST" action="">
		<div class="form-group">
			<label for="name">Имя</label>
			<input type="text" class="form-control" id="name" name="name" value="<?=$p_customer['name']?>" placeholder="<?=$p_customer['name']?>">
		</div>
		<div class="form-group">
			<label for="surname">Фамилия</label>
			<input type="text" class="form-control" id="surname" name="surname" value="<?=$p_customer['surname']?>" placeholder="<?=$p_customer['surname']?>">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" value="<?=$p_customer['email']?>" placeholder="<?=$p_customer['email']?>">
		</div>
		<div class="form-group">
			<label for="phone">Телефон</label>
			<?php if ( !$data_flag ): ?>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Введите ваш номер телефона">
			<?php else: ?>
				<input type="text" class="form-control" id="phone" name="phone" value="<?=$p_customer['phone']?>" placeholder="<?=$p_customer['phone']?>">
			<?php endif; ?>
		</div>
		<div class="form-group">
			<label for="address">Адресс</label>
			<?php if ( !$data_flag ): ?>
				<input type="text" class="form-control" id="address" name="address" placeholder="Введите ваш адресс">
			<?php else: ?>
				<input type="text" class="form-control" id="address" name="address" value="<?=$p_customer['address']?>" placeholder="<?=$p_customer['address']?>">
			<?php endif; ?>
		</div>
		<button type="submit" class="btn btn-success">Подтвердить</button>
	</form>
</div>