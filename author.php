<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>


<div class="wrapper" id="author-wrapper">

    <div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

            <main class="site-main" id="main">

                <header class="page-header author-header">

                    <?php
                    $curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug',
                        $author_name ) : get_userdata( intval( $author ) );
                    ?>

                     <?php if ( ! empty( $curauth->ID ) ) : ?>
                        <div class="author-avatar"><?php echo get_avatar( $curauth->ID ); ?></div>
                    <?php endif; ?>

                    <h1 id="author-name"><?php echo esc_html( $curauth->nickname ); ?></h1>

                    <dl>
                        <?php if ( ! empty( $curauth->user_url ) ) : ?>
                            <dt><?php esc_html_e( 'Tribe:', 'understrap' ); ?></dt>
                            <dd>
                                <a href="<?php echo esc_html( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
                            </dd>
                        <?php endif; ?>                        

                        <?php if ( ! empty( $curauth->user_description ) ) : ?>
                            <dt><?php esc_html_e( 'More about me: ', 'understrap' ); ?></dt>
                            <dd><?php echo esc_html( $curauth->user_description ); ?></dd>
                        <?php endif; ?>

                        <?php if (count_user_posts( $curauth->ID ) >0 ) {
                            echo '<dt>Posts:</dt><dd> ' . count_user_posts( $curauth->ID ) . '</dd>';
                        } else {
                            echo ' No posts yet.';
                        };?>

                    </dl>                    

                </header><!-- .page-header -->
                <h2>Progress</h2>
                <div class="container">
                    <div class="row">                 
                    <!-- The Loop -->
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                             <div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="dummy"></div>
                                <div class="thumbnail"></div>
                            </div>
                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                    <?php endif; ?>
                    </div>
                </div>
                    <!-- End Loop -->


            </main><!-- #main -->

            <!-- The pagination component -->
            <?php understrap_pagination(); ?>

        </div><!-- #primary -->

        <!-- Do the right sidebar check -->
        <?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

            <?php get_sidebar( 'right' ); ?>

        <?php endif; ?>

    </div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
