<?php 
//include $cloud
include('word_counter.php'); 
include('locale.php'); 
?>
<?php echo 
header ( "Content-Type: application/vnd.ms-excel" );
header ( "Content-disposition: attachment; filename=".$name.".csv" );
header ( "Content-Type: application/force-download" );
header ( "Content-Transfer-Encoding: binary" );
header ( "Pragma: no-cache" );
header ( "Expires: 0" );
echo _l('word').','._l('qty')."\n";
foreach ($cloud->get_tags() as $key => $value) {
    echo ($key.','.$value."\n");
}
?>
