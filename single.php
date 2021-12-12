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
	  <h4></h4>
  <img id="produkt_img" src="" alt="" />

    <p class="pris"></p>
	<div class="ui">
		
		<div id="container">
      <button id="ned">-</button>
      <div id="number">0</div>

      <button id="up">+</button>
    </div>
		
    <button>Tilføj til kurv</button>
		</div>
    <p class="beskrivelse"></p>
    
</article>

<h2 id="produkt_oplysninger">Produkt oplysninger</h2>

<article class="lang_beskrivelse">
	
	 <p class="beskrivelse_dropdown"></p>

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
		let add = document.querySelector("#up");
        let remove = document.querySelector("#ned");
        let nr = document.querySelector("#number");
        let integer = 0;

        add.addEventListener("click", () => {
          integer += 1;
          nr.innerHTML = integer;
        });

        remove.addEventListener("click", () => {
          if (integer > 0) {
            integer -= 1;
            nr.innerHTML = integer;
          }
        });
		   
		   
         //Promise - data lover program at komme med date, imen det køre videre
         const result = await fetch(url);
         produkt = await result.json();
        console.log(produkt);
         visProdukt();
       }


       function visProdukt() {

   	document.querySelector("h4").innerHTML = produkt.navn;
    document.querySelector(".pris").innerHTML = produkt.pris + " kr.";
    document.querySelector(".beskrivelse").innerHTML = produkt.beskrivelse;
	document.querySelector("#produkt_img").src = produkt.billede.guid;
		   
    document.querySelector(".beskrivelse_dropdown").innerHTML = produkt.beskrivelse_dropdown;
	 
       }

  getJson();
</script>



<?php
do_action( 'botiga_do_sidebar' );
get_footer();
