 <?php
require('recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6Lf-V9sSAAAAAIQSq5svMrJ_nLVMlbbQtB3KNdtr";
$privatekey = "6Lf-V9sSAAAAAAKvaOUF7BxP3p_ItGIqmPV8FJQh";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

$ok = false;

# was there a reCAPTCHA response?
if (isset($_POST["recaptcha_response_field"])) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
			if (isset($_FILES["file"])&&$_FILES["file"]["error"] == 0) {
				
				if (isset($_FILES["file"])&&$_FILES["file"]["type"] == 'text/plain') {

					if(isset($_FILES["file"])&&isset($_POST['top'])&&isset($_POST['commons'])) {
					  	$id = rand(0, 1000000000);
					  	$name = $id.'.txt';
						move_uploaded_file($_FILES['file']['tmp_name'], 'upload_files/'.$name);

						if (file_exists('upload_files/'.$name)) {
							$ok = true;
						}else{
							$error = _l('error_upload');
						}

					}

				} else {
					$error = _l('error_txt');
				}

			} else {
				$error = "Error: " . $_FILES["file"]["error"] . "<br />" . "<br />";
			}
        } else {
                # set the error code so that we can display it
                $error = _l('error_captcha').'('.$resp->error.')';
        }
}

?>

<div class="span8 offset2 marginplus">
<?php if($ok){ 
	$f = @fopen('upload_files/'.$name ,'r');
	$prev = '';
	while( !feof($f) && strlen($prev)<300) {
		$prev .= fgets($f,100);
	}

	?>

	<p class="text-success"><?php echo _l('success'); ?></p>
	<div class="span2">
		<h3>Info:</h3>
		<p>Upload: <?php echo $_FILES["file"]["name"];?></p>
	    <p>Type: <?php echo $_FILES["file"]["type"];?></p>
	    <p>Size: <?php echo ($_FILES["file"]["size"] / 1024);?> Kb</p>
	    <p>ID: <?php echo $id;?></p>
	    <a class="btn btn-large btn-info" href="?page=view&name=<?php echo $id;?>&commons=<?php echo $_POST['commons']; ?>&top=<?php echo $_POST['top']; ?>"><?php echo _l('visualize'); ?></a>
	</div>
	<div class="span5">
		<h3><?php echo _l('file'); ?>:</h3>
		<textarea class='span5' style="height:100px;resize:none;"><?php echo substr($prev, 0, 300); ?></textarea>
		<span><?php echo _l('preview'); ?></span>
	</div>	
<?php } else { 
	?>

	<p class="text-error"><?php echo $error; ?></p>
	<a class="btn btn-large btn-info" href="javascript:javascript:history.go(-1);"><?php echo _l('retry'); ?></a>
<?php } ?>
</div>