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

<template>
	<article class="produkter">
      <h4></h4>
          <img class="produkt_img" src="" alt="" />
          <p class="pris"></p>
    </article>
</template>





     
<section class="produkt_oversigt"></section>
	



<script>
window.addEventListener("DOMContentLoaded", start);


const produktTemplate = document.querySelector("template");

const url = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/produkt?per_page=100";

const catUrl = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/categories?per_page=100";


let produkter;
let kategori;
let filterKurs;
let filter = "alle";


function start() {
     getJson(url);
	console.log("id er", <?php echo get_the_ID() ?>);
}

async function getJson() {
  //Promise - data lover program at komme med date, imen det køre videre
  	let response = await fetch(url);
    let catResponse = await fetch(catUrl);
  	produkter = await response.json();
    kategori = await catResponse.json();
  console.log(kategori);

  	visProdukter();
    
};

function visProdukter() {
    const container = document.querySelector(".produkt_oversigt");
  container.textContent = ""; //Ryd container inden loop
  produkter.forEach((produkt) => {


        if (produkt.categories.includes(4)) {

        //Er filter det samme som objekt? || betyder eller
        //Bestemt kategori eller alle objekter
   
      let klon = produktTemplate.cloneNode(true).content;
     
      //Placer i HTML

      klon.querySelector("h4").innerHTML = produkt.title.rendered;
      klon.querySelector(".pris").innerHTML = produkt.pris;
	  klon.querySelector(".produkter").addEventListener("click", () => {
        location.href = produkt.link;

      });

      container.appendChild(klon); 

        }
    });
}


	


</script>


<?php
do_action( 'botiga_do_sidebar' );
get_footer();


