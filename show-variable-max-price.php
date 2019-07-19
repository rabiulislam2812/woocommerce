<?php
// Variation Price

function custom_min_max_variable_price_html( $price, $product ) {
    $prices = $product->get_variation_prices( true );
    $min_price = current( $prices['price'] );
    $max_price = end( $prices['price'] );

    $max_keys = current(array_keys( $prices['price'] ));
    $max_price_regular = $prices['regular_price'][$max_keys];
    $max_price_html = wc_price( $max_price ) . $product->get_price_suffix();

    if( $max_price_regularr != $max_price ){ // When min price is on sale (Can be removed)      
        $max_price_html = $max_price_regular_html .'<ins>' . $max_price_html . '</ins>';
    }
	if( 2871 === $product->id ){
		$price = sprintf( __( '100gm - %1$s', 'woocommerce' ), $max_price_html );
	}elseif( 2917 === $product->id ){
		$price = sprintf( __( '12pcs/1 Dozen - %1$s', 'woocommerce' ), $max_price_html );
	}elseif( 2930 === $product->id ){
		$price = sprintf( __( '12pcs/1 Dozen - %1$s', 'woocommerce' ), $max_price_html );
	}else{
		$price = sprintf( __( '1kg - %1$s', 'woocommerce' ), $max_price_html );
	}
    return $price;
}
add_filter( 'woocommerce_variable_price_html', 'custom_min_max_variable_price_html', 10, 2 );