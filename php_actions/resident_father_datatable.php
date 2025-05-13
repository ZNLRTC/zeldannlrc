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
        fname LIKE :fname) ";
   $searchArray = array( 
        'lname'=>"%$searchValue%", 
        'fname'=>"%$searchValue%",
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
foreach($empRecords as $row){
   $data[] = array(
    "id"=>$count,
      "lname"=>$row['lname'],
      "fname"=>$row['fname'],
      "mname"=>$row['mname'],
      "date_of_birth"=>$row['date_of_birth'],
      
      "action"=>"<button class='btn btn-sm btn-primary' id='res_father' res-id-father =".$row['id']."><i class='fas fa-check'i></i> </button>
      
      "
     
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
