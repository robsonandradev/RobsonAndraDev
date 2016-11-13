<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artigo extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('envartigo');
	}
    
    public function novo()
    {
        $article = array(
            "title" => $_POST["title"],
            "text"  => htmlspecialchars($_POST["textArt"]),
            "tags"  => isset($_POST["tags"]) ? $_POST["tags"] : NULL
        );
        $this->load->model("artigoModel");
        $message = $this->artigoModel->insert( $article );
        if( $message == "Sucesso" )
        {
            print "Artigo salvo com sucesso!";
        }
        else
        {
            print "Falha ao salvar o Artigo <br />" . $message;
        }
    }
    
    public function lista()
    {
        $this->load->model("artigoModel");
        $articles = $this->artigoModel->getArticles();
        print json_encode($articles);
    }
    
    public function text()
    {
        htmlspecialchars($_POST["textArt"]);
    }
}
