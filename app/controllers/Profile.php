<?php

	

	class Profile extends Controller {

		public function index() {

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$messages = $this->chatMessagesModel->admin_get_chats($user_session);
				if($messages){
					$count_msgs = count($messages);
					$messages_unseen_count = $this->chatMessagesModel->count_unseen_chats($user_session);
					$message = $messages[$count_msgs - 1];
				}else{
					$count_msgs = null;
					$messages_unseen_count = 0;
					$message = null;
				}

				$data['count_unseen'] = $messages_unseen_count;
				$data['batch'] = $user_info['batch'];

				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data ['html_head'] =$this->Model->getViewHtml( 'error-page/head_html',$data);
				$data ['html_body'] =$this->Model->getViewHtml( 'error-page/body_html',$data);
				$data ['html_footer'] =$this->Model->getViewHtml( 'error-page/footer_error',$data);
				$this->loadView('template/main_html',$data);

			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');
			}

		}



		public function out() {

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$redirect = $session->redirectTo(BASE_URL.'profile/dashboard');

		}else{

			$data ['html_title'] ='Logout | Zenldan Nordic Language Review & Training Center';

			$data['page'] = $this->logoutModel->getPageText();

            $data ['html_head'] =$this->Model->getViewHtml( 'logout/head_logout',$data);

			$data ['html_body'] =$this->Model->getViewHtml( 'logout/body_logout',$data);

			$data ['html_footer'] =$this->Model->getViewHtml( 'logout/footer_logout',$data);

			$this->loadView('template/main_html',$data);

		}

		}



		public function dashboard() {

			require_once('./classes/session.php');

			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$is_staff = $this->profileModel->ifStaff();
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$document_types = $this->documentTypeModel->getDocumentTypes();
				$user_documents = [];
				$faq_parents = $this->faqsModel->get_all_faqs_parent();
				$convos = $this->chatMessagesModel->get_all_conversation_of_user($user_session);
				$testimonial = $this->adminModel->get_latest_testimonial();
				$blog = $this->blogsModel->get_latest_blog();

				// echo '<pre>';
				// print_r($blogs);
				// exit;
				
				$convo_active_count = 0;
				for($i = 0; $i < count($convos); $i++){
					if($convos[$i]['status'] == 'active'){
						$convo_active_count++;
					}
				}

				foreach($faq_parents as $key => $fp){
					$sub_faqs = $this->faqsModel->get_all_sub_faqs($fp['id']);
					$faq_parents[$key]['sub_faq'] = $sub_faqs;
				}

				foreach($document_types as $type){
					$document = $this->userDocumentsModel->get_user_document($user_session, $type['id']);
					$document['description'] = $type['description'];

					if($document){
						$user_documents[$type['typename']] = $document;
					}else{
						$user_documents[$type['typename']] = NULL;
					}
					
				}
				

				if($is_staff == 1){
					$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
					$data['user'] = $this->profileModel->getProfile();
					$data['user_documents'] = $user_documents;
					$data['batch'] = $user_info[0]['batch'];
					$data['faqs'] = $faq_parents;
					$data['convo_active_count'] = $convo_active_count;
					$data['testimony'] = $testimonial;
					$data['blog'] = $blog;

					// echo '<pre>';
					// print_r($data);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/head_html',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/body_html',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/footer_profile',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'admin/dashboard');
				}
			}else{
				// load view
				$redirect = $session->redirectTo(BASE_URL.'login');
			}
		}

		public function messages() {

			require_once('./classes/session.php');

			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$is_staff = $this->profileModel->ifStaff();
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$is_seen_true = $this->chatMessagesModel->is_seen_true_trainee($user_session);
				$keywords = $this->faqsModel->get_all_keywords();
				$convos = $this->chatMessagesModel->get_all_conversation_of_user($user_session);
				
				$convo_active_count = 0;
				for($i = 0; $i < count($convos); $i++){
					if($convos[$i]['status'] == 'active'){
						$convo_active_count++;
					}
				}

				if($is_staff == 1){
					$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
					$data['user'] = $this->profileModel->getProfile();
					$data['batch'] = $user_info[0]['batch'];
					$data['keywords'] = $keywords;
					$data['conversation_history'] = $convos;
					$data['convo_active_count'] = $convo_active_count;

					// echo '<pre>';
					// print_r($data);
					// exit;

					
					$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/head_html',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/body_messages',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/footer_profile',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'admin/dashboard');
				}
			}else{
				// load view
				$redirect = $session->redirectTo(BASE_URL.'login');
			}
		}

		public function messages_faqs() {

			require_once('./classes/session.php');

			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$is_staff = $this->profileModel->ifStaff();
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$is_seen_true = $this->chatMessagesModel->is_seen_true_trainee($user_session);
				$faq_parents = $this->faqsModel->get_all_faqs_parent();
				$convos = $this->chatMessagesModel->get_all_conversation_of_user($user_session);
				
				$convo_active_count = 0;
				for($i = 0; $i < count($convos); $i++){
					if($convos[$i]['status'] == 'active'){
						$convo_active_count++;
					}
				}
				
				foreach($faq_parents as $key => $fp){
					$sub_faqs = $this->faqsModel->get_all_sub_faqs($fp['id']);
					$faq_parents[$key]['sub_faq'] = $sub_faqs;
				}


				if($is_staff == 1){
					$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
					$data['user'] = $this->profileModel->getProfile();
					$data['batch'] = $user_info[0]['batch'];
					$data['faq_parents'] = $faq_parents;
					$data['convo_active_count'] = $convo_active_count;
					// echo '<pre>';
					// print_r($faq_parents);
					// exit;

					
					$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/head_html',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/messages-faqs/body_messages_faqs', $data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/footer_profile',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'admin/dashboard');
				}
			}else{
				// load view
				$redirect = $session->redirectTo(BASE_URL.'login');
			}
		}

		public function conversation() {

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			
			if(!$_GET['ticket']){
				$redirect = $session->redirectTo(BASE_URL.'profile/messages');
			}

			if($session->exists('user_session')){
				$ticket = $_GET['ticket'];
				$is_staff = $this->profileModel->ifStaff();
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$is_seen_true = $this->chatMessagesModel->is_seen_true_trainee($user_session);

				$convo_data = $this->chatMessagesModel->get_one_conversation_by_where(['ticket', $ticket]);
				$convo_chats = $this->chatMessagesModel->get_all_chats_by_where(['conversation_id', $convo_data['id']]);
				$convo_data['chats'] = $convo_chats;

				//count active messages
				$convos = $this->chatMessagesModel->get_all_conversation_of_user($user_session);
				$convo_active_count = 0;
				for($i = 0; $i < count($convos); $i++){
					if($convos[$i]['status'] == 'active'){
						$convo_active_count++;
					}
				}

				if($is_staff == 1){
					$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
					$data['user'] = $this->profileModel->getProfile();
					$data['batch'] = $user_info[0]['batch'];
					$data['chats'] = $convo_data;
					$data['convo_active_count'] = $convo_active_count;
					// echo '<pre>';
					// print_r($data);
					// exit;
					
					$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/conversation/header_conversation',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/conversation/body_conversation',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/conversation/footer_conversation',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'admin/dashboard');
				}
			}else{
				// load view
				$redirect = $session->redirectTo(BASE_URL.'login');
			}
		}

		public function changePassword(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['userChangePass'] = $this->profileModel->userChangePass();
				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo('login');	
			}

		}



		public function view(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$spouse_info = $this->profileModel->get_spouse_info($user_session);
				$children_info = $this->profileModel->get_children_info($user_session);
				$batches = $this->batchModel->get_all_batches();
				$convos = $this->chatMessagesModel->get_all_conversation_of_user($user_session);
				
				$convo_active_count = 0;
				for($i = 0; $i < count($convos); $i++){
					if($convos[$i]['status'] == 'active'){
						$convo_active_count++;
					}
				}


				$data['batch'] = $user_info[0]['batch'];
				$data['batches'] = $batches;
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['userExp'] = $this->profileModel->getUserExp();
				$data['user'] = $this->profileModel->getProfile();
				$data['user']['spouse'] = $spouse_info;
				$data['user']['children'] = $children_info;
				$data['convo_active_count'] = $convo_active_count;

				// echo '<pre>';
				// print_r($data);
				// exit;

				$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/head_html',$data);
				$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/body_view',$data);
				$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/footer_profile',$data);
				$this->loadView('template/main_html',$data);

			}else{
				// load view
				$redirect = $session->redirectTo(BASE_URL.'login');
			}
		}

		public function update_info(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$update = $this->profileModel->update_personal_data();
			
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['data'] = $update;

				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function update_spouse(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$update = $this->profileModel->update_spouse();
				if($_POST['action'] == 0) $delete = $this->profileModel->delete_spouse($user_session);
			
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['data'] = $update;

				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function update_child(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$update = $this->profileModel->update_child();
				$data['data'] = $update;

				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function delete_child(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$update = $this->profileModel->delete_child();
				$data['data'] = $update;

				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function update(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['user'] = $this->profileModel->updateProf();
				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}


		public function avatar(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$convos = $this->chatMessagesModel->get_all_conversation_of_user($user_session);
				
				$convo_active_count = 0;
				for($i = 0; $i < count($convos); $i++){
					if($convos[$i]['status'] == 'active'){
						$convo_active_count++;
					}
				}

				$data['convo_active_count'] = $convo_active_count;
				$data['batch'] = $user_info[0]['batch'];
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['user'] = $this->profileModel->getProfile();
				$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/head_html',$data);
				$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/body_avatar',$data);
				$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/footer_profile',$data);
				$this->loadView('template/main_html',$data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');
			}
		}



		public function avatar_update(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['user'] = $this->profileModel->updateAvatar();
				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo('login');	
			}

		}



		public function filemanager(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){

				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$document_types = $this->documentTypeModel->getDocumentTypes();
				$user_documents = [];
				$priority_checker = $this->priorityUserDocumentsToLinkModel->get_prio_by_email($user_info[0]['email']);
				$doc_complete_checker = $this->priorityUserDocumentsToLinkModel->get_doc_complete_by_email($user_info[0]['email']);

				foreach($document_types as $type){
					$document = $this->userDocumentsModel->get_user_document($user_session, $type['id']);
					$document['description'] = $type['description'];
					$document['doc_id'] = $type['id'];

					if($document){
						$user_documents[$type['typename']] = $document;
					}else{
						$user_documents[$type['typename']] = NULL;
					}
					
				}

				$convos = $this->chatMessagesModel->get_all_conversation_of_user($user_session);
				
				$convo_active_count = 0;
				for($i = 0; $i < count($convos); $i++){
					if($convos[$i]['status'] == 'active'){
						$convo_active_count++;
					}
				}

				$data['batch'] = $user_info[0]['batch'];
				$data['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['user'] = $this->profileModel->getProfile();
				$data['document'] = $this->profileModel->getDocuments();
				$data['medCert'] = $this->profileModel->getMedical();
				$data['user_documents'] = $user_documents;
				$data['convo_active_count'] = $convo_active_count;
				$data['prio_checker'] = $priority_checker;
				$data['doc_complete_checker'] = $doc_complete_checker;
				// echo '<pre>';
				// print_r($data);
				// exit;

			$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/head_html',$data);
			$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/body_filemanager',$data);
			$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/footer_profile',$data);
			$this->loadView('template/main_html',$data);

			}else{

			// load view

			$redirect = $session->redirectTo(BASE_URL.'login');

			}

		}

		public function add(){



			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){

				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['user'] = $this->profileModel->getProfile();
				$data ['html_head'] =$this->Model->getViewHtml( 'applicant-profile/head_html',$data);
				$data ['html_body'] =$this->Model->getViewHtml( 'applicant-profile/upload_documents',$data);
				$data ['html_footer'] =$this->Model->getViewHtml( 'applicant-profile/footer_profile',$data);
				$this->loadView('template/main_html',$data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');
			}
		}





		public function upload(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user_info = $this->profileModel->get_user_info($user_session);
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['upload'] = $this->profileModel->uploadFile();
				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo('login');	
			}

		}

		public function uploadavatar(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['uploadavatar'] = $this->profileModel->uploadavatars();
				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo('login');	
			}
		}



		public function deleteDocs(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');

				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';

				$data['delDocs'] = $this->profileModel->deleteDocuments();




			echo json_encode($data);

			}else{

				$redirect = $session->redirectTo('login');	

			}

		}

		public function request_to_delete(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$id = $_POST['document-id'];
				$message = $_POST['request-removal-reason'];

				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['request'] = $this->userDocumentsModel->request_delete_document($id, $message);

				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo('login');	
			}
		}

		public function request_doc(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$data ['html_title'] ='Profile | Zenldan Nordic Language Review & Training Center';
				$data['request'] = $this->profileModel->requestDocuments();

			echo json_encode($data);
			}else{
				$redirect = $session->redirectTo('login');	
			}
		}
		



		public function viewDocument(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

		ob_clean();

			flush();

			if($session->exists('user_session')){

	

					$folder = BASE_URL.'assets/documents';

				$filename = $_POST['file-name'];

				

				if($folder. '/' . $filename){

				   

					// Header content type

					header('Content-type: application/pdf');

									

					header('Content-Disposition: inline; filename="' . $filename . '"');



					header('Content-Transfer-Encoding: binary');



					header('Accept-Ranges: bytes');



					// Read the file

					@readfile($folder.'/'.$filename);

				}



			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}

		}

		

		public function downloadDocumets(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				

				$folder2 = BASE_URL.'assets/documents';

				$filename2 = $_POST['file-name'];

				if($folder2. '/' . $filename2){

					//Define header information

					header('Content-Description: File Transfer');

					header('Content-Type: application/octet-stream');

					header('Content-Disposition: attachment; filename="'. $filename2.'"');

					header('Content-Length: ' . filesize($folder2. '/' . $filename2));

					header('Pragma: public');



					//Clear system output buffer

					flush();



					//Read the size of the file

					readfile($folder2. '/' . $filename2,true);



					//Terminate from the script

					die();

				}

				

				



			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}

		}

		public function znlrcInfoRequestUpdate(){
			$user_id = $_POST['user-id'];
			$message = $_POST['znlrc-request-update-info'];

			$insert = $this->znlrcRequestsModel->save_request($user_id, $message);

			if($insert){
				$response['status'] = 'success';
				$response['id'] = $insert;
			}else{
				$response['status'] = 'error';
				$response['id'] = null;
			}
			
			echo json_encode($response);
		}

		public function upload_documents(){
			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["document-file"])) {
				if ($_FILES["document-file"]["error"] == UPLOAD_ERR_OK) {
					$file_name = $_FILES["document-file"]["name"];
					$file_tmp = $_FILES["document-file"]["tmp_name"];
					$file_size_kb = $_FILES["document-file"]["size"] / 1024;
					$file_type = $_POST['document-type'];
					$user_id = $_POST['user-id'];
					$user_name = $_POST['user-name'];
					$upload_directory = "assets/documents/";
					
					// Check if the upload directory exists, if not create it
					if (!file_exists($upload_directory)) {
						mkdir($upload_directory, 0777, true);
					}

					$new_file_name = $user_name . '_' . $file_type . '_' .date('mdY').'.pdf';
					
					// Check if the uploaded file is a PDF
					$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
					if (strtolower($file_extension) == 'pdf') {
						if (move_uploaded_file($file_tmp, $upload_directory . $new_file_name)) {

							$user_doc = $this->userDocumentsModel->add_document($user_id, $file_type, $new_file_name, $file_size_kb);

							$response['status'] = 'success';
							$response['message'] = 'Success';
						} else {
							$response['status'] = 'error';
							$response['message'] = 'An error occurred. Please contact IT administrator';
						}
					} else {
						$response['status'] = 'error';
						$response['message'] = 'Only PDF files are allowed';
					}
				} else {
					$response['status'] = 'error';
					$response['message'] = "Error: " . $_FILES["document-file"]["error"];
				}
			} else {
				$response['status'] = 'error';
				$response['message'] = "Invalid request!";
			}
			
			$response = json_encode($response);
			$response = trim($response);
			header('Content-Type: application/json');
			echo $response;
		}

		public function delete_document(){

			$data = $this->userDocumentsModel->get_document_info($_POST['id']);
			$documents = $this->userDocumentsModel->get_all_document_by_type($data['document_type_id'], $data['user_id']);
			
			foreach($documents as $doc){
				$this->userDocumentsModel->delete_document($doc['id']);
			}

			$response['status'] = 'success';
			echo json_encode($response);

		}

		public function save_chat_message(){
			date_default_timezone_set('Asia/Manila');
			$row = array(
				'chat_from' => $_POST['chat_from'],
				'chat_to' => $_POST['chat_to'],
				'message' => $_POST['message'],
				'is_seen' => 0,
				'conversation_id' => $_POST['convo_id'],
				'date_created' => date('Y-m-d H:i:s')
			);
	
			$id = $this->chatMessagesModel->add('chat_messages', $row );
			$data = $this->chatMessagesModel->get_chat_information($id);
	
			if($data){
				$response['status'] = 'success';
				$response['data'] = $data;
			}else{
				$response['status'] = 'error';
				$response['data'] = null;
			}
	
			echo json_encode($response);
		}

		public function get_batch_number_by_id(){
			$id = $_POST['id'];
			$batch_nums = $this->batchModel->get_all_batch_number_by_batch_id($id);
			
			if($batch_nums){
				$response['status'] = 'success';
				$response['data'] = $batch_nums;
			}else{
				$response['status'] = 'error';
				$response['data'] = null;
			}

			echo json_encode($response);
		}

		public function start_conversation(){
			date_default_timezone_set('Asia/Manila');
			$tag = $_POST['tag'];
			$dept = $_POST['dept_id'];
			$user = $_POST['user_id'];
			$ticket = $user .''. date('ymdhis');

			
			$check_ticket = $this->chatMessagesModel->get_one_conversation_by_where(['ticket', $ticket]); //Avoid ticket duplication
			if(empty($check_ticket)){
				$row = array(
					'ticket' => $ticket,
					'status' => 'active',
					'department' => $dept,
					'tag' => $tag
				);

				$convo = $this->chatMessagesModel->add('chat_conversation', $row);
				if($tag != 'Others'){
					$tag_message = 'How can we help you with regards to your '.$tag.'?';
				}else{
					$tag_message = 'How can we help you?';
				}
				

				if($convo){
					$row_chat_messages = array(
						'chat_from' => 1,
						'chat_to' => $user,
						'message' => $tag_message,
						'is_seen' => 0,
						'conversation_id' => $convo,
						'date_created' => date('Y-m-d H:i:s')
					);

					$chat = $this->chatMessagesModel->add('chat_messages', $row_chat_messages);
					$log_conversation = $this->chatMessagesModel->add_conversation_log([
						'conversation_id' => $convo, 
						'status' => 'active',
						'updated_by' => $user
					]);

					if($chat){
						$response['status'] = 'success';
						$response['url'] = BASE_URL . 'profile/conversation?ticket=' . $ticket;
					}else{
						$response['status'] = 'error';
					}
				}else{
					$response['status'] = 'error';
				}
			}else{
				$response['status'] = 'success';
				$response['url'] = BASE_URL . 'profile/conversation?ticket=' . $ticket;
			}
			
			echo json_encode($response);
		}

		public function delete_document_from_storage(){
			$id = $_POST['id'];
			$data = $this->profileModel->get_document_data($id);
			//$dir = $_SERVER['DOCUMENT_ROOT'] . '/zeldannlrc/assets/documents/' . $data['path'];
			$dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/documents/' . $data['path']; //pang live server, code sa taas kapag sa localhost
		
			if (file_exists($dir)) {
				unlink($dir);
				$response['status'] = 'success';
			} else {
				$response['status'] = 'error';
				$response['message'] = 'File does not exist';
				$response['path'] = $dir;
			}
		
			echo json_encode($response);
			
		}

		public function prioritizeLinkDocs(){
			$email = $_POST['email'];
			$id = $this->priorityUserDocumentsToLinkModel->save_prio($email);
			if($id){
				$response['status'] = 'success';
			}else{
				$response['status'] = 'error';
			}

			echo json_encode($response);
		}

		public function documentCompletedBtn(){
			$email = $_POST['email'];
			$id = $this->priorityUserDocumentsToLinkModel->save_complete_doc($email);
			if($id){
				$response['status'] = 'success';
			}else{
				$response['status'] = 'error';
			}

			echo json_encode($response);
		}

	}

?>

