<!DOCTYPE html>
<html>

<head>
    <!-- L'en-tête du document avec au moins un titre -->
    <link type="text/css" rel="stylesheet"  href="<?php echo File::build_path(array('css','style.css'));?>">
    <meta charset="utf-8">
    <title><?php echo $pagetitle;?></title>
</head>

<!--------------header--------->

<body>
<?php
require (File::build_path(array("view", $controller, "$view.php")));
?>
</body>
</html>