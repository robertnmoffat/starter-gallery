<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends Application {

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
		//$this->load->view('gallery');
		// $this->data['pagebody'] = 'gallery';
		// $this->render();
		
		// Get all images from model
		$pix = $this->images->all();
		
		// Build array of formatted cells
		foreach ($pix as $picture)
			$cells[] = $this->parser->parse('_cell', (array) $picture, true);
			
		// prime the table class
		$this->load->library('table');
		$parms = array(
			'table_open' => '<table class="gallery">',
			'cell_start' => '<td class="oneimage">',
			'cell_alt_start' => '<td class="oneimage">'
		);
		$this->table->set_template($parms);
		
		// Generate table (finally)
		$rows = $this->table->make_columns($cells, 3);
		$this->data['thetable'] = $this->table->generate($rows);
		
		$this->data['pagebody'] = 'gallery';
		$this->render();
	}
}
