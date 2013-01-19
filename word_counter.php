<?php
	require('cloud.php');

	$top = (isset($_GET['top']))?($_GET['top']>200)?200:$_GET['top']:10;

	$commons = (isset($_GET['commons']))?$_GET['commons']:$COMMONS;

	$name = $_GET['name'];

	$cloud = new PTagCloud($top);
    $cloud->set_commons($commons);

    $ok = false;
    $cache = false;
    if(file_exists('cache/'.$name.'.cache.txt')){
    	$cache = true;
    	$cache = @fopen('cache/'.$name.'.cache.txt', "r");
    	$txt = '';
    	while (!feof($cache))
		  {
		    $linea=fgets($cache);
		    $lineasalto=nl2br($linea);
		    $txt .= $lineasalto;
		  }
		$txt = json_decode($txt,true);
		$cloud->set_total_words($txt['TOTAL_WORDS']);
		unset($txt['TOTAL_WORDS']);
    	$cloud->setTagsFromCache($txt);
    	$ok = true;
    	fclose($cache);
    }else{

		$fh = @fopen('upload_files/'.$name.'.txt', "r");
		if ($fh) {
		    $ok = true;
		    while (($line = fgets($fh)) !== false) {
		        $cloud->addTagsFromText($line);
		    }
		    fclose($fh);
		}

    }
?>
