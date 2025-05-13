<?php

class profileModel extends Model{

	

    public function ifStaff(){

        require_once('./classes/session.php');

        

        $session = new Session();

        $role =  $session->get('user_session');

        $select = '*';

        $this->database->table( 'users' );

        $this->database->where( 'users.is_staff', 1);

        $this->database->where( 'users.is_approved', 0,'AND');

        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        

        $staff = $this->database->runSelectQuery( $select );

    

        // return the data

        return 1;

    }



    public function getProfile(){

        require_once('./classes/session.php');

        

        $session = new Session();

        $role =  $session->get('user_session');

        $select = 'users.*,applicant_profile.c_barangay,applicant_profile.contact_number,applicant_profile.c_municipality

        ,applicant_profile.c_province,applicant_profile.region';

        $this->database->table( 'users' );

        $this->database->join( 'left','applicant_profile','applicant_profile.user_id=users.id' );

        $this->database->where( 'users.id', $role);

        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        

        $user = $this->database->runSelectQuery( $select );

    

        // return the data

        return $user;

    }



    public function getUserExp(){

        require_once('./classes/session.php');

        

        $session = new Session();

        $role =  $session->get('user_session');

        $selectEXP = '*';

        $this->database->table( 'users' );

        $this->database->join( 'left','applicant_experience','applicant_experience.user_id=users.id' );

        $this->database->where( 'users.id', $role);

        $this->database->fetch( Database::PDO_FETCH_MULTI );

        

        $usereXP = $this->database->runSelectQuery( $selectEXP );

    

        // return the data

        return $usereXP;

    }

    public function get_user_info($id){
        $this->database->table('users');
        $this->database->where('id', $id);
        $this->database->fetch( Database::PDO_FETCH_MULTI );
        $query = $this->database->runSelectQuery( '*' );
        return $query;
    }

    public function get_user_info_by_email($email){
        $this->database->table('users');
        $this->database->where('email', $email);
        $this->database->fetch( Database::PDO_FETCH_MULTI );
        $query = $this->database->runSelectQuery( '*' );
        return $query;
    }

    public function update_personal_data(){
        
        require_once('./classes/session.php');

        $date = date("Y-m-d H:i:s");
        $session = new Session();
        $id =  $session->get('user_session');
        $action = $_POST['action'];

        switch($action){
            case 'personal_info':
                $row = array(
                    'first_name'        => $_POST['firstname'],
                    'last_name'         => $_POST['lastname'],
                    'middlename'        => $_POST['middlename'],
                    'former_name'       => $_POST['formername'],
                    'gender'            => $_POST['gender'],
                    'citizenship'       => $_POST['citizenship'],
                    'birthdate'         => $_POST['birthdate'],
                    'birthplace'        => $_POST['country-birth-place'],
                    'marital_status'    => $_POST['marital-status'],
                    'occupation'        => $_POST['occupation'],
                    'mother_tongue'     => $_POST['mother-tongue'],
                    'discord'           => $_POST['discord'],
                    'field_of_work'     => $_POST['field_of_work'],
                    'years_work_experience' => $_POST['years-work-experience']
                );
            break;

            case 'passport_info':
                $row = array(
                    'passport_number'           => $_POST['passport-no'],
                    'passport_issued_country'   => $_POST['passport-issued-country'],
                    'passport_date_from'        => $_POST['expiry-from'],
                    'passport_date_to'          => $_POST['expiry-to']
                );
            break;

            case 'address_info':
                $row = array(
                    'street_address'    => $_POST['street-address'],
                    'postal_code'       => $_POST['postal-code'],
                    'country'           => $_POST['country'],
                    'telephone_number'  => $_POST['tel-no']
                );
            break;
            
            case 'spouse_info':

                $row = array(
                    'user_id'           => $id,
                    'last_name'         => $_POST['spouse-last-name'],
                    'first_name'        => $_POST['spouse-first-name'],
                    'former_name'       => $_POST['spouse-former-name'],
                    'gender'            => $_POST['spouse-gender'],
                    'birthdate'         => $_POST['spouse-birthdate'],
                    'birth_place'       => $_POST['spouse-birth-place'],
                    'citizenship'       => $_POST['spouse-citizenship'],
                    'move_to_finland'   => $_POST['spouse-move-to-finland'],
                    'date_updated'      => date('Y-m-d H:i:s')
                );

                $spouse = $this->get_spouse_info($id);
                if(!$spouse){
                    $this->database->table( 'applicant_spouse' );
                    $this->database->runInsertQuery( $row );
                    return $row;
                    exit;
                }else{
                    $this->database->table( 'applicant_spouse' );
                    $this->database->where( 'id', $spouse['id']);
                    $this->database->runUpdateQuery( $row );
                    return $row;
                    exit;
                }
            break;

            case 'child_info':

                $main_row = [];
                for($i = 0; $i < (int)$_POST['child-count']; $i++){
                    $row = array(
                        'user_id'       => $id,
                        'last_name'     => $_POST['child-last-name-' . $i],
                        'first_name'    => $_POST['child-first-name-' . $i],
                        'gender'        => $_POST['child-gender-' . $i],
                        'birthdate'     => $_POST['child-birthdate-' . $i],
                        'citizenship'   => $_POST['child-citizenship-' . $i],
                        'application'   => $_POST['child-simultaneous-application-' . $i],
                        'date_updated'  => $date
                    );

                    if($_POST['child-id-'.$i] == '0'){
                        $this->database->table( 'applicant_children' );
                        $child_id = $this->database->runInsertQuery( $row );
                        $row['id'] = $child_id;
                        $row['count'] = $_POST['child-count'];
                        $main_row[] = $row;
                    }else{
                        $this->database->table( 'applicant_children' );
                        $this->database->where( 'id', $_POST['child-id-'.$i]);
                        $this->database->runUpdateQuery( $row );
                        $row['id'] = $_POST['child-id-'.$i];
                        $row['count'] = $_POST['child-count'];
                        $main_row[] = $row;
                    } 
                }
                return $main_row;
                exit;
            break;
                
        }

        $this->database->table( 'users' );
        $this->database->where( 'id', $id);
        $this->database->runUpdateQuery( $row );
        
        return $row;
    }

