<?php
include_once("../model/conn.class.php");

class TagFactory extends Conn
{
    private $conn;
    
    function __construct()
    {
        $this->conn = $this->getConn();
    }
    
    function __construct1($extConn)
    {
        $this->conn = $extConn;
    }
    
    public function autocommit($boo = true){
        $this->conn->autocommit($boo);
    }
    
    public function getTagBayName($tagName)
    {
        $sql = "select idtag from tag where nametag = '$tagName'";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    public function insertTag($tagname)
    {
        $sql = "insert into tag values(null, '$tagName')";
        return $this->conn->query($sql);
    }
    
    public function commit()
    {
        $this->conn->commit();
    }
    
    public function rollBack()
    {
        $this->conn->rollBack();
    }
    
    public function close()
    {
        $this->conn->close();
    }
}
// test class
/*
$artigo = new Artigo();

$result = $artigo->getIdArticleByTitle("teste");
for($rows = array(); $row = $result->fetch_assoc(); $rows[$row["idarticle"]] = $row["idarticle"])
{
    print_r($row);
}
*/

// header("Access-Control-Allow-Origin: http://yourdomain-you-are-connecting-from.com");
?>

