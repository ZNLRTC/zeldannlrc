<?php

class applicantApprovalLogsModel extends Model{
    
    public function save_log($trainee, $admin, $action){
        date_default_timezone_set('Asia/Manila');
        $row = array(
            'trainee_id' => $trainee,
            'updated_by' => $admin,
            'approval_status' => $action,
            'date_created' => date('Y-m-d H:i:s')
        );

        $this->database->table('applicant_approval_logs');
        $query = $this->database->runInsertQuery( $row );
        return $query;
    }

    public function get_log_info($id){
        $this->database->table('applicant_approval_logs as t1');
        $this->database->join('left', 'users as t2', 't1.trainee_id = t2.id');
        $this->database->join('right', 'users as t3', 't1.updated_by = t3.id');
        $this->database->where('t1.trainee_id', 59);
        $this->database->orderBy('t1.date_created', 'desc');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $log = $this->database->runSelectQuery( 't1.*, t2.first_name as trainee_fname, t2.last_name as trainee_lname, t3.first_name as admin_fname, t3.last_name as admin_lname' );

        return $log;
    }
    
}

?>