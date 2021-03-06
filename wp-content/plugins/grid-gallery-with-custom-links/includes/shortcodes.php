<?php
/**
 * Process shortcode
*/
if ( ! defined( 'ABSPATH' ) ){exit;}

function abcfggcl_scodes_add( $args ) {
    wp_enqueue_script( 'ggcl-equal-heights-js' );
    //$args = shortcode_atts( abcfggcl_scodes_defaults(), $args );

    $ver = str_replace('.', '' , ABCFGGCL_VERSION);
    $args = shortcode_atts( array( 'id' => '0', 'pversion' => $ver ), $args );
    return abcfggcl_gbldrs_get_pg($args);

    //return abcfggcl_gbldrs_get_pg((int) $args['id']);
}
add_shortcode( 'abcf-grid-gallery-custom-links', 'abcfggcl_scodes_add' );

function abcfggcl_scodes_defaults() {
    return array( 'id' => '0' );
}

function abcfggcl_scodes_build_scode( $args ) {
    $args = wp_parse_args( $args, abcfggcl_scodes_defaults() );
    if(empty($args['id'])) { return '';}
    $scode = '[abcf-grid-gallery-custom-links' . ' id="' . $args['id'] . '"' . ']';
    return esc_attr( $scode );
}