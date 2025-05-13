<?php

	

	class Maintenance extends Controller {

		

		public function index() {

			require_once('./classes/session.php');

			session_start();



			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');

				$data ['html_title'] ='Maintenance | Zeldan Nordic Language Review & Training Center';

				$data['session'] = $user_session;

				$data ['html_head'] =$this->Model->getViewHtml( 'maintenance/head_html',$data);

			$data ['html_body'] =$this->Model->getViewHtml( 'maintenance/body_html',$data);

			$data ['html_footer'] =$this->Model->getViewHtml( 'maintenance/footer_html',$data);

				

			$this->loadView('template/main_html',$data);

			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}

				

		}

		



		



		

	}

	

		

?>

