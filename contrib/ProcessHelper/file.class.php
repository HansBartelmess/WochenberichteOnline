<?php

class DoesNotExistException extends Exception
{
}

class File
{
	private $filename;
	
	public function File ($value)
	{
		$this->SetFilename($value);
	}

	public function SetFilename ($value)	
	{
		$this->filename = $value;


		if (is_file($value) != true)
		{
		throw new DoesNotExistException("File: (" . $value . ") does not exist!");
		}
	}

	public function GetFilename ()	
	{
		return $this->filename;
	}
	
   public function GetTimestamp () 
   {
      return date('d.m.Y H:i:s', filemtime($this->GetFilename()));
   }

   public function GetDate ()
   {
      $month =  date('n', filemtime($this->GetFilename()));
      $day =  date('j', filemtime($this->GetFilename()));
      $year =  date('Y', filemtime($this->GetFilename()));
      
      return gregoriantojd ($month, $day, $year);
   }

   public function GetSize () 
   {
      return filesize($this->GetFilename());
   }
}

?>
