<?php
final class DBMySQLi {
    private $link;
    public function __construct($hostname, $username, $password, $database) {
        $this->link = new mysqli($hostname, $username, $password, $database);        
        if (mysqli_connect_error()) {
            echo "<!--HTML-->";
            echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
				<html> 
				    <head> 
				    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
				    	<title>Something went wrong</title> 
				    </head> 
				    <body> 
					<br><br><br><br><br><br><br> 
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> 
   					    <tr> 
      						<td align="center"> 
      						    <img src="error.png" border="0"> 
      						    <h1 style="margin:0;padding:0;font-family: trebuchet ms;">Something went wrong. Please try again later.</h1> 
      						</td> 
      					    </tr> 
    					</table> 
 				 </body> 
			    </html> ';
            throw new ErrorException('Error: Could not make a database link (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            exit();
        }
        $this->link->set_charset("utf8");
    }
    public function query($sql) {
        if(is_string($sql)){
            $query = $this->link->query($sql);
            if (!$this->link->errno){
                if (isset($query->num_rows)) {
                    $data = array();
                    while ($row = $query->fetch_assoc()) {
                        $data[] = $row;
                    }
                    $result = new stdClass();
                    $result->num_rows = $query->num_rows;
                    $result->row = isset($data[0]) ? $data[0] : array();
                    $result->rows = $data;
                    unset($data);
                    $query->close();
                    return $result;
                } else{
                    return $this->link->affected_rows;
                }
            }else if($this->link->errno == 1062 /*Mysql Duplicate key code*/){
                return [$this->link->errno=>$this->link->error];
            }
        }
    }
    public function getLastId() {
        return $this->link->insert_id;
    }
    public function __destruct() {
        $this->link->close();
    }
}
?>