<?php
    include_once("../factory/artigofactory.class.php");
    include_once("../model/artigo.class.php")
    if(isset($_POST["title"]))
    {
        $title = $_POST["title"];
        $textArt = $_POST["textArt"];
        $artigoFactory = new ArtigoFactory();
        $artigoFactory->autocommit(false);
        $result = $artigoFactory->getIdArticleByTitle($title);
        if($result->num_rows <= 0 )
        {
            $artigo = new Artigo();
            $artigo->setTitle($textArt);
            $artigo->setText($textArt);
            if($artigoFactory->insertArticle($artigo) === true)
            {
                if(isset($_POST["tags"]))
                {
                    $tags = $_POST["tags"];
                    $err = putTags($conn, $title, $tags, $artigoFactory);
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
    $artigoFactory->close();

    function putTags($conn, $title, $tags, $artigoFactory)
    {
        foreach($tags as $tag)
        {
            $resultTag = $artigoFactory->getTagByName($tag);
            if($resultTag->num_rows <= 0 )
            {
                if($artigoFactory->insertTag($tag) == true)
                {
                    $result = $artigoFactory->getIdArticleByTitle($title);
                    $row = $result->fetch_assoc();
                    $idArticle = $row["idarticle"];
                    $row = $resultTag->fetch_assoc();
                    $idTag = $row["idtag"];
                    if($artigo->insertArticleTag($idArticle, $idTag) != true)
                    {
                        $conn->rollBack();
                        return 2;
                    }
                }
                else
                {
                    $conn->rollBack();
                    return 1;
                }
            }
        }
        return 0;
    }
?>