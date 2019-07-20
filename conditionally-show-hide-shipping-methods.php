<?php
// Conditionally show/hide shipping methods
add_filter( 'woocommerce_package_rates','show_hide_shipping_methods', 90, 2 );
function show_hide_shipping_methods( $rates, $package ) {
    if ( WC()->session->get('hide_shipping' ) == '1' ){
        // HERE below set your shipping methods IDs to be removed
        unset($rates['flat_rate:22']);
        

    }else{
    	unset($rates['free_shipping:23']);
    }

   if ( WC()->session->get('hide_shipping' ) == '1' ){
        // HERE below set your shipping methods IDs to be removed
        unset($rates['flat_rate:24']);
        

    }else{
    	unset($rates['free_shipping:25']);
    }

    return $rates;
}

// Function that gets the Ajax data
add_action( 'wp_ajax_session_hideit', 'wc_session_hide_shipping_method' );
add_action( 'wp_ajax_nopriv_session_hideit', 'wc_session_hide_shipping_method' );
function wc_session_hide_shipping_method() {
    if ( isset($_POST['disable_smi']) && $_POST['disable_smi'] == '1' ){
        WC()->session->set('hide_shipping', '1' );
    } else {
        WC()->session->set('hide_shipping', '0' );
    }
    // Just for testing ==> To be removed
    echo json_encode( WC()->session->get('billing_ups' ) );
    die(); // Alway at the end (to avoid server error 500)
}

// Enabling, disabling and refreshing session shipping methods data
add_action( 'woocommerce_checkout_update_order_review', 'refresh_shipping_methods', 10, 1 );
function refresh_shipping_methods( $post_data ){
    $bool = true;
    if ( WC()->session->get('hide_shipping' ) == '1' ) $bool = false;

    // Mandatory to make it work with shipping methods
    foreach ( WC()->cart->get_shipping_packages() as $package_key => $package ){
        WC()->session->set( 'shipping_for_package_' . $package_key, $bool );
    }
    WC()->cart->calculate_shipping();
}

// The Jquery script
add_action( 'wp_footer', 'custom_checkout_script' );
function custom_checkout_script() {
    if( ! is_checkout() ) return;
    ?>
    <script type="text/javascript">
    jQuery( function($){
        // The Ajax function
        function triggerAjax(b){
            $.ajax({
                type: 'POST',
                url: wc_checkout_params.ajax_url,
                data: {
                    'action': 'session_hideit',
                    'disable_smi': b,
                },
                success: function (response) {
                    $('body').trigger('update_checkout');
                },
                error: function(error){
                    
                }
            });
        }
        var a = 'input[name^="payment_method"]';

        // Once Dom is loaded
        if( $(a).val() === 'alg_custom_gateway_1' )
            triggerAjax(1);

        // On payment method change
        $( 'form.checkout' ).on('change', a, function() {
            var b = 0;
            if( $(this).val() === 'alg_custom_gateway_1' )
                b = 1;
            triggerAjax(b);
        });

        
    });
    </script>
    <?php
}