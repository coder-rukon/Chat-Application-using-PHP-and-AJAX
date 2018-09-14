<?php 
include 'connection.php';
include('inc/db.php');
include('inc/cls/Rs_Users.php');
session_start();
$isRegister = false;
$message = "";
if(isset($_REQUEST['sign']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $userName = $_POST['user_name'];
    $user = new Rs_Users();
    $isValide = true;
    if($user->CheckUserEmail($email)){
        $message = "Email Address Exist";
        $isValide = false;
    }
    if($user->CheckUserName($userName)){
        $message = "User Name Exist";
        $isValide = false;
    }
    if($isValide){
        $user->f_name = $fname;
        $user->l_name = $lname;
        $user->password = md5($password);
        $user->email = $email;
        $user->user_name = $userName;
        $user->Create();
        $user->SetUserToSession();
        $_SESSION['is_login'] = true;
        $isRegister = true;
    }
    if($isRegister){
        header("location:home.php");
    }else{
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
    <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column ">

     

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
                                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Sign Up</span></h6>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <form class="form-horizontal" action="" method="post" >
                                        <?php
                                            if(isset($_REQUEST['sign'])){
                                                echo '<p>'.$message.'</p>';
                                            }
                                        ?>
                                        <fieldset class="form-group has-feedback has-icon-left">
                                            <input type="text" value="" style="text-indent: 25px;" class="form-control input-lg" name="fname" title="Your Name" placeholder="Enter First Name" tabindex="1" required >
                                            <div class="form-control-position"  style="height:35px;width:35px;line-height: 35px;">
                                                <i class="icon-head"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                        <fieldset class="form-group has-feedback has-icon-left">
                                            <input type="text" value="" style="text-indent: 25px;" class="form-control input-lg" name="lname" title="Your Name" placeholder="Enter last Name" tabindex="1" required >
                                            <div class="form-control-position"  style="height:35px;width:35px;line-height: 35px;">
                                                <i class="icon-head"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                        <fieldset class="form-group has-feedback has-icon-left">
                                            <input type="text" value="" style="text-indent: 25px;" pattern="[a-zA-Z]+" class="form-control input-lg" name="user_name" title="Your Name" placeholder="User Name" tabindex="1" required >
                                            <div class="form-control-position"  style="height:35px;width:35px;line-height: 35px;">
                                                <i class="icon-head"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                        <fieldset class="form-group has-feedback has-icon-left">
                                            <input type="text" value="" style="text-indent: 25px;" class="form-control input-lg" name="email" title="Your Email Address" placeholder="Enter Email Address" tabindex="1" required >
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
                                        <button type="submit" name="sign" tabindex="3" class="btn btn-danger btn-block btn-lg"><i class="icon-unlock2"></i> Sign Up</button>
 <br/><p><a href="index.php" style="font-size:16px;">Login</a></p>                                   
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