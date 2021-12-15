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

<ul class="breadcrumb">
      <li><a href="https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/">Hjem</a></li>
      <li>Sneakerpleje</li>
      
    </ul>

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

  <!-- Dropdown menu, hvert menupunkt har tildelt et 
      id, så vi kan sortere i indholdet efter der bliver klikket -->

	<div class="dropdown">
  <button class="dropbtn">Sortering</button>
  <div class="dropdown-content">
 <li id="lav_hoej">Sortér efter pris: lav til høj</li>
 <li id="hoej_lav">Sortér efter pris: høj til lav</li>
 <li id="rating">Sortér efter popularitet</li>
 
  </div>
</div>
  <!-- Template tag der definerer strukturen for den information
        som vi ønsker at vise i DOM'en -->
<template>
	<article class="produkter">
     
          <img class="produkt_img" src="" alt="" />
		 <h4></h4>
          <p class="pris"></p>
    </article>
</template>





      <!-- Tom section tag som bruges som container og 
            placere indholdet fra forEach loopet -->
<section class="produkt_oversigt"></section>
	



<script>

  // Der "lyttes" efter om alt DOM-indhold er loaded. Når indholdet er loaded kaldes start funktionen. 
window.addEventListener("DOMContentLoaded", start);

// Der defineres en variabel for templaten 
const produktTemplate = document.querySelector("template");

// Der defineres yderligere to urler for henholdsvis alle produkter og alle kategorier 
const url = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/produkt?per_page=100";

const catUrl = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/categories?per_page=100";


// Der defineres en varibabel for produkter og for kategori, ligesom der skal blev oprettet urler
let produkter;
let kategori;


	
	// Variabler til dropdown:

const dropdown_menu = document.querySelector(".dropdown");
const dropdown_indhold = document.querySelector(".dropdown-content");

const lowHigh = document.querySelector("#lav_hoej");
const highLow = document.querySelector("#hoej_lav");
const rates = document.querySelector("#rating");


function start() {
  // Her kaldes funktionen getJson, den kaldes med parameteret url som blev defineret som variabel
     getJson(url);



	    // Dropdown-sortering

    dropdown_menu.addEventListener("click", ()=> {
      dropdown_indhold.classList.toggle("block");
    })
    


// Når der klikkes på et punkt i dropdown menuen bliver arrayet produkter sorteret i pris
// fra høj til lav før det vises i DOM'en

    highLow.addEventListener("click", ()=> {

      produkter.sort((a, b) => {
          return b.pris - a.pris;
        }); 
        visProdukter();


      console.log("highLow");
    })

// Når der klikkes på et punkt i dropdown menuen bliver arrayet produkter sorteret i pris
// fra lav til høj før det vises i DOM'en
  lowHigh.addEventListener("click", ()=> {

    produkter.sort((a, b) => {
          return a.pris - b.pris;
        }); 
        visProdukter();


      console.log("lowHigh");
    })

// Når der klikkes på et punkt i dropdown menuen bliver arrayet produkter sorteret efter id
// før det skrives ud i DOM'en. Sortingen i id skal imitere en sortering af de mest populære produkter

    rates.addEventListener("click", ()=> {

      produkter.sort((a, b) => {
          return a.id - b.id;
        }); 
        visProdukter();



  
      console.log("rating");
    })

    




}

 // Funktion der henter data via json
 
async function getJson() {
  //Promise - data lover program at komme med date, imens det kører videre
  	let response = await fetch(url);
    let catResponse = await fetch(catUrl);
  	produkter = await response.json();
    kategori = await catResponse.json();
  console.log(kategori);

  	visProdukter();
};

// I denne funktion skrives indholdet ud i DOM'en
function visProdukter() {
  // Der defineres en variabel for en tom sektion hvor indholdet skal skrives ud i
    const container = document.querySelector(".produkt_oversigt");
  container.textContent = ""; //Ryd container inden loop
  // Der laves et forEach loop for hvert produkt, således 
  // Hvert produkt får klonet informationerne og får så det appended 
  // det til containeren.
  produkter.forEach((produkt) => {


    // Der laves en if sætning der sikrer at der kun hentes
    // produkter ind hvis de har tilknytning til en bestemt kategori. 
        if (produkt.categories.includes(4)) {

        //Er filter det samme som objekt? || betyder eller
        //Bestemt kategori eller alle objekter
   
      let klon = produktTemplate.cloneNode(true).content;
     
      //Placer i HTML

      klon.querySelector("h4").innerHTML = produkt.title.rendered;
      klon.querySelector(".pris").innerHTML = produkt.pris + " kr.";
	    klon.querySelector("img").src = produkt.billede.guid;
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


