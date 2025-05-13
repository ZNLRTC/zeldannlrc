<?php
include './connection/db.php';

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
   $searchQuery = " AND (lname LIKE :lname or 
        fname LIKE :fname or igorot_name LIKE :igorot_name) ";
   $searchArray = array( 
    'lname'=>"%$searchValue%", 
    'fname'=>"%$searchValue%", 
    'igorot_name'=>"%$searchValue%",
   );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM residents ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM residents WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Total number of resident in household
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM residents WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];
## Fetch records
$stmt = $conn->prepare("SELECT *  FROM residents WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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

foreach($empRecords as $row2){
   
   
   if($row2['deceased'] == 1){
      $action = "<button class='btn btn-sm btn-warning' id='del_resident' res-id-res =".$row2['id']." disabled>Deceased </button>";
   }else{
      $action = "<button class='btn btn-sm btn-primary' id='view_resident'  res-id-res ='".$row2['id']."'><i class='fas fa-eye'i></i> </button>  <button class='btn btn-sm btn-danger' id='del_resident' res-id-res =".$row2['id']."><i class='fas fa-trash'i></i> </button> ";
   }
   $data[] = array(
         
    "id"=>$count,
      "lname"=>$row2['lname'].', '.$row2['fname'].' '.$row2['mname'],
      "igorot_name"=>$row2['igorot_name'],
      "date_of_birth"=>$row2['date_of_birth'],
      "permanent_add"=>$row2['permanent_add'],
      "contact_no"=>$row2['contact_no'],
      "occupation"=>$row2['occupation'],
      "place_of_employment"=>$row2['place_of_employment'],
      "action"=>$action,
     
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
