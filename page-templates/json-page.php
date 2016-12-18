<?php $args = array( 
    'post_type' => 'post', 
    'post_status' => 'publish', 
    'nopaging' => true 
);
$query = new WP_Query( $args ); // $query is the WP_Query Object
$posts = $query->get_posts();   // $posts contains the post objects

$output = array();
foreach( $posts as $post ) {    // Pluck the id and title attributes
    $output[] = array( 'id' => $post->ID, 'title' => $post->post_title );
}
//echo json_encode( $output );
?>
<?php 
/**
 * Template Name: JSON page
 *
 * 
 */

get_header();
 ?>
<script src="https://unpkg.com/vue@2.1.4/dist/vue.js" type="text/javascript" charset="utf-8" ></script>


<div id="blog">
  <ul>
    <li v-for="post in posts" class="hvr-sweep-to-top">
      <a :href="post.link" target="_blank" class="commit">
       <!-- Rendered HTML is templated differently  -->
      <div v-html="post.title.rendered"></div></a>
      <div v-html="post.content.rendered"></div>
    </li>
  </ul>  
</div>  


<script type="text/javascript" charset="utf-8">
var postData = <?php echo json_encode($output); ?> 

var blog = new Vue({
  el: '#blog',
  data: {  
    posts: postData
  }

})

</script>





<?php
get_footer();
