<?php
class db{
    public $host="localhost";
    public $dbname="dbpresence";
    public $name="root";
    public $pass="";
    public $con;
    public $isconnected;
    function connectdb(){
        $this->con=mysqli_connect($this->host,$this->name,$this->pass,$this->dbname);
        $this->isconnected=(($this->con)==TRUE);
    }
    function excute($req){
        if($this->isconnected){
            
            $res=mysqli_query($this->con,$req);
            return $res;
        }
        

    }
    function exsolo($req){
        $res=excute($req);
        return mysqli_fetch_array($res)[0];
    }
    function close(){
        $this->con->close();
    }
}
?>