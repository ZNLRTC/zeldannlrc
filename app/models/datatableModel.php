<?php





class datatableModel extends Model{







public function getEmployees(){

        require_once('./classes/session.php');
        require_once('./classes/db.php');

        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        ## Search 
        $searchQuery = " ";
        if($searchValue != ''){
                $searchQuery = " AND (t2.first_name LIKE :first_name or t2.last_name LIKE :last_name OR t2.email LIKE :email or t3.description LIKE :department) ";

                $searchArray = array( 
                        'first_name'=>"%$searchValue%", 
                        'last_name'=>"%$searchValue%",
                        'email'=>"%$searchValue%",
                        'department'=>"%$searchValue%",
                );
        }



        ## Total number of records without filtering
        $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM employees");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM employees as t1 LEFT JOIN users as t2 ON t1.employee_id = t2.id RIGHT JOIN departments as t3 on t1.department_id = t3.id WHERE 1".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        //$stmt = $db->prepare("SELECT users.* ,applicant_profile.contact_number FROM users LEFT JOIN applicant_profile on users.id=applicant_profile.user_id WHERE 1 and users.is_staff != 0  ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

        $stmt = $db->prepare("SELECT t2.*, t3.description FROM employees as t1 LEFT JOIN users as t2 on t1.employee_id = t2.id RIGHT JOIN departments as t3 on t1.department_id = t3.id WHERE t2.is_staff != 0" .$searchQuery. "ORDER BY " .$columnName. " " .$columnSortOrder. " LIMIT :limit, :offset");

        // Bind values
        foreach($searchArray as $key => $search){
                $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        // echo '<pre>';
        // print_r($empRecords);
        // exit;

        $data = array();
        $count=1;
        foreach($empRecords as $row){

                if($row['is_active'] == 1 ){
                        $button = "<button class='btn btn-sm btn-warning' id='user_suspend' user-id =".$row['id']."><i class='dripicons-warning'></i> Suspend</button>";
                }else{
                        $button = "<button class='btn btn-sm btn-primary' id='user_active' user-id =".$row['id']."><i class='dripicons-return'></i> Activate</button>"; 
                }

                $data[] = array(
                        "id"=>$count,
                        "last_name"=>$row['first_name'].' '.$row['last_name'],
                        "email"=>$row['email'],
                        "contact_number"=>$row['description'],
                        "action"=> $button
                );
                
                $count++;

        }



        ## Response
        $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" =>$totalRecordwithFilter,
                "aaData" => $data
        );

        echo json_encode($response);
}

        
        public function getApplicants(){

                require_once('./classes/session.php');
                require_once('./classes/db.php');

                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                $batch = $_POST['batch-name'] .'-'. $_POST['batch-number'];
                $upcoming = $_POST['upcoming'];
                $year = $_POST['year'];
                $month = $_POST['month'];
                $batch_filter = "";

                // echo '<pre>';
                // print_r([$batch, $month, $year, $_POST['batch-status']]);
                // exit;

                if($batch == '0-0'){ // 0-0 meaning theres no batch number parameter
                        $status = $_POST['batch-status'];
                        if($_POST['batch-status']){
                                if($status == 'deployed'){
                                        if($year !== '0' && $month !== '0'){
                                                $batch_filter = " AND flag_status = '" . $status ."' AND YEAR(deployment_date) = ".$year." AND MONTH(deployment_date) = ".$month;
                                        }else{
                                                $batch_filter = " AND flag_status = '" . $status ."'";  
                                        }
                                }else{
                                        $batch_filter = " AND flag_status = '" . $status ."'";
                                }
                        }else{
                                $batch_filter = "";
                        } 
                        
                }else{
                        
                        $name = $_POST['batch-name'];
                        $number = $_POST['batch-number'];
                        $status = $_POST['batch-status'];

                        if($_POST['batch-status']){
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number." AND users.flag_status = '" . $status ."'";
                        }else{
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number;
                        }
                }

                if($upcoming == 1){
                        $batch_filter = $batch_filter . " AND deployment_date > CURDATE()";
                }

                $searchArray = array();

                ## Search 

                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " AND (users.first_name LIKE :first_name or users.last_name LIKE :last_name OR users.email LIKE :email OR users.batch LIKE :batch OR users.batch_number LIKE :batch_number ) ";
                        $searchArray = array( 

                                'first_name'=>"%$searchValue%", 
                                'last_name'=>"%$searchValue%",
                                'email'=>"%$searchValue%",
                                'batch'=>"%$searchValue%",
                                'batch_number'=>"%$searchValue%",

                        );
                }



