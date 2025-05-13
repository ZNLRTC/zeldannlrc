<?php

class requestAccessModel extends Model{
    public function add($row){
        date_default_timezone_set('Asia/Manila');

        $this->database->table('request_access');
        $query = $this->database->runInsertQuery($row);

        return $query;
    }

    public function get_all(){
        $this->database->table('request_access as t1');
        $this->database->join('left', 'users as t2', 't1.user_id = t2.id');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery('t1.*, t2.first_name, t2.last_name');
        return $query;
    }

    public function get_all_pending(){

        $this->database->table('request_access as t1');
        $this->database->join('left', 'users as t2', 't1.user_id = t2.id');
        $this->database->where('t1.status', 'pending');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery('t1.*, t2.first_name, t2.last_name');
        return $query;
    }

    public function get_all_approved_from($date = null, $time = null){

        $this->database->table('request_access as t1');
        $this->database->join('left', 'users as t2', 't1.user_id = t2.id');
        $this->database->where('t1.status', 'approved');

        if($date){
            $this->database->where('t1.date', $date, 'AND');
        }
        if($time){
            $this->database->where('t1.access_from', $time, 'AND');
        }

        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery('t1.*, t2.first_name, t2.last_name');
        return $query;
    }

    public function get_all_approved_to($date = null, $time = null){

        $this->database->table('request_access as t1');
        $this->database->join('left', 'users as t2', 't1.user_id = t2.id');
        $this->database->where('t1.status', 'approved');

        if($date){
            $this->database->where('t1.date', $date, 'AND');
        }
        if($time){
            $this->database->where('t1.access_to', $time, 'AND');
        }

        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery('t1.*, t2.first_name, t2.last_name');
        return $query;
    }

    public function get_row($id){
        $this->database->table('request_access');
        $this->database->where('id', $id);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery('*');
        return $query;
    }

    public function approve_request($id){
        $row = array(
            'status' => 'approved'
        );
        
        $this->database->table('request_access');
        $this->database->where( 'id', $id);
        $this->database->runUpdateQuery( $row );
        return 1;
    }
    
}

?>