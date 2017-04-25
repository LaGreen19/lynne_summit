<?php
/**
 * The template for displaying speaker pages
 *
 * @package WordPress
 * @subpackage divi-child_Theme
 * @since divi-child Theme 1.1
 */
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post();?>

			<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
