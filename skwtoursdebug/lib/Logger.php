<?php
	class Logger{
		protected $file;

		public function __construct($filename)
		{
			$this->file = fopen($_SERVER["DOCUMENT_ROOT"]."/".$filename, "a+");
		}

		public function write($str){
			fwrite($this->file,date("[d-m-Y H-i-s] "). $str."\r\n");
		}

		public function __desctruct(){
			fclose($file);
		}
	}