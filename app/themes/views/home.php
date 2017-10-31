<?php
include (__DIR__ . "/../parts/header.php");
echo app\helpers\core::env("DB_USERNAME");
?>
<body>
	<header class="header">
		<div class="header__topline topline block">
			<button class="topline__button topline__button--search" role="button">
				<span class="icon icon--search"></span>
			</button>

			<div class="topline__logo">
				<a class="topline__logo-link logo" href="#" role="banner">
					<span class="logo__image logo__image--ulgov">Правительство Ульяновской области</span>
					<span class="logo__image logo__image--eul">Корпорация развития ИТ</span>
					<span class="logo__title">Корпорация развития ИТ<br> Ульяновской области</span>
				</a>
			</div>

			<div class="topline__search">
				<form class="topline__search-form search" action="#" method="post">
					<input class="search__input input" type="text" value="" role="search" placeholder="Поиск по сайту">

					<button class="search__button" type="submit">
						<span class="icon icon--search"></span>
						<span class="icon icon--right"></span>
					</button>
				</form>
			</div>

			<button class="topline__button topline__button--menu toggle" role="button">
				<span class="toggle__line"></span>
				<span class="toggle__line"></span>
				<span class="toggle__line"></span>
			</button>
		</div>

		<div class="header__menu menu">
			<nav class="menu__list block" role="navigation">
				<a class="menu__link" href="#">О нас</a>
				<a class="menu__link" href="#">Новости</a>
				<a class="menu__link" href="#">Органам власти</a>
				<a class="menu__link" href="#">Связи с общественностью</a>
				<a class="menu__link" href="#">Учебный центр</a>
				<a class="menu__link" href="#">Юрпомощь</a>
				<a class="menu__link" href="#">Галерея</a>
				<a class="menu__link" href="#">Контакты</a>
			</nav>
		</div>
	</header>

	<section class="slider" role="slider">
		<div class="slider__control">
			<button class="slider__control-item slider__control-item--prev" tabindex="-1">
				<span class="icon icon--left">
			</button>

			<button class="slider__control-item slider__control-item--next" tabindex="-1">
				<span class="icon icon--right">
			</button>
		</div>

		<div class="slider__list">
			<article class="slider__item" style="background-image: url(assets/images/slider/geo-portal.jpg)">
				<div class="slider__item-wrap">

					<div class="slider__item-content block">
						<h2 class="slider__item-heading">Геопортал</h2>
						<h3 class="slider__item-description">Создание и развитие инфраструктуры пространственных данных Ульяновской области</h3>

						<a class="slider__item-button button" href="#">Перейти</a>
					</div>

				</div>
			</article>

			<article class="slider__item" style="background-image: url(assets/images/slider/temp-image.jpg)">
				<div class="slider__item-wrap">

					<div class="slider__item-content block">
						<h2 class="slider__item-heading">Электронный дневник</h2>
						<h3 class="slider__item-description">Сетевой город. Образование СГО</h3>

						<a class="slider__item-button button" href="#">Зарегистрироваться</a>
					</div>

				</div>
			</article>
		</div>
	</section>

	<section class="news block">
		<div class="news__wrap">
			<h2 class="news__heading text text--heading">Новости ИТ региона</h2>

			<div class="news__list">
				<article class="news__item">
					<p class="news__item-date">2 августа 2017</p>

					<a class="news__item-link" href="#" role="link">
						<h3 class="news__item-title">Для специалистов ИТ-сферы пройдет вебинар по электронному управлению на тему &laquo;Умные города, управляемые Большими данными&raquo;</h3>
						<p class="news__item-excerpt">
							Мероприятие организовано Европейским региональным офисом Всемирной организации электронных правительств городов и местной власти.
							<span class="news__item-more icon icon--right"></span>
					</p>
					</a>
				</article>

				<article class="news__item">
					<p class="news__item-date">31 июля 2017</p>

					<a class="news__item-link" href="#" role="link">
						<h3 class="news__item-title">Команда студентов-робототехников УлГТУ стала четвертой в России в конкурсе «Роботлон» Второго всероссийского форума «Новые кадры ОПК»</h3>
						<p class="news__item-excerpt">
							Команда студентов факультета информационных систем и технологий УлГТУ была приглашена принять участие в финале танкового биатлона «Роботлон» и заняла четвертое место.

							<span class="news__item-more icon icon--right"></span>
						</p>
					</a>
				</article>

				<article class="news__item">
					<p class="news__item-date">13 июля 2017</p>

					<a class="news__item-link" href="#" role="link">
						<h3 class="news__item-title">Жители Ульяновской области, подавшие заявку через Госуслуги, могут получить охотбилет в центре «Мои Документы»</h3>
						<p class="news__item-excerpt">
							Необходимо обратиться в ближайший к вам МФЦ для получения документов

							<span class="news__item-more icon icon--right"></span>
						</p>
					</a>
				</article>

				<article class="news__item">
					<p class="news__item-date">11 апреля 2017</p>

					<a class="news__item-link" href="#" role="link">
						<h3 class="news__item-title">В детском лагере «Волжанка» сотрудники ОГКУ «Правительство для граждан» обучили детей правилам безопасности в Интернете</h3>
						<p class="news__item-excerpt">
							Сотрудники помогли детям разобраться в правилах безопасности.

							<span class="news__item-more icon icon--right"></span>
						</p>
					</a>
				</article>
			</div>

			<div class="news__button">
				<a class="button" href="#">Читать все новости</a>
			</div>
		</div>
	</section>

	<section class="grid grid--services block">
		<div class="grid__wrap">
			<h2 class="grid__heading text text--heading">Электронные услуги и сервисы</h2>

			<div class="grid__list">

				<a class="grid__item" href="http://mfc.ulgov.ru/" title="Перейти на сайт МФЦ" role="link">
					<div class="grid__item-logo">
						<img class="grid__item-image" src="/assets/images/logo/logo-mfc.png" alt="Получение услуг в МФЦ">
					</div>

					<div class="grid__item-detail">
						<h3 class="grid__item-tagline">Получение услуг в МФЦ</h3>

						<p class="grid__item-text">Государственные и муниципальные услуги</p>
						<p class="grid__item-link">http://mfc.ulgov.ru/</p>
					</div>
				</a>

				<a class="grid__item" href="http://sgo.cit73.ru/" role="link">
					<div class="grid__item-logo">
						<img class="grid__item-image" src="/assets/images/logo/logo-el-dnevnik.png" alt="">
					</div>

					<div class="grid__item-detail">
						<h3 class="grid__item-tagline">Электронный дневник</h3>

						<p class="grid__item-text">Сетевой город. <br>Образование СГО</p>
						<p class="grid__item-link">http://sgo.cit73.ru</p>
					</div>
				</a>

				<a class="grid__item" href="http://nalog.ru" role="link">
					<div class="grid__item-logo">
						<img class="grid__item-image" src="/assets/images/logo/logo-nalog.png">
					</div>

					<div class="grid__item-detail">
						<h3 class="grid__item-tagline">Оплата налогов</h3>

						<p class="grid__item-text">Сайт федеральной налоговой службы</p>
						<p class="grid__item-link">http://nalog.ru</p>
					</div>
				</a>

				<a class="grid__item" href="http://gosuslugi.ru" role="link">
					<div class="grid__item-logo">
						<img class="grid__item-image" src="/assets/images/logo/logo-gosuslugi.png">
					</div>

					<div class="grid__item-detail">
						<h3 class="grid__item-tagline">Получение госуслуг</h3>

						<p class="grid__item-text">Теперь пользоваться госуслугами очень просто!</p>
						<p class="grid__item-link">http://gosuslugi.ru</p>
					</div>
				</a>

				<a class="grid__item" href="http://ulgov.ru/epress/video/" role="link">
					<div class="grid__item-logo">
						<img class="grid__item-image" src="/assets/images/logo/logo-ulgov.png">
					</div>

					<div class="grid__item-detail">
						<h3 class="grid__item-tagline">Online трансляции</h3>

						<p class="grid__item-text">Online трансляции официального сайта правительства</p>
						<p class="grid__item-link">http://ulgov.ru/epress/video/</p>
					</div>
				</a>

				<a class="grid__item" href="https://doctror73.ru" role="link">
					<div class="grid__item-logo">
						<img class="grid__item-image" src="/assets/images/logo/logo-doctor73.png">
					</div>

					<div class="grid__item-detail">
						<h3 class="grid__item-tagline">Запись на прием к врачу</h3>

						<p class="grid__item-text">Официальный портал учреждений здравоохранения</p>
						<p class="grid__item-link">https://doctror73.ru</p>
					</div>
				</a>
			</div>
		</div>
	</section>

	<aside class="promo promo--feedback block">
		<div class="promo__wrap">
			<h2 class="promo__heading text text--heading">Уже воспользовались услугами на нашем сайте?</h2>

			<div class="promo__detail">
				<p class="text">Мы хотим, чтобы наш портал стал еще проще и удобнее. Каждое мнение помогает улучшать и развивать проект.</p>
				<p class="text">Если у вас есть предложения, конструктивная критика или просто хороший отзыв &mdash; пишите, мы будем благодарны.</p>
			</div>

			<div class="promo__button">
				<button class="button" type="button" role="button">Оставить отзыв</a>
			</div>
		</div>
	</aside>


	<script src="/assets/scripts.min.js"></script>
</body>
</html>
