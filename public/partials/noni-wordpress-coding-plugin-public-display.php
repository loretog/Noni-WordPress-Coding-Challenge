<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       noni
 * @since      1.0.0
 *
 * @package    Noni_Wordpress_Coding_Plugin
 * @subpackage Noni_Wordpress_Coding_Plugin/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1>Let us know about your Address</h1>
<form class="noni-form" method="post">
	<input type="hidden" name="noni-wordpress-save-info" value="1">
	<input type="hidden" name="user_id" value="<?php echo get_current_user_id() ?>">
	<?php wp_nonce_field('save_info'); ?>
	<div class="form-group">
		<label for="address">Address</label>
		<input type="text" name="address" maxlength="100" required>
	</div>
	<div class="form-group">
		<label for="address2">Address 2</label>
		<input type="text" name="address2" maxlength="100" required>
	</div>
	<div class="form-group">
		<label for="city">City</label>
		<input type="text" name="city" maxlength="100" required>
	</div>
	<div class="form-group">
		<label for="province">Province</label>
		<input type="text" name="province" maxlength="100" required>
	</div>
	<div class="form-group">
		<label for="postal_code">Postal Code</label>
		<input type="text" name="postal_code" maxlength="15" required>
	</div>
	<div class="form-group">
		<label for="country">Country</label>
		<input type="text" name="country" maxlength="20" required>
	</div>


	<input type="submit" value="Update">
	
</form>