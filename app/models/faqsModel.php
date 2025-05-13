<?php

    class faqsModel extends Model{
        public function get_all_faqs(){
            

            $this->database->table('faqs as t1');
            $this->database->join('left', 'departments as t2', 't1.department = t2.id');
            $this->database->where('t1.status', 'active');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery( 't1.*, t2.description' );
            return $query;
        }

        public function get_all_faqs_parent(){
            $this->database->table('faqs as t1');
            $this->database->join('left', 'departments as t2', 't1.department = t2.id');
            $this->database->where('t1.status', 'active');
            $this->database->where('t1.is_parent', 1, 'AND');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery( 't1.*, t2.description' );
            return $query;
        }

        public function get_faq_info($id){
            $this->database->table('faqs as t1');
            $this->database->join('left', 'departments as t2', 't1.department = t2.id');
            $this->database->where('t1.id', $id);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery('t1.*, t2.id as department, t2.description');
            return $query;
        }

        public function get_faq_parent($id){
            $this->database->table('faqs_sub');
            $this->database->where('faq_id', $id);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery('*');

            return $query;
        }

        public function get_all_sub_faqs($parent_id){
            $this->database->table('faqs_sub as t1');
            $this->database->join('left', 'faqs as t2', 't1.faq_id = t2.id');
            $this->database->join('right', 'departments as t3', 't2.department = t3.id');
            $this->database->where('t1.faq_parent', $parent_id);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('t1.*, t2.question, t2.answer, t3.id as department, t3.description');
            return $query;
        }

        public function add_message_faq($post){

            if(array_key_exists('messages-faqs-checkbox', $post)){
                $row = array(
                    'question' => $post['question'],
                    'answer' => $post['answer'],
                    'department' => $post['department'],
                    'is_parent' => 0
                );
            }else{
                $row = array(
                    'question' => $post['question'],
                    'answer' => $post['answer'],
                    'department' => $post['department'],
                    'is_parent' => 1
                );
            }

            $this->database->table('faqs');
            $message = $this->database->runInsertQuery( $row );

            if(array_key_exists('messages-faqs-checkbox', $post)){
                $row0 = array(
                    'faq_id' => $message,
                    'faq_parent' => $post['question-parent']
                );

                $this->database->table('faqs_sub');
                $faq_sub = $this->database->runInsertQuery( $row0 );
            }

            return $message;

        }

        public function check_if_sub_faq($id){
            $this->database->table('faqs_sub');
            $this->database->where('faq_parent', $id);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('id');
            return $query;
        }

        public function delete_faq($id){
            $this->database->table('faqs');
            $this->database->where('id', $id);
            $this->database->runDeleteQuery();
            return 1;
        }

        public function edit_message_faq($post){
            date_default_timezone_set('Asia/Manila');
    
            $row = array(
                'question' => $post['question'],
                'answer' => $post['answer'],
                'department' => $post['department'],
                'date_updated' => date('Y-m-d H:i:s')
            );
    
            $this->database->table('faqs');
            $this->database->where('id', $post["faq-id"]);
            $update = $this->database->runUpdateQuery( $row );
    
            return 1;
        }

        public function add($row, $table){
            $this->database->table($table);
            $query = $this->database->runInsertQuery( $row );
            return $query;
        }

        public function get_all_keywords(){
            $this->database->table('chat_keywords as t1');
            $this->database->join('left', 'departments as t2', 't1.department = t2.id');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery( 't1.*, t2.description as dept_desc' );
            return $query;
        }

        public function get_all_by_where($where, $table){
            $this->database->table($table);
            $this->database->where($where);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery( '*' );
            return $query;
        }

        public function get_one_by_where($where, $table){
            $this->database->table($table);
            if(count($where) > 1){
                $this->database->where($where[0]);
                for($i = 1; $i < count($where); $i++){
                    $this->database->where($where[$i], 'AND');
                }
            }else{
                $this->database->where($where);
            }
           
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery( '*' );
            return $query;
        }
    }

?>