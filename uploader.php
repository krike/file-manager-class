<?php

Class Uploader
{
	public function multiple_upload($files, $upload_dir = 'images/', $allowed_types = 'gif|jpg|jpeg|jpe|png', $size)
	{
		if(isset($files) && !empty($files)):
		$errors = FALSE;
		$filename = $files['name'];
		$rand = rand(111111111,999999999);
		$filetmp = $files['tmp_name'];
		$filetype = $files['type'];
		$filesize = $files['size'];
		$path = realpath($upload_dir)."/".$rand.$filename;
		$allowed_types = explode("|", $allowed_types);
			$allowed = false;
			foreach($allowed_types as $types):
				if($filetype == "image/".$types):
					$allowed = true;
				endif;
			endforeach;
			
			//if the submitted file is larger then the allowed size, return false
			if($filesize > $size):
				return false;
			endif;
			
			if($allowed == true):
				if(move_uploaded_file($filetmp,$path)):
					return $path;
				else:
					return false;
					$error = true;
				endif;
			else:
				return false;
			endif;
	
		endif;//end of if files exist and is not empty
			

		// There was errors, we have to delete the uploaded files
		if($errors):
			@unlink($path);
			return false;
		else:
			return $files;
		endif;

    }
	/*
	NOG AAN TE PASSEN
	public function upload_batch_images($name = 'userfile', $upload_dir = 'sources/images/', $allowed_types = 'gif|jpg|jpeg|jpe|png', $size)
	{
		/*$CI =& get_instance();
			$realpath = $upload_dir."images-".rand(1111111111,9999999999); //let's make it unique
			$config['upload_path']   = $realpath;
			$config['allowed_types'] = $allowed_types;
			$config['max_size']      = $size;
			$config['overwrite']     = FALSE;
			$config['encrypt_name']  = TRUE;

		$CI->upload->initialize($config);

		if(mkdir($realpath)):
			if($CI->upload->do_upload($name)):
				$files = $CI->upload->data();
				if(openZip($realpath."/".$files['file_name'], $realpath)):
					@unlink($files['full_path']);
					return $realpath;
				else:
					@unlink($files['full_path']);
					return false;
				endif;
			endif;
		else:
			return false;
		endif;

	}

	public function openZip($file_to_open, $zip_target)
	{
		/*$zip = new ZipArchive();
		$x = $zip->open($file_to_open);
		if ($x === true):
			$zip->extractTo($zip_target);
			$zip->close();
			return true;
		else:
			return false;
		endif;
	}*/
}