                ## Total number of records without filtering

                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users WHERE is_staff =0 AND is_superuser =0" .$batch_filter);
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];

                ## Total number of records with filtering
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users  WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0 ".$batch_filter." ".$searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $stmt = $db->prepare("SELECT users.* ,applicant_profile.contact_number FROM users LEFT JOIN applicant_profile on users.id=applicant_profile.user_id WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0 ".$batch_filter." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder."  LIMIT :limit,:offset");

                // Bind values
                foreach($searchArray as $key=>$search){
                        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
                }


                $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
                $stmt->execute();
                $empRecords = $stmt->fetchAll();
                $data = array();
                $count=1;

                foreach($empRecords as $row){

                        $uid= $row['id'];

                                ## Total number of records requested

                        $stmt2 = $db->prepare("SELECT COUNT(*) AS allcountRequest FROM user_documents   WHERE user_documents.user_id = $uid AND user_documents.request_for_edit =3");
                        $stmt2->execute();
                        $recordsRequest = $stmt2->fetch();
                        $totalRecordsRequest = $recordsRequest['allcountRequest'];


                        if($totalRecordsRequest >= 1){
                                $req = "<i class='dripicons-warning' style='color:red;'> </i> &nbsp;  ";
                        }else{
                                $req = ""; 
                        }



                        if($row['middlename']){
                                $splitmname = str_split($row['middlename']);
                        }else{
                                $splitmname = [""];
                        }

                        $select_status = '<select class="form-select trainee-flag-status-btn" name="trainee-flag-status" data-user-id="'.$row["id"].'">
                                                <option class="status-active" value="active" '. ($row["flag_status"] == "active" ? "selected" : "") .'>Active</option>
                                                <option class="status-on-hold" value="on-hold" '. ($row["flag_status"] == "on-hold" ? "selected" : "") .'>On Hold</option>
                                                <option class="status-inactive" value="inactive" '. ($row["flag_status"] == "inactive" ? "selected" : "") .'>Inactive</option>
                                                <option class="status-quit" value="quit" '. ($row["flag_status"] == "quit" ? "selected" : "") .'>Quit</option>
                                                <option class="status-deployed" value="deployed" '. ($row["flag_status"] == "deployed" ? "selected" : "") .'>Deployed</option>
                                        </select>';
                                

                        if($row['is_approved'] == 1 ){
                                $button = "<button class='btn bg-none text-warning' id='disapprove' user-id =".$row['id']."><i class='fas fa-ban'></i> Disapprove</button>";
                                $status = "Approved";
                        }else if($row['is_approved'] == 0){
                                $button = "<button class='btn bg-none text-primary' id='user_approve' user-id =".$row['id']." data-url='".BASE_URL."'><i class='fas fa-check'></i> Approve</button>"; 
                                $status = "Pending";
                        }else{
                                $button = "<button class='btn bg-none text-warning' id='user_approve' user-id =".$row['id']." data-url='".BASE_URL."'><i class='fas fa-check'></i> Reconsider</button>"; 
                                $status = "Disapproved";
                        }

                        $full_name = $row['last_name'].", ".$row['first_name'];
                        $checkbox = "<input type='checkbox' value=".$row['id']." name='applicants-checkbox' data-trainee-email=".$row['email']." data-trainee-name='".$full_name."' data-trainee-batch=".strtoupper($row['batch']) .'-'. $row['batch_number']." data-current-status=".$row['flag_status'].">";
                        $batch_link = "<a href='applicants?batch=".$row['batch']."-".$row['batch_number']."'>".strtoupper($row['batch']) ." ". $row['batch_number']."</a>";
                        $dep_date = $row['deployment_date'] != null ? date('M d, Y', strtotime($row['deployment_date'])) : '<span class="opacity-25">No Record</span>';
                        $viewdoc="<button class='btn bg-none text-primary' id='view_user' user-id =".$row['id']."><i class='fas fa-eye'></i> View</button>";

                        $data[] = array(
                                "id"=> $checkbox,
                                "last_name"=> $row['last_name'].', '.$row['first_name'].' '.$splitmname[0],
                                "email"=>$row['email'],
                                "batch" => $batch_link,
                                "contact_number"=>$dep_date,
                                "status"=>$select_status,
                                "action"=>$viewdoc.' '. $button ." <button class='btn bg-none text-danger' id='del_Appli' user-id =".$row['id']."><i class='fas fa-trash-alt'></i> Delete</button>"
                        );

                        $count++;

                }

        

                ## Response

                $response = array(
                        "draw" => intval($draw),
                        "iTotalRecords" => $totalRecords,
                        "iTotalDisplayRecords" =>$totalRecordwithFilter,
                        "aaData" => $data
                );

                echo json_encode($response);

        }

        public function getApplicantsApproved(){

                require_once('./classes/session.php');
                require_once('./classes/db.php');

                ## Read value

                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                $batch = $_POST['batch-name'] .'-'. $_POST['batch-number'];
                $upcoming = $_POST['upcoming'];
                $year = $_POST['year'];
                $month = $_POST['month'];
                $batch_filter = "";

                if($batch == '0-0'){ // 0-0 meaning theres no batch number parameter
                        $status = $_POST['batch-status'];
                        if($_POST['batch-status']){
                                if($status == 'deployed'){
                                        if($year !== '0' && $month !== '0'){
                                                $batch_filter = " AND flag_status = '" . $status ."' AND YEAR(deployment_date) = ".$year." AND MONTH(deployment_date) = ".$month;
                                        }else{
                                                $batch_filter = " AND flag_status = '" . $status ."'";  
                                        }
                                }else{
                                        $batch_filter = " AND flag_status = '" . $status ."'";
                                }
                        }else{
                                $batch_filter = "";
                        } 
                        
                }else{
                        
                        $name = $_POST['batch-name'];
                        $number = $_POST['batch-number'];
                        $status = $_POST['batch-status'];

                        if($_POST['batch-status']){
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number." AND users.flag_status = '" . $status ."'";
                        }else{
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number;
                        }
                }

                if($upcoming == 1){
                        $batch_filter = $batch_filter . " AND deployment_date > CURDATE()";
                }

                $searchArray = array();



                ## Search 

                $searchQuery = " ";

                if($searchValue != ''){

                        $searchQuery = " AND (users.first_name LIKE :first_name or users.last_name LIKE :last_name OR users.email LIKE :email OR users.batch LIKE :batch OR users.batch_number LIKE :batch_number ) ";

                        $searchArray = array( 

                                'first_name'=>"%$searchValue%", 
                                'last_name'=>"%$searchValue%",
                                'email'=>"%$searchValue%",
                                'batch'=>"%$searchValue%",
                                'batch_number'=>"%$searchValue%",

                        );

                }



                ## Total number of records without filtering

                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users WHERE is_staff =0 AND is_superuser =0" . $batch_filter);
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];

                ## Total number of records with filtering

                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users  WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0  and users.is_approved = 1" . $batch_filter ." ". $searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];


                ## Fetch records

                $stmt = $db->prepare("SELECT users.* ,applicant_profile.contact_number FROM users LEFT JOIN applicant_profile on users.id=applicant_profile.user_id WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0  and users.is_approved = 1".$batch_filter." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder."  LIMIT :limit,:offset");

                // Bind values
                foreach($searchArray as $key=>$search){
                        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
                }


                $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
                $stmt->execute();
                $empRecords = $stmt->fetchAll();

                $data = array();
                $count=1;

                foreach($empRecords as $row){

                        $uid= $row['id'];

                        ## Total number of records requested

                        $stmt2 = $db->prepare("SELECT COUNT(*) AS allcountRequest FROM user_documents   WHERE user_documents.user_id = $uid AND user_documents.request_for_edit =3");
                        $stmt2->execute();
                        $recordsRequest = $stmt2->fetch();
                        $totalRecordsRequest = $recordsRequest['allcountRequest'];

                        if($totalRecordsRequest >= 1){
                                $req = "<i class='dripicons-warning' style='color:red;'> </i> &nbsp;  ";
                        }else{
                                $req = ""; 
                        }


                        if($row['middlename']){
                                $splitmname = str_split($row['middlename']);
                        }else{
                                $splitmname = [""];
                        }

                        $select_status = '<select class="form-select trainee-flag-status-btn" name="trainee-flag-status" data-user-id="'.$row["id"].'">
                                                <option class="status-active" value="active" '. ($row["flag_status"] == "active" ? "selected" : "") .'>Active</option>
                                                <option class="status-on-hold" value="on-hold" '. ($row["flag_status"] == "on-hold" ? "selected" : "") .'>On Hold</option>
                                                <option class="status-inactive" value="inactive" '. ($row["flag_status"] == "inactive" ? "selected" : "") .'>Inactive</option>
                                                <option class="status-quit" value="quit" '. ($row["flag_status"] == "quit" ? "selected" : "") .'>Quit</option>
                                                <option class="status-deployed" value="deployed" '. ($row["flag_status"] == "deployed" ? "selected" : "") .'>Deployed</option>
                                        </select>';
                                

                        if($row['is_approved'] == 1 ){
                                $button = "<button class='btn bg-none text-warning' id='disapprove' user-id =".$row['id']."><i class='fas fa-ban'></i> Disapprove</button>";
                                $status = "Approved";
                        }else{
                                $button = ""; 
                                $status = "";

                        }

                        $full_name = $row['last_name'].", ".$row['first_name'];
                        $checkbox = "<input type='checkbox' value=".$row['id']." name='applicants-checkbox' data-trainee-email=".$row['email']." data-trainee-name='".$full_name."' data-trainee-batch=".strtoupper($row['batch']) .'-'. $row['batch_number']." data-current-status=".$row['flag_status'].">";
                        $batch_link = "<a href='applicants?batch=".$row['batch']."-".$row['batch_number']."'>".strtoupper($row['batch']) ." ". $row['batch_number']."</a>";
                        $viewdoc="<button class='btn text-primary' id='view_user' user-id =".$row['id']."><i class='fas fa-eye'></i> View</button>";
                        $dep_date = $row['deployment_date'] != null ? date('M d, Y', strtotime($row['deployment_date'])) : '<span class="opacity-25">No Record</span>';

                        $data[] = array(

                                "id"=>$checkbox,
                                "last_name"=>$row['last_name'].', '.$row['first_name'].' '.$splitmname[0],
                                "email"=>$row['email'],
                                "batch" => $batch_link,
                                "contact_number"=>$dep_date,
                                "status"=>$select_status,
                                "action"=>$viewdoc.' '. $button ." <button class='btn bg-none text-danger' id='del_Appli' user-id =".$row['id']."><i class='fas fa-trash-alt'></i> Delete</button>"
                
                        );

                        $count++;

                }


                ## Response
                $response = array(
                        "draw" => intval($draw),
                        "iTotalRecords" => $totalRecords,
                        "iTotalDisplayRecords" =>$totalRecordwithFilter,
                        "aaData" => $data
                );

                echo json_encode($response);

        }

        public function getApplicantsdisapproved(){

                require_once('./classes/session.php');
                require_once('./classes/db.php');


                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                $batch = $_POST['batch-name'] .'-'. $_POST['batch-number'];
                $upcoming = $_POST['upcoming'];
                $year = $_POST['year'];
                $month = $_POST['month'];
                $batch_filter = "";

                if($batch == '0-0'){ // 0-0 meaning theres no batch number parameter
                        $status = $_POST['batch-status'];
                        if($_POST['batch-status']){
                                if($status == 'deployed'){
                                        if($year !== '0' && $month !== '0'){
                                                $batch_filter = " AND flag_status = '" . $status ."' AND YEAR(deployment_date) = ".$year." AND MONTH(deployment_date) = ".$month;
                                        }else{
                                                $batch_filter = " AND flag_status = '" . $status ."'";  
                                        }
                                }else{
                                        $batch_filter = " AND flag_status = '" . $status ."'";
                                }
                        }else{
                                $batch_filter = "";
                        } 
                        
                }else{
                        
                        $name = $_POST['batch-name'];
                        $number = $_POST['batch-number'];
                        $status = $_POST['batch-status'];

                        if($_POST['batch-status']){
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number." AND users.flag_status = '" . $status ."'";
                        }else{
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number;
                        }
                }

                if($upcoming == 1){
                        $batch_filter = $batch_filter . " AND deployment_date > CURDATE()";
                }

                $searchArray = array();


                ## Search 
                $searchQuery = " ";

                if($searchValue != ''){

                        $searchQuery = " AND (users.first_name LIKE :first_name or users.last_name LIKE :last_name OR users.email LIKE :email OR users.batch LIKE :batch OR users.batch_number LIKE :batch_number ) ";

                        $searchArray = array( 

                                'first_name'=>"%$searchValue%", 
                                'last_name'=>"%$searchValue%",
                                'email'=>"%$searchValue%",
                                'batch'=>"%$searchValue%",
                                'batch_number'=>"%$searchValue%",

                        );

                }



                ## Total number of records without filtering

                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users WHERE is_staff =0 AND is_superuser =0 and users.is_approved = 3" . $batch_filter);
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];

                ## Total number of records with filtering

                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users  WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0  and users.is_approved = 3".$batch_filter ." ". $searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records

                $stmt = $db->prepare("SELECT users.* ,applicant_profile.contact_number FROM users LEFT JOIN applicant_profile on users.id=applicant_profile.user_id WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0  and users.is_approved = 3".$batch_filter ." ". $searchQuery." ORDER BY ".$columnName." ".$columnSortOrder."  LIMIT :limit,:offset");



                // Bind values

                foreach($searchArray as $key=>$search){
                        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
                }

                $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
                $stmt->execute();
                $empRecords = $stmt->fetchAll();

                $data = array();
                $count=1;

                foreach($empRecords as $row){

                        if($row['middlename']){
                                $splitmname = str_split($row['middlename']);
                        }else{
                                $splitmname = [""];
                        }
                        
                        $select_status = '<select class="form-select trainee-flag-status-btn" name="trainee-flag-status" data-user-id="'.$row["id"].'">
                                                <option class="status-active" value="active" '. ($row["flag_status"] == "active" ? "selected" : "") .'>Active</option>
                                                <option class="status-on-hold" value="on-hold" '. ($row["flag_status"] == "on-hold" ? "selected" : "") .'>On Hold</option>
                                                <option class="status-inactive" value="inactive" '. ($row["flag_status"] == "inactive" ? "selected" : "") .'>Inactive</option>
                                                <option class="status-quit" value="quit" '. ($row["flag_status"] == "quit" ? "selected" : "") .'>Quit</option>
                                                <option class="status-deployed" value="deployed" '. ($row["flag_status"] == "deployed" ? "selected" : "") .'>Deployed</option>
                                        </select>';


                        

                        if($row['is_approved'] == 3 ){

                                $button = "<button class='btn bg-none text-warning' id='user_approve' user-id =".$row['id']." data-url='".BASE_URL."'><i class='fas fa-check'></i> Reconsider</button>"; 

                                $status = "Disaproved";

                        }else{
                                $button = ""; 
                                $status = "";
                        }

                        $full_name = $row['last_name'].", ".$row['first_name'];
                        $checkbox = "<input type='checkbox' value=".$row['id']." name='applicants-checkbox' data-trainee-email=".$row['email']." data-trainee-name='".$full_name."' data-trainee-batch=".strtoupper($row['batch']) .'-'. $row['batch_number']." data-current-status=".$row['flag_status'].">";
                        $batch_link = "<a href='applicants?batch=".$row['batch']."-".$row['batch_number']."'>".strtoupper($row['batch']) ." ". $row['batch_number']."</a>";
                        $viewdoc="<button class='btn bg-none text-primary' id='view_user' user-id =".$row['id']."><i class='fas fa-eye'></i> View</button>";
                        $dep_date = $row['deployment_date'] != null ? date('M d, Y', strtotime($row['deployment_date'])) : '<span class="opacity-25">No Record</span>';

                        $data[] = array(
                                "id"=>$checkbox,
                                "last_name"=>$row['last_name'].', '.$row['first_name'].' '.$splitmname[0],
                                "email"=>$row['email'],
                                "batch" => $batch_link,
                                "contact_number"=>$dep_date,
                                "status"=>$select_status,
                                "action"=>$viewdoc.' '. $button ." <button class='btn bg-none text-danger' id='del_Appli' user-id =".$row['id']."><i class='fas fa-trash-alt'></i> Delete</button>"

                        );

                $count++;

                }

                ## Response
                $response = array(
                        "draw" => intval($draw),
                        "iTotalRecords" => $totalRecords,
                        "iTotalDisplayRecords" =>$totalRecordwithFilter,
                        "aaData" => $data
                );

                echo json_encode($response);

        }

        public function getApplicantspending(){

                require_once('./classes/session.php');
                require_once('./classes/db.php');

        
                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value
                
                $batch = $_POST['batch-name'] .'-'. $_POST['batch-number'];
                $upcoming = $_POST['upcoming'];
                $year = $_POST['year'];
                $month = $_POST['month'];
                $batch_filter = "";

                if($batch == '0-0'){ // 0-0 meaning theres no batch number parameter
                        $status = $_POST['batch-status'];
                        if($_POST['batch-status']){
                                if($status == 'deployed'){
                                        if($year !== '0' && $month !== '0'){
                                                $batch_filter = " AND flag_status = '" . $status ."' AND YEAR(deployment_date) = ".$year." AND MONTH(deployment_date) = ".$month;
                                        }else{
                                                $batch_filter = " AND flag_status = '" . $status ."'";  
                                        }
                                }else{
                                        $batch_filter = " AND flag_status = '" . $status ."'";
                                }
                        }else{
                                $batch_filter = "";
                        } 
                        
                }else{
                        
                        $name = $_POST['batch-name'];
                        $number = $_POST['batch-number'];
                        $status = $_POST['batch-status'];

                        if($_POST['batch-status']){
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number." AND users.flag_status = '" . $status ."'";
                        }else{
                                $batch_filter = " AND users.batch = '".$name."' AND users.batch_number = ".$number;
                        }
                }
                
                if($upcoming == 1){
                        $batch_filter = $batch_filter . " AND deployment_date > CURDATE()";
                }

                $searchArray = array();

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){

                        $searchQuery = " AND (users.first_name LIKE :first_name or users.last_name LIKE :last_name OR users.email LIKE :email OR users.batch LIKE :batch OR users.batch_number LIKE :batch_number ) ";

                        $searchArray = array( 

                                'first_name'=>"%$searchValue%", 
                                'last_name'=>"%$searchValue%",
                                'email'=>"%$searchValue%",
                                'batch'=>"%$searchValue%",
                                'batch_number'=>"%$searchValue%",

                        );
                }



                ## Total number of records without filtering

                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users WHERE is_staff =0 AND is_superuser =0 and users.is_approved = 0" . $batch_filter);
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];



                ## Total number of records with filtering
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM users  WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0  and users.is_approved = 0".$batch_filter ." ". $searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];



                ## Fetch records
                $stmt = $db->prepare("SELECT users.* ,applicant_profile.contact_number FROM users LEFT JOIN applicant_profile on users.id=applicant_profile.user_id WHERE 1 AND users.is_staff = 0 and users.is_superuser = 0  and users.is_approved = 0".$batch_filter ." ". $searchQuery." ORDER BY ".$columnName." ".$columnSortOrder."  LIMIT :limit,:offset");



                // Bind values

                foreach($searchArray as $key=>$search){
                        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
                }


                $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
                $stmt->execute();
                $empRecords = $stmt->fetchAll();


                $data = array();
                $count=1;
                foreach($empRecords as $row){

                        $splitmname = str_split($row['middlename']);
                        $select_status = '<select class="form-select trainee-flag-status-btn" name="trainee-flag-status" data-user-id="'.$row["id"].'">
                                                <option class="status-active" value="active" '. ($row["flag_status"] == "active" ? "selected" : "") .'>Active</option>
                                                <option class="status-on-hold" value="on-hold" '. ($row["flag_status"] == "on-hold" ? "selected" : "") .'>On Hold</option>
                                                <option class="status-inactive" value="inactive" '. ($row["flag_status"] == "inactive" ? "selected" : "") .'>Inactive</option>
                                                <option class="status-quit" value="quit" '. ($row["flag_status"] == "quit" ? "selected" : "") .'>Quit</option>
                                                <option class="status-deployed" value="deployed" '. ($row["flag_status"] == "deployed" ? "selected" : "") .'>Deployed</option>
                                        </select>';


                        

                        if($row['is_approved'] == 0 ){

                                $button = "<button class='btn bg-none text-success' id='user_approve' user-id =".$row['id']." data-url='".BASE_URL."'><i class='fas fa-check'></i> Approve</button>"; 
                                $status = "Pending";

                        }else{
                                $button = ""; 
                                $status = ""; 
                        }

                        $viewdoc="<button class='btn bg-none text-primary' id='view_user' user-id =".$row['id']."><i class='fas fa-eye'></i> View</button>";
                        $full_name = $row['last_name'].", ".$row['first_name'];
                        $checkbox = "<input type='checkbox' value=".$row['id']." name='applicants-checkbox' data-trainee-email=".$row['email']." data-trainee-name='".$full_name."' data-trainee-batch=".strtoupper($row['batch']) .'-'. $row['batch_number']." data-current-status=".$row['flag_status'].">";
                        $batch_link = "<a href='applicants?batch=".$row['batch']."-".$row['batch_number']."'>".strtoupper($row['batch']) ." ". $row['batch_number']."</a>";
                        $dep_date = $row['deployment_date'] != null ? date('M d, Y', strtotime($row['deployment_date'])) : '<span class="opacity-25">No Record</span>';

                        $data[] = array(
                                "id"=>$checkbox,
                                "last_name"=>$row['last_name'].', '.$row['first_name'].' '.$splitmname[0],
                                "email"=>$row['email'],
                                "batch" => $batch_link,
                                "contact_number"=>$dep_date,
                                "status"=>$select_status,
                                "action"=>$viewdoc.' '. $button ." <button class='btn bg-none text-danger' id='del_Appli' user-id =".$row['id']."><i class='fas fa-trash-alt'></i> Delete</button>"
                        );

                        $count++;

                }


                ## Response
                $response = array(
                        "draw" => intval($draw),
                        "iTotalRecords" => $totalRecords,
                        "iTotalDisplayRecords" =>$totalRecordwithFilter,
                        "aaData" => $data
                );

                echo json_encode($response);
        }

        public function documentList(){

                require_once('./classes/session.php');
                require_once('./classes/db.php');
                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value
                $searchArray = array();


                ## Search 

                $searchQuery = " ";
                if($searchValue != ''){
                $searchQuery = " AND (document_type.typename LIKE :typename) ";
                $searchArray = array( 
                        'typename'=>"%$searchValue%", 
                );
                }


                ## Total number of records without filtering
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM document_type ");
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];


                ## Total number of records with filtering
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM document_type  WHERE 1 ".$searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];


                ## Fetch records
                $stmt = $db->prepare("SELECT document_type.*  FROM document_type  WHERE 1".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");


                // Bind values
                foreach($searchArray as $key=>$search){
                        $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
                }

                $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
                $stmt->execute();
                $empRecords = $stmt->fetchAll();
                $data = array();
                $count=1;

                foreach($empRecords as $row){

                        if($row['status'] == 'active'){
                                $archive_btn =  '<button class="btn btn-sm btn-warning archive-document-btn" data-action="archive" data-docu-id="'.$row["id"].'" data-docu-name="'.$row["typename"].'"><i class="fas fa-file-archive"></i> Archive</button>';
                        }else{
                                $archive_btn =  '<button class="btn btn-sm btn-success archive-document-btn" data-action="activate" data-docu-id="'.$row["id"].'" data-docu-name="'.$row["typename"].'"><i class="fas fa-file"></i> Activate</button>';
                        }

                        

                        $data[] = array(
                                "id"=>$count,

                                "typename"=>$row['typename'],

                                "action"=> ' <button class="btn btn-sm btn-primary" id="editDocuList" data-name="'.$row["typename"].'" data-description="'.$row["description"].'" editDocuList_id ="'.$row["id"].'"><i class="dripicons-document-edit"></i> Edit</button>  '.$archive_btn.' <button class="btn btn-sm btn-danger" id="delDocuList" delDocuList_id ="'.$row["id"].'"><i class="dripicons-document-delete"></i> Delete</button>'
                        );
                        $count++;
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" =>$totalRecordwithFilter,
                "aaData" => $data
                );
                echo json_encode($response);
        }
}







?>