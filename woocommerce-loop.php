<?php
/**
 * Template Name: Products
 */
 ?>
 <?php get_header();  ?>

<div class="container">
  	<?php
    $args = array(
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'sample'
            )
        ),
        'post_type' => 'product',
        'orderby' => 'title',
    ); ?>
    <?php
  		$loop = new WP_Query($args);
  		if ( $loop->have_posts() ) {
  			while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <table>
        <tr>
          <td><?php the_content();  ?></td>
          <td><?php the_title(); ?></td>
          <td><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></td>
          <td><?php   echo $product->get_price_html();   ?></td>
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
