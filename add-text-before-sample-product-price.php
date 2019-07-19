<?php
//Add text in Simple before price to certain products
function themeprefix_custom_price_message( $price ) { 
	
	global $post;
		
	$product_id = $post->ID;
	$my_product_array = array( 2822,2830,2848 );//add in product IDs
	$another_product_id = array( 2971,2989 );
	if ( in_array( $product_id, $my_product_array )) {
		$textbefore = 'pcs - '; //add your text
		return '<span class="price-description">' . $textbefore . '</span>' . $price;
	}elseif( in_array( $product_id, $another_product_id )){
	 $another_textabefore = '1bundle/Ati - '; //add your text
		return '<span class="price-description">' . $another_textabefore . '</span>' . $price;
	}else { 
		return $price; 
	} 
}
add_filter( 'woocommerce_get_price_html', 'themeprefix_custom_price_message' );