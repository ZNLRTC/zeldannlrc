<?php

class guestModel extends Model{

	public function check_account($email){
        $select = 'users.password';
        $this->database->table('users');
        $this->database->where('email', $email);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery($select);
        return $query;
    }

	

	public function save_applicants(){

        require_once('./classes/db.php');


        $insert = array(

            'last_name'=>trim($_POST['lname']),

            'first_name'=>trim($_POST['fname']),

            'middlename'=>trim($_POST['mname']),

            'email'=>trim($_POST['email']),

            'password'=>password_hash($_POST['pass'],PASSWORD_DEFAULT),

            'date_joined'=>date("Y-m-d H:i:s"),

            'middlename'=>trim($_POST['mname']),

            'avatar'=>"avatar.png",
            
            'batch' => $_POST['register-batch-names'],

            'batch_number' => $_POST['register-batch-numbers'],

            'is_staff'=>'0',

            'is_superuser'=>'0',

            'is_active'=>'1',

        );

        

        

         $chkEmail = $_POST['email'];

                $sql = "select * from users where email = :email ";

				$handle = $db->prepare($sql);

				$params = ['email'=>$chkEmail];

				$handle->execute($params);

                if($handle->rowCount() > 0)

				{

                    return json_encode(1);

                }else{

                    $docum = '*';

                    $this->database->table( 'document_type' );

                    $this->database->fetch( Database::PDO_FETCH_MULTI );

                    $docus = $this->database->runSelectQuery( $docum );   

                    

                    $this->database->table( 'users' );

                    $insertData = $this->database->runInsertQuery( $insert );

                    $inserte = array(

                        'user_id'=>$insertData,

                    );

                    $counts = array(

                        'user_id'=>$insertData,

                        'max_upload'=> 15,

                    );

                    foreach($docus as $docs){

                        $insertedocu = array(

                            'user_id'=>$insertData,

                            'document_name'=>$docs['typename'],

                            'document_type_id'=>$docs['id'],

                        );

                        $this->database->table( 'user_documents');

                        $insertData3 = $this->database->runInsertQuery( $insertedocu );  

                    } 

                    $this->database->table( 'applicant_experience');

                    $insertData2 = $this->database->runInsertQuery( $inserte );

                    $this->database->table( 'applicant_profile');

                    $insertData2 = $this->database->runInsertQuery( $inserte );

                    $this->database->table( 'document_count' );

                    $update2 = $this->database->runInsertQuery( $counts );



                    return $insertData;



                }

        











        



    }



}



?>

