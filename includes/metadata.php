<?php
//metadata
require_once('includes/db.php');
require_once("includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="initial-scale=1.0">
        <meta name="description" content="<?php echo $app_name." - ".$app_description; ?>">
        <link rel="shortcut icon" href="resources/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/global.css" />
        <script type="text/javascript" src="js/init.js"></script>
        <script>
          (function(d) {
            var config = {
              kitId: 'inm7ich',
              scriptTimeout: 3000,
              async: true
            },
            h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
          })(document);
        </script>
        <title><?php echo $app_name." - ".$app_description; ?></title>
    </head>
    <body>