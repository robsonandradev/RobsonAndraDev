<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArtigoModel extends CI_Model
{
    private $articleTable = "article",
            $articleTag   = "articletag",
            $tag          = "tag";
    
    public function getArticleByTitle( $title )
    {
        $this->db->select()
            ->from( $this->articleTable . " a" )
            ->join( $this->articleTag . " at ", "a.idarticle = at.article" )
            ->join( $this->tag . " t ", "t.idtag = at.tag" )
            ->where( "a.title", $title );
        return $this->db->get();
    }
    
    public function getArticles()
    {
        return $this->db->get($this->articleTable)->result();
    }
    
    public function insert( $article ) 
    {
        try
        {
            error_reporting( E_ALL ^ E_WARNING );
            $this->db->trans_begin();
            $tmpArt = $this->db->get_where( $this->articleTable, array( "title" => $article["title"] ) )->result();
            
            if( $tmpArt == array() )
            {
                $today = getdate();
                $this->db->insert( $this->articleTable, array(
                   "idarticle" => NULL,
                   "title" => $article["title"],
                   "text"  => $article["text"],
                   "publicdate" => $today["mday"] . "/" . $today["mon"] . "/" . $today["year"] . "/"
                ));
                $this->checkError();

                $tags = $article["tags"];
                $tmpArt = $this->db->get_where( $this->articleTable, array( "title" => $article["title"] ) )->result();
                $idArticle = $tmpArt[0]->idarticle;
                foreach( $tags as $tagName )
                {
                    $tmpTag = $this->db->get_where( $this->tag, array( "nametag" => $tagName ) )->result();                    
                    if( $tmpTag == array() )
                    {
                        $this->db->insert( $this->tag, array(
                            "idtag" => NULL,
                            "nametag" => $tagName
                        ));
                        $this->checkError();
                        $tmpTag = $this->db->get_where( $this->tag, array( "nametag" => $tagName ) )->result();
                    }
                    
                    $idTag = $tmpTag[0]->idtag;
                    $this->db->insert( $this->articleTag, array(
                        "idarttag" => NULL,
                        "article"  => $idArticle,
                        "tag"      => $idTag
                    ));
                    $this->checkError(); 
                }
            }
            else
            {
                throw new Exception("Artigo já existe.");
            }
            $this->db->trans_commit();
            return "Sucesso";
        } 
        catch ( Exception $e )
        {
            $this->db->trans_rollback();
            return $e->getMessage();
        }
    }
    
    private function checkError()
    {
        $e = $this->db->error();
        if( $e["message"] != "" )
        {
            throw new Exception( $e["message"] );
            return false;
        }
        else
        {
            return true;
        }
    }
}