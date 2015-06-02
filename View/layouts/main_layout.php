<!DOCTYPE html>
<html>
<head>
	<title>Bookshop</title>
	<meta content="text/html; charset=utf8" http-equiv="content-type">
	<!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
	<!-- jQuery -->
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<!-- Bootstrap.js -->
   	<script src="js/bootstrap.js"></script>
	<!-- Site scripts -->
	<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body>
	<header class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<a class="navbar-brand" href="<?=SITE_URL?>">Книжный магазин</a>
			<div class="navbar-right">
				<?php if( empty($customer) || !isset($customer) ): ?>
				<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-auth">Вход</button>
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-reg">Регистрация</button>
				<?php else: ?>
					<a href="<?='http://localhost/bookshop/?r=site/profile'?>" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;&nbsp;<?=$customer['name'] . ' ' . $customer['surname']?></a>
					<a href="<?=SITE_URL.'&action=exit'?>" class="btn btn-primary btn-sm ajax_link">Выйти</a>
				<?php endif; ?>
				<a href="http://localhost/bookshop/?r=site/cart" class="pull-right" id="top_cart_num" href="#">
					<?php if ($cart_count == 0) $cart_count = '';?>
					<span id="cart_count_top"><?=$cart_count?></span>
					<span class="glyphicon glyphicon-shopping-cart"></span>
				</a>
			</div>
		</div>
	</header>
	<div id="main" class="container">

		<?=$content ?>

	</div>
	<footer class="footer">
		<div class="container">
			<p class="text-muted">Place sticky footer content here.</p>
		</div>
	</footer>

	<div class="modal fade" id="modal-auth">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Авторизация</h4>
                </div>
                <div class="modal-body">
                	<div class="alerts">
                		<div class="alert alert-success alert-authorization" role="alert"></div>
	                	<div class="alert alert-warning alert-authorization" role="alert"></div>
	                	<div class="alert alert-danger alert-authorization" role="alert"></div>
                	</div>
                    <form id="authorization_form" method="POST" action="javascript:void(0);">
	                    <div class="form-group">
		                    <label class="control-label" for="auth_email_input">Введите email</label>
		                    <div class="input-group">
		                    	<span class="input-group-addon">@</span>
		                    	<input type="email" class="form-control" id="auth_email_input" name="email" placeholder="Ваш email">
		                    </div>
	                    </div>
	                    <div class="form-group">
	                    	<label for="auth_pass_input">Введите новый пароль</label>
	                    	<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>                		
		                    	<input type="password" class="form-control" id="auth_pass_input" name="password" placeholder="Ваш пароль">
	                    	</div>
	                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="authorization_form" class="btn btn-success ajax_link" type="subbmit" request-type="post">Войти</button>
                    <button class="btn btn-default" type="button" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="modal-reg">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Регистрация</h4>
                </div>
                <div class="modal-body">
                	<p>Все поля обязательны для заполнения</p>
                	<div class="alerts">
                		<div class="alert alert-success alert-registration" role="alert"></div>
	                	<div class="alert alert-warning alert-registration" role="alert"></div>
	                	<div class="alert alert-danger alert-registration" role="alert"></div>
                	</div>
                    <form id="registration_form" method="POST" action="javascript:void(0);">
	                    <div class="form-group">
	                    	<label for="reg_name_input">Введите имя</label>
	                    	<div class="input-group">
	                    		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                    		<input type="text" class="form-control" id="reg_name_input" name="name" placeholder="Ваше имя">
	                    	</div>
	                    </div>
	                    <div class="form-group">
	                    	<label for="reg_pass_input">Введите фамилию</label>
	                    	<div class="input-group">
	                    		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                    		<input type="text" class="form-control" id="reg_pass_input" name="surname" placeholder="Ваша фамилия">
	                    	</div>
	                    </div>
	                    <div class="form-group">
		                    <label class="control-label" for="reg_email_input">Введите email</label>
		                    <div class="input-group">
		                    	<span class="input-group-addon">@</span>
		                    	<input type="email" class="form-control" id="reg_email_input" name="email" placeholder="Ваш email">
		                    </div>
	                    </div>
	                    <div class="form-group">
	                    	<label for="reg_pass_input1">Введите новый пароль</label>
	                    	<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>                		
		                    	<input type="password" class="form-control" id="reg_pass_input1" name="password1" placeholder="Ваш пароль">
	                    	</div>
	                    </div>
	                    <div class="form-group">
	                    	<label for="reg_pass_input2">Повторите пожалуйста пароль</label>
	                    	<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>                    		
		                    	<input type="password" class="form-control" id="reg_pass_input2" name="password2" placeholder="Еще разок">
	                    	</div>
	                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="registration_form" class="btn btn-primary ajax_link" type="subbmit" request-type="post">Зарегистрироваться</button>
                    <button class="btn btn-default" type="button" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>