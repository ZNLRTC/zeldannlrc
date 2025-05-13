<?php
include './connection/db.php';

if(isset($_POST["import"])){
    $fileName = $_FILES["excel"]["name"];
    $fileExtension = explode('.', $fileName);
$fileExtension = strtolower(end($fileExtension));
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads/" . $newFileName;
    move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

   

    require '../app/assets/phpreader/excel_reader2.php';
    require '../app/assets/phpreader/SpreadsheetReader.php';

    $reader = new SpreadsheetReader($targetDirectory);

    
        try {
            $conn->beginTransaction(); 
            $sqla = "INSERT INTO residents(lname, fname, mname, extname, igorot_name, father_id, mother_id, sex, cstatus, date_of_birth, place_of_birth, permanent_add, contact_no, email, occupation, place_of_employment, salary_ave, educational_att, entered_by) VALUES(:lname,:fname,:mname,:extname,:igorot_name,:father_id,:mother_id,:sex,:cstatus,:dob,:pob,:permanent_add,:contact_no,:email,:occupation,:place_of_employment,:salary_ave,:educational_att,:entered_by)";
            $stmtcp= $conn->prepare($sqla);
            foreach($reader as $key => $row){
            $resultcp = $stmtcp->execute(
                array(
                    ':lname' => strtoupper($row[1]),
                    ':fname' => strtoupper($row[2]),
                    ':mname' => strtoupper($row[3]),
                    ':extname' => strtoupper($row[4]),
                    ':igorot_name' => strtoupper($row[5]),
                    ':father_id' => $row[6],
                    ':mother_id' => $row[7],
                    ':sex' => $row[8],
                    ':cstatus' => $row[9],
                    ':dob' => $row[10],
                    ':pob' => $row[11],
                    ':permanent_add' => strtoupper($row[12]),
                    ':contact_no' => $row[13],
                    ':email' => $row[14],
                    ':occupation' => strtoupper($row[15]),
                    ':place_of_employment' => strtoupper($row[16]),
                    ':salary_ave' => $row[17],
                    ':educational_att' => strtoupper($row[18]),
                    ':entered_by' => $row[19],
                  
                   
                )
            );
        }
            $conn->commit();
           // header('Location:./mswd');
            exit;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            echo json_encode(0);
        }

  

    echo "<script>alert('Succesfully Imported'); /*document.location.href = '';*/</script>";
       
}
?>
