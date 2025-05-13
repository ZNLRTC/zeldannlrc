<?php

	class Admin extends Controller {

		public function dashboard() {
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);

				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'admin/blogs');

				if($user['is_staff'] == 1){
					
					$documents = $this->adminModel->getDocumentRequests();
					$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['countStaff'] = $this->adminModel->countEmployee();
					$data['countAppli'] = $this->adminModel->countApprovedApli();
					$data['countActiveAppli'] = $this->adminModel->countApprovedActiveApli();
					$data['countDeployedAppli'] = $this->adminModel->countApprovedDeployedApli();
					$data['countDeployedUpcoming'] = $this->adminModel->countDeployedUpcoming();
					$data['countInactiveAppli'] = $this->adminModel->countApprovedInactiveApli();
					$data['countOnholdAppli'] = $this->adminModel->countApprovedOnholdApli();
					$data['countQuitAppli'] = $this->adminModel->countApprovedQuitApli();
					$data['countPending'] = $this->adminModel->countpendingApli();
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);
					$data['total_count_current_week'] = $this->get_total_transfers_current_week();
					$data['total_count_previous_week'] = $this->get_total_transfers_previous_week();
					
					// echo '<pre>';
					// print_r($data['user']);
					// exit;
					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/dashboard/admin_dashboard',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/dashboard/footer_dashboard',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}



		public function profile(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_profile',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function batch(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();
				$batches = $this->batchModel->get_all_batches();
				$batch_numbers = $this->batchModel->get_all_batch_numbers();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				
				foreach($batch_numbers as $key => $num){
					$active = $this->batchModel->count_trainee_under_batch($num['name'], $num['batch_number'], 'active');
					$inactive = $this->batchModel->count_trainee_under_batch($num['name'], $num['batch_number'], 'inactive');
					$on_hold = $this->batchModel->count_trainee_under_batch($num['name'], $num['batch_number'], 'on-hold');
					$quit = $this->batchModel->count_trainee_under_batch($num['name'], $num['batch_number'], 'quit');
					$deployed = $this->batchModel->count_trainee_under_batch($num['name'], $num['batch_number'], 'deployed');
					$upcoming = $this->batchModel->count_trainee_under_batch($num['name'], $num['batch_number'], 'upcoming');

					$batch_numbers[$key]['trainee_count'] = array(
						count($active) < 10 ? '0' . count($active) : count($active),
						count($inactive) < 10 ? '0' . count($inactive) : count($inactive),
						count($on_hold) < 10 ? '0' . count($on_hold) : count($on_hold),
						count($quit) < 10 ? '0' . count($quit) : count($quit),
						count($deployed) < 10 ? '0' . count($deployed) : count($deployed),
						count($upcoming) < 10 ? '0' . count($upcoming) : count($upcoming),
					); 
				}

				// echo '<pre>';
				// print_r($batch_numbers);
				// exit;

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['batch_names'] = $batches;
					$data['batch_numbers'] = $batch_numbers;
					$data['count_active_tickets'] = count($active_tickets);


					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_batch',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function messages_faqs(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				$documents = $this->adminModel->getDocumentRequests();
				$departments = $this->departmentsModel->get_all_departments();
				$faqs = $this->faqsModel->get_all_faqs();
				$faq_parents = $this->faqsModel->get_all_faqs_parent();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				
				foreach($faq_parents as $key => $fp){
					$sub_faqs = $this->faqsModel->get_all_sub_faqs($fp['id']);
					$faq_parents[$key]['sub_faq'] = $sub_faqs;
				}

				// echo '<pre>';
				// print_r($faq_parents);
				// exit;

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['departments'] = $departments;
					$data['faqs'] = $faqs;
					$data['faq_parents'] = $faq_parents;;
					$data['count_active_tickets'] = count($active_tickets);

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/messages_faqs/header_messages_faqs',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/messages_faqs/body_messages_faqs',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/messages_faqs/footer_messages_faqs',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function messages_faqs_keywords(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				$documents = $this->adminModel->getDocumentRequests();
				$departments = $this->departmentsModel->get_all_departments();
				$keywords = $this->faqsModel->get_all_keywords();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				// echo '<pre>';
				// print_r($keywords);
				// exit;

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['departments'] = $departments;
					$data['keywords'] = $keywords;
					$data['count_active_tickets'] = count($active_tickets);


					$data ['html_head'] =$this->Model->getViewHtml( 'admin/messages_faqs/header_messages_faqs',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/messages_faqs/body_messages_faqs_keywords',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/messages_faqs/footer_messages_faqs',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
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

				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';

				$data['user'] = $this->adminModel->updateprofile();

			echo json_encode($data);

			}else{

				$redirect = $session->redirectTo('login');	

			}

		}


		public function conversation(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			$ticket = $_GET['ticket'];
			$uid = isset($_GET['uid']) ? $_GET['uid'] : null;

			if(!$ticket) $redirect = $session->redirectTo(BASE_URL.'errors');

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				$convo_data = $this->chatMessagesModel->get_one_conversation_by_where(['ticket', $ticket]);
				$convo_chats = $this->chatMessagesModel->get_all_chats_by_where(['conversation_id', $convo_data['id']]);
				if($convo_chats){
					$convo_data['chats'] = $convo_chats;
					$convo_data['trainee'] = $this->adminModel->getEmployeeProfile($convo_chats[0]['chat_to']);
				}else{
					$convo_data['chats'] = [];
					$convo_data['trainee'] = $uid != null ? $this->adminModel->getEmployeeProfile($uid) : [];
				}
				
				//get who opened/closed conversation
				$ticket_history = $this->chatMessagesModel->get_conversation_log_history($ticket);
				$convo_data['transfer_history'] = $this->chatMessagesModel->get_transfer_message_logs_full_details_by_where(['ticket_id', $convo_data['id']]);
				$employees = $this->adminModel->get_all_employees();
				$emp_ids = [];
				foreach($employees as $emp){
					$emp_ids[] = $emp['id'];
				}

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['chats'] = $convo_data;
					$data['ticket_history'] = $ticket_history;
					$data['count_active_tickets'] = count($active_tickets);
					$data['employee_ids'] = $emp_ids;

					// echo '<pre>';
					// print_r($data);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/conversations/body_conversations',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/conversations/footer_conversations',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function messages(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			$uid = $_GET['uid'];

			if(!$uid) $redirect = $session->redirectTo(BASE_URL.'errors');

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();
				$keywords = $this->faqsModel->get_all_keywords();
				$convos = $this->chatMessagesModel->get_all_conversation_of_user($uid);
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active'], ['']);

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['conversation_history'] = $convos;
					$data['trainee_info'] = $this->adminModel->getEmployeeProfile($uid); 
					$data['keywords'] = $keywords;
					$data['count_active_tickets'] = count($active_tickets);	

					// echo '<pre>';
					// print_r($data);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_messages',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function userMessages(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();

				if($user['id'] == 1){
					$message_tickets = $this->chatMessagesModel->get_all_conversations();
				}else{
					$message_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']]);
				}
				
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				foreach($message_tickets as $key => $mt){
					$chats = $this->chatMessagesModel->get_all_chats_by_where(['conversation_id', $mt['id']]);
					if(!$chats){
						$this->chatMessagesModel->delete_conversation_by_ticket($mt['ticket']);
						$message_tickets[$key]['chats'] = [];
						$message_tickets[$key]['trainee_info'] = [];
						$message_tickets[$key]['transfers'] = [];
					}else{
						$t_info = $this->adminModel->getEmployeeProfile($chats[0]['chat_to']);
						$convo = $this->chatMessagesModel->get_one_conversation_by_where(['ticket', $mt['ticket']]);
						$transfer = $this->chatMessagesModel->get_transfer_message_logs_by_where(['ticket_id', $convo['id']]);
						$message_tickets[$key]['chats'] = $chats;
						$message_tickets[$key]['trainee_info'] = $t_info;
						$message_tickets[$key]['transfers'] = $transfer;
						
					}
				}

				$employees = $this->adminModel->get_all_employees();
				$emp_ids = [];
				foreach($employees as $emp){
					$emp_ids[] = $emp['id'];
				}


				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['message_tickets'] = $message_tickets;
					$data['count_active_tickets'] = count($active_tickets);
					$data['employee_ids'] = $emp_ids;
					
					// echo '<pre>';
					// print_r($data);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/userMessages/admin_userMessages',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/userMessages/footer_userMessages',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function employees(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['empType'] = $this->adminModel->empType();
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_employees',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}


		public function departments(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();
				$departments = $this->departmentsModel->get_all_departments();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				
				foreach($departments as $key => $dept){
					$employees = $this->departmentsModel->get_all_employees($dept['id']);
					$departments[$key]['employees'] = $employees;
				}

				

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['empType'] = $this->adminModel->empType();
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['departments'] = $departments;
					$data['count_active_tickets'] = count($active_tickets);

					// echo '<pre>';
					// print_r($departments);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/departments/header_departments',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/departments/admin_departments',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/departments/footer_departments',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function request_access(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				if($user['id'] == 8729) $redirect = $session->redirectTo(BASE_URL.'errors');
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				
			
				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['empType'] = $this->adminModel->empType();
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);
					$data['requests'] = $this->requestAccessModel->get_all_pending();

					// echo '<pre>';
					// print_r($data['requests']);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/request_access/header_request_access',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/request_access/body_request_access',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/request_access/footer_request_access',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function employeeDatatable(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			$user_session = $session->get('user_session');

			$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
			$data['allUsers'] =$this->datatableModel->getEmployees();
			echo $data['allUsers'];

		}

		



	public function create(){

		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		if($session->exists('user_session')){
			if($this->adminModel->is_superuser() == "super"){
				$user_session = $session->get('user_session');
				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
				$data['session'] = $user_session;
				$user = $this->adminModel->getEmployeeProfile($user_session);
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_addEmployees',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'errors');	
			}

		}else{

			$redirect = $session->redirectTo(BASE_URL.'login');	

		}

	}

	public function testimonials() {
		require_once('./classes/session.php');
		session_start();
		$session = new Session();

		$user = $this->adminModel->getEmployeeProfile();
		$testimonials = $this->adminModel->get_all_testimonials_where('t1.status', 'active');
		$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

		$data['user'] = $user;
		$data['testimonials'] = $testimonials;
		$data['count_active_tickets'] = count($active_tickets);

		// echo '<pre>';
		// print_r($data);
		// exit;

		$data ['html_title'] ='Testimonials | Zeldan Nordic Language and Training Center';
		$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
		$data ['html_body'] =$this->Model->getViewHtml( 'admin/index_testimonials',$data);
		$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
		$this->loadView('template/main_html',$data);

	}

	public function blogs() {
		require_once('./classes/session.php');
		session_start();
		$session = new Session();

		$user = $this->adminModel->getEmployeeProfile();
		$blogs = $this->blogsModel->get();
		$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

		$data['user'] = $user;
		$data['blogs'] =$blogs;
		$data['count_active_tickets'] = count($active_tickets);

		// echo '<pre>';
		// print_r($data);
		// exit;

		$data ['html_title'] ='Testimonials | Zeldan Nordic Language and Training Center';
		$data ['html_head'] =$this->Model->getViewHtml( 'admin/blogs/head_blogs',$data);
		$data ['html_body'] =$this->Model->getViewHtml( 'admin/blogs/admin_blogs',$data);
		$data ['html_footer'] =$this->Model->getViewHtml( 'admin/blogs/footer_blogs',$data);
		$this->loadView('template/main_html',$data);

	}



	public function delet_apli(){

		require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$data['delete'] = $this->adminModel->delete_apli();

				echo json_encode($data);

			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}



	}

	public function delete_employee(){

		require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$data['delete'] = $this->adminModel->delete_employees();

				echo json_encode($data);

			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}



	}





	public function saveEmployee(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');

				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';

				$data['user'] = $this->adminModel->insertEmployee();

			echo json_encode($data);

			}else{

				$redirect = $session->redirectTo('login');	

			}

	}



	

	public function suspendUser(){

		require_once('./classes/session.php');
			session_start();
			$session = new Session();
			if($session->exists('user_session')){
				$data['suspend_user'] = $this->adminModel->suspend();
				echo json_encode($data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}

	}

	public function activateUser(){

		require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$data['activate_user'] = $this->adminModel->activate_user();

				echo json_encode($data);

			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}

	}



	public function changepassword(){

		require_once('./classes/session.php');
		session_start();
		$session = new Session();

		if($session->exists('user_session')){
			$user = $this->adminModel->getEmployeeProfile();
			if($user['is_staff'] == 1){
				$user_session = $session->get('user_session');
				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
				$data['session'] = $user_session;
				$data['user'] = $user;
				$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();

				$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
				$data ['html_body'] =$this->Model->getViewHtml( 'admin/change_password',$data);
				$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
				$this->loadView('template/main_html',$data);
			}else{
				$redirect = $session->redirectTo(BASE_URL.'errors');	
			}
		}else{
			$redirect = $session->redirectTo(BASE_URL.'login');	
		}
	}



	public function passwordChange(){

		require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');

				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';

				$data['adminChangepas'] = $this->adminModel->passChange();

			echo json_encode($data);

			}else{

				$redirect = $session->redirectTo('login');	

			}

	}





	public function out() {

		require_once('./classes/session.php');

		session_start();

		$session = new Session();

		if($session->exists('user_session')){

			$redirect = $session->redirectTo(BASE_URL.'admin/dashboard');

	}else{

		$data ['html_title'] ='ZNLRC-Logout';

		$data['page'] = $this->logoutModel->getPageText();

		$data ['html_head'] =$this->Model->getViewHtml( 'logout/head_logout',$data);

		$data ['html_body'] =$this->Model->getViewHtml( 'logout/body_logout',$data);

		$data ['html_footer'] =$this->Model->getViewHtml( 'logout/footer_logout',$data);

		$this->loadView('template/main_html',$data);

	}

	}



		public function applicants(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_applicants',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}

			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}

		}

		public function documentRequests(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				// echo '<pre>';
				// print_r($documents);
				// exit;

				if($user['is_staff'] == 1){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['documents'] = $documents;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_documentRequests',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}

			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}

		}



		public function view_med(){

	require_once('./classes/session.php');

	session_start();

	$session = new Session();

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



	echo json_encode($data);

	}else{

		$redirect = $session->redirectTo('login');	

	}

}

}



