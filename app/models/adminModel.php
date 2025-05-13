<?php



class adminModel extends Model {

	public function __construct( $autoloader ) {

		parent::__construct( $autoloader );



		// make sure things are loaded for use in the model

		$this->loadAllModels( $autoloader, __CLASS__ );

	}


	public function getPageText() {

		// get page text from database or code

		return USE_DATABASE ? $this->getPageTextFromDatabase() : $this->getPageTextFromCode();

	}



	public function getPageTextFromCode() {

		print_r( array( // page info

			'info' => array(

				'title' => 'ZNLRC-ADMIN',

				'content' => ' content',

			),

		));

	}

	public function get_all_employees(){

		$this->database->table('users');
		$this->database->where('is_staff', 1);
		$this->database->fetch(Database::PDO_FETCH_MULTI);
		$query = $this->database->runSelectQuery( '*' );
		return $query;
		
	}



	public function countEmployee(){

		require_once('./classes/session.php');

		

		$session = new Session();

		$role =  $session->get('user_session');

		$selecth = '*';

		

		$this->database->table( 'users' );

		$this->database->where( 'users.is_staff', '1');

		$this->database->fetch( Database::PDO_FETCH_MULTI );

		

		$count_hh = $this->database->runSelectQuery( $selecth );

	

		// return the data

		return $count_hh;

	}



	public function countApprovedApli(){

		require_once('./classes/session.php');

		

		$session = new Session();

		$role =  $session->get('user_session');

		$selecth = '*';

		

		$this->database->table( 'users' );

		$this->database->where( 'users.is_staff', '0');

		$this->database->where( 'users.is_superuser', '0','AND');

		$this->database->where( 'users.is_approved', '1','AND');

		$this->database->fetch( Database::PDO_FETCH_MULTI );

		

		$count_hh = $this->database->runSelectQuery( $selecth );

	

		// return the data

		return $count_hh;

	}

	public function countpendingApli(){

		require_once('./classes/session.php');

		

		$session = new Session();

		$role =  $session->get('user_session');

		$selecth = '*';

		

		$this->database->table( 'users' );

		$this->database->where( 'users.is_staff', '0');

		$this->database->where( 'users.is_superuser', '0','AND');

		$this->database->where( 'users.is_approved', '0','AND');

		$this->database->fetch( Database::PDO_FETCH_MULTI );

		

		$count_hh = $this->database->runSelectQuery( $selecth );

	

		// return the data

		return $count_hh;

	}



	public function getProfile($id = null){

        require_once('./classes/session.php');
        $session = new Session();

		isset($id) ? $role = $id : $role =  $session->get('user_session');

        $select = 'users.*,applicant_profile.c_barangay,applicant_profile.contact_number,applicant_profile.c_municipality

        ,applicant_profile.c_province,applicant_profile.country,applicant_profile.region';

        $this->database->table( 'users' );

        $this->database->join( 'left','applicant_profile','applicant_profile.user_id=users.id' );

        $this->database->where( 'users.id', $role);

        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        

        $user = $this->database->runSelectQuery( $select );

    

        // return the data

        return $user;

    }

	public function getEmployeeProfile($id = null){

        require_once('./classes/session.php');
        $session = new Session();

		isset($id) ? $role = $id : $role =  $session->get('user_session');

        $select = 'users.*, employees.department_id';
        $this->database->table( 'users' );
		$this->database->join('left', 'employees', 'employees.employee_id = users.id');
        $this->database->where( 'users.id', $role);
        $this->database->fetch( Database::PDO_FETCH_SINGLE );
        $user = $this->database->runSelectQuery( $select );
        return $user;
    }

	public function viewApplicant(){

        require_once('./classes/session.php');

        $view = $_POST['user'];

        $session = new Session();

        $role =  $session->get('user_session');

        $select = 'users.*,applicant_profile.c_barangay,applicant_profile.contact_number,applicant_profile.c_municipality

        ,applicant_profile.c_province,applicant_profile.country as country2,applicant_profile.region,applicant_destination.name ';

        $this->database->table( 'users' );

        $this->database->join( 'left','applicant_profile','applicant_profile.user_id=users.id' );

        $this->database->join( 'left','applicant_destination','applicant_destination.id=applicant_profile.destination_id' );

        $this->database->where( 'users.id', $view);

        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        

        $user = $this->database->runSelectQuery( $select );

    

        // return the data

        return $user;

    }



