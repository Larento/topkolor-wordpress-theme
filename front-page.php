<?php get_header(); ?>
<main role="main">
	<section class="tk-section hero">
		<?php tk_home_slideshow(); ?>
		<div class="container">
			<h1>Превращаем камень в искусство</h1>
		</div>
		<div class="container buttons">
			<a class="tk-button" href="/terrazzo">Изделия терраццо</a>
			<a class="tk-button" href="/micro-concrete">Покрытия из микробетона</a>
			<a class="tk-button" href="/decorative-concrete">Продукция из арт-бетона</a>
		</div>
	</section>
	<section class="tk-section commerce">
		<div class="container">
			<h2 class="heading">Почему ТОПКОЛОР?</h2>
			<div class="container lists">
				<div class="list-wrapper">
					<a class="icon no-text" <?= tk_icon('f00c', 'solid') ?>></a>
					<h4 class="list-heading">Оптимальный уровень цены при высоком качестве изделий</h4>
					<ul class="advantages-list">
						<li>Качество нашей продукции определяется её <strong>долговечностью</strong>, <strong>надежностью</strong> и <strong>функциональностью</strong></li>
						<li>На каждое изделие предоставляется <strong>гарантия на 12 месяцев</strong></li>
					</ul>
				</div>
				<div class="list-wrapper">
					<a class="icon no-text" <?= tk_icon('f1b8', 'solid') ?>></a>
					<h4 class="list-heading">Полный цикл изготовления изделий</h4>
					<ul class="advantages-list">
						<li>Проектирование 3D модели</li>
						<li>Выбор образцов</li>
						<li>Изготовление форм</li>
						<li>Изготовление и установка изделия</li>
						<li>Послепродажное обслуживание</li>
						<li>Консультации по уходу за изделиями (подбор чистящих, моющих и защитных средств для обработки поверхностей)</li>
					</ul>
				</div>
				<div class="list-wrapper">
					<a class="icon no-text" <?= tk_icon('f0c3', 'solid') ?>></a>
					<h4 class="list-heading">Собственное производство на основе оригинальных технологий</h4>
					<ul class="advantages-list">
						<li><strong>Сокращение срока</strong> изготовления изделий</li>
						<li><strong>Улучшение контроля</strong> за процессом производства</li>
					</ul>	
				</div>
				<div class="list-wrapper">
					<a class="icon no-text" <?= tk_icon('f2b5', 'solid') ?>></a>
					<h4 class="list-heading">Сотрудничество с ведущими архитектурными бюро</h4>
					<ul class="advantages-list">
						<li>Архитектурное бюро «САГА» (г. Москва)</li>
						<li>Артбюро «1/1»</li>
					</ul>	
				</div>
			</div>
			<a class="tk-button hollow" href="/about">Подробнее о компании</a>
		</div>
	</section>
	<section class="tk-section post document">
		<div class="container">
		<h3>OMG Guys This is Amazing!</h3>
		<?php the_content(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>