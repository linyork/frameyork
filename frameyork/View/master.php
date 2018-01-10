<!DOCTYPE html>
<html>
<head>

    <!--START CSS START-->
    <?php foreach( $css as $v ):?>
        <!--START <?php echo ROOT_PATH.$v;?> START-->
        <link rel="stylesheet" type="text/css" href="<?php echo $v . '?' . \time();?>" media="screen">
        <!--END <?php echo ROOT_PATH.$v;?> END-->
    <?php endforeach;?>
    <!--START CSS START-->

    <title><?php echo \htmlspecialchars($title);?></title>
</head>
<body>

<!--START HEADER START-->
<?php echo $headerElement;?>
<!--END HEADER END-->

<!--START BODY START-->
<?php echo $bodyElement;?>
<!--END BODY START-->

<!--START FOOTER START-->
<?php echo $footerElement;?>
<!--END FOOTER END-->

</body>

<!--START JSON DATA START-->
<script>
    var jsData=<?php echo \json_encode($jsData) ?>;
</script>
<!--END JSON DATA END-->

<!--START JS FILE START-->
<?php foreach( $js as $v):?>
    <!--START <?php echo ROOT_PATH.$v;?> START-->
    <script>
        <?php @include ROOT_PATH.$v;?>
    </script>
    <!--END <?php echo ROOT_PATH.$v;?> END-->
<?php endforeach;?>
<!--END JS FILE END-->
</html>
