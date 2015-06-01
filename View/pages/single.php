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

<!-- <div id="books_container" class="col-lg-9">
	<?php $books_count = count($books); ?>
	<?php for ($i = 0; $i < $books_count; $i++): ?>
		<?php if ( $books_count > 4): ?>
			<div class="row">
		<?php endif; ?>
				<div class="col-lg-3">
					<a href="<?=SITE_URL.'&id_book='.$books[$i]['id_book']?>">
						<img src="images/books/<?=$books[$i]['cover']?>" />
					</a>
					<br/><br/>
					<p><?=$books[$i]['title']?></p>
					<p><a class="ajax_link" href="<?=SITE_URL.'&action=to_cart&id_book='.$books[$i]['id_book']?>">В корзину</a></p>
				</div>
		<?php if ( $books_count > 4): ?>
			</div>
		<?php endif; ?>
	<?php endfor; ?>
</div> -->