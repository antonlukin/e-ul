<?php
/**
 * Home region template
 *
 * Display front page content with news archive and main slider
 *
 * @since 1.0
 */

use Flight as app;

?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&amp;subset=cyrillic" rel="stylesheet">
	<link href="/assets/styles.min.css" rel="stylesheet" type="text/css" media="all" />

	<link href="/manifest.json" rel="manifest">

	<meta name="theme-color" content="#262626">
</head>

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
