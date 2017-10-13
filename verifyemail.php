<?php
/**
 * Verify Email
 *
 * @package    Verify Email
 * @author     Rishabh Jain <rishabh@jnexsoft.com>
 * @copyright  Copyright (c) JNEX Software Solutions 2016-2017
 * @license    MIT
 * @version    1.1
 * @link       http://www.jnexsoft.com/
 */

define("CLIENTAREA", true);
require "init.php";

if(isset($_GET['action']) && count($_GET) < 2) exit("This file is not accessable.");

require_once __DIR__.'/modules/addons/verifyemail/includes.php';


use JNEX\Handel;

$data =  Handel::Request($_GET);

if($data === true){
    header("Location: /login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Verify Email</title>
  <link rel='stylesheet' type='text/css' href="<?=JNEX_URL;?>assets/css/bootstrap.min.css" />
</head>
<body>
  <div class="container text-center">
    <h1 class="lead">Verify Email</h1>
    <?php if(!empty($data)){ ?>
      <p class="col-sm-6 col-sm-offset-3 lead bg-<?=($_GET['status'] == 'true') ? 'success': 'danger'; ?>">
        <strong>
          <span aria-hidden="true" class="icon icon-<?=($_GET['status'] == 'true') ? 'circle': 'ban'; ?>"></span>
          <?=($_GET['status'] == 'true') ? 'Success!': 'Warning!'; ?>
        </strong>
        <br>
        <?=$data?>
      </p>
    <?php } ?>

    <div class="col-sm-6 col-sm-offset-3">
      <form>
        <div class="form-group">
          <div class="input-group input-group-lg">
            <span class="input-group-addon">
              <span aria-hidden="false" class="icon icon-envelope">@</span>
            </span>
            <input type="hidden" class="form-control" name="action" value="resend">
            <input class="form-control" name="userid" id="email" value="<?=htmlentities(htmlspecialchars(urldecode($_GET['userid'])));?>" type="email" placeholder="Email Address"/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p><input type="submit" class="btn btn-primary" value="Submit" /></p>
          </div>
        </div>
      </form>
    </div>


  </div>

</body>
</html>