public function uploadMedCert(){

	require_once('./classes/session.php');

	session_start();

	$session = new Session();

	if($session->exists('user_session')){

		$user_session = $session->get('user_session');

		$data ['html_title'] ='ZNLRC-Profile';

		$data['upload'] = $this->adminModel->uploadFileMedCert();

		//$redirect = $session->redirectTo('filemanager');	



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
				$user = $this->adminModel->getEmployeePRofile($user_session);
				$user_info = $this->adminModel->viewApplicant();
				$documents = $this->adminModel->getDocumentRequests();
				$batches = $this->batchModel->get_all_batches();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);

				if($user_info['has_spouse'] == 1){
					$trainee_spouse = $this->adminModel->getSpouseInfo($user_info['id']);
				}else{
					$trainee_spouse = 0;
				}

				if($user_info['has_children'] == 1){
					$trainee_children = $this->adminModel->getChildrenInfo($user_info['id']);
				}else{
					$trainee_children = 0;
				}

				$docu_types = $document_types = $this->documentTypeModel->getDocumentTypes();
				$user_documents = [];

				foreach($docu_types as $type){
					$document = $this->userDocumentsModel->get_user_document($user_info['id'], $type['id']);
					$document['description'] = $type['description'];
					$document['document_type_id'] = $type['id'];

					if($document){
						$user_documents[$type['typename']] = $document;
					}else{
						$user_documents[$type['typename']] = NULL;
					}
				}

				foreach($batches as $key => $batch){
					$batch_nums = $this->batchModel->get_all_batch_numbers($batch['id']);
					$batches[$key]['batch_numbers'] = $batch_nums;
				}

				//get status
				$log = $this->applicantFlagStatusModel->get_log_info($user_info['id']);
				$approval_logs = $this->applicantApprovalLogsModel->get_log_info($user_info['id']);
				$batch_history = $this->applicantBatchHistoryModel->get_batch_history($user_info['id']);
				

				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
				$data['session'] = $user_session;
				$data['user'] = $user;
				$data['appli'] = $user_info;
				$data['appli']['spouse'] = $trainee_spouse;
				$data['appli']['children'] = $trainee_children;
				$data['pending_document_request_count'] = count($documents);
				$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
				$data['userDocu'] = $user_documents;

				$data['info_update_requests'] = $this->znlrcRequestsModel->get_user_pending_requests($user_info['id']);
				$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
				$data['count_active_tickets'] = count($active_tickets);

				$data['status_history'] = $log;
				$data['approval_logs'] = $approval_logs;
				$data['batches'] = $batches;
				$data['batch_history'] = $batch_history;

				// echo '<pre>';
				// print_r($user_documents);
				// exit;

				$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
				$data ['html_body'] =$this->Model->getViewHtml( 'admin/applicant_view/admin_viewApplicant',$data);
				$data ['html_footer'] =$this->Model->getViewHtml( 'admin/applicant_view/footer_view_applicant',$data);

			$this->loadView('template/main_html',$data);

			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}

		}

		public function settings(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){

				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile();
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				
				if($user['is_staff'] == 1 ){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_settings',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
				
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}

		}

		public function viewdocument(){
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

		public function infoRequests(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				if($user['is_staff'] == 1 ){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['trainees'] = $this->znlrcRequestsModel->get_all_pending_requests();
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					// echo '<pre>';
					// print_r($data);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_updateInfoRequests',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}

		}

		public function add_trainee(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				$user_session = $session->get('user_session');
				$user = $this->adminModel->getEmployeeProfile($user_session);
				$documents = $this->adminModel->getDocumentRequests();
				$active_tickets = $this->chatMessagesModel->get_all_conversation_by_where(['department', $user['department_id']], ['status', 'active']);
				
				if($user['is_staff'] == 1 ){
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['session'] = $user_session;
					$data['user'] = $user;
					$data['batch_names'] = $this->batchModel->get_all_batches();
					$data['batch_numbers'] = $this->batchModel->get_all_batch_numbers();
					
					$data['pending_document_request_count'] = count($documents);
					$data['info_pending_requests'] = $this->znlrcRequestsModel->count_all_pending_requests();
					$data['count_unread_messages'] = $this->chatMessagesModel->get_unread_messages();
					$data['count_active_tickets'] = count($active_tickets);

					// echo '<pre>';
					// print_r($data);
					// exit;

					$data ['html_head'] =$this->Model->getViewHtml( 'admin/admin_head',$data);
					$data ['html_body'] =$this->Model->getViewHtml( 'admin/admin_addTrainee',$data);
					$data ['html_footer'] =$this->Model->getViewHtml( 'admin/admin_footer',$data);
					$this->loadView('template/main_html',$data);
				}else{
					$redirect = $session->redirectTo(BASE_URL.'errors');	
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}



		public function downloadDocumet(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				

				$folder2 = $_SERVER['DOCUMENT_ROOT'].'/znlrc/assets/documents';

				$filename2 = $_POST['file-name'];

				if(is_file($folder2. '/' . $filename2)){

					if($this->adminModel->empType() == "topmake"){

						echo json_encode(2);

					}else{

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

					

				}

				

				



			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}

		}

		

		public function applicantsDatatable(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			$user_session = $session->get('user_session');

			// echo '<pre>';
			// print_r($_POST);
			// exit;

			$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
			$data['allUsers'] =$this->datatableModel->getApplicants();
			echo $data['allUsers'];
		}

		public function applicantsDatatableApproved(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			$user_session = $session->get('user_session');
			$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
			$data['allUsers'] =$this->datatableModel->getApplicantsApproved();
			echo $data['allUsers'];

		}

		

		public function applicantsDatatabledisapproved(){

			require_once('./classes/session.php');

			session_start();



				$session = new Session();

				$user_session = $session->get('user_session');

				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';

				$data['allUsers'] =$this->datatableModel->getApplicantsdisapproved();

				echo $data['allUsers'];



		}



		public function applicantsDatatablepending(){

			require_once('./classes/session.php');

			session_start();



				$session = new Session();

				$user_session = $session->get('user_session');

				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';

				$data['allUsers'] =$this->datatableModel->getApplicantspending();

				echo $data['allUsers'];



		}



		public function approveApplicant(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();

			if($session->exists('user_session')){
				if($this->adminModel->empType() == "topmake"){
					echo json_encode(2);
				}else{
					$data['approve_applicant'] = $this->adminModel->approveApplicant();
					$data['log'] = $this->applicantApprovalLogsModel->save_log($_POST['userID'], $session->get('user_session'), $_POST['action']);
					echo json_encode($data);
				}

			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}

		public function disapproveApplicant(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				if($this->adminModel->empType() == "topmake"){

					echo json_encode(2);

				}else{

					$data['disapproved_applicant'] = $this->adminModel->disapproveApplicant();
					$data['log'] = $this->applicantApprovalLogsModel->save_log($_POST['userID'], $session->get('user_session'), $_POST['action']);

					echo json_encode($data);

				}

			

			}else{

				$redirect = $session->redirectTo(BASE_URL.'login');	

			}

		}

		public function documentList(){

			require_once('./classes/session.php');

			session_start();

			

			$session = new Session();

			$user_session = $session->get('user_session');

			$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';

			$data['allUsers'] =$this->datatableModel->documentList();

			echo $data['allUsers'];

			

		}

		

	



		public function insertDocuList(){
			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			
			if($session->exists('user_session')){
				if($this->adminModel->empType() == "topmake"){
					echo json_encode(2);
				}else{
					$user_session = $session->get('user_session');
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['inserted'] = $this->adminModel->insertDocuLis();
					echo json_encode($data);
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}	
		}

		public function archive_docu_list(){

			require_once('./classes/session.php');
			session_start();
			$session = new Session();
			
			if($session->exists('user_session')){
				if($this->adminModel->empType() == "topmake"){
					echo json_encode(2);
				}else{
					$user_session = $session->get('user_session');
					$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';
					$data['archived'] = $this->adminModel->archive_docu_list();
					echo json_encode($data);
				}
			}else{
				$redirect = $session->redirectTo(BASE_URL.'login');	
			}
		}



		public function deleteDocuLists(){

			require_once('./classes/session.php');

				session_start();

				$session = new Session();

				if($session->exists('user_session')){

					if($this->adminModel->empType() == "topmake"){

						echo json_encode(2);

					}else{

						$data['delete'] = $this->adminModel->deleteDocuLists();

					echo json_encode($data);

					}

					

				}else{

					$redirect = $session->redirectTo(BASE_URL.'login');	

				}

	

		}



		

		public function saveEditDocList(){

			require_once('./classes/session.php');

			session_start();

			$session = new Session();

			if($session->exists('user_session')){

				if($this->adminModel->empType() == "topmake"){

					echo json_encode(2);

				}else{

					$user_session = $session->get('user_session');

				$data ['html_title'] ='Admin | Zeldan Nordic Language & Training Center';

				$data['updateDocuLis'] = $this->adminModel->saveEditDoclis();

			echo json_encode($data);

				}

				

			}else{

				$redirect = $session->redirectTo('login');	

			}

		}

		

	



	public function approveEditDocu(){

		require_once('./classes/session.php');
		session_start();
		$session = new Session();

		if($session->exists('user_session')){
			$data['approveEdit'] = $this->adminModel->approveEditDocu();
			echo json_encode($data);
		}else{
			$redirect = $session->redirectTo(BASE_URL.'login');	
		}
	}
	
	/* Start --  Added By Migs -- 02-26-2024  */
	public function getUserInfo(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();

		$data['userInfo'] = $this->adminModel->getAccountInfo();
		echo json_encode($data);
	}

	public function submitTraineeAdditionalInfo(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$_POST['admin_id'] = $session->exists('user_session');

		$query = $this->adminModel->traineeAdditionalInfo($_POST);
		$info = $this->adminModel->getEmployeeProfile($_POST['trainee-id']);
		$data['query'] = $query;
		$data['email'] = $info['email'];
		echo json_encode($data);
	}

	public function fetch_docu_info(){
		$id = $_POST['id'];
		$data = $this->userDocumentsModel->get_document_info($id);
		if($data){
			$response['status'] = 'success';
			$response['data'] = $data;
		}else{
			$response['status'] = 'error';
			$response['data'] = NULL;
		}

		echo json_encode($response);
	}

	public function document_request_status_action(){
		$id = $_POST['id'];
		$action = $_POST['action'];

		$query = $this->userDocumentsModel->request_status_action($id, $action);

		if($query){
			$response['status'] = 'success';
			$response['data'] = $query;
		}else{
			$response['status'] = 'error';
			$response['data'] = NULL;
		}

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
			'date_created' => date('Y-m-d H:i:s'),
			'date_updated' => date('Y-m-d H:i:s')
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

	public function update_applicant_flag_status(){
		$flag_status = $_POST['flag-status'];
		$trainee_id = $_POST['trainee-id'];
		$deployment_date = isset($_POST['deployment-date']) ? $_POST['deployment-date'] : null;

		$row = $this->adminModel->updateTraineeFlagStatus($flag_status, $trainee_id, $deployment_date);
		$log = $this->save_flag_status_logs($flag_status, $trainee_id);

		if($log != null){
			$response['status'] = 'success';
			$response['data'] = $log;
		}else{
			$response['status'] = 'error';
			$response['data'] = null;
		}

		echo json_encode($response);
	}

	public function save_flag_status_logs($flag, $trainee){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');
		$log = $this->applicantFlagStatusModel->save_log($admin_id, $trainee, $flag);

		if($log){
			return $log;
		}else{
			return null;
		}
	}

	public function check_batch_name(){
		$batch_name = $_POST['batch-name'];
		$batch = $this->batchModel->get_batch_by_name($batch_name);
		if($batch){
			$response['status'] = 'already-exist';
		}else{
			$response['status'] = 'proceed-to-add';
		}

		echo json_encode($response);
	}

	public function add_batch(){
		
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');
		$action = $_POST['action'];

		switch($action){
			case 'add':
				$batch = $this->batchModel->add_batch($_POST['batch-name'], $admin_id);
			break;

			case 'edit':
				$batch = $this->batchModel->edit_batch($_POST['batch-name'], $admin_id, $_POST['batch-id']);
			break;
		}
		

		if($batch){
			$response['status'] = 'success';
			$response['data'] = $batch;
		}else{
			$response['status'] = 'error';
			$response['data'] = null;
		}

		echo json_encode($response);
	}

	public function delete_batch(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');
		$id = $_POST['batch-id'];

		$delete = $this->batchModel->delete_batch($id);

		if($delete){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function add_batch_number(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');
		$batch = $_POST['batch-id'];
		$number = $_POST['batch-number'];

		$batch_number = $this->batchModel->add_batch_number($batch, $number, $admin_id);

		if($batch_number){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function check_batch(){
		$check = $this->batchModel->check_batch($_POST['id']);
		if($check){
			$response['status'] = 'error';
		}else{
			$response['status'] = 'success';
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

	public function check_batch_number(){

		$batch_name = $_POST['batch-id'];
		$batch_number = $_POST['batch-number'];

		$check = $this->batchModel->check_batch_number($batch_name, $batch_number);

		if($check){
			$response['status'] = 'error';
		}else{
			$response['status'] = 'success';
		}

		echo json_encode($response);

	}
	

	public function edit_batch_number(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');

		$batch_id = $_GET['batch-num-id'];
		$batch_name = $_GET['batch-id'];
		$batch_number = $_GET['batch-number'];

		$update = $this->batchModel->edit_batch_number($batch_id, $batch_name, $batch_number, $admin_id);

		if($update){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function check_batch_number_content(){
		$batch = $this->batchModel->get_batch_number_name_and_number($_POST['id']);
		$tainees_under_batch = $this->batchModel->get_all_trainees_under_batch($batch);

		if(!empty($tainees_under_batch)){
			$response['status'] = 'error';
		}else{
			$batch['id'] = (int)$_POST['id'];
			$response['status'] = 'success';
			$response['data'] = $batch;
		}

		echo json_encode($response);

	}

	public function delete_batch_number(){
		$delete = $this->batchModel->delete_batch_number($_POST['data']);
		if($delete){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function get_applicants_batches(){
		$batches = $this->batchModel->get_all_batches();

		if($batches){
			$response['status'] = 'success';
			$response['batches'] = $batches;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function get_applicants_batch_numbers(){
		$batch = $this->batchModel->get_batch_by_name($_POST['name']);
		$numbers = $this->batchModel->get_all_batch_number_by_batch_id($batch[0]['id']);

		if($numbers){
			$response['status'] = 'success';
			$response['numbers'] = $numbers;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function move_trainee_batch(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');

		foreach($_POST['ids'] as $id){
			$this->batchModel->update_user_batch($id, $_POST['batch'], $_POST['batch_number']);
			$this->batchModel->save_batch_history_update($id, $admin_id, $_POST['batch'], $_POST['batch_number']);
		}

		$response['status'] = 'success';
		echo json_encode($response);

	}

	public function mass_change_trainee_status(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');

		if($_POST['status'] == 'deployed'){
			foreach($_POST['ids'] as $id){
				$this->adminModel->updateTraineeFlagStatus($_POST['status'], $id, $_POST['deploymentDate']);
			}
		}else{
			foreach($_POST['ids'] as $id){
				$this->adminModel->updateTraineeFlagStatus($_POST['status'], $id);
			}
		}

		$response['status'] = 'success';
		echo json_encode($response);
	}

	public function add_department(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');

		$check_dept_name = $this->departmentsModel->check_department_name($_POST['description']);

		if($check_dept_name != 0){
			$response['status'] = 'form-incomplete';
			echo json_encode($response);
			exit;

		}else{
			$dept = $this->departmentsModel->add_department($_POST['description'], $admin_id);
			if($dept){
				$response['status'] = 'success';
				$response['data'] = $dept;
			}else{
				$response['status'] = 'error';
			}
		}

		echo json_encode($response);
	}

	public function get_department_info(){
		$id = $_POST['id'];

		$department = $this->departmentsModel->get_department_by_id($id);
		
		if($department){
			$response['status'] = 'success';
			$response['data'] = $department;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function edit_department(){

		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin_id = $session->get('user_session');

		$id = $_POST['department-id'];
		$description = $_POST['description'];

		
		$check_dept_name = $this->departmentsModel->check_department_name($_POST['description']);

		if($check_dept_name){
			$response['status'] = 'form-incomplete';
			echo json_encode($response);
			exit;

		}else{
			$admin = $this->adminModel->get_user_info($admin_id);
			$update = $this->departmentsModel->edit_department($id, $description, $admin_id);

			if($update){
				$response['status'] = 'success';
				$response['description'] = ucwords($description);
				$response['admin_name'] = ucwords($admin['first_name']) .' '. ucwords($admin['last_name']);
			}else{
				$response['status'] = 'error';
			}
		}

		echo json_encode($response);
	}

	public function check_department_content(){
		$id = $_POST['id'];

		$check = $this->departmentsModel->check_department_if_has_employee($id);

		if($check == 0){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function delete_department(){
		$delete = $this->departmentsModel->delete_department($_POST['department-id']);

		if($delete){
			$response['status'] = 'success';
			$response['id'] = $_POST['department-id'];
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function get_employees_with_no_department(){
		$employees = $this->departmentsModel->get_employees_with_no_department();

		if($employees){
			$response['status'] = 'success';
			$response['employees'] = $employees;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function add_employee_department(){
		$dept_id = $_POST['department-id'];
		$emp_id = $_POST['employees'];

		$emp_dept = $this->departmentsModel->add_employee_department($dept_id, $emp_id);

		if($emp_dept){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function get_first_department(){
		$first = $this->departmentsModel->get_all_departments();

		if($first){
			$response['status'] = 'success';
			$response['f_department'] = $first[0];
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function remove_employee_from_department(){
		$emp_id = $_POST['employee-id'];
		$dept_id = $_POST['department-id'];

		$delete = $this->departmentsModel->remove_employee_from_department($dept_id, $emp_id);

		if($delete){
			$response['status'] = 'success';
			$response['emp_id'] = $emp_id;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function get_faq_info(){
		$id = $_POST['id'];
		$info = $this->faqsModel->get_faq_info($id);

		if($info){
			$response['status'] = 'success';
			$response['data'] = $info;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function add_message_faq(){
		$post = $_POST;

		$message = $this->faqsModel->add_message_faq($post);
		if($message){
			$response['status'] = 'success';
			$response['data'] = $message;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);

	}

	public function delete_faq(){
		$id = $_POST['faq-id'];

		$check_if_sub_faq = $this->faqsModel->check_if_sub_faq($id);

		if($check_if_sub_faq){
			$response['status'] = 'is_faq_parent';
			echo json_encode($response);
			exit;
		}else{
			$delete = $this->faqsModel->delete_faq($id);
			if($delete){
				$response['status'] = 'success';
				$response['id'] = $id;
			}else{
				$response['status'] = 'error';
			}
		}

		echo json_encode($response);

	}

	public function edit_message_faq(){
		$post = $_POST;

		$edit = $this->faqsModel->edit_message_faq($post);

		if($edit){
			$response['status'] = 'success';
			$response['data'] = $post;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function add_faq_keyword(){
		$post = $_POST;
		$row = array(
			'description' => $post['keyword-description'],
			'icon' => $post['keyword-icon'],
			'department' => $post['keyword-department']
		);

		$add = $this->faqsModel->add($row, 'chat_keywords');

		if($add){
			$response['status'] = 'success';
			$response['data'] = $add;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function close_ticket(){
		date_default_timezone_set('Asia/Manila');
		$id = $_POST['ticket-id'];

		$row = array(
			'status' => 'closed',
			'date_updated' => date('Y-m-d H:i:s')
		);

		$update = $this->chatMessagesModel->set_conversation_status(['id', $id], $row);

		if($update){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function open_ticket(){
		date_default_timezone_set('Asia/Manila');
		$id = $_POST['ticket-id'];

		$row = array(
			'status' => 'active',
			'date_updated' => date('Y-m-d H:i:s')
		);

		$update = $this->chatMessagesModel->set_conversation_status(['id', $id], $row);

		if($update){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function admin_start_conversation(){
		date_default_timezone_set('Asia/Manila');
		$tag = $_POST['tag'];
		$dept = $_POST['dept_id'];
		$user = $_POST['user_id'];
		$admin = $_POST['admin_id'];
		$ticket = $user .''. date('ymdhis');

		$row = array(
			'ticket' => $ticket,
			'status' => 'active',
			'department' => $dept,
			'tag' => $tag
		);

		$convo = $this->chatMessagesModel->add('chat_conversation', $row);
		$log_conversation = $this->chatMessagesModel->add_conversation_log([
			'conversation_id' => $convo, 
			'status' => 'active',
			'updated_by' => $admin
		]);

		if($convo){
			$response['status'] = 'success';
			$response['url'] = BASE_URL . 'admin/conversation?ticket=' . $ticket . '&uid=' .$user;
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);
	}

	public function get_all_keywords(){
		$keywords = $this->faqsModel->get_all_keywords();

		if($keywords){
			$response['status'] = 'success';
			$response['data'] = $keywords;
		}else{
			$response['status'] = 'error';
			$response['data'] = 0;
		}

		echo json_encode($response);
	}

	public function transfer_message(){
		date_default_timezone_set('Asia/Manila');

		if($_POST['keyword-id'] == null){
			$response['status'] = 'no-keyword';
			echo json_encode($response);
			exit;
		}

		if($_POST['transfer-message-reason'] == null){
			$response['status'] = 'no-message';
			echo json_encode($response);
			exit;
		}
		
		$key = $this->chatMessagesModel->get_department_by_keyword($_POST['keyword-id']);
		$convo = $this->chatMessagesModel->get_one_conversation_by_where(['ticket', $_POST['ticket']]);

		// echo '<pre>';
		// print_r($key);
		// exit;

		$update = $this->chatMessagesModel->update_chat_conversation_by_where(['ticket', $_POST['ticket']], [
			'tag' => $key['description'],
			'department' => $key['department'], 
			'date_updated' => date('Y-m-d H:i:s')
		]);

		$transfer_log = $this->chatMessagesModel->save_transfer_log([
			'ticket_id' => $convo['id'],
			'transfer_from' => $_POST['current-deparment'], 
			'transfer_to' => $key['department'], 
			'transfer_by' => $_POST['admin-id'],
			'transfer_reason' => $_POST['transfer-message-reason'],
			'date_created' => date('Y-m-d H:i:s'),
			'date_updated' => date('Y-m-d H:i:s')
		]);

		if($transfer_log){
			$response['status'] = 'success';
		}else{
			$response['status'] = 'error';
		}

		echo json_encode($response);

	}

	public function save_testimonial() {
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
	
		$user_session = $session->get('user_session');
		$name = $_POST['name'];
		$testimonial = $_POST['testimonial'];
		$action = $_POST['action'];
		$t_id = $_POST['id'];
	
		// dito ang ma a-upload na folder
		//$directory = $_SERVER['DOCUMENT_ROOT'] . '/zeldannlrc/assets/images/testimonials-profiles';
		$directory = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/testimonials-profiles';
	
		// Kapag wala yung folder na testimonial-profiles, gagawa sya tapos iseset yung permissions para pwede makapag upload sa folder
		if (!is_dir($directory)) {
			mkdir($directory, 0777, true);
			$command = 'icacls ' . escapeshellarg($directory) . ' /grant Users:(OI)(CI)F';
			exec($command, $output, $return_var);
			if ($return_var != 0) {
				$response['status'] = 'error';
				$response['message'] = 'Failed to set permissions. Error: ' . implode("\n", $output);
				echo json_encode($response);
				return;
			}
		}
	
		// mga file extenstions lang na acceptable
		$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
		$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
	
		// ito yung uploading part
		if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
			$image = $_FILES['image']; //raw na file name ito
			$fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
			
			// validate natin image type dito
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $image['tmp_name']);
			finfo_close($finfo);
	
			if (in_array($mimeType, $allowedMimeTypes) && in_array($fileExtension, $allowedExtensions)) {
				$sep1 = explode('.', basename($image['name'])); //separate natin yung file name to array
				$img_name = str_replace(' ', '_', $sep1[0]) . '_' . date('Ymdhis') . '.' . $fileExtension; // gawing underscore yung spaces sa filename tapos ilagay yung file extension
				$imagePath = $directory . DIRECTORY_SEPARATOR . $img_name;
				
				// lagay natin yung image sa folder na pag a-uploadan
				if (move_uploaded_file($image['tmp_name'], $imagePath)) {
					$imageUrl = $img_name;
				} else {
					$response['status'] = 'error';
					$response['message'] = 'Failed to upload image';
					echo json_encode($response);
					return;
				}
			} else {
				$response['status'] = 'error';
				$response['message'] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.';
				echo json_encode($response);
				return;
			}
		} else {
			$imageUrl = null; // Kapag walang image
		}

		if($action =="add"){
			$new_id = $this->adminModel->save_testimonial($name, $testimonial, $imageUrl, $user_session);
			$testimonial_data = $this->adminModel->fetch_testimonial_data($new_id);
		}else{
			$this->adminModel->update_testimonial($t_id, $name, $testimonial, $imageUrl, $user_session);
			$testimonial_data = $this->adminModel->fetch_testimonial_data($t_id);
		}
	
		$response['status'] = 'success';
		$response['testimonial'] = $testimonial_data;
		$response['url'] = BASE_URL_ASSETS . 'images/testimonials-profiles/';
	
		echo json_encode($response);
	}

	public function fetch_testimonial() {
		$id = $_POST['id'];
		$testimonial_data = $this->adminModel->fetch_testimonial_data($id);

		$response['status'] = 'success';
		$response['data'] = $testimonial_data;

		echo json_encode($response);

	}

	public function delete_testimonial(){
		$id = $_POST['id'];
		$this->adminModel->deleteTestimonial($id);

		$response['status'] = 'success';
		echo json_encode($response);
		
	}

	public function delete_previous_image(){
		
		$id = $_POST['id'];
		$data = $this->adminModel->fetch_testimonial_data($id);

		if($_SERVER['SERVER_NAME'] == 'localhost'){
			$dir = $_SERVER['DOCUMENT_ROOT'] . '/zeldannlrc/assets/images/testimonials-profiles/' . $data['image'];
		}else{
			$dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/testimonials-profiles/' . $data['image'];
		}

		if(file_exists($dir)) {
			unlink($dir);
			$response['status'] = 'success';
		}else{
			$response ['status'] = 'error';
			$response['message'] = 'File does not exist';
		}
		echo json_encode($response);
	}

	public function delete_blog_image(){
		
		$id = $_POST['id'];
		$data = $this->blogsModel->fetch_blog_data($id);

		if($data['image'] == NULL){
			$response['status'] = 'success';
		}else{
			
			if($_SERVER['SERVER_NAME'] == 'localhost'){
				$dir = $_SERVER['DOCUMENT_ROOT'] . '/zeldannlrc/assets/images/blogs/' . $data['image'];
			}else{
				$dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/blogs/' . $data['image'];
			}

			if(file_exists($dir)) {
				unlink($dir);
				$response['status'] = 'success';
			}else{
				$response ['status'] = 'error';
				$response['message'] = 'File does not exist';
			}
		}

		echo json_encode($response);
	}

	public function save_blog() {
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
	
		$user_session = $session->get('user_session');
		$title = $_POST['title'];
		$content = $_POST['content'];
		$action = $_POST['action'];
		$b_id = $_POST['id'];
	
		// dito ang ma a-upload na folder
		if($_SERVER['SERVER_NAME'] == 'localhost'){
			$directory = $_SERVER['DOCUMENT_ROOT'] . '/zeldannlrc/assets/images/blogs';
		}else{
			$directory = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/blogs';
		}
	
		// Kapag wala yung folder na blogs, gagawa sya tapos iseset yung permissions para pwede makapag upload sa folder
		if (!is_dir($directory)) {
			mkdir($directory, 0777, true);
			$command = 'icacls ' . escapeshellarg($directory) . ' /grant Users:(OI)(CI)F';
			exec($command, $output, $return_var);
			if ($return_var != 0) {
				$response['status'] = 'error';
				$response['message'] = 'Failed to set permissions. Error: ' . implode("\n", $output);
				echo json_encode($response);
				return;
			}
		}
	
		// mga file extenstions lang na acceptable
		$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
		$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
	
		// ito yung uploading part
		if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
			$image = $_FILES['image']; //raw na file name ito
			$fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
			
			// validate natin image type dito
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $image['tmp_name']);
			finfo_close($finfo);
	
			if (in_array($mimeType, $allowedMimeTypes) && in_array($fileExtension, $allowedExtensions)) {
				$sep1 = explode('.', basename($image['name'])); //separate natin yung file name to array
				$img_name = str_replace(' ', '_', $sep1[0]) . '_' . date('Ymdhis') . '.' . $fileExtension; // gawing underscore yung spaces sa filename tapos ilagay yung file extension
				$imagePath = $directory . DIRECTORY_SEPARATOR . $img_name;
				
				// lagay natin yung image sa folder na pag a-uploadan
				if (move_uploaded_file($image['tmp_name'], $imagePath)) {
					$imageUrl = $img_name;
				} else {
					$response['status'] = 'error';
					$response['message'] = 'Failed to upload image';
					echo json_encode($response);
					return;
				}
			} else {
				$response['status'] = 'error';
				$response['message'] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.';
				echo json_encode($response);
				return;
			}
		} else {
			$imageUrl = null; // Kapag walang image
		}

		if($action =="add"){
			$new_id = $this->blogsModel->save_blog($title, $content, $imageUrl);
			$blog_data = $this->blogsModel->fetch_blog_data($new_id);
		}else{
			$this->blogsModel->update_blog($b_id, $title, $content, $imageUrl);
			$blog_data = $this->blogsModel->fetch_blog_data($b_id);
		}
	
		$response['status'] = 'success';
		$response['blog'] = $blog_data;
		$response['url'] = BASE_URL_ASSETS . 'images/blogs/';
	
		echo json_encode($response);
	}

	public function fetch_blog() {
		$id = $_POST['id'];
		$blog_data = $this->blogsModel->get($id);

		$response['status'] = 'success';
		$response['data'] = $blog_data;

		echo json_encode($response);

	}

	public function delete_blog(){
		$id = $_POST['id'];
		$this->blogsModel->deleteBlog($id);

		$response['status'] = 'success';
		echo json_encode($response);
		
	}


	public function fetch_inforeq() {

		$id = $_POST['id'];
		$inforeq_data = $this->adminModel->fetch_inforeq_data($id);

		$response['status'] = 'success';
		$response['data'] = $inforeq_data;

	
		echo json_encode($response);



	}

	public function delete_inforeq(){
		$id = $_POST['id'];
		$this->adminModel->deleteInforeq($id);

		$response['status'] = 'success';
		$response['message'] = 'Deleted Successfully';
		echo json_encode($response);
		
	}

	/* End --  Added By Migs  */


	public function get_deployed_count_per_month(){
		// month year
		$startDate = new DateTime('first day of January this year');
		$endDate = new DateTime(); 

		$result = [];
		$months = [];
		$counts = [];
		$links = [];

		while ($startDate <= $endDate) {
			$month = $startDate->format('F'); 
			$year = $startDate->format('Y');
			$month_num = $startDate->format('m'); 
			

			$months[] = $month;
			$counts[] = $this->adminModel->countDeployedPerMonth($year, $month_num);
			$links[] = 'applicants?status=deployed&year=' .$year. '&month='.$startDate->format('m');

			
			// Move to the next month
			$startDate->modify('first day of next month');
		}
		$response = [
			'status'=>'success',
			'months'=>$months,
			'counts'=>$counts,
			'links' => $links
		];

		echo json_encode($response);

	}	

	// batch transfers per week of current year
	public function get_transfers_per_week_of_current_year() {
		$currentDate = new DateTime();
		$currentYear = $currentDate->format('Y');
		$currentWeek = $currentDate->format('W');

		$startDate = new DateTime("first day of January $currentYear");
	
		$weeks = [];
		$counts = [];
	
		while ($startDate->format('Y') == $currentYear && $startDate->format('W') <= $currentWeek) {
			$weekNumber = $startDate->format('W');
	
			$weekStart = clone $startDate;
			$weekEnd = clone $startDate;
			$weekStart->setISODate($currentYear, $weekNumber, 1);
			$weekEnd->setISODate($currentYear, $weekNumber, 7);
	
			$weeks[] = $weekStart->format('W');
			$counts[] = $this->adminModel->countTransfersForWeek($currentYear, $weekNumber);
			$startDate->modify('next week');
		}
		$response = [
			'status' => 'success',
			'weeks' => $weeks,
			'counts' => $counts
		];
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	private function get_days_of_the_week($year, $week) {
		$startDate = new DateTime();
		$startDate->setISODate($year, $week, 1);

		
	
		$days = [];
		$dayNames = [];
		$currentCounts = [];
	
		for ($i = 0; $i < 7; $i++) {
			$day = clone $startDate;
			$day->modify("+$i day");
	
			$formattedDate = $day->format('Y-m-d');
			$days[] = $formattedDate;
			$dayName = $day->format('l');
			$dayNames[] = $dayName;
			$count = $this->adminModel->dailyCountTransfersForCurrentWeek($formattedDate);
			$currentCounts[] = $count;
		}

		$data = ['days' => $days, 'dayNames' => $dayNames, 'currentCounts' => $currentCounts];

		return $data;

		// echo '<pre>';
		// print_r($data);
		// exit;
	}

	// daily batch transfers of the current week of the current year
	public function get_daily_transfers_current_week() {
		$currentDate = new DateTime();
		$currentYear = $currentDate->format('Y');
		$currentWeek = $currentDate->format('W');
		$previousWeek = $currentDate->modify('-1 week');
		$previousWeek = $previousWeek->format('W');

		$currentWeekdata = $this->get_days_of_the_week($currentYear, $currentWeek);
		$previousWeekdata = $this->get_days_of_the_week($currentYear, $previousWeek);

		$data = [
			'currentWeek' => $currentWeekdata,
			'previousWeek' => $previousWeekdata
		];
	
	
		$response = [
			'status' => 'success',
			'data' => $data
		];

	
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// daily batch transfers of the current week of the current year
	public function get_total_transfers_current_week() {
		$currentDate = new DateTime();
		$currentYear = $currentDate->format('Y');
		$currentWeek = $currentDate->format('W');
	
		$startDate = new DateTime();
		$startDate->setISODate($currentYear, $currentWeek, 1);
	
		$days = [];
		$dayNames = [];
		$currentCounts = [];
	
		for ($i = 0; $i < 7; $i++) {
			$day = clone $startDate;
			$day->modify("+$i day");
	
			$formattedDate = $day->format('Y-m-d');
			$days[] = $formattedDate;
			$dayName = $day->format('l');
			$dayNames[] = $dayName;
			$count = $this->adminModel->dailyCountTransfersForCurrentWeek($formattedDate);
			$currentCounts[] = $count;
		}
	
		// Compute the sum of the counts
		$totalCountCurrentWeek = array_sum($currentCounts);
	
		$response = [
			'status' => 'success',
			'days' => $days,
			'dayNames' => $dayNames,
			'currentCounts' => $currentCounts,
			'totalCountCurrentWeek' => $totalCountCurrentWeek
		];

		return $totalCountCurrentWeek;
	}

	public function get_total_transfers_previous_week() {
		$currentDate = new DateTime();
		$currentYear = $currentDate->format('Y');
		$currentWeek = $currentDate->format('W');
	
		// Adjust to previous week
		$previousWeekDate = clone $currentDate;
		$previousWeekDate->modify('-1 week');
		$previousYear = $previousWeekDate->format('Y');
		$previousWeek = $previousWeekDate->format('W');
	
		$startDate = new DateTime();
		$startDate->setISODate($previousYear, $previousWeek, 1);
	
		$days = [];
		$dayNames = [];
		$currentCounts = [];
	
		for ($i = 0; $i < 7; $i++) {
			$day = clone $startDate;
			$day->modify("+$i day");
	
			$formattedDate = $day->format('Y-m-d');
			$days[] = $formattedDate;
			$dayName = $day->format('l');
			$dayNames[] = $dayName;
			$count = $this->adminModel->dailyCountTransfersForCurrentWeek($formattedDate);
			$currentCounts[] = $count;
		}
	
		// Compute the sum of the counts
		$totalCountPreviousWeek = array_sum($currentCounts);
	
		$response = [
			'status' => 'success',
			'days' => $days,
			'dayNames' => $dayNames,
			'currentCounts' => $currentCounts,
			'totalCountPreviousWeek' => $totalCountPreviousWeek
		];
	
		return $totalCountPreviousWeek;
	}

	public function generate_password($email){
		$user = $this->loginModel->get_user_info($email);

		if(!$user){
			return 'User does not exist';

		}else{
			$date_hash =  urlencode(sha1((string) $user['updated_at']));
			$link = BASE_URL . "resetpassword?email=" . $user['email'] . '&token=' . $date_hash;
			return $link;
		}
	}

	public function ajax_add_trainee(){
		date_default_timezone_set('Asia/Manila');
		$post = $_POST;
		$row = array(
			'first_name' => $post['first-name'],
			'last_name' => $post['last-name'],
			'middlename' => $post['middle-name'],
			'email' => $post['email'],
			'batch' => $post['batch'],
			'avatar' => 'avatar.png',
			'is_active' => 1,
			'is_approved' => 1,
			'flag_status' => 'inactive',
			'batch_number' => $post['batch-number'],
			'date_joined' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s'),
		);

		$email_checker = $this->profileModel->get_trainee_by_email($post['email']);

		if($email_checker){
			$response = [
				'status' => 'email-already-exist'
			];
		}else{
			$data = $this->profileModel->add_trainee($row);
			$token = $this->generate_password($post['email']);
	
			$response = [
				'status' => 'success',
				'data' => $data,
				'link' => $token
			];
		}

		echo json_encode($response);
	}

	public function update_trainee_deployment_date(){
		require_once('./classes/session.php');
		session_start();
		$session = new Session();
		$admin = $session->exists('user_session');
		$date = $_POST['deployment-date'];
		$trainee_id = $_POST['user-id'];

		$update = $this->profileModel->update_trainee_deployment_date($date, $trainee_id);
		$log_update = $this->applicantFlagStatusModel->save_log($admin, $trainee_id, 'deployed');

		if($update){
			$response = array(
				'status' => 'success',
				'message' => 'Update deployment date successfull'
			);
		}else{
			$response = array(
				'status' => 'error',
				'message' => 'Something went wrong. Please contact IT administrator'
			);
		}

		echo json_encode($response);
	}

	public function approve_access_request(){
		date_default_timezone_set('Asia/Manila');

		$req_id = $_POST['reqId'];
		$req_data = $this->requestAccessModel->get_row($req_id);
		$from = new DateTime($req_data['access_from']);
		$current = new DateTime(date('H:i'));

		$this->requestAccessModel->approve_request($req_id);
		if($current > $from){
			$this->profileModel->update_employee_status($req_data['user_id']);
		}

		$response['status'] = 'success';
		echo json_encode($response);

	}
}

	

?>

