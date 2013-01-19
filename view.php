<?php 
//include $cloud
include('word_counter.php'); ?>

<div class="span8 offset2 marginplus">
	<?php if($ok){ 
		if(!$cache){
			$tags = $cloud->get_tags_raw();
			$tags['TOTAL_WORDS'] = $cloud->get_total_words();
			$cache_file = fopen('cache/'.$name.'.cache.txt', "x");
			fwrite($cache_file,  json_encode($tags));
			fclose($cache_file);
		}
		
		$palabras = $cloud->get_tags();

		?>

			<h3 class="text-success"><?php echo $cloud->get_total_words();?><?php echo _l('processed'); ?></h3>

			<ul class="nav nav-tabs">
			  <li class="active"><a href="#result" data-toggle="tab">Top #<?php echo $top;?> </a></li>
			  <li><a href="#commons" data-toggle="tab"><?php echo _l('exclusions'); ?></a></li>
			  <li><a href="#viz" data-toggle="tab"><?php echo _l('visualize'); ?></a></li>
			  <li><a href="#reprocess" data-toggle="tab"><?php echo _l('re-process'); ?></a></li>
			</ul>

			<div class="tab-content">
			  <div class="tab-pane active" id="result">
			  	<a class="btn pull-right btn-info" href="<?php echo str_replace('/palabras/', '/palabras/csv.php', $_SERVER["REQUEST_URI"]);?>"><?php echo _l('export');?></a>
				<table class="table">
					<tr><th>#</th><th><?php echo _l('word'); ?></th><th><?php echo _l('qty'); ?></th></tr>
					<?php 
					$i=1;
					foreach ($palabras as $key => $value) {?>
						<tr><td><?php echo $i;?></td><td><?php echo $key;?></td><td><?php echo $value;?></td></tr>
					<?php 
						$i++;
						}	
						?>
				</table>
			  	<a class="btn pull-right btn-info" href="<?php echo str_replace('/palabras/', '/palabras/csv.php', $_SERVER["REQUEST_URI"]);?>"><?php echo _l('export');?></a>
			  </div>
			  <div class="tab-pane" id="commons">
			  	<p><?php echo str_replace(',', ' , ', $commons); ?></p>
			  </div>
			  <div class="tab-pane" id="viz">

			    <script type="text/javascript">
			      google.load("visualization", "1", {packages:["corechart"]});
			      google.setOnLoadCallback(drawChart);
			      function drawChart() {
			        var data = google.visualization.arrayToDataTable([
			          ["<?php echo _l('word'); ?>", "<?php echo _l('qty'); ?>"],
						
					<?php
					$i=1;
					foreach ($palabras as $key => $value) {
						echo "['".$key."',".$value."]";
						$i++;
						if(count($palabras)>=$i)
							echo ',';							
					}?>
			        ]);

			        var options = {
			          title: "<?php echo _l('title'); ?>",
			          height: <?php echo count($palabras)*25; ?>,
			          width: 600,
			          chartArea:{left:200,top:50}
			        };

			        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
			        chart.draw(data, options);
			      }
			    </script>

			  	<div id="chart_div" style="width: 600px; height: <?php echo count($palabras)*25+20; ?>px;"></div>
			  </div>
  			  <div class="tab-pane" id="reprocess">
  			  	<form method="GET" enctype="multipart/form-data">
  			  		<label>Archivo ID: <?php echo $name; ?></label>
  			  		<label for="top">Top:</label>
					<select name="top">
						<option <?php echo ($top==5)?' selected="selected" ':''; ?> value="5">5</option>
						<option <?php echo ($top==10)?' selected="selected" ':''; ?> value="10">10</option>
						<option <?php echo ($top==25)?' selected="selected" ':''; ?> value="25">25</option>
						<option <?php echo ($top==50)?' selected="selected" ':''; ?> value="50">50</option>
						<option <?php echo ($top==100)?' selected="selected" ':''; ?> value="100">100</option>
						<option <?php echo ($top==200)?' selected="selected" ':''; ?> value="200">200</option>
					</select>
					<label for="commons"><?php echo _l('exclusions'); ?>:</label>
					<textarea name="commons" class='span8' style="height:100px;resize:none;"><?php echo $commons; ?></textarea>
					<input type="hidden" name="name" value="<?php echo $name; ?>">
					<input type="hidden" name="page" value="view">
					<div class="form-actions">
						<input class="btn btn-large btn-info" type="submit" value="<?php echo _l('re-process'); ?>"></input>
					</div>
				</form>
  			  </div>
			</div>

	<?php }else{?>
		<p class="text-error">El archivo no existe!</p>
	<?php }?>
</div>