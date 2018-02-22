<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/Assets/css/bootstrap.css"/>

    <?php foreach( $css as $v ):?>
        <!--START <?php echo $v;?> START-->
        <link rel="stylesheet" type="text/css" href="<?php echo $v . '?' . \time();?>" media="screen">
        <!--END <?php echo $v;?> END-->
    <?php endforeach;?>

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

<!-- Jquery Library 3.2.1 JavaScript-->
<script src="/Assets/js/jquery-3.2.1.js"></script>

<!-- Bootstrap Core JavaScript-->
<script src="/Assets/js/bootstrap.js"></script>

<!--START JSON DATA START-->
<script>
    var jsData=<?php echo \json_encode($jsData) ?>;
</script>
<!--END JSON DATA END-->

<!--START JAVASCRIPT START-->
<?php foreach( $js as $v):?>
    <!--START <?php echo $v;?> START-->
    <script>
        <?php @include ROOT_PATH.$v;?>
    </script>
    <!--END <?php echo $v;?> END-->
<?php endforeach;?>
<!--END JAVASCRIPT END-->
</html>
