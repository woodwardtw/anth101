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
                            echo '<dt>Challenges Met:</dt><dd> ' . (count_user_posts( $curauth->ID )) . '</dd>';
                        } else {
                            echo ' No challenges yet.';
                        };?>

                    </dl>                    

                </header><!-- .page-header -->
            
                        
                <h2>Progress</h2>
                


<!-- 3rd row responsive images in background with centered content -->
                <div class="row">


                 <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <a href="<?php the_permalink();?>">
                            <div class="square bg img1" <?php get_post_background_img ($post);?>>
                               <div class="content">
                                    <div class="table" id="assignments">
                                        <div class="table-cell" id="assg_<?php get_assignment_category_number();?>">
                                            <span class="assignment_id"><?php get_assignment_category_number();?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     </a>
                    <?php endwhile; ?>

                    <?php else : ?>

                        <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                    <?php endif; ?>
                    <!-- End Loop -->       
                </div>
            

            <?php 
            //get the categories form the Student Submissions parent category and put them in an array
            $challenge_names = get_categories( array( 'child_of' => 293,'hide_empty' => false, 'orderby' => 'slug' ) );                
            $challenge_array =[];
            for($i = 0; $i <count($challenge_names); $i++) {
                echo $challenge_names[$i]->cat_name . '<br>';
                array_push($challenge_array, $challenge_names[$i]->cat_name);
            }
            var_dump($challenge_array);

            $args = array( 
                'author' => $curauth->ID,                
                );
            $the_query = new WP_Query( $args );
            // The Loop
            if ( $the_query->have_posts() ) :

            while ( $the_query->have_posts() ) : $the_query->the_post();
              // Do Stuff
             //var_dump(get_the_category($post->ID)[0]->name);             
             $challenges = 0;
             if (get_the_category($post->ID)[0]->name === "1. Talking to Strangers"){
                 echo "<div>4. Getting Uncomfortable – Thick Descriptions</div>";
                 $challenges = 1;
                var_dump($challenges);
                 }

            endwhile;
            endif;
            // Reset Post Data
            wp_reset_postdata();
            ?>
                        

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