    public function update_spouse(){
        require_once('./classes/session.php');

        $date = date("Y-m-d H:i:s");
        $session = new Session();
        $role =  $session->get('user_session');

        $this->database->table( 'users' );
        $this->database->where( 'id', $role);
        $update = $this->database->runUpdateQuery( ['has_spouse' => $_POST['action']] );

        return 1;
    }

    public function delete_spouse($user_id){
        $this->database->table('applicant_spouse');
        $this->database->where('user_id', $user_id);
        $this->database->runDeleteQuery($user_id);

        return 1;
    }

    public function get_spouse_info($user_id){
        require_once('./classes/session.php');
        $session = new Session();
        $role =  $session->get('user_session');
        $select = '*';

        $this->database->table( 'applicant_spouse' );
        $this->database->where( 'user_id', $user_id);
        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        $spouse = $this->database->runSelectQuery( $select );

        return $spouse;
    }

    public function update_child(){
        require_once('./classes/session.php');

        $date = date("Y-m-d H:i:s");
        $session = new Session();
        $id =  $session->get('user_session');

        $this->database->table( 'users' );
        $this->database->where( 'id', $id);
        $update = $this->database->runUpdateQuery( ['has_children' => $_POST['action']] );

        return 1;
    }

    public function delete_child(){
        require_once('./classes/session.php');

        $date = date("Y-m-d H:i:s");
        $session = new Session();
        $id =  $session->get('user_session');

        $this->database->table( 'applicant_children' );
        $this->database->where( 'id', $_POST['id']);
        $update = $this->database->runDeleteQuery();

        return $_POST['id'];
    }

    public function get_children_info($user_id, $child_id = null){

        $select = '*';
        $this->database->table( 'applicant_children' );
        isset($child_id) ? $this->database->where( 'id', $child_id ) : $this->database->where( 'user_id', $user_id);
        $this->database->fetch( Database::PDO_FETCH_MULTI );

        $children = $this->database->runSelectQuery( $select );
        return $children;
    }

