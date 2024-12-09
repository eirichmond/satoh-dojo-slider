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

?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="create-block"
	<?php echo wp_interactivity_data_wp_context( array( 'isActive'    => false ) ); ?>
>

    <button data-wp-on--click="actions.slideLeft"><</button>
    <div class="carousel-wrapper">
        <div class="carousel-container">
            <div class="carousel-item">Item 1</div>
            <div class="carousel-item">Item 2</div>
            <div class="carousel-item">Item 3</div>
        </div>
    </div>
    <button data-wp-on--click="actions.slideRight">></button>


</div>
