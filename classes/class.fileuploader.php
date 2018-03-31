<?php

require __DIR__.'/../config.php';
include Class_path.'class.patient.php';
class fileuploader{
	
	function upload()
	{
		if(!$this->check_content_type()) {$this->response = "Content Type Error"; return 0;}
		if( $this->size > $this->max_size ) {$this->response = "Size too big"; return 0;}
		$patient = patient::get_patient_with_reg_id($this->reg_id);
		$this->patient_id = $patient['id'];
		$this->path = root;
		$this->req_path = ['\appData',"\\".$this->patient_id,"\\".$this->reg_id,"\\".$this->from];
		foreach ($this->req_path as $value)  
		{
			$this->check_path($value);	
		}		
		$this->saveImage();

	}
	function get_rec()
	{
		$patient = patient::get_patient_with_reg_id($this->reg_id);
		$this->patient_id = $patient['id'];
		$this->path = root.'\appData'."\\".$this->patient_id."\\".$this->reg_id."\\".$this->from;
		$this->path_to_access = domain.'/appData'."/".$this->patient_id."/".$this->reg_id."/".$this->from;
		$this->files = [];
		$files = scandir($this->path);
		foreach ($files as $key => $value) {
			if (!is_dir($value)) {
				$file = new stdClass();
				$file->name = $value;
				$file->last_mod = date("Y M d H:m:s",filemtime($this->path."\\".$value));
				$this->files[] = $file;
			}
		}
	}
	function check_content_type()
	{
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$query = "SELECT * FROM accpted_file_contents where content_type = '$this->type'";
		$result = $con->query($query);
		if($result->num_rows > 0)
		{
			$exe = $result->fetch_array();
			$this->type_id = $exe['content_id'];	
			$this->max_size = $exe['max_size'] * MB;
			return true;
		}
		return false;
	}
	function saveImage()
	{	
		$file = $this->path."\\$this->name";
		$myfile = fopen($file, "w")or print_r("Unable to open file! $file");
		fwrite($myfile, $this->Content);
		fclose($myfile); 
	}
	function check_path($value)
	{
		$this->path .= $value;
		if(!file_exists($this->path))
		{
			mkdir($this->path,755);
		}
		return 0;
	}
}