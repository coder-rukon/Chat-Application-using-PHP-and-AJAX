<?php
/**
 * 
 */
class Rs_Users
{
	public $table = 'tbl_users';
	public $tableParent = 'tbl_parent_std';
	public $tableTutor = 'tbl_tutor_std';
	public $id, $f_name, $l_name, $user_name, $password, $email, $user_role, $created_date, $last_activity, $picture;
	private $userRoles = ['subscriber','admin','tutor','parent','student'];
	function __construct($id = null,$conDb = null)
	{
		$this->id = null;
		$this->f_name = "";
		$this->l_name = "";
		$this->user_name = "";
		$this->password = "";
		$this->email = "";
		$this->created_date = date("Y-m-d h:i:sa");
		$this->last_activity = $this->created_date;
		$this->picture = "";
		$this->user_role = $this->userRoles[0];

		if($conDb != null){
			$this->db = $conDb;
		}else{
			$this->db = new DB();
		}
		if($id !=null){
			$this->setObjectData($id);
		}

	}
	/*
	find user by id and set objset
	 */
	private function setObjectData($id){
		$this->id = $id;
		$user = $this->db->con->query("SELECT * from $this->table where id = $id");
		if($user->num_rows>0):
			while ($row = $user->fetch_assoc()) {
				foreach ($row as $key => $value) {
					$this->{$key} = $value;
				}
			}
		endif;
	}
	/*
	Delete user
	 */
	public function Delete($id = null){
		if($id != null){
			return $this->db->con->query("DELETE FROM $this->table where id = $id");
		}else if($this->id != null){
			return $this->db->con->query("DELETE FROM $this->table where id = $this->id");
		}else{
			return false;
		}
	}
	public function Save(){
		if($this->id != null){
			$query = "UPDATE $this->table SET 
			f_name = '$this->f_name', 
			l_name = '$this->l_name', 
			password = '$this->password', 
			email = '$this->email', 
			last_activity = '$this->last_activity', 
			user_role = '$this->user_role' 
			picture = '$this->picture' 
			WHERE id = $this->id
			";
			$this->db->con->query($query);
		}else{
			$this->Create();
		}
		$this->setObjectData($id);
		return $this;

	}
	public function Create($data = array())
	{
		if(!empty($data)){
			foreach ($data as $key => $value) {
				if(isset($this->{$key}))
				$this->{$key} = $value;
			}
		}
		$query = "INSERT into $this->table(f_name,l_name,password,email,last_activity,user_role,picture,user_name) 
			values('$this->f_name','$this->l_name','$this->password','$this->email','$this->last_activity','$this->user_role' ,'$this->picture','$this->user_name') 
			";
		$result = $this->db->con->query($query);

		if($result){
			$this->setObjectData($this->db->con->insert_id);
		}
		return $this;
	}
	public function CheckAuth($userName,$pass)
	{
		$pw = md5($pass);
		$result = $this->db->con->query("SELECT * from $this->table where  ( user_name='$userName' || email = '$userName' ) AND password = '$pw' ");
		if($result and $result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				foreach ($row as $key => $value) {
					$this->{$key} = $value;
				}
			}
			return true;
		}else{
			return false;
		}
	}

	public function getRelationalData($type = "get_child"){
		if($this->id == null)
			return false;
		switch ($type) {
			case 'get_parents':
				$sql = "SELECT * , {$this->tableParent}.parent_id as 'obj_id' from $this->table JOIN tbl_parent_std  
						ON {$this->tableParent}.parent_id = {$this->table}.id where {$this->tableParent}.std_id = $this->id";
				break;
			case 'get_childrens':
				$sql = "SELECT *  , {$this->tableParent}.std_id as 'obj_id'  from $this->table JOIN tbl_parent_std  
						ON {$this->tableParent}.std_id = {$this->table}.id where {$this->tableParent}.parent_id = $this->id";
				break;
			
			default:
				return false;
				break;
		}
		
		
		$usersList = array();
		$result = $this->db->con->query($sql);
		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()) {
				$usersList[] =[
					"id" => $row['obj_id'],
					"name" => $row['f_name'].' '.$row['l_name'],
					"email" => $row['email'],
				];
			}
		}
		return $usersList;
	}

	/*
	*return all parents of current children or student
	 */
	public function GetParents()
	{
		return $this->getRelationalData('get_parents');
	}
	/*
	*Retur all children of current parent 
	 */
	public function GetChildrens()
	{
		return $this->getRelationalData('get_childrens');
	}

	/*
	
	 */
	public function GetTutor()
	{
		
	}

	/*
	
	 */
	public function GetStudent()
	{
		
	}

	/*
	
	 */
	
	public function MakeRelation($parentTutorId,$stdId,$type ='parent_std')
	{
		
	}

	/*
	
	 */
	public function DeleteRelate($parentTutorId,$stdId,$type ='parent_std')
	{
		
	}

	/* Set user data in session*/
	public function SetUserToSession(){
		$_SESSION['user']['id'] = $this->id;
		$_SESSION['user']['user_name'] = $this->user_name;
		$_SESSION['user']['email'] = $this->email;
		$_SESSION['user']['l_name'] = $this->l_name;
		$_SESSION['user']['f_name'] = $this->f_name;
		$_SESSION['user']['name'] = $this->f_name." ".$this->l_name;
	}


	/*Check if user exist*/
	public function Has()
	{
		if($this->id != null)
			return true;
		return false;
	}
	public function CheckUserName($userName){
		$result = $this->db->con->query("SELECT * from $this->table where user_name='$userName'");
		if($result and $result->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	public function CheckUserEmail($email){
		$result = $this->db->con->query("SELECT * from $this->table where email = '$email'");
		if($result and $result->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	/*
	Get user by id

	 */
	public function GetUser($id)
	{
		$this->setObjectData($id);
		return $this;
	}
}