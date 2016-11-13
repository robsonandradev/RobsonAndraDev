<?php
include_once("../model/conn.class.php");
include_once("../model/artigo.class.php");

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
        $row = $result->fetch_assoc();
        $tag = new Tag();
        $tag->setIdTag( $row["idtag"] );
        $tag->setNameTag( $row["nametag"] );
        
        print $sql;
        print_r($row); 
            
        return $tag;
    }
    
    public function insertTag($tag)
    {
        print_r($tag);
        $nameTag = $tag->getNameTag();
        $sql = "insert into tag values(null, '$nameTag')";
        echo "<br>insert tag: $sql<br>";
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
$tagFactory = new TagFactory();

$result = $tagFactory->getIdArticleByTitle("teste");
/*for($rows = array(); $row = $result->fetch_assoc(); $rows[$row["idarticle"]] = $row["idarticle"])
{
    print_r($row);
}
*/

// header("Access-Control-Allow-Origin: http://yourdomain-you-are-connecting-from.com");
?>

