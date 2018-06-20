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

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;
			?>
			
			<!-- Feature Image Slider Wrapper: -->
			<div class="w3-content w3-display-container">
			
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				
				// get_template_part( 'template-parts/content', get_post_format() );
			
				////Featured Image/Thumbnail linked to the post:			
				if ( has_post_thumbnail() ) : ?>
				
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('', array( 'class' => 'mySlides' ) ); ?></a>
				<?php endif;
				
				//// Additional Multiple Featured Image/Thumbnail linked to the post:
				if( class_exists('Dynamic_Featured_Image') ) {
					global $dynamic_featured_image;
					$featured_images = $dynamic_featured_image->get_featured_images( );					
					
       				//for each loop requested to extract the content
       				if( !is_null($featured_images) ){
						
						foreach( $featured_images as $images ): ?>
						
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img class="mySlides" src="<?php echo $images['full'] ?>" /></a>
						<?php endforeach;
       				}   					
				}

			endwhile;
			?>
			<button class="w3-button w3-black w3-display-left" onclick="plusSlides(-1)"></button>
  			<button class="w3-button w3-black w3-display-right" onclick="plusSlides(1)"></button>
			</div>	
			<!-- Wrapper End -->
			
			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();