<?php

	class Resetpassword extends Controller {
        public function index() {
            $email = $_GET['email'];
            $token = $_GET['token'];
            $user = $this->loginModel->get_user_info($email);

            if(!$user || sha1((string) $user['updated_at']) != $token){
                header('Location: errors/tokenExpired');
                exit();
            }

            $data['user'] = $user;
            $data ['html_title'] ='Reset Password | Zeldan Nordic Language Training & Training Center';
            $data ['html_head'] =$this->Model->getViewHtml( 'reset_password/head_html', $data);
            $data ['html_body'] =$this->Model->getViewHtml( 'reset_password/body_html', $data);
            $data ['html_footer'] =$this->Model->getViewHtml( 'reset_password/footer_html', $data);
            $this->loadView('template/main_html', $data);
		}

        public function change_password(){
            $input = $_POST;

            if($input['reset-password'] != $input['confirm-reset-password']){
                $response['status'] = 'input-match-error';
                echo json_encode($response);
                exit();
            }else{
                $email = $input['email'];
                $password = password_hash($input['reset-password'], PASSWORD_DEFAULT);

                $this->profileModel->user_change_password_from_forgot_password($email, $password);
                $response['status'] = 'success';
                echo json_encode($response);
            }   
        }
    }
    

?>