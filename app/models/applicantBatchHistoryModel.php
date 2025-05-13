<?php

class applicantBatchHistoryModel extends Model{

    public function get_batch_history($trainee_id = null){

        if($trainee_id){
            $this->database->where('t1.trainee_id', $trainee_id);
        }

        $this->database->table('applicant_batch_history as t1');
        $this->database->join('left', 'users as t2', 't1.trainee_id = t2.id');
        $this->database->join('left', 'users as t3', 't1.updated_by = t3.id');
        $this->database->orderBy('t1.date_created', 'desc');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery( 't1.id, t2.first_name as trainee_fname, t2.last_name as trainee_lname, t1.batch, t1.batch_number, .t3.first_name as admin_fname, t3.last_name as admin_lname, t1.date_created' );
        return $query;
    }
}
?>