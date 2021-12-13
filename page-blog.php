<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Botiga
 */

get_header();


?>

	<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>">


	
<template>
	<article class="blogs">
     
          <img src="" alt="" />
		 <h4 id="blog_navn"></h4>
          <p class="loop_beskrivelse"></p>
    </article>
</template>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	


<section class="blog_oversigt"></section>

<script>
window.addEventListener("DOMContentLoaded", start);


const blogTemplate = document.querySelector("template");

const url = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/blog_opslag?per_page=100";

const catUrl = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/categories?per_page=100";


let blogs;
let kategori;
let filterProdukt;
	


function start() {
     getJson(url);
    



}


async function getJson() {
  //Promise - data lover program at komme med date, imen det køre videre
  	let response = await fetch(url);
    let catResponse = await fetch(catUrl);
	blogs = await response.json();
    kategori = await catResponse.json();
  console.log(kategori);

  	 visBlogs();

    
    
};

function visBlogs() {
    const container = document.querySelector(".blog_oversigt");
  container.textContent = ""; //Ryd container inden loop
  blogs.forEach((blog) => {


        if (blog.categories.includes(7)) {

        //Er filter det samme som objekt? || betyder eller
        //Bestemt kategori eller alle objekter
   
      let klon = blogTemplate.cloneNode(true).content;
     
      //Placer i HTML

      klon.querySelector("#blog_navn").innerHTML = blog.title.rendered;
      klon.querySelector(".loop_beskrivelse").innerHTML = blog.blog_beskrivelse_kort;
	//klon.querySelector("img").src = blog.coverbillede.guid;
	  klon.querySelector(".blogs").addEventListener("click", () => {
        location.href = blog.link;

      });

      container.appendChild(klon); 

        }
    });
}


	


</script>


	

<?php
do_action( 'botiga_do_sidebar' );
get_footer();
