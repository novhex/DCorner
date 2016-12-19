<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	private $protected_urls = array('profile.html','update_profile');
	private $redirect_to_profile_if_hasLoggedIn = array('login.html','register.html');

	public function __construct(){

		parent::__construct();
		$this->load->helper(array('url','string'));
		$this->load->library(array('form_validation','paginator','session','redbean'));

			if(in_array(uri_string(), $this->protected_urls)){

				if($this->session->userdata('id')==''){

				 	redirect(base_url('index.html'));

				}

			}

			if(in_array(uri_string(), $this->redirect_to_profile_if_hasLoggedIn)){

				if($this->session->userdata('id')!=''){

					redirect(base_url('profile.html'));
				}
			}

	}

	public function index(){

		$data['page_title'] = 'The Dating Corner &ndash; Find your match now!';

		$data['css'] = array(
			base_url('assets/css/bootstrap.min.css'),
			base_url('assets/css/custom.css'),
			base_url('assets/css/main.css'),
			base_url('assets/css/font-awesome-4.6.1/css/font-awesome.min.css'),
			);

		$data['js']=array(
			base_url('assets/js/jquery.min.js'),
			base_url('assets/js/bootstrap.min.js'),
			base_url('assets/js/scrolling-nav.js'),
			base_url('assets/js/jquery.easing.min.js'),
			base_url('assets/js/modernizr-2.6.2-respond-1.1.0.min.js'),
			base_url('assets/js/datingcorner.js')
			);

		$this->load->view('tpl/header-default',$data);
		$this->load->view('tpl/navbar',$data);
		$this->load->view('default',$data);
		$this->load->view('tpl/footer',$data);

	}

	public function login(){

		

		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters("<p style='color:white;'>","</p>");

		if($this->form_validation->run()==FALSE){

				$data['page_title'] = 'Login - The Dating Corner &ndash; Find your match now!';

				$data['css'] = array(
					base_url('assets/css/bootstrap.min.css'),
					base_url('assets/css/custom.css'),
					base_url('assets/css/main.css'),
					base_url('assets/css/font-awesome-4.6.1/css/font-awesome.min.css')
					);

				$data['js']=array(
					base_url('assets/js/jquery.min.js'),
					base_url('assets/js/bootstrap.min.js'),
					base_url('assets/js/scrolling-nav.js'),
					base_url('assets/js/jquery.easing.min.js'),
					base_url('assets/js/modernizr-2.6.2-respond-1.1.0.min.js')
					);

				$this->load->view('tpl/header-default',$data);
				$this->load->view('tpl/navbar',$data);
				$this->load->view('login',$data);
				$this->load->view('tpl/footer',$data);

		}else{
				

				$email_address = $this->input->post('email',TRUE);
				$password = $this->input->post('password',TRUE);
				$userdata=R::findOne( 'members', ' email = ? ', [ $email_address ] );

				if($userdata!==NULL){
					
					$hashed_userpass =R::findOne('members','email = ?',[ $email_address ])->password;

					if($hashed_userpass!==''){

						if(password_verify($password,$hashed_userpass)===TRUE){
							$array = array(
							'id' => $userdata->id,
							'firstname'=>$userdata->firstname,
							'lastname'=>$userdata->lastname,
							'email'=>$userdata->email,
							'username'=>$userdata->username
						);
					
						$this->session->set_userdata( $array );
						redirect(base_url('profile.html'));
						
						}else{
							$this->session->set_flashdata('login_error', 'Invalid Username or Password');
							redirect(base_url('login.html'));	
						}
					}

				}else{
					$this->session->set_flashdata('login_error', 'Invalid Username or Password');
					redirect(base_url('login.html'));
				}


		}

	}


	public function logout(){

		if($this->session->userdata('id')==''){ 

			redirect(base_url('index.html')); 

		}else{
			$this->session->unset_userdata(array('id','firstname','lastname','email','username'));
			redirect(base_url('login.html'));
		}

	}

	public function profile(){



				$data['page_title'] ='Profile of '.$this->session->userdata('firstname').'  - The Dating Corner &ndash; Find your match now!';
				$data['profile'] = R::load('members',$this->session->userdata('id'));	



				$data['css'] = array(
					base_url('assets/css/bootstrap.min.css'),
					base_url('assets/css/custom.css'),
					base_url('assets/css/main.css'),
					base_url('assets/css/datepicker.css'),
					base_url('assets/css/font-awesome-4.6.1/css/font-awesome.min.css')
					);

				$data['js']=array(
					base_url('assets/js/jquery.min.js'),
					base_url('assets/js/bootstrap.min.js'),
					base_url('assets/js/scrolling-nav.js'),
					base_url('assets/js/jquery.easing.min.js'),
					base_url('assets/js/modernizr-2.6.2-respond-1.1.0.min.js'),
					base_url('assets/js/datepicker.js'),
					base_url('assets/js/datingcorner.js')
					);

				$this->load->view('tpl/header-default',$data);
				$this->load->view('tpl/navbar',$data);
				$this->load->view('profile',$data);
				$this->load->view('tpl/footer',$data);

	}

	public function register(){

		

		$this->form_validation->set_rules('firstname','Firstname','trim|required|min_length[2]|max_length[40]');
		$this->form_validation->set_rules('lastname','Lastname','trim|required|min_length[2]|max_length[40]');
		$this->form_validation->set_rules('gender','Gender','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
		$this->form_validation->set_rules('re_password','Verify Password','trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email|is_unique[members.email]');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('bdate', 'Birthdate', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[15]|min_length[6]|alpha_dash|is_unique[members.username]');

		$this->form_validation->set_error_delimiters("<p style='color:yellow;'>","</p>");

		if($this->form_validation->run()==FALSE){

			$data['page_title'] = 'Register - The Dating Corner &ndash; Find your match now!';

			$data['css'] = array(
				base_url('assets/css/bootstrap.min.css'),
				base_url('assets/css/custom.css'),
				base_url('assets/css/main.css'),
				base_url('assets/css/datepicker.css'),
				base_url('assets/css/font-awesome-4.6.1/css/font-awesome.min.css')
				);

			$data['js']=array(
				base_url('assets/js/jquery.min.js'),
				base_url('assets/js/bootstrap.min.js'),
				base_url('assets/js/scrolling-nav.js'),
				base_url('assets/js/jquery.easing.min.js'),
				base_url('assets/js/modernizr-2.6.2-respond-1.1.0.min.js'),
				base_url('assets/js/moment.js'),
				base_url('assets/js/datepicker.js'),
				base_url('assets/js/datingcorner.js')
				);

			$this->load->view('tpl/header-default',$data);
			$this->load->view('tpl/navbar',$data);
			$this->load->view('register',$data);
			$this->load->view('tpl/footer',$data);

		}else{

			$reg = R::dispense('members');
			
			$reg->firstname = 		$this->input->post('firstname',TRUE);
			$reg->lastname = 		$this->input->post('lastname',TRUE);
			$reg->gender=			$this->input->post('gender',TRUE);
			$reg->country=			$this->input->post('country',TRUE);
			$reg->email=			$this->input->post('email',TRUE);
			$reg->password = 		password_hash($this->input->post('re_password',TRUE),PASSWORD_BCRYPT);	
			$reg->reg_ip =			$this->input->ip_address();
			$reg->display_photo = 	$this->input->post('gender',TRUE)=='male' ? base_url('/assets/profile/male-def.jpg') : base_url('/assets/profile/female-def.jpg');
			$reg->birthdate		= 	$this->input->post('bdate',TRUE);
			$reg->username 		=	$this->input->post('username',TRUE);
			$last_id = 				R::store($reg);

				if(is_int($last_id)){

					 $update_member = R::load('members',$last_id);
					 $update_member->member_id = $last_id;
					 $status = R::store($update_member);
					$this->session->set_flashdata('register-success','Registration Success');
					redirect(base_url('register.html'));
				}

		}

	}


	public function search_person(){

		$data['page_title'] = 'Search  Result - The Dating Corner &ndash; Find your match now!';
		$data['css'] = array(
			base_url('assets/css/bootstrap.min.css'),
			base_url('assets/css/custom.css'),
			base_url('assets/css/main.css'),
			base_url('assets/css/font-awesome-4.6.1/css/font-awesome.min.css'),
			);

		$data['js']=array(
			base_url('assets/js/jquery.min.js'),
			base_url('assets/js/bootstrap.min.js'),
			base_url('assets/js/scrolling-nav.js'),
			base_url('assets/js/jquery.easing.min.js'),
			base_url('assets/js/modernizr-2.6.2-respond-1.1.0.min.js'),
			base_url('assets/js/datingcorner.js')
			);

		$search_result = R::find('members',' firstname LIKE :fname ',
		  array(':fname' => '%' . $this->input->get('search') . '%' )
		);

		$this->load->library('paginator');

		$this->paginator->set_config(10,'p');

		$searchresult_count = $this->paginator->set_total(sizeof($search_result));

		$data['search_res'] = R::find('members','firstname LIKE :fname '.$this->paginator->get_limit(),
			array(
				':fname' => '%' . $this->input->get('search') . '%'
				
			));


		$data['page_links'] = $this->paginator->page_links('?','&search='.$this->input->get('search'));
		$this->load->view('tpl/header-default',$data);
		$this->load->view('tpl/navbar',$data);
		$this->load->view('searchperson',$data);
		$this->load->view('tpl/footer',$data);

	}

	public function update_profile(){

		if($_POST && $this->input->is_ajax_request()===FALSE){

			   	$update_profile = R::load('members',$this->session->userdata('id'));
			   	
                $update_profile->firstname = 	$this->input->post('firstname',TRUE);
                $update_profile->lastname = 	$this->input->post('lastname',TRUE);
                $update_profile->email = 		$this->input->post('email',TRUE);
                $update_profile->birthdate 	= 	$this->input->post('bdate',TRUE);
                $update_profile->gender =		$this->input->post('gender',TRUE);

                $status = R::store($update_profile);

                if(is_int($status)){
                	$this->session->set_flashdata('update-profile-ok', 'Profile Successfully Updated');
                	redirect(base_url('profile.html'));
                }

		}else{
			redirect(base_url('profile.html'));
		}
	}

	public function update_profile_photo(){

		if($_FILES){

			$config['upload_path']          = 'assets/profile/';
            $config['allowed_types']        = 'jpg|png|bmp';
            $config['max_size']             = 2048;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['encrypt_name']			= TRUE;


            $this->load->library('upload', $config);
            

            if (!$this->upload->do_upload('dphoto')){

                $error = array('error' => $this->upload->display_errors());
                redirect(base_url('profile.html'));

            }
            else{

                 $data = array('upload_data' => $this->upload->data());
                 $update_profile = R::load('members',$this->session->userdata('id'));
                 $update_profile->display_photo = base_url('assets/profile').'/'. $data['upload_data']['file_name'];

                $status = R::store($update_profile);

	             if(is_int($status)){
	                	$this->session->set_flashdata('update-profile-ok', 'Profile Photo Successfully Updated');
	                	redirect(base_url('profile.html'));
	             }

                }
		}else{
				redirect(base_url('profile.html'));
		}

	}


	public function viewprofile($profile_name){


		$data['page_title'] = 'Profile of @'.$profile_name.' - The Dating Corner &ndash; Find your match now!';

		$data['css'] = array(
			base_url('assets/css/bootstrap.min.css'),
			base_url('assets/css/custom.css'),
			base_url('assets/css/main.css'),
			base_url('assets/css/font-awesome-4.6.1/css/font-awesome.min.css'),
			);

		$data['js']=array(
			base_url('assets/js/jquery.min.js'),
			base_url('assets/js/bootstrap.min.js'),
			base_url('assets/js/scrolling-nav.js'),
			base_url('assets/js/jquery.easing.min.js'),
			base_url('assets/js/modernizr-2.6.2-respond-1.1.0.min.js'),
			base_url('assets/js/datingcorner.js')
			);

		$this->load->view('tpl/header-default',$data);
		$this->load->view('tpl/navbar',$data);
		$this->load->view('viewprofile',$data);
		$this->load->view('tpl/footer',$data);

	}

}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */