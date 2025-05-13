<?php

	

	class Login extends Controller {

		

		public function index() {
			
			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$is_staff = $this->profileModel->ifStaff();

				$user_session = $session->get('user_session');
				if($is_staff == 1){
					$redirect = $session->redirectTo(BASE_URL.'admin/dashboard');	
				}else{
					$redirect = $session->redirectTo(BASE_URL.'profile/dashboard');
				}
			}else{
				$data ['html_title'] ='Login | Zeldan Nordic Language Review & Training Center';
				$data['page'] = $this->loginModel->getPageText();
				$data ['html_head'] =$this->Model->getViewHtml( 'login/head_html',$data);
				$data ['html_body'] =$this->Model->getViewHtml( 'login/body_html',$data);
				$data ['html_footer'] =$this->Model->getViewHtml( 'login/footer_login',$data);
				$this->loadView('template/main_html',$data);
			}
		}

		public function userLogin(){
			$username = $_POST['email'];
			$password = $_POST['password'];

			if($username != 'it_administrator'){
				if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
					$data['page'] = $this->loginModel->loginUser($username,$password);
				} else {
					$data['page'] = $this->loginModel->loginUser(1,1);
				}
			}else{
				$data['page'] = $this->loginModel->loginUser($username,$password);
			}
		}

		public function validating(){
			$data ['html_title'] ='Error | Zeldan Nordic Language Review & Training Center';
			$data['page'] = $this->loginModel->getPageText();
            $data ['html_head'] =$this->Model->getViewHtml( 'login/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'login/validating',$data);
			$this->loadView('template/main_html',$data);
		}

		public function disapproved(){

			$data ['html_title'] ='Error | Zeldan Nordic Language Review & Training Center';
			$data['page'] = $this->loginModel->getPageText();
            $data ['html_head'] =$this->Model->getViewHtml( 'login/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'login/disapproved',$data);
			$this->loadView('template/main_html',$data);
		}

		public function employee_suspended(){

			$email = $_GET['email'] ?? null;
			$data['email'] = $email;

			// echo '<pre>';
			// print_r($email);
			// exit;

			$data ['html_title'] ='Suspended | Zeldan Nordic Language Review & Training Center';
			$data['page'] = $this->loginModel->getPageText();
            $data ['html_head'] =$this->Model->getViewHtml( 'login/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'login/employee_suspended',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'login/footer_login',$data);
			$this->loadView('template/main_html',$data);
		}

		public function validate_user_email(){
			$email = $_POST['fp-email'];
			$validate = $this->loginModel->validate_user_email($email);

			if($validate == '0'){
				$response['status'] = 'invalid-email';
			}else{
				$response['status'] = 'success';
				$response['data'] = $validate;
			}

			echo json_encode($response);
		}

		public function generate_password(){
			$email = $_GET['email'];
			$user = $this->loginModel->get_user_info($email);

			if(!$user){
				echo 'User does not exist';
				exit;
			}else{
				$date_hash =  urlencode(sha1((string) $user['updated_at']));
				$link = BASE_URL . "resetpassword?email=" . $user['email'] . '&token=' . $date_hash;
				echo $link;
				exit;
			}
		}

		public function save_system_request_access(){
			date_default_timezone_set('Asia/Manila');

			$email = $_POST['email'];
			$from = $_POST['from'];
			$to = $_POST['to'];
			$purpose = $_POST['purpose'];

			$user = $this->profileModel->get_user_info_by_email($email);

			$row = array(
				'user_id' => $user[0]['id'],
				'date' => date('Y-m-d'),
				'access_from' => $from,
				'access_to' => $to,
				'purpose' => $purpose
			);

			$data = $this->requestAccessModel->add($row);

			$response['status'] = 'success';
			$response['message'] = 'Request has been sent!';
			$response['data'] = $data;

			echo json_encode($response);
		}

		public function approve_access_requests(){
			date_default_timezone_set('Asia/Manila');
			$time = date('H:i').':00';
			$requests = $this->requestAccessModel->get_all_approved_from(date('Y-m-d'), $time);

			foreach($requests as $r){
				$this->profileModel->approve_employee_status($r['user_id']);
			}
		}

		public function suspend_access_requests(){
			date_default_timezone_set('Asia/Manila');
			$time = date('H:i').':00';
			$requests = $this->requestAccessModel->get_all_approved_to(date('Y-m-d'), $time);

			foreach($requests as $r){
				$this->profileModel->suspend_employee_status($r['user_id']);
			}
		}

	}

?>

