<?php
require_once("file.class.php");

class Process
{	
	private $exec;
	private $prozess;
	private $exitCode;
   private $pipes;
   private $args;
   private $stdout;
   private $stderr;
	
	public function __construct ($file, $args = "") 
   { 								
		$this->exitCode = -1;
      $this->pipes = array();
      $this->stdout = "";
      $this->stderr = "";

      $this->SetExecutable($file);
      $this->SetArgs($args);
   }

   public function __destruct ()
   {
      try {
         $this->Stop();
      } 
      catch (Exception $e) {
         // NOP
      }
   }

   public function SetArgs ($args) 
   {
      $this->args = $args;
   }

	public function SetExecutable ($value)	
	{								
		$this->exec = $value;
	}

	public function GetExecutable () 
	{								
		return $this->exec;
	}

	public function Start () 
	{
		$descriptorspec = array(
			0 => array("pipe", "r"),  // stdin is a pipe that the child will read from -> results in pipes[0]
			1 => array("pipe", "w"),  // stdout is a pipe that the child will write to -> results in pipes[1]
			2 => array("pipe", "w")   // stderr is a pipe that the child will write to -> results in pipes[2]
		);
	
		$cwd = $this->exec->GetFilename(); 

		$tmp = strrpos($this->exec->GetFilename(), "/"); //Ermittelt das letzte Vorkommen eines Zeichens in einer anderen Zeichenkette.
      $path = substr($this->exec->GetFileName(), 0, $tmp);
      $cmd = $this->exec->GetFilename() . " " . $this->args;
		
		$this->prozess = proc_open($cmd, $descriptorspec, $this->pipes, $path, NULL);
	}

   public function GetStdout () 
   {
      if (is_array($this->pipes) && is_resource($this->pipes[1])) {
         $this->stdout .= stream_get_contents($this->pipes[1]); 
      }
      return $this->stdout;
   }

   public function GetStderr () 
   {
      if (is_array($this->pipes) && is_resource($this->pipes[2])) {
         $this->stderr .= stream_get_contents($this->pipes[2]);
      }
      return $this->stderr;
   }

   public function GetExitCode () 
   {
      if ($this->IsRunning()) {
         throw new Exception("Process is stil running");
      }

      return $this->exitCode;
   }
	
	public function Stop () 
	{	
		if (is_resource($this->prozess)) {

			do {
            sleep (2);
            $this->GetStdout();
            $this->GetStdErr();

            echo " "; flush(); ob_flush(); // Billiger Timeoutverhinderer
			} while ($this->IsRunning());

         $this->GetStdout();
         $this->GetStdErr();

			// Pipes müssen vor dem Prozess-Handle geschlossen werden, sonst bleeebts hängen
			fclose($this->pipes[0]);
			fclose($this->pipes[1]);
			fclose($this->pipes[2]);
			
			$this->exitCode = proc_close($this->prozess);
		}
		
		return $this->exitCode;
	}
	
	public function IsRunning () 
	{
		if (is_resource($this->prozess)) {
			$status = proc_get_status($this->prozess);
			return $status['running'];
		}
		else return false;
	}
}

?>
