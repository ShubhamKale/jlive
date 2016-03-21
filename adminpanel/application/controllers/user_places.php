<?php
class User_places extends CI_Controller {
 
   /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'user/places';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('place_model');

        if(!$this->session->userdata('user_is_logged_in')){
            redirect('login');
        }
    }
	
	 /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
		
       //load the view
        $data['main_content'] = 'user/places/add';
        $this->load->view('includes/template', $data); 

    }//index

	public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				$tablename=$this->input->post('cat');
				$name=$this->input->post('name');
				$addr=$this->input->post('addr');
				$contact=$this->input->post('contact');
				$latitude=$this->input->post('latitude');
				$longitude=$this->input->post('longitude');
				$search=$this->input->post('search');
				$description=$this->input->post('description');
				$verified=0;
				$category=$this->input->post('category');
				$type=$this->input->post('type');
				$foodtype=$this->input->post('foodtype');
				$drinktype=$this->input->post('drinktype');
				$field=$this->input->post('field');
				$bankname=$this->input->post('bankname');
				
				
				if ( $tablename == 'hospital')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
					'type' => $type,
                );
				if ( $tablename == 'hotel')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
					'type' => $type,
					'foodtype' => $foodtype,
                );
				if ( $tablename == 'cinema')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
                );
				if ( $tablename == 'food')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
					'foodtype' => $foodtype,
					'drinktype' => $drinktype,
                );
				if ( $tablename == 'education')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
					'field' => $field,
					'type' => $type,
                );
				if ( $tablename == 'transport')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
					'type' => $type,
                );
				if ( $tablename == 'bank')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
                );
				if ( $tablename == 'atm')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
					'bankname' => $bankname,
                );
				if ( $tablename == 'sport')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
                );
				if ( $tablename == 'garden')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
                );
				if ( $tablename == 'petrol')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
                );
				if ( $tablename == 'medical')
					 $data_to_store = array(
                    'name' => $name,
					'addr' => $addr,
					'contact' => $contact,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'search' => $search,
					'description' => $description,
					'verified' => $verified,
					'category' => $category,
                );
				
                //if the insert has returned true then we show the flash message
                if($this->place_model->store_place($tablename,$data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'user/places/add';
        $this->load->view('includes/template', $data);  
    }   
 }
 
 ?>