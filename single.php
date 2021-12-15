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


	
	<div id="content" class="content"></div>


<ul class="breadcrumb">
      <li><a href="https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/">Hjem</a></li>
	  <li><a href="javascript:history.back()">Produktoversigt</a></li>
      <li>Produktdetaljer</li>
    </ul>






<article id="single">
	  <h1 id="single_navn"></h1>
  <img id="produkt_img" src="" alt="" />

    <h4 class="pris_single"></h4>
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

<div id="oplysninger_section">
      <h4>Se produktoplysninger</h4>
      <div class="produkt_detaljer">
        <div class="line1"></div>
        <div class="line2"></div>
      </div>
    </div>


    <p class="beskrivelse_dropdown"></p>



<h2 id="h2_lignende">Andre kunder har købt</h2>

<section id="andre_produkter"></section>

      <template>
      <article class="lignende_produkter">
     
     <img class="produkt_img" src="" alt="" />
    <h4></h4>
     <p class="pris"></p>
    </article>
      </template>
    
<script>

      let produkt;
      let produkter;

      const id = <?php echo get_the_ID() ?>;

      const url = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/produkt/"+id;

      const produkterUrl = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/produkt?per_page=3";


      const relaUrl = "https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/wp-json/wp/v2/produkt?per_page=100";

      const produktTemplate = document.querySelector("template");

      
	  
	    const ekstra_info = document.querySelector("#oplysninger_section");

      const beskrivelse = document.querySelector(".beskrivelse_dropdown");

      const streg = document.querySelector(".line2");

  

     window.addEventListener("DOMContentLoaded", getJson);



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

     beskrivelse.style.display = "none";

    ekstra_info.addEventListener("click", foldOut);
		   




    async function jason() {
    let response = await fetch(produkterUrl);
  	produkter = await response.json();
    console.log(produkter);

  	visAndreProdukter();

     }


async function getJson() {
		   
		   
         //Promise - data lover program at komme med date, imen det køre videre
         const result = await fetch(url);
         produkt = await result.json();
        console.log(produkt);
         visProdukt();
		   
		   
       }

	
	
function foldOut() {

    
        if (beskrivelse.style.display == "none") {
          beskrivelse.style.display = "block";
          streg.style.display = "none";
        } else {
          beskrivelse.style.display = "none";
          streg.style.display = "block";
        }
      }




    
function visAndreProdukter() {
    const liste = document.querySelector("#andre_produkter");
  liste.textContent = "";
  produkter.forEach((produkt) => {

    if (produkt.id != id) {
     
      let klon = produktTemplate.cloneNode(true).content;
      klon.querySelector("h4").innerHTML = produkt.title.rendered;
      klon.querySelector(".pris").innerHTML = produkt.pris + " kr.";
	  klon.querySelector("img").src = produkt.billede.guid;
	  klon.querySelector(".lignende_produkter").addEventListener("click", () => {
        location.href = produkt.link;

      });

      liste.appendChild(klon); 
      
    }
  });
}




function visProdukt() {

   	document.querySelector("#single_navn").innerHTML = produkt.navn;
    document.querySelector(".pris_single").innerHTML = produkt.pris + " kr.";
    document.querySelector(".beskrivelse").innerHTML = produkt.beskrivelse;
	document.querySelector("#produkt_img").src = produkt.billede.guid;
		   
    document.querySelector(".beskrivelse_dropdown").innerHTML = produkt.beskrivelse_dropdown;
	 
       }

  getJson();

  jason();


</script>



<?php
do_action( 'botiga_do_sidebar' );
get_footer();
