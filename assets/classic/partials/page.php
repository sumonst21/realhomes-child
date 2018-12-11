<?php
/**
 * Page Template
 *
 * @package realhomes
 * @subpackage classic
 */

get_header();
?>

<!-- Page Head -->
<?php get_template_part( 'assets/classic/partials/banners/default' ); ?>

<!-- Content -->
<div class="container contents single">
	<div class="row">
		<div class="span9 main-wrap">
			<!-- Main Content -->
			<div class="main">

				<div class="inner-wrapper">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
								<?php
								$title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
								if ( 'hide' !== $title_display ) {
									?>
									<h3 class="post-title"><?php the_title(); ?></h3>
									<hr/>
									<?php
								}

								if ( has_post_thumbnail() ) {
									$image_id  = get_post_thumbnail_id();
									$image_url = wp_get_attachment_url( $image_id );
									echo '<a class="' . get_lightbox_plugin_class() . '" href="' . esc_attr( $image_url ) . '" title="' . get_the_title() . '" >';
									the_post_thumbnail( 'post-featured-image' );
									echo '</a>';
								}

								the_content();

								// WordPress Link Pages.
								wp_link_pages( array(
									'before'         => '<div class="pages-nav clearfix">',
									'after'          => '</div>',
									'next_or_number' => 'next',
								) );
								?>
							</article>
							<?php
						endwhile;

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endif;
					?>
				</div>

			</div><!-- End Main Content -->

		</div> <!-- End span9 -->

		<?php get_sidebar( 'pages' ); ?>

	</div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>
