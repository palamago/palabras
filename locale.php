<?php
	$l = array(
		'en' => array(
		
			'upload' => 'Upload File',
			'archive' => 'Archive',
			'author' => 'Author',
			'title' => 'Words Counter',
			'exclude' => "'tis,'twas,a,able,about,across,after,ain't,all,almost,also,am,among,an,and,any,are,aren't," .
            "as,at,be,because,been,but,by,can,can't,cannot,could,could've,couldn't,dear,did,didn't,do,does,doesn't," .
            "don't,either,else,ever,every,for,from,get,got,had,has,hasn't,have,he,he'd,he'll,he's,her,hers,him,his," .
            "how,how'd,how'll,how's,however,i,i'd,i'll,i'm,i've,if,in,into,is,isn't,it,it's,its,just,least,let,like," .
            "likely,may,me,might,might've,mightn't,most,must,must've,mustn't,my,neither,no,nor,not,o'clock,of,off," .
            "often,on,only,or,other,our,own,rather,said,say,says,shan't,she,she'd,she'll,she's,should,should've," .
            "shouldn't,since,so,some,than,that,that'll,that's,the,their,them,then,there,there's,these,they,they'd," .
            "they'll,they're,they've,this,tis,to,too,twas,us,wants,was,wasn't,we,we'd,we'll,we're,were,weren't,what," .
            "what'd,what's,when,when,when'd,when'll,when's,where,where'd,where'll,where's,which,while,who,who'd," .
            "who'll,who's,whom,why,why'd,why'll,why's,will,with,won't,would,would've,wouldn't,yet,you,you'd,you'll," .
            "you're,you've,your",
            'exclude_label' => 'Exclude',
   			'history' => 'The History',
  			'invite' => 'Uploade File.<br/>Process.<br/>Visualize.',
  			'new_file' => 'New File',
  			'max' => 'Max size',
  			'just_txt' => 'Just TXT files.',
  			'upload_visualize' => 'Upload & Visualize',
  			'error_captcha' => 'ERROR: Invalid CAPTCHA ',
  			'error_upload' => 'ERROR: Upload failed.',
  			'retry' => 'Retry',
  			'success' => 'File successfully uploaded!',
  			'preview' => '*firsts 300 chars',
  			'file' => 'File',
  			'visualize' => 'Visualize',
  			'last_files' => 'Last 20 uploaded files',
  			'exclusions' => 'Exclusions',
  			're-process' => 'Re-Process',
  			'word' => 'Word',
  			'qty' => 'Qty',
  			'processed' => ' words processed.',
  			'created' => 'Created by ',
  			'inspiration' => 'Inspiration',
        'export' => 'Export to CSV',
        'error_txt' => 'Error: Just TXT files supported.'       		 			 						  			  			   			 		
		),
		'es' => array(
		
			'upload' => 'Subir Archivo',
			'archive' => 'Archivo',
			'author' => 'Autor',
			'title' => 'Contar Palabras',		
			'exclude' => 'si,no,que,del,la,las,el,ellos,los,lo,a,ante,bajo,con,contra,de,desde,durante,hacia,hasta,'.
			'para,por,segun,sin,sobre,tras,entonces,y,en',
	        'exclude_label' => 'Exclude',
			'history' => 'La Historia',
  			'invite' => 'Subir archivo.<br/>Procesar.<br/>Visualizar.',
  			'new_file' => 'Archivo nuevo',
 			'max' => 'Tama&ntilde;o m&aacute;ximo',
  			'just_txt' => 'S&oacute;lo archivos TXT.',
  			'upload_visualize' => 'Subir & Visualizar',
  			'error_captcha' => 'ERROR: CAPTCHA inválido ',
  			'error_upload' => 'ERROR: El archivo no fue subido.',
  			'retry' => 'Reintentar',
  			'success' => 'El archivo fue correctamente subido!',
  			'preview' => '*primeros 300 caracteres',
   			'file' => 'Archivo',
  			'visualize' => 'Visualizar',
  			'last_files' => '&Uacute;ltimos 20 archivos procesados',
  			'exclusions' => 'Exclusiones',
  			're-process' => 'Re-Procesar',
  			'word' => 'Palabra',
  			'qty' => 'Cantidad',
  			'processed' => ' palabras procesadas.',
  			'created' => 'Creado por ',
  			'inspiration' => 'Inspiraci&oacute;n',
        'export' => 'Exportar a CSV',
        'error_txt' => 'Error: El archivo debe ser TXT.'      		 			 						  			  			   			 		       			      		 			 						
		)
	);

	function getLocale(){
		if(isset($_GET['locale'])){
			$_SESSION['locale'] = $_GET['locale'];
		}
		if(!isset($_SESSION['locale'])){
			$_SESSION['locale'] = 'es';
		}
		return $_SESSION['locale'];
	}

	function _l($key){
		global $l;
		return (isset($l[getLocale()][$key]))?$l[getLocale()][$key]:$key;
	}
?>