<?php
include './connection/db.php';
$user_id = $_POST['extra_search'];
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
   $searchQuery = " AND (users.last_name LIKE :last_name or 
        users.email LIKE :email) ";
   $searchArray = array( 
        'residents.email'=>"%$searchValue%", 
        'residents.last_name'=>"%$searchValue%",
   );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM users ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM users WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT users.*,applicant_profile.contact_number  FROM users LEFT JOIN applicant_profile on applicant_profile.user_id=users.id WHERE 1 and users.id=:user_id ".$searchQuery." ORDER BY users.".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

// Bind values
foreach($searchArray as $key=>$search){
   $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':user_id', $user_id);
$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
$count=1;
foreach($empRecords as $row){
   
   $data[] = array(
      "id"=>$count,
      "first_name"=>$row['first_name'].' '.$row['last_name'],
      "email"=>$row['email'],
      "contact_number"=>$row['contact_number'],
  "action"=>"<button class='btn btn-sm btn-warning' id='user_suspend' user-id =".$row['id']."><i class='dripicons-warning'></i> Suspend</button> <button class='btn btn-sm btn-danger' id='del_user' usesr-id =".$row['id']."><i class='dripicons-document-delete'></i> Delete</button>"
  
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
