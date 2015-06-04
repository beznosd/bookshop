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
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=old_orders" class="list-group-item">
			<i class="glyphicon glyphicon-ok"></i>История заказов
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=change_data" class="list-group-item">
			<i class="glyphicon glyphicon-wrench"></i>Изменить данные
		</a>
		<a href="http://localhost/bookshop/?r=site/profile&menu_point=change_pass" class="list-group-item active">
			<i class="glyphicon glyphicon-lock"></i>Сменить пароль
		</a>
	</div>
</div>
<div class="col-lg-9">
	<?php if ( $msg == 'success' ): ?>
		<div class="alert alert-success alert-visible" role="alert">Пароль успешно изменен</div>
	<?php elseif ( $msg != 'success' && $msg != ''): ?>
		<div class="alert alert-danger alert-visible" role="alert"><?=$msg?></div>
	<?php endif; ?>
	<form method="POST" action="">
		<div class="form-group">
			<label for="old_pass">Старый пароль</label>
			<input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Введите старый пароль">
		</div>
		<div class="form-group">
			<label for="new_pass1">Новый пароль</label>
			<input type="password" class="form-control" id="new_pass1" name="new_pass1" placeholder="Введите новый пароль">
		</div>
		<div class="form-group">
			<label for="new_pass2">Повторите новый пароль</label>
			<input type="password" class="form-control" id="new_pass2" name="new_pass2" placeholder="Введите еше раз новый пароль">
		</div>
		<button type="submit" class="btn btn-success">Подтвердить</button>
	</form>
</div>