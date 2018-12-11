<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 * 
 * Customized by sumonst21
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$theme_property_detail_variation = get_option('theme_property_detail_variation');

get_header();

// Page Head.
$header_variation = get_option('inspiry_property_detail_header_variation');

if (empty($header_variation) || ('none' === $header_variation)) {
    get_template_part('assets/modern/partials/banner/header');
} elseif (! empty($header_variation) && ('banner' === $header_variation)) {
    // Banner Image.
    $banner_image_path = '';
    $banner_image_id   = get_post_meta($post->ID, 'woo_auction_page_banner_image', true);
    if ($banner_image_id) {
        $banner_image_path = wp_get_attachment_url($banner_image_id);
    } else {
        $banner_image_path = get_default_banner();
    } ?>
	<section class="rh_banner rh_banner__image" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo esc_url($banner_image_path); ?>'); background-size: cover; ">

		<div class="rh_banner__cover"></div>
		<!-- /.rh_banner__cover -->

		<div class="rh_banner__wrap">

			<h2 class="rh_banner__title">
				<?php echo esc_html(get_the_title()); ?>
			</h2>
			<!-- /.rh_banner__title -->

		</div>
		<!-- /.rh_banner__wrap -->

	</section>
	<!-- /.rh_banner -->
	<?php
}

