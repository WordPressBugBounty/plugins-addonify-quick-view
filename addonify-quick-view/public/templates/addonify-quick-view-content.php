<?php
/**
 * Display quick view content.
 *
 * This template can be overridden by copying it to yourtheme/addonify/addonify-quick-view-content.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package     Addonify_Quick_View\Public\Templates
 * @version     1.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

do_action( 'addoify_quick_view_before_single_content', $product );
?>
<div class="woocommerce single-product">
	<div id="product-<?php echo esc_attr( $product->get_id() ); ?>" <?php post_class( 'product' ); ?>>
		<?php do_action( 'addonify_quick_view_product_image' ); ?>
		<div class="summary entry-summary">
			<?php do_action( 'addonify_quick_view_before_product_summary_content', $product ); ?>
			<div class="summary-content">
				<?php do_action( 'addonify_quick_view_product_summary', $product ); ?>
			</div>
			<?php do_action( 'addonify_quick_view_after_product_summary_content', $product ); ?>
		</div>
	</div>
</div>
<?php
do_action( 'addonify_quick_view_after_single_content', $product );
