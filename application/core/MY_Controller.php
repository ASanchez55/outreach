<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $template = array();
    public $data = array();
    public $middle = '';
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper(array('form', 'language', 'url'));
    }

    public function render($middleParam = '')
    {
        if ($middleParam == '')
        {
            $middleParam = $this->middle;
        }

        $this->template['header'] = $this->load->view('layout/header.php', $this->data, true);
        $this->template['navbar'] = $this->load->view('layout/navbar.php', $this->data, true);
        $this->template['middle'] = $this->load->view($middleParam, $this->data, true);
        $this->template['footer'] = $this->load->view('layout/footer.php', $this->data, true);
        $this->load->view('layout/front', $this->template);
    }
}