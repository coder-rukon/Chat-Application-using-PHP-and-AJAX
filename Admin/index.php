<?php
session_start();
$e=0;
include('inc/db.php');
include('inc/cls/Rs_Users.php');
// prepare and bind
if(isset($_POST['login']))
{

    $email=$_POST['userid'];
    $pass=$_POST['password'];
    $user = new Rs_Users();
    if($user->CheckAuth($email,$pass)){
        $_SESSION['is_login'] = true;
        $user->SetUserToSession();
        header("location:home.php");
    }else{
        $e = 1;
        session_unset();
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">  
    <head>
<?php
include_once 'master_page/head.php';
?>
    </head>
    <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column">     

        <!-- ////////////////////////////////////////////////////////////////////////////-->
        <div class="robust-content content container-fluid">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body"><section class="col-md-4 offset-md-4 col-xs-12 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-2 py-2 row mb-0">
                            <div class="card-header no-border">
                                <div class="card-title text-xs-center">
                                    <img src="images/logo/logo.png" style="width: 60%;" alt="branding logo" >
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login</span></h6>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <form class="form-horizontal" action="" method="post" >
                                        
<?php

if($e==1)
{
?>
<p style="color:red;">Invalid Username & Password</p>
<?php
}
?>
<fieldset class="form-group has-feedback has-icon-left">
                                            <input type="text" value="" style="text-indent: 25px;" class="form-control input-lg" name="userid" title="Please Enter Userid" placeholder="Your Userid" tabindex="1" required >
                                            <div class="form-control-position"  style="height:35px;width:35px;line-height: 35px;">
                                                <i class="icon-head"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                        <fieldset class="form-group has-feedback has-icon-left">
                                            <input type="password" value="" style="text-indent: 25px;" class="form-control input-lg" name="password" placeholder="* * * * *" tabindex="2" required pattern="^.{5,15}$"  title="Please Enter Minimum 5 and Maximum 15 character">
                                            <div class="form-control-position" style="height:35px;width:35px;line-height: 35px;">
                                                <i class="icon-key3"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                        <fieldset class="form-group row">
                                            <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                                <fieldset>
                                                    <input type="checkbox" name="remember"  id="remember-me" class="chk-remember" style="min-width:10px;" />
                                                    <label for="remember-me"> Remember Me</label>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a href="" class="card-link">Forgot Password?</a></div>
                                        </fieldset>
                                        <button type="submit" name="login" tabindex="3" class="btn btn-danger btn-block btn-lg"><i class="icon-unlock2"></i> Login</button>
 <br/><p><a href="register.php" style="font-size:16px;">Create New Account</a></p>                                   
</form>
                                </div>
                            </div>


                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- ////////////////////////////////////////////////////////////////////////////-->



<?php
include_once 'master_page/footer.php';
include_once 'master_page/script.php';
?>
    </body>
</html>