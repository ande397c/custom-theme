<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/custom.css ">
	
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
		
	
		<div id="menu">
    <nav class="navigations_menu">
				<a class="logo" href="index.html"
					><img class="logo_img" src="./assets/images/logo.svg" alt="logo"
				/></a>
				<div id="burger_wrapper">
					<div id="menuknap">
						<div class="streg_1"></div>
						<div class="streg_2"></div>
						<div class="streg_3"></div>
					</div>
					<ul class="menu hidden">
						<li><a class="active" href="https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/">Shop</a></li>
						<li><a href="https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/guide/">Guide</a></li>
						<li><a href="cocktail.html">Blog</a></li>
						<li><a href="https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/om-os/">Om os</a></li>
					</ul>
				</div>
			</nav>
		
	</div>