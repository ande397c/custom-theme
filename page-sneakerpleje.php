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
      <li>Produktoversigt</li>
      
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

	<div class="dropdown">
  <button class="dropbtn">Sortering</button>
  <div class="dropdown-content">
 <li id="lav_hoej">Sortér efter pris: lav til høj</li>
 <li id="hoej_lav">Sortér efter pris: høj til lav</li>
 <li id="rating">Sortér efter popularitet</li>
 
  </div>
</div>

<template>
	<article class="produkter">
     
          <img class="produkt_img" src="" alt="" />
		 <h4></h4>
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
let filterProdukt;
let filter = "alle";
	
	// Variabler til dropdown:

const dropdown_menu = document.querySelector(".dropdown");
const dropdown_indhold = document.querySelector(".dropdown-content");

const lowHigh = document.querySelector("#lav_hoej");
const highLow = document.querySelector("#hoej_lav");
const rates = document.querySelector("#rating");


function start() {
     getJson(url);
	    // Dropdown-sortering

    dropdown_menu.addEventListener("click", ()=> {
      dropdown_indhold.classList.toggle("block");
    })
    



    highLow.addEventListener("click", ()=> {

      produkter.sort((a, b) => {
          return b.pris - a.pris;
        }); 
        visProdukter();


      console.log("highLow");
    })


  lowHigh.addEventListener("click", ()=> {

    produkter.sort((a, b) => {
          return a.pris - b.pris;
        }); 
        visProdukter();


      console.log("lowHigh");
    })


    rates.addEventListener("click", ()=> {

      produkter.sort((a, b) => {
          return a.id - b.id;
        }); 
        visProdukter();



  
      console.log("rating");
    })

    




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


