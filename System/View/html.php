<!DOCTYPE html>
<html>
<head>
    <?php foreach( $css as $v ):?>
        <link rel="stylesheet" type="text/css" href="<?php echo $v . '?' . \time();?>" media="screen">
    <?php endforeach;?>
    <title><?php echo \htmlspecialchars($title);?></title>
</head>
<body>
<?php echo $mainDiv;?>
</body>
<script>
    var jsData=<?php echo \json_encode($jsData) ?>;
</script>
<?php foreach( $js as $v):?>
    <!--START <?php echo ROOT_PATH.$v;?> START-->
    <script>
        <?php @include ROOT_PATH.$v;?>
    </script>
    <!--END <?php echo ROOT_PATH.$v;?> END-->
<?php endforeach;?>
</html>
