<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title"
	      content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="hfeed site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">
	<div class="title-left">
		<!-- Your site title as branding in the menu -->
							<?php if ( ! has_custom_logo() ) { ?>
							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								<!--<?php bloginfo( 'name' ); ?>-->
								<div class="brand" id="brand-short">ANTH </div>
								<div class="brand" id="brand-short">
								101
								</div>
							</a>
							<?php } else {
								the_custom_logo();
		} ?><!-- end custom logo -->
		</div>	

		<a class="skip-link screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content',
		'understrap' ); ?></a>
		
		<nav class="navbar site-navigation" itemscope="itemscope" id="navbar-custom"
		     itemtype="http://schema.org/SiteNavigationElement">

			<div class="<?php echo esc_html( $container ); ?>" id="content">

				<div class="navbar-header">

					<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
					<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse"
					        data-target=".exCollapsingNavbar" aria-controls="exCollapsingNavbar" aria-expanded="false"
					        aria-label="Toggle navigation"></button>					

				</div>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-toggleable-xs exCollapsingNavbar',
						'container_id'    => 'exCollapsingNavbar',
						'menu_class'      => 'nav navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				); ?>
				
			</div> <!-- .container -->			

		</nav><!-- .site-navigation -->
		<div id="sub-nav-right">
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>  
			<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>  
			<a href="#"><i class="fa fa-soundcloud" aria-hidden="true"></i></a> | 
			<a href="#">Other Link</a> | <a href="#">More</a>
			</div>

	</div><!-- .wrapper-navbar end -->
