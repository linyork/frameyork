<!DOCTYPE html>
<html lang="zh-TW">
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Metronic | Dashboard</title>

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta content="" name="york" />
        <!-- BEGIN MASTER STYLES -->
        <link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END MASTER STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php foreach( $css as $v ):?>
            <link rel="stylesheet" type="text/css" href="<?php echo $v . '?' . \time();?>" media="screen">
        <?php endforeach;?>
        <!-- END PAGE LEVEL PLUGINS -->

        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">

        <!-- BEGIN HEADER -->
        <div class="page-header navbar-fixed-top">
            <!--START HEADER START-->
            <?php echo $headerElement;?>
            <!--END HEADER END-->
        </div>
        <!-- END HEADER -->

        <!-- BEGIN CONTAINER -->
        <div class="page-container page-content-inner page-container-bg-solid">

            <!-- BEGIN CONTENT -->
            <div class="container-fluid container-lf-space margin-top-30">
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row widget-row">
                    <?php echo $bodyElement;?>
                </div>
                <!-- END PAGE BASE CONTENT -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <?php echo $footerElement;?>
        <!-- END FOOTER -->

        <!--START JSON DATA START-->
        <script>
            var jsData=<?php echo \json_encode($jsData) ?>;
        </script>
        <!--END JSON DATA END-->

        <!-- BEGIN MASTER JS-->
        <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/js/app.min.js" type="text/javascript"></script>
        <script src="/assets/js/layout.min.js" type="text/javascript"></script>
        <!-- END MASTER JS-->

        <!-- BEGIN PAGE LEVEL JS -->
        <?php foreach( $js as $v):?>
            <script>
                <?php @include ROOT_PATH.$v;?>
            </script>
        <?php endforeach;?>
        <!-- END PAGE LEVEL JS -->
    </body>

</html>