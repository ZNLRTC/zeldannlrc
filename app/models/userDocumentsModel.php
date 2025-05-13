<?php

	class userDocumentsModel extends Model {
        public function get_user_document($user_id, $type){
            $select = '*';
            $this->database->table('user_documents_beta');
            $this->database->where('user_id', $user_id);
            $this->database->where('document_type_id', $type, 'AND');
            $this->database->fetch(Database::PDO_FETCH_SINGLE);

            $query = $this->database->runSelectQuery( $select );
            return $query;
        }

        public function add_document($user_id, $file_type, $file_name, $file_size_kb){

            $select = 'id';
            $this->database->table('document_type');
            $this->database->where('typename', $file_type);
            $this->database->fetch( Database::PDO_FETCH_SINGLE );
            $type = $this->database->runSelectQuery( $select );

            $row = array(
                'user_id' => $user_id,
                'document_type_id' => $type['id'],
                'path' => $file_name,
                'size' => $file_size_kb,

            );

            $this->database->table('user_documents_beta');
            $query = $this->database->runInsertQuery( $row );
            return $query;
        }

        public function request_delete_document($id, $message){
            $row = array(
                'message' => $message,
                'request_edit' => 1
            );

            $this->database->table('user_documents_beta');
            $this->database->where('id', $id);
            $query = $this->database->runUpdateQuery( $row );

            return 1;
        }

        public function delete_document($id){
            $this->database->table('user_documents_beta');
            $this->database->where('id', $id);
            $deleteUser = $this->database->runDeleteQuery();
            return 1;
        }

        public function get_document_info($id){
            $select = 't1.*, t2.description';
            $this->database->table('user_documents_beta as t1');
            $this->database->join('left', 'document_type as t2', 't1.document_type_id = t2.id');
            $this->database->where('t1.id', $id);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery( $select );

            return $query;
        }

        public function get_document_info_by_doc_type($id){
            $select = 't1.*, t2.description';
            $this->database->table('user_documents_beta as t1');
            $this->database->join('left', 'document_type as t2', 't1.document_type_id = t2.id');
            $this->database->where('t1.id', $id);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery( $select );

            return $query;
        }

        public function get_all_document_by_type($type, $user_id){

            
            $this->database->table('user_documents_beta');
            $this->database->where('user_id', $user_id);
            $this->database->where('document_type_id', $type, 'AND');
            $this->database->fetch( Database::PDO_FETCH_MULTI );
            $query = $this->database->runSelectQuery( '*' );

            return $query;


        }

        public function request_status_action($id, $action){
            $status = 0;
            if($action == 'approve'){
                $status = 2;
            }elseif($action == 'deny'){
                $status == 0;
            }

            $row = array(
                'request_edit' => $status,
                'date_updated' => date('Y-m-d H:i:s')
            );

            $this->database->table('user_documents_beta');
            $this->database->where('id', $id);
            $this->database->runUpdateQuery( $row );

            return 1;
        }
    }

?>

