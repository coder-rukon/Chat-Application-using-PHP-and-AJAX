<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header" style="background: white">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
                <li class="nav-item"><a href="index.php" style="padding-top: 10px;   -webkit-filter: drop-shadow(0px 0px 0px black);" class="navbar-brand nav-link"><img alt="srimca logo" height="40px" src="images/logo/logo.png" data-expand="images/logo/logo.png" data-collapse="images/logo/logo-smal.png" class="brand-logo"></a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>
                </ul>

                <ul class="nav navbar-nav float-xs-right">




                    <li class="dropdown dropdown-notification nav-item rs_top_message_notify">
                        <a class="nav-link nav-link-label" href="inbox.php">
                            <i class="far fa-envelope"></i>
                            <span class="count"></span>
                        </a>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="images/profile/atmankakadiya@gmail.com.jpeg" style="width:30px;height:30px;" alt="avatar"><i></i></span><span class="user-name"><?php echo $_SESSION['user']['name']; ?></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item"><i class="icon-head"></i> Profile</a>
                            <a href="" class="dropdown-item"><i class="icon-comments"></i> Inbox</a>
                            <a href="" class="dropdown-item"><i class="icon-credit-card"></i> Payment</a>
                            <a href="" class="dropdown-item"><i class="icon-user-plus"></i>Parent</a>
                            <a href="" class="dropdown-item"><i class="icon-calendar"></i>Schedule</a>                            
                            
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item"><i class="icon-power3"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div id="fullscreen-search" class="fullscreen-search">
    <form class="fullscreen-search-form">
        <input type="search" placeholder="Search..." class="fullscreen-search-input">
        <button type="submit" class="fullscreen-search-submit">Search</button>
    </form>
    <div class="fullscreen-search-content">
        <div class="fullscreen-search-options">
            <div class="row">
                <div class="col-sm-12">
                    <fieldset>
                        <label class="custom-control custom-checkbox display-inline">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">All</span>
                        </label>
                        <label class="custom-control custom-checkbox display-inline">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">People</span>
                        </label>
                        <label class="custom-control custom-checkbox display-inline">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Project</span>
                        </label>
                        <label class="custom-control custom-checkbox display-inline">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Task</span>
                        </label>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="fullscreen-search-result mt-2">
            <div class="row">
                <div class="col-lg-4">
                    <h3>People</h3>
                    <div class="media"><a href="#" class="media-left"><img src="robust-assets/images/portrait/small/avatar-s-2.png" alt="Generic placeholder image" class="media-object rounded-circle"></a>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Karmen Dartez</a></h5>
                            <p class="mb-0"><span class="tag tag-pill mr-1 tag-danger">JavaScript</span><span class="tag tag-pill mr-1 tag-primary">HTML</span></p>
                            <p><span class="font-weight-bold">Sr. Developer - </span><a href="mailto:john@example.com">karmen@example.com</a></p>
                        </div>
                    </div>
                    <div class="media"><a href="#" class="media-left"><img src="robust-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image" class="media-object rounded-circle"></a>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Scot Loh</a></h5>
                            <p class="mb-0"><span class="tag tag-pill mr-1 tag-danger">PhotoShop</span><span class="tag tag-pill mr-1 tag-warning">UX</span></p>
                            <p><span class="font-weight-bold">Sr. UI/UX Desugner - </span><a href="mailto:john@example.com">scot@example.com</a></p>
                        </div>
                    </div>
                    <div class="media"><a href="#" class="media-left"><img src="robust-assets/images/portrait/small/avatar-s-5.png" alt="Generic placeholder image" class="media-object rounded-circle"></a>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Kim Willmore</a></h5>
                            <p class="mb-0"><span class="tag tag-pill mr-1 tag-warning">CSS</span><span class="tag tag-pill mr-1 tag-danger">HTML</span></p>
                            <p><span class="font-weight-bold">UI Developer - </span><a href="mailto:john@example.com">kim@example.com</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3>Project</h3>
                    <div class="media">
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">WordPress Template Support</a></h5>
                            <progress value="25" max="100" class="progress progress-xs progress-success mb-0">25%</progress>
                            <p class="mb-0">Collicitudin vel metus scelerisque ante  commodo.</p>
                            <p><span class="tag tag-pill tag-success">In Progress</span><span class="tag tag-default tag-default float-sm-right">25% Completed</span></p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Application UI/UX</a></h5>
                            <progress value="100" max="100" class="progress progress-xs progress-info mb-0">100%</progress>
                            <p class="mb-0">Cetus scelerisque ante sollicitudin commodo.</p>
                            <p><span class="tag tag-pill tag-info">Completed</span><span class="tag tag-default tag-default float-sm-right">100% Completed</span></p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">SEO Project</a></h5>
                            <progress value="65" max="100" class="progress progress-xs progress-warning mb-0">65%</progress>
                            <p class="mb-0">Notifications scelerisque ante sollicitudin commodo.</p>
                            <p><span class="tag tag-pill tag-warning">Delayed</span><span class="tag tag-default tag-default float-sm-right">65% Completed</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3>Task</h3>
                    <div class="media">
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Create the new layout for menu</a></h5>
                            <p class="mb-0">Pcelerisque ulla vel metus  ante sollicitudin commodo.</p>
                            <p><span class="tag tag-pill tag-danger">Open</span><span class="tag tag-default tag-default tag-default tag-icon float-sm-right"><i class="icon-calendar5"></i> 22 January, 16</span></p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Addition features on footer</a></h5>
                            <p class="mb-0">Tuaiulla vel metus scelerisque ante sollicitudin commodo.</p>
                            <p><span class="tag tag-pill tag-warning">On hold</span><span class="tag tag-default tag-default tag-default tag-icon float-sm-right"><i class="icon-calendar5"></i> 24 January, 16</span></p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Remove TODO comments</a></h5>
                            <p class="mb-0">Mulullametu vel  scelerisque ante sollicitudin commodo.</p>
                            <p><span class="tag tag-pill tag-info">Resolved</span><span class="tag tag-default tag-default tag-default tag-icon float-sm-right"><i class="icon-calendar5"></i> 25 January, 16</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><span class="fullscreen-search-close"></span>
</div>
<div class="fullscreen-search-overlay"></div>

<!-- ////////////////////////////////////////////////////////////////////////////-->	