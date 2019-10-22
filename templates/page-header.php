<?php
	$isFrontPage = is_front_page();

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active('advanced-custom-fields/acf.php') && !is_archive() ) {
		//$implied = ( get_field( 'show_title' ) ? $implied : ' implied' );
		$showTitle = (boolean) get_field( 'show_title' );
	}

	if ( $showTitle ) {
		if ( !$isFrontPage ): ?><div class="page-header"><?php endif; ?>
  <h1><?php echo roots_title(); ?></h1>
<?php if ( !$isFrontPage ): ?></div><?php endif;
} // $showTitle ?>