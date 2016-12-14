<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon" role="contentinfo">

					<div class="bio-info col-md-3">
					<h3>Michael Wesch</h3>
					University Distinguished Teaching Scholar<br>
					Associate Professor of Cultural Anthropology<br>
					2008 US Professor of the Year<br>
					Kansas State University

					</div>
					<div class="bio-info col-md-3">
					<h3>Ryan Klataske</h3>
					ABD Michigan State University<br>
					2017 KSU Spotlight Speaker for Outstanding Teaching<br>
					Kansas State University

					</div>
					<!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
