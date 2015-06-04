<div class="col-lg-3">
	<nav>
		<ul>
			<?php $cat_count = count($categories); ?>
			<?php for ($i = 0; $i < $cat_count; $i++): ?>
				<li><a href="http://localhost/bookshop/?r=site/category&category=<?=$categories[$i]['category']?>"><?=$categories[$i]['category']?></a></li>
			<?php endfor; ?>
		</ul>
	</nav>
</div>

<div id="books_container" class="col-lg-9">
	<?php $books_count = count($books); ?>
	<?php for ($i = 0; $i < $books_count; $i++): ?>
			<div class="col-lg-3">
				<a href="<?='http://localhost/bookshop/?r=site/single'.'&id_book='.$books[$i]['id_book']?>">
					<img src="images/books/<?=$books[$i]['cover']?>" />
				</a>
				<br/><br/>
				<p class="book_name"><?=mb_substr($books[$i]['title'], 0, 30) . '...'?></p>
				<p><a class="ajax_link" href="<?=SITE_URL.'&action=to_cart&id_book='.$books[$i]['id_book']?>">В корзину</a></p>
			</div>
	<?php endfor; ?>
</div>