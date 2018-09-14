<?php
if(class_exists("Message"))
	return;
class Message{
	private $fileUploadDir='chat_files/';
	private $fileWebUrl='';
	private $db;
	private $App;
	public $id = null,$message,$sender,$conversation_id,$time,$file="",$type='text';
	private $table = 'chat_message';
	private $tableParticipant = 'msg_participants';
	public function __construct($id= null,$dbArg = null){
		if($dbArg != null){
			$this->db = $dbArg;
		}else{
			$this->db = new DB();
		}
		$this->time = date("Y-m-d h:i:sa");

		if($id !=null){
			$this->SetObjectData($id);
		}
		$this->App = new Rs_App();
	}
	private function SetObjectData($id){
		$this->id = $id;
		$message = $this->Get($id);
		if($message->num_rows>0):
			while ($mes = $message->fetch_assoc()) {
				foreach ($mes as $key => $value) {
					$this->{$key} = $value;
				}
			}
		endif;
	}
	public function Send($convsId,$senderId,$message,$file= '',$type = "text"){
		$message = mysqli_real_escape_string($this->db->con,$message);
		$sql = "
			INSERT into $this->table(sender,conversation_id,message,time,file,type)
			values ('$senderId','$convsId','$message','$this->time','$file','$type')
			";
		$isInserted = $this->db->con->query($sql);
		if($isInserted){
			$lstId = $this->db->con->insert_id;
			$this->SetObjectData($lstId);
			$conObj = new Conversation();
			$conObj->DoUnreadMessage($convsId,$senderId);
			$conObj->notifyToConversatoinTable($convsId);
			return $lstId;
		}else{
			return false;
		}
	}

	public function Get($id){
		return $this->db->con->query("SELECT * from $this->table where id = $id");
	}
	public function Delete($id = null){
		if($id != null){
			return $this->db->con->query("DELETE FROM $this->table where id = $id");
		}else if($this->id != null){
			return $this->db->con->query("DELETE FROM $this->table where id = $this->id");
		}else{
			return false;
		}
	}

	public function GetConversationMessages($conversationId,$startAt=0,$limit=100){
		$sql = "SELECT * from $this->table where conversation_id = '$conversationId' ORDER BY id ASC  LIMIT $limit OFFSET  $startAt";
		return $this->db->con->query($sql);
	} 
	public function GetUnreadMessage($userId,$conversation){
		$count = 0;
		$sql = "SELECT * FROM $this->tableParticipant where user_id = $userId AND conversation_id = $conversation";
		$count = $this->db->con->query($sql);
		return $count;
	}	
	public function GetConversationLastMessage($conversationId){
		$sql = "SELECT * from $this->table where conversation_id = '$conversationId' ORDER BY id DESC LIMIT 1";
		return $this->db->con->query($sql);
	}
	public function FileUpload($file)
	{
		$result = [
			'url'=>'',
			"uri" => '',
			'name' => ''
		];
		$fileDir = $this->fileUploadDir.date("Y/m/d");
		if (!file_exists($fileDir)) {
		    mkdir($fileDir, 0777, true);
		}
		$fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
		if($file && strtolower($fileType) != 'php'){
			$fileLocation = $fileDir.'/'.uniqid().$file['name'];
			move_uploaded_file($file['tmp_name'], $fileLocation);
			$result = [
				'url'=> $this->fileWebUrl.$fileLocation,
				"uri" => $fileLocation,
				"type" => $fileType,
				'name' => $file['name']
			];
		}
		return $result;
	}
	public function isImageFile($string){
		if(is_array(getimagesize($string)))
			return true;
		return false;
	}
	public function Save(){
		if($this->id != null){
			$query = "UPDATE $this->table SET 
			sender = '$this->sender', 
			conversation_id = '$this->conversation_id', 
			message = '$this->message', 
			time = '$this->time', 
			file = '$this->file', 
			type = '$this->type' 
			WHERE id = $this->id
			";
			$this->db->con->query($query);
		}else{
			$this->Send(
				$this->conversation_id,
				$this->sender,
				$this->message,
				$this->file,
				$this->type
			);
		}
	}
}