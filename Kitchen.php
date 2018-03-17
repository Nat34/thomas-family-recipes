<?php

class Kitchen extends CI_Controller
{

    private $title = "Thomas Family Recipes";
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model('recipes_model');
	$this->load->helper('url_helper');
    }
    
    public function index()
    {
        $data['title'] = $this->title;

        $this->load->view('templates/header', $data);
        $this->load->view('kitchen/home', $data);
        $this->load->view('templates/footer', $data);
    }    
    
    public function recipes($slug = NULL)
    {
	$data['recipes'] = $this->recipes_model->get_recipes();
	$data['title'] = "Recipes";
	
	$this->load->view('templates/header', $data);
	$this->load->view('kitchen/recipes', $data);
	$this->load->view('templates/footer', $data);
    }
    
	/*
	* Loads individual recipe item
	* @param string $slug
	*/
    public function view($slug = NULL)
    {
	
        $data['recipes_item'] = $this->recipes_model->get_recipes($slug);

        if (empty($data['recipes_item']))
        {
                show_404();
        }
        
        if (isset($data['recipes_item']['id']))
        {
        	$source_id = $data['recipes_item']['id'];
        	$data['recipes_item']['ingredients'] = $this->recipes_model->get_ingredients($source_id);
 		$data['recipes_item']['ingredients_icing'] = $this->recipes_model->get_icingIngredients($source_id);
        }

        $data['title'] = $data['recipes_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('kitchen/view', $data);
        //$this->load->view('templates/footer');
    }
    
    public function create()
    {
    
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$data['title'] = "Create A Recipe";

	$this->form_validation->set_rules('title', 'Title', 'required');
	$this->form_validation->set_rules('source', 'Source', 'required');
	$this->form_validation->set_rules('description', 'Description', 'required');
	$this->form_validation->set_rules('instructions', 'Instructions', 'required');

	
	if ($this->form_validation->run() === FALSE) {
		$this->load->view('templates/header', $data);
		$this->load->view('kitchen/create-recipe');
		$this->load->view('templates/footer', $data);
	} else {
		$this->recipes_model->set_recipes();
		$this->load->view('templates/header', $data);
		$this->load->view('kitchen/success');
		$this->load->view('templates/footer', $data);
	}
	
    }
    
 	/*
	* Removes individual recipe item
	* @param string $slug
	*/
    public function remove($slug = NULL)
    {
	
        $this->recipes_model->remove_recipe($slug);

	$this->load->view('templates/header');
	$this->load->view('kitchen/success');
	$this->load->view('templates/footer');

    }
    
    public function about()
    {
    
    	    $data['title'] = $this->title;
	    
	    $this->load->view('templates/header', $data);
	    $this->load->view('kitchen/about-us', $data);

    }
    
    public function gallery()
    {
    
    	    $data['title'] = $this->title;
	    
	    $this->load->view('templates/header', $data);
	    $this->load->view('kitchen/gallery', $data);

    }

}