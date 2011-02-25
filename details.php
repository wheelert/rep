<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Rep extends Module {

	public $version = '0.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Rep Module',
			),
			'description' => array(
				'en' => 'Track Sales Partner impressions and Sign-ups!',
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => TRUE
		);
	}

	public function install()
	{
		// Your Install Logic
			//Check if tables exits//
			$this->db->query("DROP TABLE IF EXISTS RepLog");	
			$this->db->query("DROP TABLE IF EXISTS RepUsers");	
			$this->db->query("DROP TRIGGER IF EXISTS RepUsers_insert");
			$this->db->query("DROP TRIGGER IF EXISTS RepUsers_update");
			$this->db->query("DROP TRIGGER IF EXISTS RepLog_insert");
		
			//create Table//
			$this->db->query("
			CREATE TABLE RepUsers ( 
				`rep_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`username` varchar( 255 ),
				`password` varchar( 255 ),
				`fullname` varchar( 255 ),
				`created` DATETIME,
				`modified` DATETIME
				) ENGINE = MYISAM
			");
			
			$this->db->query("
			CREATE TABLE RepLog ( 
				`replog_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`useragent` varchar( 255 ),
				`ip` varchar( 255 ),
				`ref_url` varchar( 255 ),
				`created` DATETIME
				) ENGINE = MYISAM
			");
		
		//Create Triggers//
		$this->db->query("CREATE TRIGGER RepUsers_insert BEFORE INSERT ON `RepUsers`
    					FOR EACH ROW SET NEW.created = NOW()");
    	$this->db->query("CREATE TRIGGER RepUsers_update BEFORE UPDATE ON `RepUsers`
    					FOR EACH ROW SET NEW.modified = NOW()");				
 		$this->db->query("CREATE TRIGGER RepLog_insert BEFORE INSERT ON `RepLog`
    					FOR EACH ROW SET NEW.created = NOW()");   					
    					
		
		return TRUE;
	}

	public function uninstall()
	{
		// Your Uninstall Logic
			$this->db->query("DROP TABLE IF EXISTS RepLog");	
			$this->db->query("DROP TABLE IF EXISTS RepUsers");	
			$this->db->query("DROP TRIGGER IF EXISTS RepUsers_insert");
			$this->db->query("DROP TRIGGER IF EXISTS RepUsers_update");
			$this->db->query("DROP TRIGGER IF EXISTS RepLog_insert");
		return TRUE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br/>Contact the module developer for assistance.";
	}
}
/* End of file details.php */
