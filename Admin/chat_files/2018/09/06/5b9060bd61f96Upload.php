<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
		return;
	}
	public function get_files($page = 1){
		$this->load->model('Rs_Global');
		$this->Rs_Global->set_table('media');
		echo  json_encode($this->Rs_Global->get(null,array('page'=>$page,'limit'=>20)));
	}
	public function do_upload(){
		$response = array();
		$response['status'] = 'success'; 
		$allowed = array('png', 'jpg','pdf');
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
			$fileNewDir = 'uploads/'.date('Y').'/'.date('m');
			if (!is_dir($fileNewDir)) {
			    mkdir($fileNewDir, 0777, TRUE);
			    $content = ":(";
				$fp = fopen($fileNewDir . "/index.html","wb");
				fwrite($fp,$content);
				fclose($fp);
			}
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

			if(!in_array(strtolower($extension), $allowed)){
				$response['status'] = 'error'; 
				$response['message'] = 'File type is not allow'; 
			}
			$temp = explode(".", $_FILES["upl"]["name"]);
			$fileNewPath = $fileNewDir.'/'.uniqid('rs_').'.'.end($temp);

			if($response['status'] !='error' and move_uploaded_file($_FILES['upl']['tmp_name'], $fileNewPath)){
				$response['url'] = base_url($fileNewPath);
				$this->load->model('Rs_Global');
				$this->Rs_Global->set_table('media');
				$dbNewData = array(
					'url' => $response['url'],
					'file'	=> $fileNewPath,
					'title'	=> $_FILES["upl"]["name"]
					);
				$response['id'] = $this->Rs_Global->add($dbNewData);
				$response['status'] = 'success'; 
				/*Thumbnail Make*/
				$config['image_library'] = 'gd2';
				$config['source_image'] = $fileNewPath;
				$config['create_thumb'] = true;
				$config['maintain_ratio'] = true;
				$config['width']         = 400;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			}
		}
		echo json_encode($response);
	}
}