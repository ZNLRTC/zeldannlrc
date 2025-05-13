<?php

	

	class Logout extends Controller {

		

		public function index() {

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

			$session->delete('user_session');

			}

			$data ['html_title'] ='Logout | Zeldan Nordic Language Review & Training Center';

			$data['page'] = $this->loginModel->getPageText();

            $data ['html_head'] =$this->Model->getViewHtml( 'logout/head_logout',$data);

			$data ['html_body'] =$this->Model->getViewHtml( 'logout/body_logout',$data);

			$data ['html_footer'] =$this->Model->getViewHtml( 'logout/footer_logout',$data);

			$this->loadView('template/main_html',$data);

		}

		



		



		

	}

	

		

?>

