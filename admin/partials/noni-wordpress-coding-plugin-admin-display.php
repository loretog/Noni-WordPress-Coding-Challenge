<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       noni
 * @since      1.0.0
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

if( isset( $_POST[ 'api-key' ] ) ) {	
	if( update_option( 'nonibrands-api-key', $_POST[ 'api-key' ] ) ) {
		?>
		<div class="notice notice-success is-dismissible">
    	<p>API Key updated.</p>
	 	</div>
		<?php
	} else {
		?>
		<div class="notice notice-error is-dismissible">
    	<p>No update made.</p>
	 	</div>
		<?php
	}
}

if( isset( $_POST[ 'article_id' ] ) && !empty( $_POST[ 'article_id' ] ) ) {
	update_option( 'nonibrands-selected-articles', json_encode ( $_POST[ 'article_id' ] ) );
}
?>
<div class="wrap">	
	<h1 class="wp-heading-inline">Nonibrands</h1>
	<hr class="wp-header-end">
	
	<div id="col-container" class="wp-clearfix">
		<div id="col-left">
			<div class="col-wrap">	
				<div class="form-wrap">
					<h2>Add API Key</h2>
					<form method="post" class="validate">
						<div class="form-field form-required term-name-wrap">
							<label for="api-key">API</label>
							<input name="api-key" id="api-key" type="text" value="<?php echo get_option( 'nonibrands-api-key' ) ?>" size="40" aria-required="true" placeholder="Your API key">							
						</div>
						<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save"></p>
					</form>
				</div>
			</div>
		</div>
		<div id="col-right">
			<div class="col-wrap">	
				<div class="form-wrap">
					<h2>Current Articles:</h2>
					<form method="post" class="validate">
						<ol>
						<?php 
							$arts = $this->list_articles( isset( $_POST[ 'article_id' ] ) && !empty( $_POST[ 'article_id' ] ) ? $_POST[ 'article_id' ] : null );
							foreach($arts as $art ) {
								echo "<li>{$art}</li>";
							}
						?>
						</ol>
						<!-- <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save"></p> -->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>