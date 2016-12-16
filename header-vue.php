<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="vuetiful" v-cloak>
		<div class="header">
			<div class="shell">
				<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<h2><?php bloginfo( 'description' ); ?></h2>

				<div class="navigation">
					<?php
						$args = array(
							'theme_location' => 'main-menu',
							'container'      => false,
							'menu_class'     => false,
							'fallback_cb'    => false,
							'depth'          => 0,
						);
					
						wp_nav_menu( $args );
					?>
				</div>
			</div>
		</div>