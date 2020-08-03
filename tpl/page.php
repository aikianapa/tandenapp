<!doctype html>
<html class="no-js" lang="en">
<wb-var base="/tpl" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{header}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{_var.base}}/assets/img/favicon.ico">
    
    <!-- CSS 
    ========================= -->
    <!--bootstrap min css-->
    
    <wb-snippet name="wbapp" />
    <wb-snippet name="bootstrap" />

</head>

<body>
<div class="container">
    <h1>{{header}}</h1>
    <div>
        {{text}}
    </div>
</div>
</body>
</html>