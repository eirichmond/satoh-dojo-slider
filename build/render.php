<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generates a unique id for aria-controls.
$unique_id = wp_unique_id( 'p-' );
$context = array(
	'transform' => 'translateX(0%)',
	'currentIndex' => 0, 
	'items' => 10,
	'itemsPerView' => 2
);
// Inline style to set the CSS variable
$style = sprintf( '--items-per-view: %d;', $context['itemsPerView'] );
?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="create-block"
	style="<?php echo esc_attr( $style ); ?>"
	<?php echo wp_interactivity_data_wp_context($context); ?>
>

<div class="carousel-header">
	<h2>Meet the Interactivity API Carousel</h2>
	<div class="carousel-navigation">
		<button data-wp-on--click="actions.slideLeft">
			<svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M20 12H4M4 12L10 6M4 12L10 18" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>
		<button data-wp-on--click="actions.slideRight">
			<svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>
	</div>
</div>



    <div class="carousel-wrapper">
        <div data-wp-style--transform="context.transform" class="carousel-container">
			<?php for ( $i = 1; $i <= 10; $i++ ): // Example items ?>
                <div class="carousel-item">Item <?php echo $i; ?></div>
            <?php endfor; ?>
        </div>
    </div>
    


</div>
