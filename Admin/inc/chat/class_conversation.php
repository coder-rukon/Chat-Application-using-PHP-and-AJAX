<?php
if(!class_exists("Message")){
	include('class_message.php');
}

/**
 * 
 */

class Conversation
{
	public $table = 'msg_conversation';
	public $tableParticipant = 'msg_participants';
	public $tableConvarsation = 'msg_conversation';
	public $tableUsers = 'tbl_users';
	public $id,$created_date,$created_by,$last_activity;
	public $db;
	private $user;
	function __construct($id = null,$dbArg = null,$userId = null)
	{
		$this->created_date = date("Y-m-d h:i:sa");
		$this->last_activity = $this->created_date;
		if($dbArg == null){
			$this->db = new DB();
		}else{
			$this->db = $dbArg;
		}
		if($userId == null){
			$this->user = new Rs_Users($_SESSION['user']['id']);
		}else{
			$this->user = new Rs_Users($userId);
		}

	}

	public function StartNew($from,$to,$message){
		$getExistConversationId = $this->IsConversationExist($from,$to);
		if(!$getExistConversationId){
			$sql = "INSERT into $this->table (created_date,created_by,send_to,last_activity) 
				VALUES('$this->created_date','$from',$to,'$this->created_date')";
			$result = $this->db->con->query($sql);
			$conversationId = $this->db->con->insert_id;
		}else{
			$conversationId = $getExistConversationId;
		}
		
		
		$fromUser = new Rs_Users($from);
		$toUser = new Rs_Users($to);

		if($fromUser->user_role == "parent" && $toUser->user_role == "tutor"):
			$this->AddParticipantFromParent($from,$conversationId,$from);
		
		elseif($fromUser->user_role == "student"  && $toUser->user_role == "tutor"):
			$this->AddParticipantFromChild($from,$conversationId,$from);
		
		elseif($fromUser->user_role == "tutor"):

			if($toUser->user_role == "parent"):
				$this->AddParticipantFromParent($toUser->id,$conversationId,$from);
			elseif($toUser->user_role == "student"):
				$this->AddParticipantFromChild($toUser->id,$conversationId,$from);
			else:
				// do nothing
			endif;

		elseif($fromUser->user_role == "admin"):
			if($toUser->user_role == "parent"):
				$this->AddParticipantFromParent($toUser->id,$conversationId,$from);
			elseif($toUser->user_role == "student"):
				$this->AddParticipantFromChild($toUser->id,$conversationId,$from);
			else:
				// do nothing
			endif;
		else:
			// do nothing
		endif;

		// Add From and To User  to the conversation
		$this->InsertParticipant($from,$conversationId,$from);
		$this->InsertParticipant($to,$conversationId,$from);
		$msgObj = new Message(null,$this->db);
		$msgObj->Send($conversationId,$from,$message);
		return $conversationId;
	}
	public function IsConversationExist($from,$to){
		$sql = "SELECT id from $this->table where (created_by = '$from' and send_to = '$to') || created_by = '$to' and send_to = '$from'";
		$result = $this->db->con->query($sql);
		if($result->num_rows>0){
			return $result->fetch_assoc()['id'];
		}else{
			return false;
		}
	}
	public function CountUnreadConversation($userId){
		$count = 0;
		$sql = "SELECT count(id) as total FROM $this->tableParticipant WHERE user_id = $userId and is_unread <> 0";
		$count = $this->db->con->query($sql);
		return $count;
	}
	public function MarkAsRead($conversatonId, $userId)
	{
		$sql = "UPDATE $this->tableParticipant SET is_unread = 0 where user_id = '$userId' AND  	conversation_id = '$conversatonId'";
		$this->db->con->query($sql);
	}
	public function DoUnreadMessage($conversatonId, $userId)
	{
		$sql = "UPDATE $this->tableParticipant SET is_unread = is_unread+1 where user_id <> '$userId' AND conversation_id = '$conversatonId'";
		$this->db->con->query($sql);
	}
	/*
	* Update Last modify last_activity field
	 */
	public function notifyToConversatoinTable($conversationId){
		$tempDate = date("Y-m-d h:i:sa");
		$sql = "UPDATE $this->table SET last_activity = '$tempDate' where id = '$conversationId'";
		$this->db->con->query($sql);
	}

