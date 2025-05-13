<?php

class batchModel extends Model{

    public function get_all_batches(){
        $this->database->table('applicant_batch as t1');
        $this->database->join('left', 'users as t2', 't1.added_by = t2.id');
        $this->database->orderBy('t1.name', 'asc');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery( 't1.id, t1.name, t1.status, t2.first_name, t2.last_name' );
        return $query;
    }

    public function get_batch_by_name($name){
        $this->database->table('applicant_batch');
        $this->database->where('name', $name);
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery('*');
        return $query;
    }

    public function get_batch_number_name_and_number($id){
        $this->database->table('applicant_batch_number as t1');
        $this->database->join('left', 'applicant_batch as t2', 't1.batch = t2.id');
        $this->database->where('t1.id', $id);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery('t2.name, t1.batch_number');
        return $query;
    }

    public function get_all_batch_number_by_batch_id($id){
        $this->database->table('applicant_batch_number');
        $this->database->where('batch', $id);
        $this->database->orderBy('batch_number', 'asc');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery('batch_number');
        return $query;
    }

    public function get_all_trainees_under_batch($batch){
        $this->database->table('users');
        $this->database->where('batch', $batch['name']);
        $this->database->where('batch_number', $batch['batch_number'], 'AND');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery( 'id' );
        return $query;
    }
    
    public function add_batch($name, $admin){
        date_default_timezone_set('Asia/Manila');

        $row = array(
			'name' => strtolower($name),
			'added_by' => $admin,
			'date_created' => date('Y-m-d H:i:s')
		);

        $this->database->table('applicant_batch');
        $query = $this->database->runInsertQuery ($row);
        return $query;
    } 

    public function edit_batch($name, $admin, $id){
        date_default_timezone_set('Asia/Manila');

        $row = array(
			'name' => strtolower($name),
			'added_by' => $admin,
			'date_created' => date('Y-m-d H:i:s')
		);

        $this->database->table('applicant_batch');
        $this->database->where('id', $id);
        $query = $this->database->runUpdateQuery ($row);
        return 1;
    } 

    public function delete_batch($id){
        $this->database->table('applicant_batch');
        $this->database->where('id', $id);
        $this->database->runDeleteQuery();
        return 1;

    }

    public function get_all_batch_numbers($batch = null){

        if($batch){
            $this->database->where('t1.batch', $batch);
        }

        $this->database->table('applicant_batch_number as t1');
        $this->database->join('left', 'users as t2', 't1.added_by = t2.id');
        $this->database->join('left', 'applicant_batch as t3', 't1.batch = t3.id');
        $this->database->orderBy('t1.batch_number', 'asc');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery( 't1.id, t3.name, t1.batch_number, t2.first_name, t2.last_name, t1.status' );
        return $query;
    }

    public function add_batch_number($batch, $number, $admin){
        date_default_timezone_set('Asia/Manila');
        $row = array(
            'batch' => $batch,
            'batch_number' => $number,
            'added_by' => $admin,
            'date_created' => date('Y-m-d H:i:s'),
            'date_updated' => date('Y-m-d H:i:s')
        );

        $this->database->table('applicant_batch_number');
        $query = $this->database->runInsertQuery( $row );
        return $query;
    }

    public function check_batch($id){
        $this->database->table('applicant_batch_number');
        $this->database->where('batch', $id);
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery( '*' );

        return $query;
    }

    public function check_batch_number($name, $num){

        $this->database->table('applicant_batch_number');
        $this->database->where('batch', $name);
        $this->database->where('batch_number', $num, 'AND');
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery( '*' );

        return $query;
    }

    public function edit_batch_number($id, $name, $number, $admin){
        date_default_timezone_set('Asia/Manila');
        $row = array(
            'batch' => $name,
            'batch_number' => $number,
            'added_by' => $admin,
            'date_updated' => date('Y-m-d H:i:s')
        );

        $this->database->table('applicant_batch_number');
        $this->database->where('id', $id);
        $query = $this->database->runUpdateQuery( $row );
        return 1;
    }

    public function delete_batch_number($data){
        $this->database->table('applicant_batch_number');
        $this->database->where('id', $data['id']);
        $this->database->runDeleteQuery();
        return 1;
    }

    public function count_trainee_under_batch($name, $num, $status = null){

        $this->database->table('users');
        $this->database->where('batch', $name);
        $this->database->where('batch_number', $num, 'AND');

        if($status){
            $this->database->where('flag_status', $status, 'AND');
        }

        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery( 'id' );
        return $query;
    }

    public function update_user_batch($trainee_id, $batch, $batch_num){
        $row = array(
            'batch' => $batch,
            'batch_number' => $batch_num,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->database->table('users');
        $this->database->where('id', $trainee_id);
        $query = $this->database->runUpdateQuery( $row );
        return $query;
    }

    public function save_batch_history_update($trainee_id, $admin_id, $batch, $batch_num){
        date_default_timezone_set('Asia/Manila');

        $row = array(
            'trainee_id' => $trainee_id,
            'batch' => $batch,
            'batch_number' => $batch_num,
            'updated_by' => $admin_id,
            'date_created' => date('Y-m-d H:i:s')
        );

        $this->database->table('applicant_batch_history');
        $query = $this->database->runInsertQuery( $row );
        return $query;
    }
    
}

?>