if (inspiry_show_header_search_form()) {
    get_template_part('assets/modern/partials/properties/search/advance');
}
global $post;
?>

	<section class="rh_section rh_wrap--padding rh_wrap--topPadding" <?php //if ($is_auction_property) : ?> style="padding-top: 0;" <?php// endif; ?>>

		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : ?>

				<?php the_post(); ?>

				<?php if (! post_password_required()) : ?>

					<div class="rh_page rh_page--fullWidth">

						<?php //get_template_part('assets/modern/partials/property/single/head'); ?>

						<div class="rh_property">

							<div class="rh_property__wrap rh_property--padding">
								<div class="rh_property__main">
									<?php
                                    /**
                                     * Property Content
                                     */
                                   // get_template_part('assets/modern/partials/property/single/content');
                                    ?>

									<?php
									/**
									 * Single Property: Content
									 *
									 * @package    realhomes
									 * @subpackage modern
									 */

									global $post;

									$property_id                     = get_post_meta(get_the_ID(), 'woo_auction_property_id', true);
									$theme_property_detail_variation = get_option('theme_property_detail_variation'); ?>

									<div class="rh_property__content">

										<div class="rh_page__head rh_page__property">

											<div class="rh_page__property_title">

												<h1 class="rh_page__title">
													<?php the_title(); ?>
												</h1>
												<!-- /.rh_page__title -->

												<?php
											//	$address_display  = get_option('inspiry_display_property_address', 'true');
											$property_address = get_post_meta(get_the_ID(), 'woo_auction_property_address', true);

											//if ('true' === $address_display) {
												?>
													<p class="rh_page__property_address">
														<?php echo esc_html($property_address); ?>
													</p>

													<?php
													/*
													$display_property_breadcrumbs = get_option('theme_display_property_breadcrumbs');
												if ('true' == $display_property_breadcrumbs) {
													get_template_part('common/partials/breadcrumbs');
												} */
												?>
													<!-- /.rh_page__property_address -->
													<?php
											//} ?>

											</div>
											<!-- /.rh_page__property_title -->

										</div>
										<!-- /.rh_page__head -->
										<?php get_template_part('assets/modern/partials/property/single/slider'); ?>

										<div class="rh_property__row rh_property__meta rh_property--borderBottom">

											<div class="rh_property__id">
												<p class="title"><?php esc_html_e('Property ID', 'framework'); ?> :</p>
												<!-- /.title -->
												<?php if (! empty($property_id)) : ?>
													<p class="id">&nbsp;<?php echo esc_html($property_id); ?></p>
													<!-- /.id -->
												<?php else : ?>
													<p class="id">&nbsp;<?php esc_html_e('None', 'framework'); ?></p>
													<!-- /.id -->
												<?php endif; ?>

											</div>

											<!-- /.rh_property__id -->

											<div class="rh_property__print">

												<a href="#" class="share" id="social-share">
													<?php include INSPIRY_THEME_DIR . '/images/icons/icon-share-2.svg'; ?>
												</a>
												<div id="share-button-title" class="hide"><?php esc_html_e('Share', 'framework'); ?></div>
												<div class="share-this"></div>

												<?php
												$fav_button = get_option('theme_enable_fav_button');
												if ('true' === $fav_button) {
													$property_id = get_the_ID();
													if (is_added_to_favorite($property_id)) {
														?>
														<span class="favorite-placeholder highlight__red">
															<?php include INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg'; ?>
															<span class="rh_tooltip">
																<p class="label">
																	<?php esc_html_e('Added to Favorite', 'framework'); ?>
																</p>
																<!-- /.label -->
															</span>
														</span>
														<?php
													} else {
														?>
														<form action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post" class="add-to-favorite-form">
															<input type="hidden" name="property_id" value="<?php echo esc_attr($property_id); ?>"/>
															<input type="hidden" name="action" value="add_to_favorite"/>
														</form>
														<span class="favorite-placeholder highlight__red hide">
															<?php include INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg'; ?>
															<span class="rh_tooltip">
																<p class="label">
																	<?php esc_html_e('Added to Favorite', 'framework'); ?>
																</p>
																<!-- /.label -->
															</span>
														</span>
														<a href="#" class="favorite add-to-favorite">
															<?php include INSPIRY_THEME_DIR . '/images/icons/icon-favorite.svg'; ?>
															<span class="rh_tooltip">
																<p class="label">
																	<?php esc_html_e('Favorite', 'framework'); ?>
																</p>
																<!-- /.label -->
															</span>
														</a>
														<?php
													}
												}
												?>

												<a href="javascript:window.print()" class="print">
													<?php include INSPIRY_THEME_DIR . '/images/icons/icon-printer.svg'; ?>
													<span class="rh_tooltip">
														<p class="label">
															<?php esc_html_e('Print', 'framework'); ?>
														</p>
													</span>
												</a>
											</div>

											<!-- /.rh_property__print -->
										</div>


										<!-- /.rh_property__wrap -->

										<?php
										// Property meta information.
										get_template_part('assets/modern/partials/property/single/meta');
										?>

										<h4 class="rh_property__heading"><?php esc_html_e('Description', 'framework'); ?></h4>
										<!-- /.rh_property__heading -->

										<div class="rh_content">
											<?php the_content(); ?>
										</div>
										<!-- /.rh_content -->

										<?php
										/*
										* Additional Details.
										*/
										get_template_part('assets/modern/partials/property/single/additional-details');

										/*
										* Common Note.
										*/
										get_template_part('assets/modern/partials/property/single/common-note');

										/*
										* Property Features.
										*/
										get_template_part('assets/modern/partials/property/single/features');

										/*
										* Property Attachments.
										*/
										get_template_part('assets/modern/partials/property/single/attachments');

										/*
										* Floor Plans.
										*/
										get_template_part('assets/modern/partials/property/single/floor-plans');

										/*
										* Property Video
										*/
										get_template_part('assets/modern/partials/property/single/video');

										/*
										* Property virtual tour.
										*/
										get_template_part('assets/modern/partials/property/single/virtual-tour');

										/*
										* Property Google Map
										*/
										get_template_part('assets/modern/partials/property/single/map');

										/*
										* Child Properties.
										*/
										get_template_part('assets/modern/partials/property/single/children');

										/*
										* Property Agent.
										*/
										if ('agent-in-sidebar' !== $theme_property_detail_variation) {
											get_template_part('assets/modern/partials/property/single/agent');
										}
										?>

									</div>
									<!-- /.rh_property__content -->

									<?php get_template_part('assets/modern/partials/property/single/similar-properties'); ?>

									<section class="rh_property__comments">
										<?php
										/**
										 * Comments
										 * If comments are open or we have at least one comment, load up the comment template.
										 */
										if (comments_open() || get_comments_number()) {
											?>
											<div class="property-comments">
												<?php comments_template(); ?>
											</div>
											<?php
										}
										?>
									</section>
									<!-- /.rh_property__comments -->

								</div>
								<!-- /.rh_property__main -->

								<div class="rh_property__sidebar">
									<?php
									//get_template_part('assets/modern/partials/property/single/auction-history');
                                    if ('agent-in-sidebar' === $theme_property_detail_variation) {
                                        ?>
										<aside class="rh_sidebar">
											<?php
											echo '<div class="rh_prop_card rh_prop_card--block widget_auction_property_details"><div class="rh_prop_card__wrap"><div class="rh_prop_card__details">';
											get_template_part('assets/modern/partials/property/single/auction-details');
											get_template_part('assets/modern/partials/property/single/auction-history');
											echo '</div></div></div>';
                                            get_template_part('assets/modern/partials/property/single/agent-for-sidebar');
                                        if (! dynamic_sidebar('property-sidebar')) :
                                            endif; ?>
										</aside>
										<!-- /.rh_sidebar -->
										<?php
                                    } else {
										echo '<div class="rh_prop_card rh_prop_card--block widget_auction_property_details"><div class="rh_prop_card__wrap"><div class="rh_prop_card__details">';
										get_template_part('assets/modern/partials/property/single/auction-details');
										get_template_part('assets/modern/partials/property/single/auction-history');
										echo '</div></div></div>';
                                        get_sidebar('property');
                                    }
                                    ?>
								</div>
								<!-- /.rh_property__sidebar -->
							</div>
							<!-- /.rh_property__wrap -->
						</div>
						<!-- /.rh_property -->

					</div>
					<!-- /.rh_page -->

				<?php else : ?>

					<div class="rh_page rh_page--fullWidth">

						<?php echo get_the_password_form(); ?>

					</div>
					<!-- /.rh_page -->

				<?php endif; ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</section>

<?php
get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
