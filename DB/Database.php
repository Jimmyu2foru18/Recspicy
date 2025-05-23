<?php
class Database 
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() 
	{
        $this->host = getenv('DB_HOST');
        $this->db_name = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
    }

    public function getConnection() 
	{
        $this->conn = null;
        try 
		{
            $this->conn = new PDO
			(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
			
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		
		catch(PDOException $e) 
		{
            error_log("DB Connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }
}