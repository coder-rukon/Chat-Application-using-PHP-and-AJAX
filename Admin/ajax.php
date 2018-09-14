<?php
session_start();
include('inc/db.php');

include('inc/cls/Rs_Users.php');
include('inc/chat/load.php');

$user = new Rs_Users($_SESSION['user']['id']);
/*$conversation = new Conversation();

$list = $conversation->GetUserConversationList("9","parent");
var_dump($list->fetch_all());*/

/*$user = new Rs_Users("12");
echo $_SESSION['user']['id'] .$_SESSION['user']['name']. " <hr> ";
var_dump($user->GetChildrens());*/
//$message->send('10','20','testMessage');
//$message->save();
//$message->delte();

if(isset($_POST['load_messanger'])){
	ob_start();
	$msgObj = new Message();
	$messageList = $msgObj->GetConversationMessages($_POST['conversation_id']);
	$isNeedEditor = false;
	if(isset($_POST['need_editor']) && $_POST['need_editor'] == "yes")
		$isNeedEditor = true;

	// Mark This message as Read
	$conversation = new Conversation();
	$conversationId = $_POST['conversation_id'];
	$conversation->MarkAsRead($conversationId,$user->id);
	?>
	<?php if($isNeedEditor): ?>
	<ul id="rs_listMessage">
	<?php endif; ?>
		<?php

			while ($message = $messageList->fetch_assoc()) {
				$text = $message['message'];
				$tempUser = new Rs_Users($message['sender']);
				$userImage = (!empty( $tempUser->picture) ? $tempUser->picture:'images/blank_user.png' );
				$fullName =$tempUser->f_name.' ' .$tempUser->l_name; 
				$itemClass = "";
				if($user->id == $tempUser->id){
					$itemClass = "reverse";
				}
				?>
				<li class="<?php echo $itemClass; ?>">
		            <div class="single_message_item">
		                <img class="thumbnail" src="<?php echo $userImage; ?>" alt="<?php echo $fullName; ?>">
		                <h3 class="sender_name"><?php echo $fullName; ?></h3>
		                <div class="message_text">
		                	<?php
		                		if($message['type'] == "file"){
		                			if($msgObj->isImageFile($message['file'])){
		                				?>
		                				<img class="rs_chat_img" src="<?php echo $message['message']; ?>" alt="">
		                				<?php
		                			}else{
		                				?>
		                				<a href="<?php echo $message['message']; ?>" target="blank" class="rs_chat_file"><i class="fa fa-file-download"></i> Download File</a>
		                				<?php
		                			}
		                		}else{
		                			echo $text;
		                		}
		                	?>
		                </div>
		                
		            </div>
		        </li>
				<?php
			}
		?>
	<?php if($isNeedEditor): ?>
    </ul>
    <div class="rs_message_editor" id="rs_message_editor">
    	<div class="rs_loading_box"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
    	<div class="message_box_group">
        	<input type="text" class="form-control" id="message_input">
        	<span id="rs_upload_file"><i class="fa fa-images"></i></span>
    	</div>
        <button class="btn btn-default">Send</button>
    </div>
	<?php endif; ?>
	<?php
	echo ob_get_clean();
}
/*file Upload*/
if(isset($_POST['rs_ctfileupload']) && $_POST['rs_ctfileupload'] =="yes"){
	$conversationId = $_POST['conversation'];
	$msgObj = new Message();
	$conversation = new Conversation();

	$fileInfo = $msgObj->FileUpload($_FILES['file']);
	$message =$fileInfo['url']; 
	$fileUri =$fileInfo['uri']; 
	$msgType = "file"; 
	$result = array('type' => "error",'message' => "you don't have access");
	//$result['file'] = $fileInfo;
	if($conversation->CanAccess($user->id,$conversationId)){
		if($msgObj->Send($conversationId,$user->id,$message,$fileUri,$msgType)){
			$result['type'] = 'success';
			$result['message'] = 'Message Sent';
		}
	}
	echo json_encode(  $result);
}

if(isset($_POST['send_to'])){
	$message = $_POST['message'];
	$conversationId = $_POST['conversation'];
	$msgObj = new Message();
	$conversation = new Conversation();
	$result = array('type' => "error",'message' => "you don't have access");
	if($conversation->CanAccess($user->id,$conversationId)){
		if($msgObj->Send($conversationId,$user->id,$message)){
			$result['type'] = 'success';
			$result['message'] = 'Message Sent';
		}
	}
	echo json_encode( $result );
}

/*Display Top Message Notificatoins*/
if(isset($_POST['top_header_notificatoin']) && $_POST['top_header_notificatoin'] == "yes"){
	$conversation = new Conversation();
	echo $conversation->CountUnreadConversation($user->id)->fetch_assoc()['total'];
}
/*Mark User Message As Read*/
if(isset($_POST['mark_as_read']) && $_POST['mark_as_read'] == "yes"){
	$conversation = new Conversation();
	$conversationId = $_POST['conversation'];
	$conversation->MarkAsRead($conversationId,$user->id);
}