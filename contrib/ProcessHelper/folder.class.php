<?php

require_once("file.class.php");

class Folder
{
	private $path;

	public function Folder ($path) 
	{
		$this->SetPath($path);
	}

	public function SetPath ($value)	
	{
		$this->path = $value;

		if (is_dir($value) != true)	
		{
			throw new DoesNotExistException("Folder: (" . $value . ") does not exist!");
		}
	}

	public function GetPath ()		
	{
		return $this->path;
	}

	public function GetSubFolders ($withEmptyFolders = true)
	{
		$handle = opendir($this->path);
      if (!is_resource($handle)) {
         throw new DoesNotExistException("Das angegebene Verzeichnis konnte nicht geöffnet werden");
      }
		$ret = array();

		while (false !== ($file = readdir($handle)))	
		{
			if ($file == "." || $file == "..") continue;

			$fullpath = $this->path . "/" . $file;		
			if (is_dir($fullpath) == false) continue;	
			
			$ret[] = new Folder($fullpath);				
			
		}

		closedir($handle);

		return $ret;	
	}

	public function GetFiles ($withSubFolders = false)
	{
		$handle = opendir($this->path);	
      if (!is_resource($handle)) {
         throw new DoesNotExistException("Das angegebene Verzeichnis konnte nicht geöffnet werden");
      }
		$ret = array();					
		
		while (false !== ($file = readdir($handle)))
		{
			if ($file == "." || $file == "..") continue;	

			$fullpath = $this->path . "/" . $file;	
			if (is_file($fullpath) == false) {		
				if ($withSubFolders) {					
					$subFolder = new Folder($fullpath);
					$ret = array_merge($subFolder->GetFiles($withSubFolders), $ret);
				}
			}
			else {									
				$ret[] = new File($fullpath);
			}
		}

		closedir($handle);				

		return $ret;							
	}

}

?>
