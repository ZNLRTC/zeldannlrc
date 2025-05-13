<?php

class priorityUserDocumentsToLinkModel extends Model{
    
    

    public function save_prio($email){
        date_default_timezone_set('Asia/Manila');
        $row = array(
            'email' => $email,
            'date_created' => date('Y-m-d H:i:s'),
            'date_updated' => date('Y-m-d H:i:s'),
        );

        $this->database->table('priority_user_documents_to_link');
        $sql = $this->database->runInsertQuery($row);

        return $sql;
    }

    public function get_prio_by_email($email){
        $this->database->table('priority_user_documents_to_link');
        $this->database->where('email', $email);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery('*');
        return $query;
    }

    public function save_complete_doc($email){
        date_default_timezone_set('Asia/Manila');
        $row = array(
            'email' => $email,
            'date_created' => date('Y-m-d H:i:s'),
            'date_updated' => date('Y-m-d H:i:s'),
        );

        $this->database->table('document_complete');
        $sql = $this->database->runInsertQuery($row);

        return $sql;
    }

    public function get_doc_complete_by_email($email){
        $this->database->table('document_complete');
        $this->database->where('email', $email);
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery('*');
        return $query;
    }
    
}

?>