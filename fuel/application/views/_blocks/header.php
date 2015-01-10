<!DOCTYPE html>
<html lang="en-US">

<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
 <meta charset="utf-8">
 	<title>
		<?php 
			if (!empty($is_blog)) :
				echo $CI->fuel_blog->page_title($page_title, ' : ', 'right');
			else:
				echo fuel_var('page_title', '');
			endif;
		?>
	</title>

	<meta name="keywords" content="<?php echo fuel_var('meta_keywords')?>">
	<meta name="description" content="<?php echo fuel_var('meta_description')?>">

	<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
	<?php
		echo css('main').css($css);

		if (!empty($is_blog)):
			echo $CI->fuel_blog->header();
		endif;
	?>
 <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?3977984863"/>
  <link rel="stylesheet" type="text/css" href="css/master_a-master.css?399256207"/>
  <link rel="stylesheet" type="text/css" href="css/index.css?391370862" id="pagesheet"/>
 
</head>
 <body>

