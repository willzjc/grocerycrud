<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */

        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        die();
    }

    public function employees_example()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('employees');
//        $crud->columns('lastName','firstName','email','jobTitle');
//        $crud->fields('lastName','firstName','extension','email','jobTitle');

        $crud->display_as('lastName','Last Name');
        $crud->display_as('firstName','First Name');
        $crud->display_as('jobTitle','Job Title');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null)

    {
        $this->load->view('our_template.php', $output);
    }

    public function my_function_name()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('employees');
        $output = $crud->render();

        $this->_example_output($output);
    }
}

/* End of file main.php */
/* Location: ./application/controllers/Demo.php */ ?>