<?php
class Artigo
{
    private idArticle = null;
    private $title;
    private $text;
    private $publicDate;
    private $tags = array();
    
    public function getIdArticle()
    {
        return $this->idArticle;
    }
    
    public function setIdArticle($id)
    {
        $this->idArticle = $id;
    }
    
    public function getTitle()
    {
        return $this->title
    }
    
    public function setTitle($title_)
    {
        $this->title = $title_;
    }
    
    public function getText()
    {
        return $this->text
    }
    
    public function setText($text_)
    {
        $this->text = $text_;
    }
    
    public function getPublicDate()
    {
        
    }
    
    public function setPublicDate($publicDate_)
    {
        $this->publicDate;
    }
    
    public function getTags()
    {
        return $this->tags;
    }
    
    public function setTags($tag)
    {
        $this->tags[$tag->idTag] = $tag->nameTag;
    }
}

class Tag
{
    private $idTag;
    private $nameTag;
    
    public function getIdTag()
    {
        return $this->idTag;
    }
    
    public function setIdTag($id)
    {
        $this->idTag = $id;
    }
    
    public function getNameTag()
    {
        return $this->nameTag;
    }
    
    public function setNameTag($name)
    {
        $this->nameTag = $name;
    }
    
}

?>






