	<?php wp_footer(); ?>
	<footer class="tk-section footer">
		<div class="container">
			<nav class="footer-links-navigation">
				<h3>Полезные ссылки</h3>
				<?php tk_get_menu( 'Footer Menu Links' ); ?>
			</nav>
			<nav class="footer-privacy-navigation">
				<h3>Информация</h3>
				<?php tk_get_menu( 'Footer Menu Privacy' ); ?>
			</nav>
			<nav class="footer-contact-navigation">
				<h3>Как связаться</h3>
				<?php tk_get_menu( 'Footer Menu Contact' ); ?>
			</nav>
			<nav class="footer-social-navigation">
				<h3>Подпишитесь на нас</h3>
				<a href="https://www.instagram.com/_tkolor/" <?= tk_icon('16d', 'brand') ?>></a>
			</nav>
		</div>
	</footer>
</body>
</html>