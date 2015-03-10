<?php
	class Validation
	{
		public $errors=array();

		public function validate($data,$rules)
        	{
			$valid=TRUE;
			foreach($rules as $fieldname=>$rule)
			{
				$callbacks=explode('%',$rule);
				foreach($callbacks as $callback)
				{
					$value=isset($data[$fieldname]) ? $data[$fieldname] : NULL;
					if ($this->$callback($value,$fieldname)==FALSE)
					{
						$valid=FALSE;
					}
				}
			}
			return $valid;
		}

		public function email($value,$fieldname) 
		{ 
			if(preg_match("/^[a-z]([a-z0-9]+|[a-z0-9]+[a-z0-9.]+)*@[a-z0-9]+\.[a-z]+/",$value))
			{
				$valid=TRUE; 
			}
			else
			{
				$valid=FALSE; 
			}
			if($valid==FALSE)
			{
				$this->errors[]="Invalid email";
			}
			return $valid;
		}

		public function required($value,$fieldname)
        	{
			$valid=!empty($value);
			if($valid==FALSE)
			{
				$this->errors[]="the $fieldname required";
			}
		return $valid;
        	}



        	public function phone($value,$fieldname)
        	{
			$valid=!empty($value);
			echo strlen($value);
			if(strlen($value)!=7 && strlen($value)!=11)
			{
				$this->errors[]="the $fieldname is Invalid";
			}
		return $valid;
        	}



        	public function exists($value,$fieldname)
        	{

				if($_FILES[$fieldname]['error'] > 0)
				{
				switch ($_FILES[$fieldname]['error'])
				{
					case 1: $error="File exceeded upload_max_filesize";
					         $this->errors[]= $error;
					          return FALSE;
					break;
					case 2: $error="File exceeded max_file_size";
					            $this->errors[]= $error;
					           return FALSE;
					break;
					case 3: $error="File only partially uploaded";
					           $this->errors[]= $error;
					           return FALSE;
					break;
					case 4: $error="No file uploaded";
					            $this->errors[]= $error;
					           return FALSE;
					break;
					case 6: $error="Cannot upload file: No temp directory specified";
					            $this->errors[]= $error;
					           return FALSE;
					break;
					case 7: $error="Upload failed: Cannot write to disk";
					            $this->errors[]= $error;
					            return FALSE;
					break;
				}
				}
				$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
				$upfile = "$DOCUMENT_ROOT/PHP-Project/uploads/".$_FILES[$fieldname]['name'] ;
				$array=array('image/gif','image/png','image/jpeg');
				
				if (!in_array($_FILES[$fieldname]['type'] ,$array ))
				{
					echo 'Problem: file is not valid';

				}
				elseif (is_uploaded_file($_FILES[$fieldname]['tmp_name']))
				{
				        if (!move_uploaded_file($_FILES[$fieldname]['tmp_name'], $upfile))
				             {
				               return FALSE;

				             }
				        else{

				        	return TRUE;

				        }
				}

        	}
	}
?>
