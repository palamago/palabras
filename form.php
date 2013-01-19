<?php
set_time_limit(120);
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('memory_limit', '50M');
$max_upload = (int)(ini_get('upload_max_filesize'));
$max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);

require('recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6Lf-V9sSAAAAAIQSq5svMrJ_nLVMlbbQtB3KNdtr";
$privatekey = "6Lf-V9sSAAAAAAKvaOUF7BxP3p_ItGIqmPV8FJQh";

?>

	<div class="span8 offset2 marginplus">
		<h2><?php echo _l('new_file'); ?></h2>
		<form method="POST" enctype="multipart/form-data">
			<label for="top">Top:</label>
			<select name="top">
				<option value="5">5</option>
				<option value="5">10</option>
				<option value="5">25</option>
				<option value="5">50</option>
				<option value="5">100</option>
				<option value="5">200</option>
			</select>
			<label for="commons"><?php echo _l('exclude_label'); ?>:</label>
			<textarea name="commons" style="width:100%; height:100px;resize:none;"><?php echo $COMMONS; ?></textarea>
			<input type="file" name="file">
			<input type="hidden" name="page" value="upload">
			<span class="help-block"><?php echo _l('max'); ?>:<?php echo $upload_mb;?> Mb. <?php echo _l('just_txt'); ?></span>
			<?php echo recaptcha_get_html($publickey); ?>
			<div class="form-actions">
				<input class="btn btn-large btn-info" type="submit" value="<?php echo _l('upload_visualize'); ?>"></input>
			</div>
		</form>
	</div>

