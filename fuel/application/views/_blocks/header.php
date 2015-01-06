<!DOCTYPE html>
<html lang="en-US">

<head>
 <script type="text/javascript">
   if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "index.css"], "outOfDate":[]};
</script>
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
  <!-- Other scripts -->
  <script type="text/javascript">
   document.documentElement.className += ' js';
</script>
 
</head>
 <body class="museBGSize">

  <div class="clearfix" id="page"><!-- column -->
   <div class="position_content" id="page_position_content">
    <a class="nonblock nontext MuseLinkActive museBGSize colelem" id="u108" href="index.html"><!-- simple frame --></a>
    <a class="nonblock nontext clearfix colelem" id="u118-4" href="login.html"><!-- content --><p>LOGIN</p></a>
    <a class="nonblock nontext clearfix colelem" id="u119-4" href="artist-signup.html"><!-- content --><p>ARTIST SIGNUP</p></a>
    <a class="nonblock nontext clearfix colelem" id="u120-4" href="fan-signup.html"><!-- content --><p>FAN SIGNUP</p></a>
    <div class="verticalspacer"></div>
    <div class="browser_width colelem" id="u148-5-bw">
     <div class="rgba-background clearfix" id="u148-5"><!-- content -->
      <p>&nbsp;</p>
      <p><span id="u148-2">Beatcrumb Inc 2014</span></p>
     </div>
    </div>
   </div>
  </div>
  <!-- JS includes -->
  <script type="text/javascript">
   if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn2.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script src="scripts/museutils.js?3777594392" type="text/javascript"></script>
  <script src="scripts/jquery.musepolyfill.bgsize.js?4259541792" type="text/javascript"></script>
  <script src="scripts/jquery.watch.js?4144919381" type="text/javascript"></script>
  <!-- Other scripts -->
  <script type="text/javascript">
   $(document).ready(function() { try {
(function(){var a={},b=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),16);return 0};(function(){$('link[type="text/css"]').each(function(){var b=($(this).attr("href")||"").match(/\/?css\/([\w\-]+\.css)\?(\d+)/);b&&b[1]&&b[2]&&(a[b[1]]=b[2])})})();(function(){$("body").append('<div class="version" style="display:none; width:1px; height:1px;"></div>');
for(var c=$(".version"),d=0;d<Muse.assets.required.length;){var f=Muse.assets.required[d],g=f.match(/([\w\-\.]+)\.(\w+)$/),k=g&&g[1]?g[1]:null,g=g&&g[2]?g[2]:null;switch(g.toLowerCase()){case "css":k=k.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");c.addClass(k);var g=b(c.css("color")),h=b(c.css("background-color"));g!=0||h!=0?(Muse.assets.required.splice(d,1),"undefined"!=typeof a[f]&&(g!=a[f]>>>24||h!=(a[f]&16777215))&&Muse.assets.outOfDate.push(f)):d++;c.removeClass(k);break;case "js":k.match(/^jquery-[\d\.]+/gi)&&
typeof $!="undefined"?Muse.assets.required.splice(d,1):d++;break;default:throw Error("Unsupported file type: "+g);}}c.remove();if(Muse.assets.outOfDate.length||Muse.assets.required.length)c="Some files on the server may be missing or incorrect. Clear browser cache and try again. If the problem persists please contact website author.",(d=location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi))&&Muse.assets.outOfDate.length&&(c+="\nOut of date: "+Muse.assets.outOfDate.join(",")),d&&Muse.assets.required.length&&(c+="\nMissing: "+Muse.assets.required.join(",")),alert(c)})()})();
/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.resizeHeight()/* resize height */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
} catch(e) { if (e && 'function' == typeof e.notify) e.notify(); else Muse.Assert.fail('Error calling selector function:' + e); }});
</script>
