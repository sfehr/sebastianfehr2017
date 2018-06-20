<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sebastian_fehr
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			
			the_post_thumbnail( 'full' );
			
		if( class_exists('Dynamic_Featured_Image') ) {
			 global $dynamic_featured_image;
			 $featured_images = $dynamic_featured_image->get_featured_images( $postId );

			//You can now loop through the image to display them as required
			if( !is_null($featured_images) ){
						
			foreach( $featured_images as $images ): ?>
			<img class="featured-image" src="<?php echo $images['full'] ?>" /></a>
			<?php endforeach;
			} 
	 	}
			
			
		// Getting Meta Data from custom Field (CMB2 + CMB2 Flexible Content Plugin)
		$flexible_fields = get_post_meta( get_the_ID(), 'sf_flexible_content', true );
		
		//check weather the field exists before displaying	
		if($flexible_fields){
			
			foreach( $flexible_fields as $field ) {
				
				// checking the field type and retrieving the data accordingly
				//IMAGE
				if ( 'image' === $field['layout'] ) { ?>
				
					<img class="featured-image" src="<?php echo esc_html( $field['sf_image'] ); ?>" />
					<?php //echo esc_html( $field['sf_radio'] );
				}
				//MOVIE
				else if ( 'movie' === $field['layout'] ) { ?>
					<div class="embed-container">
						<?php echo wp_oembed_get( $field['sf_embed'] ); ?>
					</div>
				<?php	
				}
			}			
		}	
		
			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
