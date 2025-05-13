<?php

	

	class Guest extends Controller {

	

		public function index() {

			// load view

			$data ['html_title'] ='Zeldan Nordic Language Review Training Center';
			$data ['html_description'] = 'Landing page for Zeldan Nordic Language Review Training Center';
			$data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'guest/index_home',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'guest/footer_guest',$data);
			$this->loadView('template/main_html',$data);

		}

		public function services() {

			$data ['html_title'] ='Services | Zeldan Nordic Language Review Training Center';
			$data ['html_description'] = 'Services offered by Zeldan Nordic Language Review Training Center';
			$data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'guest/index_services',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'guest/footer_guest',$data);
			$this->loadView('template/main_html',$data);

		}

		public function testimonials() {

		$testimonials = $this->adminModel->get_all_testimonials_where('t1.status', 'active');

		$data['testimonials'] = $testimonials;

			$data ['html_title'] ='Testimonials | Zeldan Nordic Language Review Training Center';
			$data ['html_description'] = 'Real student stories by Zeldan Nordic Language Review Training Center';
			$data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'guest/index_testimonials',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'guest/footer_guest',$data);
			$this->loadView('template/main_html',$data);

		}

		public function faqs() {
			$faqs = $this->faqsModel->get_all_faqs();
			$data['faqs'] = $faqs;

			$data ['html_title'] ='Frequently Asked Questions | Zeldan Nordic Language Review Training Center';
			$data ['html_description'] = 'Frequently Asked Questions from Zeldan Nordic Language Review Training Center';
			$data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'guest/index_faqs',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'guest/footer_guest',$data);
			$this->loadView('template/main_html',$data);

		}

		public function about() {
			$data ['html_title'] ='About us | Zeldan Nordic Language Review Training Center';
			$data ['html_description'] = 'Learn more about Zeldan Nordic Language Review Training Center';
			$data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'guest/index_about',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'guest/footer_guest',$data);
			$this->loadView('template/main_html',$data);
		}



		public function register(){


			if(isset($_GET['email'])){
				$email = $_GET['email'];
				$password = $this->guestModel->check_account(trim($email, '"'));

				if($password){
					if($password['password'] != NULL ){
						header('Location: '.BASE_URL.'login');
						exit;
					}
				}
			}else{
				$email = null;
			}

			$data['email'] = trim($email, '"');
			$data['batch_names'] = $this->batchModel->get_all_batches();
			$data['batch_numbers'] = $this->batchModel->get_all_batch_numbers();

			// echo '<pre>';
			// print_r($data);
			// exit;
			

			$data['html_title'] = 'Register | Zeldan Nordic Language Training & Review Center';
			$data ['html_description'] = 'Regitration form for Zeldan Nordic Language Review Training Center';
			$data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'guest/index_register',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'guest/footer_guest',$data);
			$this->loadView('template/main_html',$data);

		}



		public function save_guest(){

			$data['user_insrted'] = $this->guestModel->save_applicants();
			echo json_encode($data);
		}



		public function guest_doneRegister(){
			$data['html_title'] = 'ZNLRC-Success';
			$data ['html_description'] = 'Successfull registration on Zeldan Nordic Language Review Training Center';
			$data ['html_head'] =$this->Model->getViewHtml( 'login/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'guest/finishedRegistration_html',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'login/footer_login',$data);

			$this->loadView('template/main_html',$data);

		}

	}

?>