    public function updateProf(){

        require_once('./classes/session.php');

        $date = date("Y-m-d H:i:s");
        $session = new Session();
        $role =  $session->get('user_session');

        $updateUser = array(
            'first_name'=>$_POST['firstname'],
            'last_name'=>$_POST['lastname'],
            'middlename'=>$_POST['middlename'],
            'updated_at'=>$date,
        );

        $updateUserProfile = array(
            'contact_number'=>$_POST['contact_number'],
            'c_barangay'=>$_POST['brgy'],
            'c_municipality'=>$_POST['municipality'],
            'updated'=>$date,
            'country'=>$_POST['country'],
            'region'=>$_POST['region'],
            'c_province'=>$_POST['prov'],
        ); 

        $this->database->table( 'users' );
        $this->database->where( 'id', $role);
        $update = $this->database->runUpdateQuery( $updateUser );

        $this->database->table( 'applicant_profile' );
        $this->database->where( 'user_id', $role);
        $updateprof = $this->database->runUpdateQuery( $updateUserProfile );

		return 1;
    }



    public function updateAvatar(){

        require_once('./classes/session.php');

			

        $date = date("Y-m-d H:i:s");

        $session = new Session();

        $role =  $session->get('user_session');



        

        if(isset($_FILES["file"]["name"])){



            // File name

            $filename = $_FILES['file']['name'];

       

            // Location

            $location = BASE_URL."/images/users".$filename. '_' .date('mdYHis');

            if (move_uploaded_file($filename, $location)) {

                return "<h3>  Image uploaded successfully!</h3>";

            } else {

                return "<h3>  Failed to upload image!</h3>";

            }

       return $location;

       }

    }





