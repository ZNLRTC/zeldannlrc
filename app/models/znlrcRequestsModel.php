<?php

class znlrcRequestsModel extends Model{
    
    public function save_request($user_id, $message){
        $insert = array(
            'user_id' => $user_id,
            'message' => $message
        );

        $this->database->table('znlrc_info_requests');
        $sql = $this->database->runInsertQuery($insert);

        return $sql;
    }

    public function get_user_pending_requests($id){
        $select = '*';
        $this->database->table('znlrc_info_requests');
        $this->database->where('user_id', $id);
        $this->database->where('status', 'pending', 'AND');
        $this->database->fetch( Database::PDO_FETCH_MULTI );

        $request = $this->database->runSelectQuery($select);
        return $request;
    }

    public function get_all_pending_requests(){
        $select = 't1.*, t2.first_name, t2.middlename, t2.last_name, t2.former_name, t2.email';
        $this->database->table('znlrc_info_requests as t1');
        $this->database->join('left', 'users as t2', 't1.user_id=t2.id');
        $this->database->where('status', 'pending' );
        $this->database->fetch( Database::PDO_FETCH_MULTI );

        $requests = $this->database->runSelectQuery($select);
        return $requests;
    }

    public function count_all_pending_requests(){
        $select = 't1.*, t2.first_name, t2.middlename, t2.last_name, t2.former_name, t2.email';
        $this->database->table('znlrc_info_requests as t1');
        $this->database->join('left', 'users as t2', 't1.user_id=t2.id');
        $this->database->where('status', 'pending' );
        $this->database->fetch( Database::PDO_FETCH_MULTI );

        $requests = $this->database->runSelectQuery($select);
        return count($requests);
    }
}

?>