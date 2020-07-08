<?php
class Connection
{
    private $cn;    
	private $sth;
	private $totalRows;
	private static $hostname = "localhost";
	private static $username = "root";
	private static $password = "";
	private static $select_db = "test";
	
	
	public function openConnection() 
	{
		$this->cn = mysqli_connect(self::$hostname, self::$username, self::$password,self::$select_db) or die("Connection is not Done");
		//mysql_select_db(self::$select_db, $this->cn) or die("Database is not Selected");
		return $this->cn;
    }
    public function closeConnection()
    {
        mysqli_close($this->cn);
    }
    public function executeNoneQuery($query)
    {
		$result = mysqli_query($this->cn,$query) or die(mysqli_error());
		return $result;
		
    }
    public function executeReader($query)
    {
		$this->sth= mysqli_query($this->cn,$query) or die(mysqli_error());
		$this->totalRows = mysqli_num_rows($this->sth);
		return $this->sth;
		
    }
    public function executeScalar($query)
    {
		$result=mysqli_query($this->cn,$query) or mysqli_error();		
		return $result;
    }
	public function getTotalRows()
	{
		return $this->totalRows;
	}
	
}
?>