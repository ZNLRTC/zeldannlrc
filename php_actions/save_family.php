<?php
include './connection/db.php';


         $fam_father_id=$_POST['fa_id'];
         $fam_mother_id=$_POST['mother_id'];
         $fam_child_id=$_POST['child_id'];
         $hh_id=$_POST['hh_id'];

         $relation_father = $_POST['father_relation'];
         $relation_mother = $_POST['mother_relation'];

         if(!empty($_POST['hh_head'])){
            $hhead= $fam_father_id;
         }elseif(!empty($_POST['hh_head_mother'])){
            $hhead= $fam_mother_id;

         }else{
            $hhead= 0;
         }

         if(!empty($fam_father_id)){
            $family_name = strtoupper($_POST['fa_lname'].'-'.$_POST['fa_fname'].'-FAM');

         }
         if(!empty($fam_mother_id)){
            $family_name = strtoupper($_POST['mo_lname'].'-'.$_POST['mo_fname'].'-FAM');

         }

        try {
            $conn->beginTransaction(); 
           
            $sqlc = "INSERT INTO families VALUES ('',:fam_name,:hhid,:head_id)";
            $stmtc= $conn->prepare($sqlc);
           
            $resultc = $stmtc->execute(
             array(
               ':fam_name' => $family_name,
               ':hhid' => $hh_id,
               ':head_id' => $hhead,
             )
           );
            $fam_id = $conn->lastInsertId();
            $sqltrain = "INSERT INTO family_members VALUES ('',:family_id,:resident_id,:relationship)";
            $stmttrain= $conn->prepare($sqltrain);
            $relationship=3;
            if(!empty($fam_father_id)){
                $resulttrain = $stmttrain->execute(
                    array(
                        ':family_id' => $fam_id,
                        ':resident_id' => $fam_father_id,
                        ':relationship' => $relation_father, 
                    )
                  );
            }
            if(!empty($fam_mother_id)){
                $resulttrain = $stmttrain->execute(
                    array(
                 ':family_id' => $fam_id,
                  ':resident_id' => $fam_mother_id,
                  ':relationship' => $relation_mother,  
                    )
                  );
            }
          

            if(is_array($_POST['child_id']) ) {
             for($i = 0; $i < count($_POST['child_id']); $i++) {
               echo $_POST['child_id'][$i];
               $child_id = $_POST['child_id'][$i];
               $resulttrain = $stmttrain->execute(
                 array(
                   ':family_id' => $fam_id,
                   ':resident_id' => $child_id,
                   ':relationship' => $relationship,
                 )
               );
             }
           }
           
           $success=0;
           echo json_encode($success);
           
           $conn->commit();
           }
           catch (PDOException $e) {
             echo $e->getMessage();
             echo json_encode(0);
           }
           








?>
