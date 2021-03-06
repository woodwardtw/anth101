<?php
/**
 * Template Name: Recent IG style page
 *
 * @package pro
 */

get_header(); ?>

	<?php if( get_option( 'page_for_posts' ) ) : $cover_page = get_page( get_option( 'page_for_posts' ) ); ?>

	<?php if(get_post_meta($cover_page->ID, 'progression_page_title', true) == 'hide' ) : ?><?php else: ?>
		<div id="soundbyte-page-title">
			<div class="width-container-progression">
				<?php if(function_exists('bcn_display')) { echo '<div id="bread-crumb-container"><div class="breadcrumbs-soundbyte"><ul id="breadcrumbs-pro"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo esc_html_e( 'Home', 'soundbyte-progression' );  echo '</a></li>'; bcn_display_list(); echo '</ul><div class="clearfix-progression"></div></div></div>'; }?>
				<h1 id="page-title" class="entry-title-pro"><?php $page_for_posts = get_option('page_for_posts'); ?><?php echo get_the_title($page_for_posts); ?></h1>
				<?php if(get_post_meta($cover_page->ID, 'progression_sub_title', true)) : ?><h2><?php echo esc_html( get_post_meta($cover_page->ID, 'progression_sub_title', true) );?></h2><?php endif; ?>
			</div>
		</div><!-- #page-title-pro -->
	<?php endif; ?>
	<?php else: ?>
		<div id="soundbyte-page-title" style="background-image:url(<?php
				the_post_thumbnail_url(); ?>) !important">
			<div class="width-container-progression">
				<h1 id="page-title" class="entry-title-pro"><?php the_title(); ?></h1>
			</div>
		</div><!-- #page-title-pro -->
	<?php endif; ?>

	<div id="content-pro" class="site-content">
		<div class="width-container-progression<?php if( get_option( 'page_for_posts' ) ) : $cover_page = get_page( get_option( 'page_for_posts' ) ); ?><?php if(get_post_meta($cover_page->ID, 'progression_page_sidebar', true) == 'left-sidebar' ) : ?> left-sidebar-pro<?php endif; ?><?php endif; ?>">

				<?php if( get_option( 'page_for_posts' ) ) : $cover_page = get_page( get_option( 'page_for_posts' ) ); ?>
				<?php if(get_post_meta($cover_page->ID, 'progression_page_sidebar', true) == 'right-sidebar' ) : ?><div id="soundbyte-sidebar-container"><?php endif; ?>
				<?php if(get_post_meta($cover_page->ID, 'progression_page_sidebar', true) == 'left-sidebar' ) : ?><div id="soundbyte-sidebar-container"><?php endif; ?>
				<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php

					$args = array( 'numberposts' => '5' );
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
						echo '<div><a href="' . get_permalink($recent["ID"]) . '"><h2>' . $recent["post_title"].'</h2></a>';
						echo get_favorites_button($recent["ID"]);
						echo $recent['post_content'] . '</div> ';
						$comment_args = array( 
							'post_id' => $recent["ID"],
							'count' => 5,			
							);
						$comments = get_comments( $comment_args );
						var_dump($comments);
					}
					wp_reset_query();

				?>				

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php if( get_option( 'page_for_posts' ) ) : $cover_page = get_page( get_option( 'page_for_posts' ) ); ?>
			<?php if(get_post_meta($cover_page->ID, 'progression_page_sidebar', true) == 'right-sidebar' ) : ?></div><!-- close #main-container-pro --><?php get_sidebar(); ?><?php endif; ?>
			<?php if(get_post_meta($cover_page->ID, 'progression_page_sidebar', true) == 'left-sidebar' ) : ?></div><!-- close #main-container-pro --><?php get_sidebar(); ?><?php endif; ?>
			<?php endif; ?>

		<div class="clearfix-progression"></div>
		</div><!-- close .width-container-pro -->
	</div><!-- #content-pro -->
<?php get_footer(); ?>
