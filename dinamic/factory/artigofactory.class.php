<?php
include_once("../model/conn.class.php");
include_once("tagfactory.class.php");

class ArtigoFactory extends Conn
{
    private $conn;
    private $tags;
    private $tagFactory;
    
    function __construct()
    {
        $this->conn = $this->getConn();
        $this->tags = array();
        $this->tagFactory = new TagFactory($this->conn);
    }
    
    public function autocommit($boo = true)
    {
        $this->conn->autocommit($boo);
    }
    
    public function getIdArticleByTitle($title)
    {
        $sqlGetTitle = "select idarticle from article where title = '$title'";
        $result = $this->conn->query($sqlGetTitle);
        return $result;
    }
    
    public function insertArticle($artigo)
    {
        $title = $artigo->getTitle();
        $textArt = $artigo->getText();
        $sql = "insert into article values(null, '$title', '$textArt', DATE_FORMAT(now(),'%d-%m-%Y') )";
        return $this->conn->query($sql);
    }
    
    public function insertTag($tagName)
    {
        return $this->tagFactory->insertTag($tagName);
    }
    
    public function getTagBayName($tagName)
    {
        return $this->tagFactory->getTagBayName($tagName);
    }
    
    public function insertArticleTag($idArticle, $idTag){
        $sql = "insert into articletag values(null, $idArticle, $idTag)";
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

$artigo = new Artigo();

$result = $artigo->getIdArticleByTitle("test 1");
for($rows = array(); $row = $result->fetch_assoc(); $rows[$row["idarticle"]] = $row["idarticle"])
{
    print_r($row);
}


// header("Access-Control-Allow-Origin: http://yourdomain-you-are-connecting-from.com");
?>