    public function uploadFile(){

        $date = date("Y-m-d H:i:s");
        $session = new Session();
        $role =  $session->get('user_session');

        $uploadTo = $_SERVER['DOCUMENT_ROOT'].'/assets/documents/'; // upload directory

        $allowFileType = array('pdf','doc');
        $fileName = $_FILES['image']['name'];
        $tempPath=$_FILES["image"]["tmp_name"];
        $file_size = $_FILES['image']['size'];
        $user_iid = $_POST['user_iid'];
        $docuID = $_POST['docuID'];
        $new_size = $file_size/1024;  

        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 

            if(in_array($fileType, $allowFileType)){ 

                // Upload file to server 

                if(move_uploaded_file($tempPath,$originalPath)){ 

                // write here sql query to store image name in database

                //count documents

                $countd = 'COUNT(*) as allcount';

                $this->database->table( 'user_documents' );
                $this->database->where( 'user_id', $role);
                $this->database->fetch( Database::PDO_FETCH_SINGLE );
                $bilang = $this->database->runSelectQuery( $countd );

                $count = intval($bilang['allcount']);
                $countsave = intval($bilang['allcount'])+1;
                $countd2 = '*';

                $this->database->table( 'document_count' );
                $this->database->where( 'user_id', $role);
                $this->database->fetch( Database::PDO_FETCH_SINGLE );
                $bilang2 = $this->database->runSelectQuery( $countd2 );
                $filang = $bilang2['max_upload'];
                $uplCount = intval($bilang2['document_count']);

                    if($filang == $count){
                        return 1;
                    }else{
                        $updateUserProfile = array(
                            'destination'=>$fileName,
                            'file_size'=>$new_size,
                            'date_created'=>$date,
                        ); 

                        $this->database->table( 'user_documents' );
                        $this->database->where( 'user_id', $user_iid);
                        $this->database->where( 'id', $docuID,'and');
                        $update = $this->database->runUpdateQuery( $updateUserProfile );

                        $countd = array(
                            'document_count'=>$uplCount+1,
                        ); 

                        $this->database->table( 'document_count' );
                        $this->database->where( 'user_id', $user_iid);
                        $update = $this->database->runUpdateQuery( $countd );

                    }

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

    public function uploadavatars(){

        $date = date("Y-m-d H:i:s");
        $session = new Session();
        $role =  $session->get('user_session');
        $uploadTo = $_SERVER['DOCUMENT_ROOT'].'/assets/images/users/'; // upload directory
        $allowFileType = array('jpg', 'png', 'jpeg', 'heic', 'heif');
        $fileName = date("mdyHis"). '_' .$_FILES['image']['name'];
        $tempPath=$_FILES["image"]["tmp_name"];
        $file_size = $_FILES['image']['size'];

        $new_size = $file_size/1024;  

        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                // Upload file to server 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    // write here sql query to store image name in database

                    $updateUserProfileavatar = array(
                        'avatar'=>$fileName,
                        'updated_at'=>$date,
                    ); 

                    $this->database->table( 'users' );
                    $this->database->where( 'id', $role);
                    $updateava = $this->database->runUpdateQuery( $updateUserProfileavatar );
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

        $role =  $session->get('user_session');

        $selectmedi = '*';

        $this->database->table( 'applicant_profile' );

        $this->database->where( 'user_id', $role);

        $this->database->fetch( Database::PDO_FETCH_SINGLE );

        

        $useremed = $this->database->runSelectQuery( $selectmedi );

    

        // return the data

        return $useremed;

    }



    public function getDocuments(){

        require_once('./classes/session.php');

        

        $session = new Session();

        $role =  $session->get('user_session');

        $selectEXP = '*';

        $this->database->table( 'user_documents' );

        $this->database->where( 'user_id', $role);

        $this->database->fetch( Database::PDO_FETCH_MULTI );

        

        $usereXP = $this->database->runSelectQuery( $selectEXP );

    

        // return the data

        return $usereXP;

    }



    public function deleteDocuments(){



        $user_id=$_POST['user_id'];

        $this_id=$_POST['this_id'];



        $deleteDoc = array(

            'destination'=>'',

            'file_size'=>'',

        ); 

       

        $this->database->table( 'user_documents' );

        $this->database->where( 'id', $this_id );

        $this->database->where( 'user_id',$user_id,'AND');

        $deleteUser = $this->database->runUpdateQuery( $deleteDoc );

        return 1;

    }



    public function requestDocuments(){

        $date = date("Y-m-d H:i:s");
        $user_id=$_POST['user_id'];
        $this_id=$_POST['this_id'];

        $req = array(
            'request_for_edit'=>3,
            'date_requested'=>$date,
        ); 

        $this->database->table( 'user_documents' );
        $this->database->where( 'id', $this_id );
        $this->database->where( 'user_id',$user_id,'AND');
        $deleteUser = $this->database->runUpdateQuery( $req );
        return 1;
    }

    public function user_change_password_from_forgot_password($email, $password){
        $row = array(
            'password' => $password,
            'updated_at' => date('Y-m-d h:i:s')
        );

        $this->database->table( 'users' );
        $this->database->where( 'email', $email);
        $update = $this->database->runUpdateQuery( $row );

        return 1;
    }

   

    public function userChangePass(){

        $id =$_POST['uid'];

        $pass1 =$_POST['pass1'];

        $pass2 =$_POST['pass2'];

         $date = date("Y-m-d H:i:s");

         if($pass1 == $pass2){

            $upPass = array(

                'password'=>password_hash($_POST['pass1'],PASSWORD_DEFAULT),

                'updated_at'=>$date,

            );

            $this->database->table( 'users' );

                $this->database->where( 'id', $id);

                $update = $this->database->runUpdateQuery( $upPass );

                return 1;

         }else{
            return 2;
         }
    }

    public function get_document_data($id){
        $this->database->table('user_documents_beta');
        $this->database->where('id', $id);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery('*');
        return $query;
    }

    public function get_trainee_by_email($email){
        $this->database->table('users');
        $this->database->where('email', $email);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery('email');
        return $query;
    }

    public function add_trainee($row){
        $this->database->table('users');
        $sql = $this->database->runInsertQuery($row);

        $this->database->table('users');
        $this->database->where('id', $sql);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery('*');
        return $query;
    }

    public function update_trainee_deployment_date($date, $trainee){
        date_default_timezone_set('Asia/Manila');
        $row = array(
            'deployment_date' => date('Y-m-d', strtotime($date)),
            'updated_at' => date('Y-m-d')
        );

        $this->database->table('users');
        $this->database->where('id', $trainee);
        $this->database->runUpdateQuery($row);
        
        return 1;
    }

    public function approve_employee_status($id){
        $row = array(
            'is_active' => 1,
            'updated_at' => date('Y-m-d')
        );

        $this->database->table('users');
        $this->database->where('id', $id);
        $this->database->runUpdateQuery($row);
        return 1;
    }

    public function suspend_employee_status($id){
        $row = array(
            'is_active' => 0,
            'updated_at' => date('Y-m-d')
        );

        $this->database->table('users');
        $this->database->where('id', $id);
        $this->database->runUpdateQuery($row);
        return 1;
    }

}
    



?>

