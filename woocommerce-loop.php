<?php
/**
 * Template Name: Products
 */
 ?>
 <?php get_header();  ?>

<div class="container">
  	<?php // The args for the loop
    $args = array(
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'sample' // Your category name here
            )
        ),
        'post_type' => 'product',
        'orderby' => 'title',
    ); ?>
    <?php
  		$loop = new WP_Query($args); // The Loop
  		if ( $loop->have_posts() ) {
  			while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <table> <!-- Fetching woocommerce data in table -->
        <tr>
          <td><?php the_content(); ?></td>
          <td><?php the_title(); ?></td>
          <td><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></td>
          <td><?php   echo $product->get_price_html(); ?></td>
          <td>
           <?php global $product; // For Adding Add to Cart button in loop
              echo apply_filters( 'woocommerce_loop_add_to_cart_link',
              sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
              esc_url( $product->add_to_cart_url() ),
              esc_attr( $product->id ),
              esc_attr( $product->get_sku() ),
              $product->is_purchasable() ? 'add_to_cart_button' : '',
              esc_attr( $product->product_type ),
              esc_html( $product->add_to_cart_text() )
              ), $product ); 
            ?>
        </td>
        </tr>
        </table>
        <?php
  			endwhile;
  		} else {
  			echo __( 'No products found' );
  		}
  		wp_reset_postdata();
  	?>
</div>

 <?php get_footer(); ?>
