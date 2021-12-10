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
	
	<div id="content" class="content"></div>






<article id="single">
  <img id="product_img" src="" alt="" />
  <h4></h4>
    <p class="pris"></p>
    <button>Tilføj til kurv</button>
    <p class="beskrivelse"></p>
    
</article>

<h2 id="h2_lignende">Andre kunder har købt</h2>

<section id="andre_produkter"></section>
      <template>
        <article>
          <img src="" alt="" />
          <h2></h2>
          <p class="pris"></p>
        </article>
      </template>
    
<script>
   let produkt;
      const url = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/produkt/"+<?php echo get_the_ID() ?> ;


     window.addEventListener("DOMContentLoaded", getJson);

       async function getJson() {
         //Promise - data lover program at komme med date, imen det køre videre
         const result = await fetch(url);
         produkt = await result.json();
        console.log(produkt);
         visKurser();
       }


       function visKurser() {

   	document.querySelector("h4").innerHTML = produkt.navn;
    document.querySelector(".pris").innerHTML = produkt.pris;
    document.querySelector(".beskrivelse").innerHTML = produkt.beskrivelse;
       }

  getJson();
</script>



<?php
do_action( 'botiga_do_sidebar' );
get_footer();
