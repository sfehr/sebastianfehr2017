<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sebastian_fehr
 
 Template Name: Index
 */
get_header(); ?>

<?php
$custom_query = new WP_Query( array( 'posts_per_page' => -1 ) );
while($custom_query->have_posts()) : $custom_query->the_post(); ?>

	<div <?php post_class('index-posts'); ?> id="post-<?php the_ID(); ?>">
		
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		
		<a href="<?php the_permalink(); ?>"><span class="index-link"><?php the_title_attribute(); ?></span></a>
		<?php // the_content(); ?>
	</div>

<?php endwhile; ?>
<?php wp_reset_postdata(); // reset the query 
get_sidebar();
get_footer();
?>