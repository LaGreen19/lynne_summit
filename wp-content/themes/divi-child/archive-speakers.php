<?php
/**
 * The template for displaying speaker archive page
 *
 * @package WordPress
 * @subpackage divi-child_Theme
 * @since divi-child Theme 1.1
 */
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
<?php echo do_shortcode('[et_pb_section global_module="536"][/et_pb_section]'); ?>

			<?php while ( have_posts() ) : the_post();?>
<a href="<?php the_permalink(); ?>">
			<?php the_content(); ?>
</a>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
