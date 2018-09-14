<?php
session_start();
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
    header("location:index.php");

include('inc/db.php');
include('inc/chat/load.php');
include('inc/cls/Rs_Users.php');
$userId = $_SESSION['user']['id'];
$user = new Rs_Users($userId);
$conversation = new Conversation();
$conversationList = $conversation->GetUserConversationList($user->id,$user->user_role,1);
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
        $tempChatInformation = [
            'id' => '10',
            'conversionId' => '20',
        ];
        ?>

        <div class="robust-content content container-fluid">
            <div class="content-wrapper">
                <div class="rs_chat_box" id="rsMessageData" data-message_option = '<?php echo json_encode( $tempChatInformation ); ?>'>
                    <div class="row">
                        <!-- <div class="col-xs-12 col-sm-2">
                            <div class="rs_inbox_menu">
                                <a href="new_conversation.php" class="btn btn-default btn-danger btn-block" id="btn_conversation">New Message</a>
                                <h2 class="rs_title_message">
                                    Filter Message
                                </h2> 
                                <ul class="nav nav-stacked nav-pills">
                                  <li class="nav-item">
                                    <a class="nav-link active" href="inbox.php">All</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="inbox.php">Tutor</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#">Parent</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#">Easytutoring</a>
                                  </li>
                                </ul>
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-md-5">
                            <div class="rs_chat_users">
                                <div class="search_box">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-5">
                                            <a href="new_conversation.php" class="btn btn-default btn-danger btn-block" id="btn_conversation">New Message</a>
                                        </div>
                                        <div class="col-xs-12 col-sm-7">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <ul id="rs_conversations">
                                    <?php
                                        $activeConversationId = 0;
                                        if($conversationList->num_rows > 0){
                                            foreach ($conversationList as $keyConv => $valueConv) {
                                                $last_activity = $valueConv['last_activity'];
                                                $userTemp = $user;
                                                if($user->id == $valueConv['created_by'] ){
                                                    $userTemp = new Rs_Users($valueConv['send_to']);
                                                }else{
                                                    $userTemp = new Rs_Users($valueConv['created_by']);
                                                }
                                                $image = (!empty($userTemp->picture)? $userTemp->picture:'images/blank_user.png');
                                                $name = $userTemp->f_name.' '.$userTemp->l_name;
                                                $msgObj = new Message();
                                                $lastMsg = $msgObj->GetConversationLastMessage($valueConv['id'])->fetch_assoc();
                                                $itemClass = "";
                                                $totalUnreadMessage = $msgObj->GetUnreadMessage($user->id,$valueConv['id'])->fetch_assoc();
                                                if($keyConv<=0){
                                                    $itemClass = 'active';
                                                    $activeConversationId = $valueConv['id'];
                                                }
                                                ?>
                                                <li class="<?php echo $itemClass; ?>" data-cv_id="<?php echo $valueConv['id']; ?>">
                                                    <a href="#" class="single_user">
                                                        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                                                        <div>
                                                            <?php if($totalUnreadMessage['is_unread'] >= 1): ?>
                                                            <span class="notify"><?php echo $totalUnreadMessage['is_unread']; ?></span>
                                                            <?php endif; ?>
                                                            <h3 class="name"><?php echo $name; ?></h3>
                                                            <span class="last_message"><?php echo substr($lastMsg['message'],0,100); ?>...</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-7">
                            <form action="" id="rs_file_form">
                                <input type="file" id='rs_file_input' name="rs_chat_file">
                            </form>
                            <div class="rs_messanger" data-converstaion='<?php echo $activeConversationId; ?>'>
                                
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
        
    </body>
</html>