	public function viewApplicantDocus(){

        require_once('./classes/session.php');
        $view = $_POST['user'];
        $session = new Session();
        $select = 't1.*, t2.description';
        $this->database->table('user_documents_beta as t1');
        $this->database->join( 'left','document_type as t2','t1.document_type_id=t2.id' );
		$this->database->where('t1.user_id', $view );
        $this->database->fetch( Database::PDO_FETCH_MULTI );

        $doki = $this->database->runSelectQuery( $select );
        return $doki;

    }

	public function countDocus(){

        require_once('./classes/session.php');

        $view = $_POST['user'];

        $session = new Session();

        $select = '* ';

        $this->database->table( 'user_documents' );

        $this->database->join( 'left','users','user_documents.user_id=users.id' );

        $this->database->where( 'user_documents.user_id', $view);

        $this->database->fetch( Database::PDO_FETCH_MULTI );

        

        $countdoki = $this->database->runSelectQuery( $select );

    

        // return the data

        return $countdoki;

    }





	

	



	public function is_superuser(){

		$session = new Session();

        $role =  $session->get('user_session');

        $select = 'users.*';

        $this->database->table( 'users' );

        $this->database->where( 'users.id', $role);

        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        $user = $this->database->runSelectQuery( $select );

		if($user['is_superuser'] == 1){

			return "super";

		}else{

			return "staff";

		}

	}

	public function empType(){

		$session = new Session();

        $role =  $session->get('user_session');

        $select = 'users.*';

        $this->database->table( 'users' );

        $this->database->where( 'users.id', $role);

        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        $user = $this->database->runSelectQuery( $select );

		if($user['is_staff'] == 1){

			return "nlrc";

		}else{

			return "topmake";

		}

	}

	public function delete_apli(){

		$userID = $_POST['userID'];

		$this->database->table( 'users' );

			$this->database->where( 'id', $userID);

			$deleteUser = $this->database->runDeleteQuery( $userID );



			$this->database->table( 'applicant_profile' );

			$this->database->where( 'user_id', $userID);

			$deleteProf = $this->database->runDeleteQuery( $userID );



			$this->database->table( 'user_documents' );

			$this->database->where( 'user_id', $userID);

			$deleteUserdocu = $this->database->runDeleteQuery( $delDocuList );



			return 1;

	}

	public function suspend(){

		$userID = $_POST['userID'];

		$userIDSuspend = array(
			'is_active'=>'0',
		);

		$this->database->table( 'users' );
		$this->database->where( 'id', $userID);
		$updateUser = $this->database->runUpdateQuery( $userIDSuspend );
		return 1;

	}

	public function activate_user(){

		$userID = $_POST['userID'];

		$userIDactiv = array(
			'is_active'=>'1',
		);

		$this->database->table( 'users' );
		$this->database->where( 'id', $userID);
		$updateUser = $this->database->runUpdateQuery( $userIDactiv );
		return 1;

	}

	

	public function updateprofile(){

		require_once('./classes/session.php');

			

            $date = date("Y-m-d H:i:s");

			$session = new Session();

			$role =  $session->get('user_session');

			$updateUser = array(

				

				'email'=>$_POST['email'],

				'first_name'=>$_POST['first_name'],

				'last_name'=>$_POST['last_name'],

				'middlename'=>$_POST['middlename'],

				'updated_at'=>$date,

			);

           

            $updateUserProfile = array(

				'contact_number'=>$_POST['contact_number'],

			

			); 

			$this->database->table( 'users' );

			$this->database->where( 'id', $role);

			$update = $this->database->runUpdateQuery( $updateUser );



            $this->database->table( 'applicant_profile' );

			$this->database->where( 'user_id', $role);

			$updateprof = $this->database->runUpdateQuery( $updateUserProfile );



			return 1;

	}

		//delete user employee



