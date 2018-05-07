<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>HypeNode</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/assets/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/assets/css/login-2.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="content">
    <h2 class="font-white" >
        HypeNode
    </h2>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">

    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="index.html" method="post">
        <div class="form-title">
            <span class="form-title">歡迎</span>
            <span class="form-subtitle">請登入</span>
        </div>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> 錯誤的帳號或密碼 </span>
        </div>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span> 這裡有提示的版型 </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">帳號 / 信箱</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="帳號 / 信箱" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">密碼</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="密碼" name="password" /> </div>
        <div class="form-actions">
            <button type="submit" class="btn red btn-block uppercase">登入</button>
        </div>
        <div class="form-actions">
            <div class="pull-left">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" />記得我
                    <span></span>
                </label>
            </div>
            <div class="pull-right forget-password-block">
                <a href="javascript:;" id="forget-password" class="forget-password">忘記密碼?</a>
            </div>
        </div>
        <div class="create-account">
            <p>
                <a href="javascript:;" class="btn-primary btn" id="register-btn">建立帳號</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->

    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="index.html" method="post">
        <div class="form-title">
            <span class="form-title">忘記密碼 ?</span>
            <span class="form-subtitle">輸入您的 e-mail</span>
        </div>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default">返回</button>
            <button type="submit" class="btn btn-primary uppercase pull-right">送出</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->

    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="index.html" method="post">
        <div class="form-title">
            <span class="form-title">註冊</span>
        </div>
        <p class="hint"> 請輸入您的個人資訊 </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">名稱</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="名稱" name="fullname" /> </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" /> </div>
        <p class="hint"> 請輸入您的帳號資訊 </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">帳號名稱</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="帳號名稱" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">密碼</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="密碼" name="password" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">再次輸入密碼</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="再次輸入密碼" name="rpassword" /> </div>
        <div class="form-actions">
            <button type="button" id="register-back-btn" class="btn btn-default">返回</button>
            <button type="submit" id="register-submit-btn" class="btn red uppercase pull-right">送出</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->

</div>
<!-- END LOGIN -->

<!-- BEGIN CORE PLUGINS -->
<script src="/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/js/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/js/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/assets/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/js/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/js/login.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

</body>
</html>