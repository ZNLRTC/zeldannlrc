<?php

	

	class Errors extends Controller {

	

		public function index() {

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');

				$data ['html_title'] ='Profile | Zeldan Nordic Language Review & Trainind Center';

			$data ['html_head'] =$this->Model->getViewHtml( 'error-page/head_html',$data);

			$data ['html_body'] =$this->Model->getViewHtml( 'error-page/body_html',$data);

			$data ['html_footer'] =$this->Model->getViewHtml( 'error-page/footer_error',$data);

			$this->loadView('template/main_html',$data);

			}else{

			// load view

			$redirect = $session->redirectTo(BASE_URL.'login');

			

			}

		}

		public function tokenExpired(){
			$data ['html_title'] ='Link Expired';
			$data ['html_head'] =$this->Model->getViewHtml( 'error-page/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'error-page/body_html',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'error-page/footer_error',$data);
			$this->loadView('template/main_html',$data);
		}

	}

?>

