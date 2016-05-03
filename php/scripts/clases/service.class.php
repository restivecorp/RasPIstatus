<?php
	class Service{
	    public $name;
	    public $status;
		public $styleClass;
	 
	    public function __construct($arg_name, $arg_status){
	        $this->name = $arg_name; 
	        $this->status = $arg_status; 
	        
			if (strpos($arg_status, 'inactive') !== false) {
   				$this->styleClass = "danger";
			} else {
				$this->styleClass = "success";
			}

	    }
	   
	}
?>