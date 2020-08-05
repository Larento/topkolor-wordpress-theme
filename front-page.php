<?php get_header(); ?>

<main role="main">
	<section class="tk-section hero">
		<?php tk_home_slideshow(); ?>
		<h1>Превращаем камень в искусство</h1>
		<button class="tk-button" href="/terrazzo">Изделия терраццо</button>
		<a role="button" href="/micro-concrete">Покрытия из микробетона</a>
		<a role="button" href="/decorative-concrete">Продукция из арт-бетона</a>
	</section>
	<section class="tk-section commerce">
		<h2>Почему ТОПКОЛОР?</h2>
		<h3>Оптимальный уровень цены при высоком качестве изделий</h3>
		<ul class="">
			<li><a <?= tk_icon('007', 'solid') ?>></a><li>
			<li>Качество нашей продукции определяется её <strong>долговечностью</strong>, <strong>надежностью</strong> и <strong>функциональностью</strong></li>
			<li>На каждое изделие предоставляется <strong>гарантия на 12 месяцев</strong></li>
		</ul>
		<h3>Полный цикл изготовления изделий</h3>
		<ul>
			<li>Проектирование 3D модели</li>
			<li>Выбор образцов</li>
			<li>Изготовление форм</li>
			<li>Изготовление и установка изделия</li>
			<li>Послепродажное обслуживание</li>
			<li>Консультации по уходу за изделиями (подбор чистящих, моющих и защитных средств для обработки поверхностей)</li>
		</ul>
		<h6>Собственное производство на основе оригинальных технологий</h6>
		<ul>
			<li style="text-align: left;"><strong>Сокращение срока</strong> изготовления изделий</li>
			<li style="text-align: left;"><strong>Улучшение контроля</strong> за процессом производства</li>
		</ul>
		<h6>Сотрудничество с ведущими архитектурными бюро</h6>
		<ul>
			<li style="text-align: left;">Архитектурное бюро «САГА» (г. Москва)</li>
			<li>Артбюро «1/1»</li>
		</ul>
		<a role="button" href="/about">Подробнее о компании
		</a>
	</section>
</main>

<?php get_footer(); ?>