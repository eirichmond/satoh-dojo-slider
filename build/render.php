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


$attributes = wp_parse_args(
    $attributes,
    [
        'items'        => 10,
        'itemsPerView' => 2,
        'itemType'     => 'post',
    ]
);

$items = intval( $attributes['items'] );
$itemsPerView = intval( $attributes['itemsPerView'] );
$postType = sanitize_text_field( $attributes['itemType'] );

// Query the posts
$query_args = [
    'post_type'      => $postType,
    'posts_per_page' => $items,
    'post_status' => 'publish',
];
$query = new WP_Query( $query_args );

$context = [
	'title' => 'Enter title',
    'transform' => 'translateX(0%)',
    'currentIndex' => 0,
    'items' => $query->post_count,
    'itemsPerView' => $itemsPerView,
];


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
        <h2><?php echo $attributes['title']; ?></h2>
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
            <?php if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="carousel-item">
                        <h3><?php the_title(); ?></h3>
						
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No posts found.', 'text-domain' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    


</div>
