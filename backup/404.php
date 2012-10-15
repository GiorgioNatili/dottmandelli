<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

<div id="main" style="height:400px; text-align: center; padding:30px 0;">
<div class="harmonia uppercase tcenter"><strong><h1>Pagina non trovata</h1></strong></div>
<div class="helvetica"><h2>Prova a cercare dalla <a href="<?php print site_url(); ?>">homepage del sito</a></h2></div>
</div>
<?php get_footer(); ?>