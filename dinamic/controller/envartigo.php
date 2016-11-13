<?php
    include_once("../factory/artigofactory.class.php");
    include_once("../model/artigo.class.php");
    if(isset($_POST["title"]))
    {
        $title = $_POST["title"];
        $textArt = $_POST["textArt"];
        $artigoFactory = new ArtigoFactory();
        $artigoFactory->autocommit(false);
        $idArticle = $artigoFactory->getIdArticleByTitle($title);
        if($idArticle == null )
        {
            $artigo = new Artigo();
            $artigo->setTitle($title);
            $artigo->setText($textArt);
            if($artigoFactory->insertArticle($artigo) === true)
            {
                if(isset($_POST["tags"]))
                {
                    $tags = $_POST["tags"];
                    $err = putTags($title, $tags, $artigoFactory);
                    if($err == 0)
                    {
                        $artigoFactory->commit();
                        echo "Sucesso";
                    }
                    else if($err == 1)
                    {
                        echo "Falha ao cadastrar os dados";
                    }
                    else
                    {
                        echo "Falha ao salvar tag ";
                    }
                }
                else
                {
                    $artigoFactory->commit();
                    echo "Sucesso[no tags]";
                }
            }
            else
            {
                $artigoFactory->rollBack();
                echo "Falha ao cadastrar artigo";
            }
        }
        else
        {
            echo "Titulo já está em uso!";
        }
    }
    else
    {
        echo "Sem titulo.";
    }
    $artigoFactory->close();

    function putTags($title, $tags, $artigoFactory)
    {
        foreach($tags as $tag)
        {
            $objTag = $artigoFactory->getTagByName($tag);
            if($objTag->getIdTag() == NULL)
            {
                if($artigoFactory->insertTag($tag) == true)
                {
                    $idArticle = $artigoFactory->getIdArticleByTitle($title);
                    echo "<br><br>";
                    $objTag = $artigoFactory->getTagByName($tag);
                    echo $objTag->getIdTag();
                    echo $objTag->getNameTag();
                    echo "<br><br>";
                    
                    if($artigoFactory->insertArticleTag($idArticle, $objTag->getIdTag()) != true)
                    {
                        $artigoFactory->rollBack();
                        return 2;
                    }
                }
                else
                {
                    $artigoFactory->rollBack();
                    return 1;
                }
            }
        }
        return 0;
    }
?>