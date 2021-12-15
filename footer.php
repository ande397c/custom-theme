<!DOCTYPE HTML>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

?>

	<?php do_action( 'botiga_main_wrapper_end' ); ?>			

	<?php do_action( 'botiga_footer_before' ); ?>

	<?php do_action( 'botiga_footer' ); ?>

	<?php do_action( 'botiga_footer_after' ); ?>

<div id="footer">


	<div class="oplysninger">


	<h3>Oplysninger</h3>

	<p>Sneakidong ApS</p>
	<p>CVR: 38172808</p>
	<p>Kirkevænget 4, 1 th</p>
	<p>Kirkevænget 4, 1 th,
	3450 Allerød, Danmark</p>
	<p>(+45) 27 62 93 05</p>
	<p>contact@sneakidong.com</p>
	</div>

	<div class="information">

	<h3>Information</h3>
	<a href="https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/handelsbetingelser/">
		<p>Handelsbetingelser</p>
 </a>
		<a href="https://anderstrapman.dk/kea/2.semester/eksamen/sneaidong/om-os/">
		<p>Kontakt os</p>
 </a>
	</div>



<div  class="nyhedsbrev">
	<h3>
		Tilmeld nydhedsbrev
	</h3>
	
	<div class="contaioner_form">
		
  <form action="action_page.php">

    <input type="text" id="email" name="email" placeholder="Email"> 
	  
    <input type="text" id="fname" name="firstname" placeholder="Fornavn"> 

    <input type="text" id="lname" name="lastname" placeholder="Efternavn">

   <input type="submit" id="tilmeld_knap" value="Tilmeld">
 </form>
</div>
	
</div>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

