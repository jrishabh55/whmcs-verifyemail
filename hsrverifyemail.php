<?php
define("CLIENTAREA", true);
require "init.php";

if(isset($_GET['action']) && count($_GET) < 2) exit("This file is not accessable.");

require_once __DIR__.'/modules/addons/hsrverifyemail/includes.php';


use HSR\Handel;

$error =  Handel::Request($_GET);

if($error === true){
    header("Location: /login.php");
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<head>
  <meta charset="UTF-8">
  <title>Stack Network Ltd - Lost Password Reset</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow"/>
  <base href="<?=$_SERVER['SERVER_NAME']; ?>"/>
  <link rel="stylesheet" href="/templates/hexa/assets/css/combined.css">
  <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <link rel='stylesheet' href="/templates/hexa/assets/css/style1.css"/>
  <script src="/assets/js/jquery.min.js"></script>
  <style type="text/css">.navbar .navbar-brand .logo img{border:none;border-radius:0px;height:auto;}</style>
</head>
<body class="minimal">
<div class="hexa-container hidden-xs"><a href="contact.php" class="btn btn-xs btn-default hexa-btn" data-original-title="Contact Us"><i class="fa fa-send-o"></i></a></div>
<style media="screen" type="text/css">.login-wrapper{position:absolute;top:90px;left:0;right:0;text-align:center;}.login-wrapper .logo{margin-bottom:45px;position:relative;left:-2px;}.login-wrapper .box{box-shadow:0 0 6px 2px rgba(0,0,0,0.1);border-radius:5px;background:rgba(255,255,255,0.65);}.login-wrapper .box h6{text-transform:uppercase;color:#3f77a4;padding-top:30px;font-size:18px;font-weight:600;margin:0 0 30px;}.login-wrapper .box input[type="text"],.login-wrapper .box input[type="password"]{font-size:15px;border-color:#b2bfc7;}.login-wrapper .box input:-moz-placeholder{color:#9ba8b6;font-size:15px;letter-spacing:0;font-style:italic;}.login-wrapper .box a.forgot{display:block;text-align:right;font-style:italic;text-decoration:underline;color:#3d88ba;font-size:13px;margin-bottom:6px;}.login-wrapper .box .remember{display:block;overflow:hidden;margin-bottom:20px;}.login-wrapper .box .remember input[type="checkbox"]{float:left;margin-right:8px;}.login-wrapper .box .remember label{float:left;color:#4a576a;font-size:13px;font-weight:600;}.login-wrapper .box .login{text-transform:uppercase;font-size:13px;padding:8px 30px;}.login-wrapper .no-account{float:none;text-align:center;font-size:14px;margin:25px auto 0;}.login-wrapper .no-account p{display:inline-block;color:#fff;}.login-wrapper .no-account a{color:#fff;margin-left:7px;border-bottom:1px solid;transition:all .1s linear;-moz-transition:all .1s linear;-webkit-transition:all .1s linear;-o-transition:all .1s linear;}.login-wrapper .no-account a:hover{text-decoration:none;color:#fff;border-bottom-color:#fff;}.login-wrapper .input-group-addon{background-color:transparent;color:#a2afb7;border-color:#b2bfc7;}.logo-page{margin-bottom:30px;}.logo{color:#fff;font-size:33px;font-weight:100;}.login-wrapper .box input:-ms-input-placeholder,.login-wrapper .box input::-webkit-input-placeholder{color:#9ba8b6;font-style:italic;letter-spacing:0;font-size:15px;}.displaynone{display:none!important;}.text-alert{margin-top:15px;padding:5px;}</style>
<div class="login-wrapper">
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4 logo-page">
      <a href="index.php" title="Stack Network Ltd">
        <span class="logo">
          <img style="width:200px" src="https://vezel.thestack.net/assets/img/logo.png">
        </span>
      </a>
    </div>
  </div>
<div class="row">
<div class="col-md-4 col-md-offset-4 box">
<div class="content-wrap">
<h6>Resend Activation Link</h6>

<?php if(!empty($error)){ ?>
<p class="text-danger bg-danger text-alert">
    <strong>
        <span aria-hidden="true" class="icon icon-<?=($_GET['status'] == 'true') ? 'circle': 'ban'; ?>"></span>
        <?=($_GET['status'] == 'true') ? 'Success!': 'Warning!'; ?>
    </strong>
    <br>
        <?=$error?>
</p>
<?php } ?>

  <form>
    <div class="form-group">
      <div class="input-group input-group-lg">
        <span class="input-group-addon"><span aria-hidden="true" class="icon icon-envelope"></span></span>
        <input type="hidden" class="form-control" name="action" value="resend">
        <input class="form-control" name="userid" id="email" type="email" placeholder="Email Address"/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p><input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit"/></p>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>
<script src='/templates/hexa/assets/js/bootstrap.min.js'></script>
<script src='/templates/hexa/assets/js/bootstrap-switch.min.js'></script>
<script src='/templates/hexa/assets/js/jquery.slimscroll.min.js'></script>
<script src='/templates/hexa/assets/js/cookie.js'></script>
<script src='/templates/hexa/assets/js/whmcs.js'></script>
<script src="/assets/js/AjaxModal.js"></script>
<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content panel panel-primary">
<div class="modal-header panel-heading">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span>
<span class="sr-only">Close</span>
</button>
<h4 class="modal-title">Title</h4>
</div>
<div class="modal-body panel-body">
Loading...
</div>
<div class="modal-footer panel-footer">
<div class="pull-left loader">
<i class="fa fa-circle-o-notch fa-spin"></i> Loading...
</div>
<button type="button" class="btn btn-default" data-dismiss="modal">
  Close
</button>
<button type="button" class="btn btn-primary modal-submit">
  Submit
</button>
</div>
</div>
</div>
</div>
</body>
</html>
