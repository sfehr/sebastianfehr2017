<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sebastian_fehr
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php // echo esc_url( __( 'https://wordpress.org/', 'sebastian-fehr' ) ); ?>"><?php // printf( esc_html__( 'Proudly powered by %s', 'sebastian-fehr' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php // printf( esc_html__( 'Theme: %1$s by %2$s.', 'sebastian-fehr' ), 'sebastian-fehr', '<a href="https://automattic.com/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
		

		<?php if ( is_front_page() && is_home() ) {

		}else{ ?>
		<div class="footer-navi">
			<a class="back-anchor animateStates" href="<?php echo esc_url( home_url() ); ?>">back</a>
			<a class="top-anchor animateStates" href="#top">top</a>
		</div>		
		<?php } ?>
		
		
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
