<?php
/**
 * The template for displaying search forms in Studio Mandelli
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" id="s" data-placeholder="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
	<input type="submit" class="submit ir" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
</form>