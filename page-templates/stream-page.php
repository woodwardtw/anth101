<?php 
/**
 * Template Name: Stream page
 *
 * 
 */

get_header();
 ?>
	<script src="https://unpkg.com/vue@2.1.4/dist/vue.js" type="text/javascript" charset="utf-8" ></script>

<h2>Blog posts via JSON API</h2>

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
	
var blogURL = 'http://192.168.33.10/wordpress/anth/wp-json/wp/v2/posts?per_page=40'

var blog = new Vue({
  el: '#blog',
  data: {  
    posts: null
  },

  created: function () {
    this.fetchData()
  },

  methods: {
    fetchData: function () {
      var xhr = new XMLHttpRequest()
      var self = this
      xhr.open('GET', blogURL)
      xhr.onload = function () {
        self.posts = JSON.parse(xhr.responseText)
        console.log(self.posts)
      }
      xhr.send()
    }
  }
})

</script>

<?php
get_footer();
