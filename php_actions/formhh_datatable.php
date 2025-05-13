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
   $searchQuery = " AND (households.hh_code LIKE :hh_code or 
        households.sitio LIKE :sitio OR barangays.barangay LIKE :barangay ) ";
   $searchArray = array( 
        'hh_code'=>"%$searchValue%", 
        'sitio'=>"%$searchValue%",
        'barangay'=>"%$searchValue%"
   );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM households ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM households LEFT JOIN barangays on households.brgy_id=barangays.id WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT households.* ,barangays.barangay FROM households LEFT JOIN barangays on households.brgy_id=barangays.id WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
      "hh_code"=>$row['hh_code'],
      "sitio"=>$row['sitio'],
      "barangay"=>$row['barangay'],
      
      "action"=>"<button class='btn btn-sm btn-primary' id='view_hh' hh-id =".$row['id']."><i class='fas fa-edit'i></i> Edit</button>
      <button class='btn btn-sm btn-success' id='manage_hh' hh-id =".$row['id']."><i class='fas fa-list'i></i> Manage</button>
      <button class='btn btn-sm btn-danger' id='del_hh' hh-id =".$row['id']."><i class='fas fa-trash'i></i> Delete</button>
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
