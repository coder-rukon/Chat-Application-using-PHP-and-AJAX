<?php
session_start();
if(!isset($_SESSION['is_login']))
{
header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
    <head>
        <?php
        include_once 'master_page/head.php';
        ?>
    </head>  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns ">
        <?php
        include_once 'master_page/header.php';
        include_once 'master_page/admin_menu.php';
        ?>

        <div class="robust-content content container-fluid">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- Sales stats -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-user font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">

                                                        <span class="font-large-1 text-bold-300 info">100</span>
                                                    </div>
                                                    <p class="text-muted" >Total Tutor </p>
                                                    <progress class="progress progress-sm progress-info" value="95" max="100"></progress>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-user font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">
                                                        <span class="font-large-1 text-bold-300 deep-orange">200</span>
                                                    </div>
                                                    <p class="text-muted">Total student</p>
                                                    <progress class="progress progress-sm progress-deep-orange" value="95" max="100"></progress>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-graduation-cap font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">
                                                        <span class="font-large-1 text-bold-300 danger">300</span>
                                                    </div>
                                                    <p class="text-muted">Total Course</p>
                                                    <progress class="progress progress-sm progress-danger" value="80" max="100"></progress>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-sm-12">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-rocket font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">
                                                        <span class="font-large-1 text-bold-300 success">300</span>
                                                    </div>
                                                    <p class="text-muted">Total Exam</p>
                                                    <progress class="progress progress-sm progress-success" value="85" max="100"></progress>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Sales stats -->


                    <!-- Sales stats -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-calendar font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">
                                                        <span class="font-large-1 text-bold-300 info">600</span>
                                                    </div>
                                                    <p class="text-muted" >Total Contact Us </p>
                                                    <progress class="progress progress-sm progress-info" value="90" max="100"></progress>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-hdd-o font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">
                                                        <span class="font-large-1 text-bold-300 deep-orange">700</span>
                                                    </div>
                                                    <p class="text-muted">Total Blog</p>
                                                    <progress class="progress progress-sm progress-deep-orange" value="90" max="100"></progress>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-flask  font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">
                                                        <span class="font-large-1 text-bold-300 danger">800</span>
                                                    </div>
                                                    <p class="text-muted">Total Test</p>
                                                    <progress class="progress progress-sm progress-danger" value="100" max="100"></progress>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media px-1">
                                                    <div class="media-left media-middle">
                                                        <i class="icon-credit-card  font-large-1 blue-grey"></i>
                                                    </div>
                                                    <div class="media-body text-xs-right">
                                                        <span class="font-large-1 text-bold-300 danger">800</span>
                                                    </div>
                                                    <p class="text-muted">Total payment transation</p>
                                                    <progress class="progress progress-sm progress-danger" value="100" max="100"></progress>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Sales stats -->



                </div>
            </div>
        </div>

        <?php
        include_once 'master_page/footer.php';
        include_once 'master_page/script.php';
        ?>
    </body>
</html>