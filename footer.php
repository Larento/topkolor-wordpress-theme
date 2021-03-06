	<?php use \tk\functions as tk; ?>
	<?php wp_footer(); ?>
	<footer class="tk-section footer">
		<div class="container">
			<nav class="footer-links-navigation">
				<h4>Полезные ссылки</h3>
				<ul class="main-menu">
					<?php tk\get_menu( 'Footer Menu Links' ); ?>
				</ul>
			</nav>
			<nav class="footer-privacy-navigation">
				<h4>Информация</h3>
				<ul class="main-menu">
				<?php tk\get_menu( 'Footer Menu Privacy' ); ?>
				</ul>
			</nav>
			<nav class="footer-contact-navigation" id="contact-link">
				<h4>Как связаться</h3>
				<ul class="main-menu">
					<?php tk\get_menu( 'Footer Menu Contact' ); ?>
				</ul>
			</nav>
			<nav class="footer-social-navigation">
				<h4>Подпишитесь на нас</h3>
				<ul class="main-menu">
					<?php tk\get_menu( 'Footer Menu Social' ); ?>
				</ul>
			</nav>
		</div>
		<p class="copyright">Copyright © 2020 ООО "ТОПКОЛОР". Все права защищены.<p>
		<?php if( current_user_can('administrator') ) { ?>
			<div class="debug">
				<?php tk\footer_debug(); ?>
			</div>
		<?php } ?>
	</footer>
</body>
</html>