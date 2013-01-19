<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Contar Palabras - Words Counter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="@palamago">
    <meta content="Contador de palabras - Words counter" name="title"/>
    <meta content="Contador de palabras - Words counter" http-equiv="title"/>
    <meta content="words, counter, word, visualization, visualize, palabras, contador, visualizar" name="keywords"/>
    <meta content="Simple word counter. Contador de palabras simple. Visualization. Visualizacion" name="description"/>
    <meta content="@palamago" name="author"/>
    <meta content="@palamago" name="DC.Creator"/>
 

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

 	<style type="text/css">

      html,
      body {
        height: 100%;
      }

      #footer {
        height: 60px;
        width: 100%;
        background-color: #f5f5f5;
        position: fixed;
        bottom: 0px

      }

      .marginplus{
      	margin-bottom: 60px;
      }

      </style>

	  <script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-18158765-1']);
	  _gaq.push(['_setDomainName', 'palamago.com.ar']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <?php 
    session_start();
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
    error_reporting(E_ALL);

    include('locale.php'); 

    function curPageURL() {
      $pageURL = 'http://';
      if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
      } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
      }

      if (strpos($_SERVER["REQUEST_URI"], '?')>0)
        $pageURL .= '&';
      else
        $pageURL .= '?';
      return $pageURL;
    }


    ?>
  </head>
 <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/palabras/"><?php echo _l('title'); ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#"></a></li>
              <li><a href="/palabras/?page=form"><?php echo _l('upload'); ?></a></li>
              <li><a href="/palabras/?page=archive"><?php echo _l('archive'); ?></a></li>
              <li><a href="/palabras/?page=author"><?php echo _l('author'); ?></a></li>
            </ul>
          </div><!--/.nav-collapse -->
          <div class="btn-group pull-right">
            <a class="btn" href="<?php echo curPageURL();?>locale=es">Espa&ntilde;ol</a>
            <a class="btn" href="<?php echo curPageURL();?>locale=en">English</a>
          </div>
        </div>
      </div>
    </div>

    <div class="container">

		<?php

    $COMMONS = _l('exclude');

		$page = isset($_REQUEST['page'])?$_REQUEST['page'].'.php':'inicio.php';

		$page = (file_exists($page))?$page:'inicio.php';

		include($page);

		?>	

	</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

    <div id="footer">
      <div class="container">
        <p class="muted credit"><?php echo _l('created'); ?><a href="https://twitter.com/palamago" target="_blank">@palamago</a></p>
        <p class="muted credit"><a href="/palabras/?page=author" target="_blank"><?php echo _l('history'); ?></a></p>
      </div>
    </div>

</body>
</html>