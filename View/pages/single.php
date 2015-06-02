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

<div id="book_container" class="col-lg-9">
	<h1><small><?=$book['title']?></small></h1>
	<div class="row">
		<div class="col-lg-3">
			<img src="images/books/<?=$book['cover']?>" />
		</div>
		<div class="col-lg-9 info_block">
			<p>Автор(а): <b><?=$book['author']?></b></p>
			<p>Количество страниц: <b><?=$book['pages']?></b></p>
			<p>Цена: <b><?=$book['price']?></b> грн.</p>
			<p>Категория: <b><?=$book['category']?></b></p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?=$book['desc']?>
		</div>
	</div>
	<p><a class="ajax_link" href="<?=SITE_URL.'&action=to_cart&id_book='.$book['id_book']?>">Добавить в корзину</a></p>
</div>