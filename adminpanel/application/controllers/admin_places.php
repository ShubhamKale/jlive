<?php
class Admin_places extends CI_Controller {
 
   /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/places';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('place_model');

        if(!$this->session->userdata('admin_is_logged_in')){
            redirect('login');
        }
    }
	
	 /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
		
        //all the posts sent by the view
		$order=$this->session->userdata('order');
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
		$tables=array("atm","bank","cinema","education","food","garden","hospital","hotel","medical","petrol","sport","transport","tempplaces");
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/places';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($order != false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
          /*  if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;
*/		

            if($order){
                $filter_session_data['order'] = $tables[$order];
				$filter_session_data['orderid'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
				$orderid = $this->session->userdata('orderid');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->place_model->count_places($this->session->userdata('order'));
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
                if($order){
                    $data['manufacturers'] = $this->place_model->get_places( $this->session->userdata('order'),$config['per_page'],$limit_end);        
                }else{
                    $data['manufacturers'] = $this->place_model->get_places($this->session->userdata('order'),$config['per_page'],$limit_end);        
                }
            

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            //$filter_session_data['order'] = $tables[0];
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->place_model->count_places($this->session->userdata['order']);
            $data['manufacturers'] = $this->place_model->get_places($this->session->userdata['order'], $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/places/list';
        $this->load->view('includes/template', $data);  

    }//index

	public function showData()
    {
		$tables=array("atm","bank","cinema","education","food","garden","hospital","hotel","medical","petrol","sport","transport");
        //all the posts sent by the view
       // $search_string = $this->input->post('search_string');        
        $order = $this->uri->segment(4);
       // $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 5;

        $config['base_url'] = base_url().'admin/places';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);
		
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($order != false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
          /*  if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;
*/		

            if($order){
                $filter_session_data['order'] = $order;
				$filter_session_data['orderid'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->place_model->count_places($this->session->userdata('order'));
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
                if($order){
                    $data['manufacturers'] = $this->place_model->get_places( $this->session->userdata('order'),$config['per_page'],$limit_end);        
                }else{
                    $data['manufacturers'] = $this->place_model->get_places($this->session->userdata('order'),$config['per_page'],$limit_end);        
                }
            

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = $tables[0];
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->place_model->count_places($this->session->userdata['order']);
            $data['manufacturers'] = $this->place_model->get_places($this->session->userdata['order'], $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/places/list';
        $this->load->view('includes/template', $data);  

    }
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
				$verified=1;
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
        $data['main_content'] = 'admin/places/add';
        $this->load->view('includes/template', $data);  
    }  


	public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
		$tablename=$this->session->userdata('order');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
               //$tablename=$this->input->post('cat');
				$name=$this->input->post('name');
				$addr=$this->input->post('addr');
				$contact=$this->input->post('contact');
				$latitude=$this->input->post('latitude');
				$longitude=$this->input->post('longitude');
				$search=$this->input->post('search');
				$description=$this->input->post('description');
				$verified=1;
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
                if($this->place_model->update_place($id, $tablename, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/places/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['place'] = $this->place_model->get_place_by_id($id,$this->session->userdata('order'));
        //load the view
        $data['main_content'] = 'admin/places/edit';
        $this->load->view('includes/template', $data);            

    }//update

	 public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
		$table= $this->session->userdata('order');
		//error_log('tesing');
        $this->place_model->delete_place($id,$table);
        redirect('admin/places/show/'.$table);
    }//edit
 
 }
 
 ?>