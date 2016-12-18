<?php $args = array( 
    'post_type' => 'post', 
    'post_status' => 'publish', 
    'nopaging' => true 
);
$query = new WP_Query( $args ); // $query is the WP_Query Object
$posts = $query->get_posts();   // $posts contains the post objects

$output = array();
foreach( $posts as $post ) {    // Pluck the id and title attributes

    $output[] = array( 'id' => $post->ID, 
                       'title' => $post->post_title,
                       'post_content' => $post->post_content,
                       'post_excerpt' => $post->post_excerpt,
                       'post_url' => get_permalink($post->ID),
                       'post_thumb' => get_the_post_thumbnail($post->ID)
                         );

}

?>


<?php 
/**
 * Template Name: JSON page
 *
 * 
 */

get_header();
 ?>


<div id="blog">
  <div class="row">
  <div class="col-md-10 offset-md-1">
    <div v-for="post in posts">
       <!-- Rendered HTML is templated differently  -->
      <div class="col-md-3">
        <a :href="post.post_url" target="_blank" class="commit">
        <h2>{{post.title}}</h2>
        <div v-html="post.post_thumb"></div>
        <div v-html="post.post_content"></div>
        </a>
      </div>  
    </div>
  </div>  
</div>  

<script type="text/javascript" charset="utf-8">
  var postData = <?php echo json_encode($output); ?> ;
</script>
<script src="https://unpkg.com/vue@2.1.4/dist/vue.js" type="text/javascript" charset="utf-8" ></script>

<script type="text/javascript" charset="utf-8">

var blog = new Vue({
  el: '#blog',
  data: {  
    posts: postData
  }

})

</script>





<?php
get_footer();