		public function delete_employees(){



			$id=$_POST['userID'];

			

			$this->database->table( 'users' );

			$this->database->where( 'id', $id);

			$deleteUser = $this->database->runDeleteQuery( $id );



			$this->database->table( 'applicant_profile' );

			$this->database->where( 'user_id', $id);

			$deleteProf = $this->database->runDeleteQuery( $id );



			return 1;

		}



	



public function showmedicalCert(){

			require_once('./classes/session.php');

			

			$session = new Session();

			if($session->exists('user_session')){

				

				$folder = $_SERVER['DOCUMENT_ROOT'].'/znlrc/assets/documents';

				$filename = $_POST['file-name'];

				if(is_file($folder. '/' . $filename)){

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

		public function uploadFileMedCert(){

			$date = date("Y-m-d H:i:s");

			$session = new Session();

			$role =  $session->get('user_session');

						$uploadTo = $_SERVER['DOCUMENT_ROOT'].'/assets/documents/'; // upload directory

						$allowFileType = array('pdf','doc');

						$fileName = $_FILES['image']['name'];

						$tempPath=$_FILES["image"]["tmp_name"];

						$file_size = $_FILES['image']['size'];

						$prof_id = $_POST['prof_id'];

	

						// new file size in KB

						$new_size = $file_size/1024;  

						// new file size in KB

	

						$basename = basename($fileName);

						$originalPath = $uploadTo.$basename; 

						$fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 

						if(!empty($fileName)){ 

						

						   if(in_array($fileType, $allowFileType)){ 

							 // Upload file to server 

							 if(move_uploaded_file($tempPath,$originalPath)){ 

							   // write here sql query to store image name in database

							   $sel = 'COUNT(*) as allcount';

								$this->database->table( 'applicant_profile' );

								$this->database->where( 'user_id', $prof_id);

								$this->database->fetch( Database::PDO_FETCH_SINGLE );

								$bilang = $this->database->runSelectQuery( $sel );

	

								

											$updateUserProfilemed = array(

											'med_cert_destination'=>$fileName,

											'med_cert_filesize'=>$new_size,

											'date_medCert_upload'=>$date,

											'med_cert_uploadedby'=>$role,

										); 

										$this->database->table( 'applicant_profile' );

										$this->database->where( 'user_id', $prof_id);

										$update = $this->database->runUpdateQuery( $updateUserProfilemed );

										

									

									return 2;

								}else{ 

									return 3;

								} 

						  }else{

							return 4;

						  }

					   }else{  

						return 5;

					   } 

			

		}



		public function getMedical(){

			require_once('./classes/session.php');

			

			$session = new Session();

			$role=$_POST['user'];

			$selectmedi = '*';

			$this->database->table( 'applicant_profile' );

			$this->database->where( 'user_id', $role);

			$this->database->fetch( Database::PDO_FETCH_SINGLE );

			

			$useremed = $this->database->runSelectQuery( $selectmedi );

		

			// return the data

			return $useremed;

		}



	public function insertEmployee(){

		require_once('./classes/session.php');

			

            $date = date("Y-m-d H:i:s");

			$session = new Session();

			$role =  $session->get('user_session');

			$insertUser = array(

				'email'=>$_POST['email'],

				'first_name'=>$_POST['first_name'],

				'last_name'=>$_POST['last_name'],

				'middlename'=>$_POST['middlename'],

				'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT),

				'is_active'=>1,

				'avatar'=>'avatar.png',

				'is_staff'=>$_POST['empType'],

				'updated_at'=>$date,

			);

           

              

			$this->database->table( 'users' );

			$update = $this->database->runInsertQuery( $insertUser );



			$inserContact = array(

				'contact_number'=>$_POST['contact_number'],

				'user_id'=>$update,

			);

            $this->database->table( 'applicant_profile' );

			$updateprof = $this->database->runInsertQuery( $inserContact );



			return 1;

	}

	//applicants



	public function approveApplicant(){

		$userID = $_POST['userID'];

		$userIDApp = array(

			'is_approved'=>'1',

		);

		$this->database->table( 'users' );

			$this->database->where( 'id', $userID);

			$updateUserApp = $this->database->runUpdateQuery( $userIDApp );

			return 1;

	}



	public function disapproveApplicant(){

		$userID = $_POST['userID'];

		$userIDdis = array(

			'is_approved'=>'3',

		);

		$this->database->table( 'users' );

			$this->database->where( 'id', $userID);

			$updateUserApp = $this->database->runUpdateQuery( $userIDdis );

			return 1;

	}

	

	public function passChange(){

		$userID = $_POST['uid'];

		$pass1 = $_POST['newpass'];

		$pass2 =$_POST['confirmpass'];

         $date = date("Y-m-d H:i:s");

         if($pass1 == $pass2){

            $upPassfad = array(

                'password'=>password_hash($_POST['newpass'],PASSWORD_DEFAULT),

                'updated_at'=>$date,

            );

            $this->database->table( 'users' );

                $this->database->where( 'id', $userID);

                $update = $this->database->runUpdateQuery( $upPassfad );

                return 1;

         }else{

            return 2;

         }

	}



	public function insertDocuLis(){

		require_once('./classes/session.php');

		$date = date("Y-m-d H:i:s");
		$session = new Session();
		$role =  $session->get('user_session');
		$inserDocLis = array(
			'typename'=>$_POST['docu-list-name'],
			'description'=>$_POST['docu-list-description'],
			'date_updated' => date('Y-m-d H:i:s')
		);  
		

		if($_POST['action'] == 'add'){
			$this->database->table( 'document_type' );
			$update = $this->database->runInsertQuery( $inserDocLis );
		}elseif($_POST['action'] == 'edit'){
			$this->database->table( 'document_type' );
			$this->database->where('id', $_POST['docu-list-id']);
			$update = $this->database->runUpdateQuery( $inserDocLis );
		}
		
		return 1;

	}

	public function archive_docu_list(){

		require_once('./classes/session.php');
		$date = date("Y-m-d H:i:s");
		$session = new Session();
		$role =  $session->get('user_session');
		
		if($_POST['action'] == 'archive'){
			$row = array(
				'status' => 'archived',
				'date_updated' => date('Y-m-d H:i:s')
			);
		}else{
			$row = array(
				'status' => 'active',
				'date_updated' => date('Y-m-d H:i:s')
			);
		}

		$this->database->table('document_type');
		$this->database->where('id', $_POST['id']);
		$this->database->runUpdateQuery( $row );
		
		return 1;
	}



	public function deleteDocuLists(){

		$delDocuList = $_POST['delDocuList'];

		$this->database->table( 'document_type' );

			$this->database->where( 'id', $delDocuList);

			$deleteUser = $this->database->runDeleteQuery( $delDocuList );

			return 1;

	}





	public function approveEditDocu(){

        $user_id=$_POST['user_id'];
        $this_id=$_POST['this_id'];

        $req = array(
            'request_edit'=>2,
            'date_updated'=> date("Y-m-d H:i:s")
        ); 

        $this->database->table( 'user_documents_beta' );
        $this->database->where( 'id', $this_id );
        $deleteUser = $this->database->runUpdateQuery( $req );

        return 1;

    }

	

	

	public function saveEditDoclis(){

		$docuList_id = $_POST['docuList_id'];

		$docuList = $_POST['docuList'];



		$updateEditdocs = array(

			'typename'=>$docuList,

		);

		$this->database->table( 'document_type' );

			$this->database->where( 'id', $docuList_id);

			$udpates = $this->database->runUpdateQuery( $updateEditdocs );

			return 1;

	}

	/* Start --  Added By Migs -- 02-26-2024  */

	public function get_user_info($id){
		$this->database->table( 'users' );
		$this->database->where( 'id', $id);
		$this->database->fetch( Database::PDO_FETCH_SINGLE );
		
		$user = $this->database->runSelectQuery( '*' );
		return $user;
	}

	public function getAccountInfo(){
		require_once('./classes/session.php');

			$session = new Session();
			$selectuser = '*';

			$id = $_POST['userID'];

			$this->database->table( 'users' );
			$this->database->where( 'id', $id);
			$this->database->fetch( Database::PDO_FETCH_SINGLE );
			
			$user = $this->database->runSelectQuery( $selectuser );
			return $user;
	}

	public function getSpouseInfo($id){
		$selectuser = '*';
		$this->database->table( 'applicant_spouse' );
		$this->database->where( 'user_id', $id);
		$this->database->fetch( Database::PDO_FETCH_SINGLE );
		
		$user = $this->database->runSelectQuery( $selectuser );
		return $user;
	}

	public function getChildrenInfo($id){
		$selectuser = '*';
		$this->database->table( 'applicant_children' );
		$this->database->where( 'user_id', $id);
		$this->database->fetch( Database::PDO_FETCH_MULTI );
		
		$user = $this->database->runSelectQuery( $selectuser );
		return $user;
	}

	public function traineeAdditionalInfo($data){

		date_default_timezone_set('Asia/Manila');

		$row1 = array(
			'batch' 				=> isset($data['trainee-batch']) ? $data['trainee-batch'] : NULL,
			'batch_number' 			=> isset($data['trainee-batch-number']) ? $data['trainee-batch-number'] : NULL,
			'passed' 				=> isset($data['trainee-passed']) ? $data['trainee-passed'] : NULL,
			'education' 			=> isset($data['trainee-education']) ? $data['trainee-education'] : NULL,
			'field_of_work' 		=> isset($data['trainee-field-of-work']) ? $data['trainee-field-of-work'] : NULL, 
			'years_work_experience' => isset($data['trainee-years-of-experience']) ? $data['trainee-years-of-experience'] : NULL,
			'date_applied' 			=> isset($data['trainee-application-date']) ? $data['trainee-application-date'] : NULL
		);

		$row2 = array(
			'status' => 'approved',
			'date_updated' => date('Y-m-d H:i:s')
		);

		$row3 = array(
			'trainee_id' => $_POST['trainee-id'],
			'batch' => $_POST['trainee-batch'],
			'batch_number' => $_POST['trainee-batch-number'],
			'updated_by' => $_POST['admin_id'],
			'date_created' => date('Y-m-d H:i:s'),
			'date_updated' => date('Y-m-d H:i:s')
		);

		$this->database->table('users');
		$this->database->where('id', $data['trainee-id']);
		$this->database->runUpdateQuery( $row1 );

		$this->database->table('znlrc_info_requests');
		$this->database->where('user_id', $data['trainee-id']);
		$this->database->runUpdateQuery( $row2 );

		$this->database->table('applicant_batch_history');
		$this->database->runInsertQuery( $row3 );
		
		return 1;
	}

	public function getDocumentRequests(){
		require_once('./classes/session.php');

			$session = new Session();
			$select_document = 't1.*, t2.first_name, t2.last_name, t2.middlename, t2.former_name, t2.email, t3.description';

			$this->database->table( 'user_documents_beta as t1' );
			$this->database->join( 'left','users as t2','t2.id=t1.user_id' );
			$this->database->join( 'left', 'document_type as t3', 't3.id = t1.document_type_id');
			$this->database->where( 't1.request_edit', '1');
			$this->database->orderBy('t1.date_updated', 'asc');
			$this->database->fetch( Database::PDO_FETCH_MULTI );
			
			$documents = $this->database->runSelectQuery( $select_document );
			return $documents;
	}

	public function updateTraineeFlagStatus($flag, $trainee, $deployment_date = null){
		date_default_timezone_set('Asia/Manila');

		if($deployment_date != null){
			$row = array(
				'flag_status' => $flag,
				'deployment_date' => $deployment_date,
				'updated_at' => date('Y-m-d h:i:s')
			);
		}else{
			$row = array(
				'flag_status' => $flag,
				'updated_at' => date('Y-m-d h:i:s')
			);
		}
		
		$this->database->table('users');
		$this->database->where('id', $trainee);
		$this->database->runUpdateQuery( $row );

		return 1;
	}

	public function save_testimonial($name, $testimonial, $url, $id){

		$row = array(
			'name' => $name,
			'image' => $url,
			'testimonial' => $testimonial,
			'updated_by' => $id
		);

		$this->database->table('testimonials');
		$query = $this->database->runInsertQuery($row);
		return $query;
	}

	public function fetch_testimonial_data($id){
		$this->database->table('testimonials');
		$this->database->where('id', $id);
		$this->database->fetch( Database::PDO_FETCH_SINGLE );
		$query = $this->database->runSelectQuery('*');
		return $query;
	}

	public function get_all_testimonials_where($index, $val){
		$this->database->table('testimonials as t1');
		$this->database->join('left', 'users as t2', 't1.updated_by = t2.id');
		$this->database->where($index,$val);
		$this->database->orderBy('t1.date_created', 'desc');
		$this->database->fetch( Database::PDO_FETCH_MULTI );
		$query = $this->database->runSelectQuery('t1.*, t2.first_name, t2.last_name');
		return $query;
	}

	public function get_latest_testimonial(){
		$this->database->table('testimonials');
		$this->database->where('status', 'active');
		$this->database->orderBy('date_created', 'desc');
		$this->database->fetch( Database::PDO_FETCH_SINGLE );
		$query = $this->database->runSelectQuery('*');
		return $query;
	}

	public function update_testimonial($id, $name, $testimonial, $imageUrl, $user_session){
		if($imageUrl != null){
			$row = array(
				'name' => $name,
				'image' => $imageUrl,
				'testimonial' => $testimonial,
				'updated_by' => $user_session,
				'date_updated' => date('Y-m-d h:i:s')
			);
		}else{
			$row = array(
				'name' => $name,
				'testimonial' => $testimonial,
				'updated_by' => $user_session,
				'date_updated' => date('Y-m-d h:i:s')
			);
		}

		$this->database->table('testimonials');
		$this->database->where('id', $id);
		$this->database->runUpdateQuery( $row );
		return 1;
	}

	public function deleteTestimonial($id){
		$this->database->table('testimonials');
		$this->database->where('id', $id);
		$this->database->runDeleteQuery();
		return 1;
	}

	public function deleteInforeq($id){
		$this->database->table('znlrc_info_requests');
		$this->database->where('id', $id);
		$this->database->runDeleteQuery();
		return 1;
	}


	/* End --  Added By Migs -- 02-26-2024  */


	//added by z
	public function countApprovedActiveApli(){

		require_once('./classes/session.php');

		

		$session = new Session();

		$role =  $session->get('user_session');

		$selecth = 'id';

		

		$this->database->table( 'users' );

		$this->database->where( 'users.is_staff', '0');

		$this->database->where( 'users.is_superuser', '0','AND');

		$this->database->where( 'users.is_approved', '1','AND');

		$this->database->where( 'users.flag_status', 'active','AND');

		$this->database->fetch( Database::PDO_FETCH_MULTI );

		

		$count_hh = $this->database->runSelectQuery( $selecth );

	

		// return the data

		return count($count_hh);

	}

	public function countApprovedDeployedApli(){
		

		require_once('./classes/session.php');

		$session = new Session();
		$role =  $session->get('user_session');
		$selecth = 'id';

		$this->database->table( 'users' );
		$this->database->where( 'users.is_staff', '0');
		$this->database->where( 'users.is_superuser', '0','AND');
		$this->database->where( 'users.is_active', '1','AND');
		$this->database->where( 'users.flag_status', 'deployed','AND');

		$this->database->fetch( Database::PDO_FETCH_MULTI );
		$count_hh = $this->database->runSelectQuery( $selecth );
	
		// return the data
		return count($count_hh);

	}

	public function countDeployedUpcoming(){
		$host = $_SERVER['SERVER_NAME'];
		if ($host === "localhost"){
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'root';
			$password = '';
		}else{
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'hradmin';
			$password = 'g9%JQ+mPR,=T1';
		}
		try {
			$pdo = new PDO($dsn, $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'SELECT "id" FROM users WHERE flag_status = "deployed" AND deployment_date > CURDATE()';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$count_hh = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return count($count_hh);

		} catch (PDOException $e) {
			return 'Database error: ' . $e->getMessage();
		}
	}

	public function countDeployedPerMonth($year, $month_num){
		$host = $_SERVER['SERVER_NAME'];
		if ($host === "localhost"){
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'root';
			$password = '';
		}else{
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'hradmin';
			$password = 'g9%JQ+mPR,=T1';
		}
		try {
			$pdo = new PDO($dsn, $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = 'SELECT "id" FROM users WHERE flag_status = "deployed" AND YEAR(deployment_date) = :year AND MONTH(deployment_date) = :month';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':year', $year, PDO::PARAM_INT);
			$stmt->bindParam(':month', $month_num, PDO::PARAM_INT);
			$stmt->execute();
			$count_hh = $stmt->fetchAll(PDO::FETCH_ASSOC);


			return count($count_hh);

		} catch (PDOException $e) {
			return 'Database error: ' . $e->getMessage();
		}
	}

	public function countTransfersForWeek($year, $week) {
		$host = $_SERVER['SERVER_NAME'];
		if ($host === "localhost"){
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'root';
			$password = '';
		}else{
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'hradmin';
			$password = 'g9%JQ+mPR,=T1';
		}
		try {
			$pdo = new PDO($dsn, $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$startDate = new DateTime();
			$startDate->setISODate($year, $week, 1);
			$startDateStr = $startDate->format('Y-m-d');
	
			$endDate = clone $startDate;
			$endDate->modify('sunday this week');
			$endDateStr = $endDate->format('Y-m-d');
	
			$sql = 'SELECT COUNT(id) FROM applicant_batch_history WHERE date_created BETWEEN :startDate AND :endDate';
			
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':startDate', $startDateStr);
			$stmt->bindParam(':endDate', $endDateStr);
			$stmt->execute();
			$count = $stmt->fetchColumn();
	
			return $count;
	
		} catch (PDOException $e) {
			return 'Database error: ' . $e->getMessage();
		}
	}


	public function dailyCountTransfersForCurrentWeek($day) {
		$host = $_SERVER['SERVER_NAME'];
		if ($host === "localhost") {
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'root';
			$password = '';
		} else {
			$dsn = 'mysql:host=bom1plzcpnl493856;dbname=znlrcdb;charset=utf8';
			$username = 'hradmin';
			$password = 'g9%JQ+mPR,=T1';
		} try {
			$pdo = new PDO($dsn, $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$sql = 'SELECT COUNT(id) FROM applicant_batch_history WHERE DATE(date_created) = :day';
			
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':day', $day);
			$stmt->execute();		
			$count = $stmt->fetchColumn();
			
			return $count;
		} catch (PDOException $e) {
			return 'Database error: ' . $e->getMessage();
		}
	}

	public function dailyCountTransfersForPreviousWeek($day) {
		$host = $_SERVER['SERVER_NAME'];
		if ($host === "localhost") {
			$dsn = 'mysql:host=localhost;dbname=znlrcdb;charset=utf8';
			$username = 'root';
			$password = '';
		} else {
			$dsn = 'mysql:host=bom1plzcpnl493856;dbname=znlrcdb;charset=utf8';
			$username = 'hradmin';
			$password = 'g9%JQ+mPR,=T1';
		} try {
			$pdo = new PDO($dsn, $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$date = new DateTime($day);		
					
			$previousWeekDay = $date->format('Y-m-d');

			// echo '<pre>';
			// print_r($previousWeekDay);
			// exit;
	
			$sql = 'SELECT COUNT(id) FROM applicant_batch_history WHERE DATE(date_created) = :day';
			
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':day', $previousWeekDay);
			$stmt->execute();
			$count = $stmt->fetchColumn();
			
			return $count;
		} catch (PDOException $e) {
			return 'Database error: ' . $e->getMessage();
		}
	}

	public function countApprovedInactiveApli(){

		require_once('./classes/session.php');

		
		$session = new Session();
		$role =  $session->get('user_session');
		$selecth = 'id';

		$this->database->table( 'users' );
		$this->database->where( 'users.is_staff', '0');
		$this->database->where( 'users.is_superuser', '0','AND');
		$this->database->where( 'users.is_active', '1','AND');
		$this->database->where( 'users.flag_status', 'inactive','AND');
		$this->database->fetch( Database::PDO_FETCH_MULTI );
		
		$count_hh = $this->database->runSelectQuery( $selecth );

		// return the data

		return count($count_hh);

	}

	public function countApprovedOnholdApli(){

		require_once('./classes/session.php');

	
		$session = new Session();
		$role =  $session->get('user_session');
		$selecth = 'id';

		$this->database->table( 'users' );
		$this->database->where( 'users.is_staff', '0');
		$this->database->where( 'users.is_superuser', '0','AND');
		$this->database->where( 'users.is_active', '1','AND');
		$this->database->where( 'users.flag_status', 'on-hold','AND');
		$this->database->fetch( Database::PDO_FETCH_MULTI );

		$count_hh = $this->database->runSelectQuery( $selecth );

		// return the data

		return count($count_hh);

	}

	public function countApprovedQuitApli(){

		require_once('./classes/session.php');

		

		$session = new Session();

		$role =  $session->get('user_session');

		$selecth = 'id';

		

		$this->database->table( 'users' );

		$this->database->where( 'users.is_staff', '0');

		$this->database->where( 'users.is_superuser', '0','AND');

		$this->database->where( 'users.is_active', '1','AND');

		$this->database->where( 'users.flag_status', 'quit','AND');

		$this->database->fetch( Database::PDO_FETCH_MULTI );

		

		$count_hh = $this->database->runSelectQuery( $selecth );

	

		// return the data

		return count($count_hh);

	}
//end added by z
}



?>