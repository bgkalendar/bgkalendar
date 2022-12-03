<!DOCTYPE html>
<?php 
   require_once('includes.php');
$lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : (isset($LANGUAGE) ? $LANGUAGE : getPreferredLang());
if ($lang != 'bg' && $lang != 'en' && $lang != 'de' && $lang != 'ru') {
  $lang = 'bg';
}
?>
<html lang="en">
<!-- 
  Following Guidelines From:
  https://github.com/swagger-api/swagger-ui
-->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <link rel="stylesheet" type="text/css" href="css/swagger-ui.css" >
   <link rel="icon" type="image/png" href="./favicon-32x32.png" sizes="32x32" />
   <link rel="icon" type="image/png" href="./favicon-16x16.png" sizes="16x16" />
   <title><?php tr('REST API - Swager UI', 'REST API - Swagger UI', 'REST API - Swagger UI', 'REST API - Swagger UI');?></title>
   <style>
   .btc {
     align: right;
     text-align: right; 
     color: darkblue;
     font-weight: bold;
   }
   html {
     box-sizing: border-box;
     overflow: -moz-scrollbars-vertical;
     overflow-y: scroll;
   }
   *,*:before,*:after {
     box-sizing: inherit;
   }
   body {
     margin:0;
     background: #fafafa;
   }
   </style>
</head>
<body class="calendarbody">
<?php include('navigation.php');?>

    <div id="swagger-ui"></div>

    <script src="//unpkg.com/swagger-ui-dist@3/swagger-ui-bundle.js"></script>
    <script src="//unpkg.com/swagger-ui-dist@3/swagger-ui-standalone-preset.js"></script>
    <script>
    window.onload = function() {
      
      // Begin Swagger UI call region
      const ui = SwaggerUIBundle({
        "dom_id": "#swagger-ui",
        deepLinking: true,
        presets: [
          SwaggerUIBundle.presets.apis,
          SwaggerUIStandalonePreset
        ],
        plugins: [
          SwaggerUIBundle.plugins.DownloadUrl
        ],
        //layout: "StandaloneLayout",
        layout: "BaseLayout",
        validatorUrl: "https://validator.swagger.io/validator",
        url: "api/bgkalendar-api-swagger.php?lang=<?php tr('bg', 'en', 'de', 'ru');?>",
      })
      
      
      // End Swagger UI call region


      window.ui = ui
    }
  </script>


<br/>
<br/>
<?php include('footer.php');?>
</body>
</html>
