	<?php wp_footer(); ?>
	<footer class="tk-section footer">
		<div class="container">
			<nav class="footer-links-navigation">
				<h3>Полезные ссылки</h3>
				<ul class="main-menu">
					<?php tk_get_menu( 'Footer Menu Links' ); ?>
				</ul>
			</nav>
			<nav class="footer-privacy-navigation">
				<h3>Информация</h3>
				<ul class="main-menu">
				<?php tk_get_menu( 'Footer Menu Privacy' ); ?>
				</ul>
			</nav>
			<nav class="footer-contact-navigation">
				<h3>Как связаться</h3>
				<ul class="main-menu">
					<?php tk_get_menu( 'Footer Menu Contact' ); ?>
				</ul>
			</nav>
			<nav class="footer-social-navigation">
				<h3>Подпишитесь на нас</h3>
				<ul class="main-menu">
					<li class="menu-item">
					<a href="https://www.instagram.com/_tkolor/" <?= tk_icon('16d', 'brand') ?>></a>
					</li>
				</ul>
			</nav>
		</div>
		<p class="copyright">Copyright © 2020 ООО "ТОПКОЛОР". Все права защищены.<p>
	</footer>
</body>
</html>