	public function GetAllConversation($userId){
		$sql = "SELECT DISTINCT conversation_id from msg_participants";
		$result = $this->db->con->query($sql);
		return $this->db->con->insert_id;
	}
	/*
	
	 */
	public function AddParticipants($usreId,$converstionId){
		if(is_array($usreId)){
			foreach ($usreId as $key => $idOfUser) {
				$this->InsertParticipant($idOfUser,$converstionId);
			}
		}else{
			$this->InsertParticipant($usreId,$converstionId);
		}
	}
	public function IsParticipantExist($userId,$converstionId){
		$sql = "SELECT id from $this->tableParticipant WHERE user_id = '$userId' AND conversation_id = '$converstionId'";
		$result = $this->db->con->query($sql);
		if($result->num_rows > 0)
			return true;
		return false;
	}

	public function AddParticipantFromChild($childUserId,$conversationId,$argAddedBy = null){
		$childUser = new Rs_Users($childUserId);
		$parents = $childUser->GetParents();
		if(!empty($parents)){
			foreach ($parents as $key => $value) {
				$this->AddParticipants($value['id'],$conversationId,$argAddedBy);
			}
			return true;
		}else{
			return false;
		}
		
	}
	
	public function AddParticipantFromParent($parentId,$conversationId,$argAddedBy = null){
		$childUser = new Rs_Users($parentId);
		$children = $childUser->GetChildrens();
		if(!empty($children)){
			foreach ($children as $key => $value) {
				$this->AddParticipants($value['id'],$conversationId,$argAddedBy);
			}
			return true;
		}else{
			return false;
		}
		
	}
	/*
	
	Insert single participant to database
	 */
	private function InsertParticipant($usreId,$converstionId,$addedByArg = null){
		if($this->IsParticipantExist($usreId,$converstionId))
			return false;
		$isRead = '0'; 
		$join_time = date("Y-m-d h:i:sa");
		if($addedByArg == null){
			$addedBy =$this->user->id;
		}else{
			$addedBy =$addedByArg;
		}
		$sql = "INSERT INTO $this->tableParticipant 
				(user_id,conversation_id,join_time,added_by,is_unread) 
				VALUES('$usreId','$converstionId','$join_time','$addedBy','$isRead')	
				";
		return $this->db->con->query($sql);
	}

	public function CanAccess($userId,$conversationId){
		$sql = "SELECT * FROM $this->tableParticipant where conversation_id = '$conversationId' AND user_id = '$userId'";
		$result = $this->db->con->query($sql);
		if($result->num_rows>0)
			return true;
		return false;
	}
	/*Get Current User Conversation*/
	public function GetUserConversationList($userId,$userRole,$pageNo = 1){
		$page = $pageNo;
		$postPerPage = 5;
		$offset = ($page - 1) * $postPerPage;
		/*$sqlARg = "SELECT tu.f_name, tu.l_name, tu.picture , tc.id as 'conversation_id', tc.created_by as 'send_from', tc.send_to , tc.last_activity   
				from $this->tableUsers tu 
				INNER JOIN $this->tableConvarsation tc  
				ON tu.id = tc.created_by 
				WHERE tc.id IN (SELECT conversation_id FROM $this->tableParticipant Where user_id = $userId)
				";*/
		$sqlARg = "SELECT * from $this->tableConvarsation tc WHERE tc.id IN (SELECT conversation_id FROM $this->tableParticipant Where user_id = $userId)
				 ORDER BY last_activity DESC";
		//$sqlARg = "SELECT * FROM $this->table";
		return $this->db->con->query($sqlARg);
	}
}