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
	<!-- Site scripts -->
	<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body>
	<header class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Книжный магазин</a>
			<a class="navbar-right" href="#">
				<span id="cart_count_top"><?=$cart_count?></span>
				<span class="glyphicon glyphicon-shopping-cart"></span>
			</a>
		</div>
	</header>
	<div id="main" class="container">
		<div class="col-lg-3">
			<nav>
				<ul>
					<?php $cat_count = count($categories); ?>
					<?php for ($i = 0; $i < $cat_count; $i++): ?>
						<li><a href="#"><?=$categories[$i]['category']?></a></li>
					<?php endfor; ?>
				</ul>
			</nav>
		</div>

		<?=$content ?>

	</div>
	<footer class="footer">
		<div class="container">
			<p class="text-muted">Place sticky footer content here.</p>
		</div>
	</footer>
</body>
</html>