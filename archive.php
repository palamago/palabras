 <?php
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}


$files = array();
if ($handle = opendir('upload_files')) {
while (false !== ($file = readdir($handle))) {
       if ($file != "." && $file != ".." && endsWith($file,'.txt')) {
          $files[filemtime('upload_files/'.$file)] = $file;
       }
   }
   closedir($handle);
}

// sort
krsort($files);

$files = array_slice($files, 0, 20);

?>

<div class="span8 offset2 marginplus">

	<h3 class="text-success"><?php echo _l('last_files'); ?></h3>

	<table class="table">
		<tr><th>#</th><th>Archivo ID</th><th>Tama&ntilde;o</th><th>Upload</th><th></th></tr>
		<?php 
		$i=1;
		foreach($files as $file) {
			$lastModified = date('F d Y, H:i:s',filemtime('upload_files/'.$file));
			$idFile = explode('.', $file);
			$idFile = $idFile[0];
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $idFile;?></td>
				<td><?php echo number_format((filesize('upload_files/'.$file))/1024/1024,2);?> Mb</td>
				<td><?php echo $lastModified;?></td>
				<td><a class="btn btn-info btn-mini" href="/palabras/?page=view&name=<?php echo $idFile; ?>"><?php echo _l('visualize'); ?></a></td>
			</tr>
		<?php 
			$i++;
			}	
			?>
	</table>

</div>
