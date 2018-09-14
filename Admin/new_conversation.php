<?php
session_start();
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
    header("location:index.php");
include('inc/db.php');
include('inc/cls/Rs_Users.php');
include('inc/chat/load.php');

$user = new Rs_Users($_SESSION['user']['id']);
$db = new DB();
$errorMessage = "";
if(isset($_POST['members']) && isset($_POST['start_con'])){
    $userFrom = $_SESSION['user']['id'];
    $userTo = $_POST['members'];
    $message = $_POST['message'];
    if(!$userTo || empty($userTo)){
        $errorMessage = "Please select a contact";
    }
    if(!$message || empty($message) ){
        $errorMessage = "Please type a message";
    }
    if(empty($errorMessage)){
       $conversation = new Conversation();
        $cnId = $conversation->StartNew($userFrom,$userTo,$message); 
        if($cnId){
            header("location:".'inbox.php?con='.$cnId);
        } 
    }
    
}

$offset = 0;
$page = 1;
$postPerPage = 10;
$contactFound = false;
$sql = "";
$skey = "";
$search_by = "";
if(isset($_GET['page'])){
    $offset = ($postPerPage * ($_GET['page'] - 1)); 
    $page = $_GET['page'];
}
if($user->user_role == "admin"){

    $sql = "SELECT * from tbl_users";
    if(isset($_GET['s'])){
        $skey = $_GET['s'];
        $search_by = $_GET['search_by'];
        $sql .= " WHERE ( f_name like '%$skey%' || l_name like '%$skey%' ) AND user_role ='$search_by'";
    }
}elseif ($user->user_role == "parent"){
    $sql = "SELECT * from tbl_users  where ( user_role = 'tutor' ||  id in( SELECT std_id from tbl_parent_std where parent_id = $user->id ) ) ";
    if(isset($_GET['s'])){
        $skey = $_GET['s'];
        $sql .= " AND ( f_name like '%$skey%' || l_name like '%$skey%' )";
    }

}elseif ($user->user_role == "student"){
    $sql = "SELECT * from tbl_users  where ( user_role = 'tutor' ||  id in( SELECT parent_id from tbl_parent_std where std_id = $user->id ) ) ";
    if(isset($_GET['s'])){
        $skey = $_GET['s'];
        $sql .= " AND ( f_name like '%$skey%' || l_name like '%$skey%' )";
    }

}elseif ($user->user_role == "tutor"){

}
$sql .= ' '."LIMIT $postPerPage OFFSET $offset";

$contactsResult = $db->con->query($sql);

?>
<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
    <head>
        <?php
        include_once 'master_page/head.php';
        ?>
        <link rel="stylesheet" type="text/css" href="style/chat.css">
    </head>  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns ">
        <?php
        include_once 'master_page/header.php';
        include_once 'master_page/admin_menu.php';
        $tempChatInformation = [
            'id' => '10',
            'conversionId' => '20',
        ];
        ?>

        <div class="robust-content content container-fluid">
            <div class="content-wrapper">
                <?php
                    if(!empty($errorMessage)){
                        ?>
                        <div class="alert alert-danger">
                          <strong>Error: </strong> <?php echo $errorMessage; ?>
                        </div>
                        <?php
                    }
                ?>
                <div class="rs_chat_box nw_conversion_chat" data-message_option = '<?php echo json_encode( $tempChatInformation ); ?>'>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            
                                
                            
                                <div class="rs_chat_users">
                                    
                                    <div class="row search_box">
                                        <form action="" method="get">
                                            <?php if($user->user_role == "admin"): ?>
                                            <div class="col-xs-3 form-group ">
                                                <select class="form-control" name="search_by">
                                                    <?php
                                                    $serchByOptoins = array(
                                                        'tutor' => "Tutors",
                                                        'student' => "Students",
                                                        'parent' => "Parent",
                                                        'admin' => "Admin"
                                                    );
                                                    foreach ($serchByOptoins as $key => $value) {
                                                        ?>
                                                        <option <?php echo ($key == $search_by ? "selected": ''); ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-xs-3">
                                                <input type="text" name="s" value="<?php echo $skey; ?>" class="form-control">
                                            </div>
                                            <div class="col-xs-6">
                                                <button class="btn rs_btn">Search</button>
                                                <a class="btn btn-default  rs_btn btn-lg" href="new_conversation.php">Reset</a>
                                                <a class="btn btn-default  rs_btn btn-lg pull-right" href="inbox.php">Inbox</a>
                                            </div>
                                        </form>
                                    </div>
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                               <ul id="rs_startConversionList">
                                                    <?php
                                                        
                                                        if($contactsResult->num_rows > 0):
                                                            $contactFound = true;
                                                            while ($contact = $contactsResult->fetch_assoc()) {
                                                                ?>
                                                                <li>
                                                                    <label style="display: block;">
                                                                        <input style="display: none;" type="radio" name="members" value="<?php echo $contact['id']; ?>">
                                                                        <div class="single_user">
                                                                            <img src="<?php echo (!empty($contact['picture'])? $contact['picture']:'images/blank_user.png'); ?>" style="width:40px;" alt="">
                                                                            <div>
                                                                                <h3 class="name"><?php echo $contact['f_name'].' '.$contact['l_name']; ?></h3>
                                                                                <span class="last_message" style="text-transform: capitalize;"><?php echo $contact['user_role']; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </li>
                                                                <?php
                                                            }
                                                        endif;
                                                    ?>
                                                </ul> 
                                                <div class="new_conv_pagination">
                                                    <div class="btn-group">
                                                        <?php if($page>=2): ?>
                                                        <a href="?page=<?php echo $page-1; ?>" class="btn btn-info">< Previus</a>
                                                        <?php endif; ?>

                                                        <?php if($contactFound): ?>
                                                        <a href="?page=<?php echo $page+1; ?>" class="btn btn-info" style="margin-left:5px;">Next ></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-7">
                                                <div class="rs_message_editor">
                                                    <textarea  type="text" name="message" class="form-control rs_editor_fw"></textarea>
                                                    <button class="btn btn-default" name="start_con">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include_once 'master_page/footer.php';
        include_once 'master_page/script.php';
        ?>
        <script type="text/javascript" src="js/chat.js"></script>
    </body>
</html>