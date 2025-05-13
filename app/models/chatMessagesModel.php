<?php

	class chatMessagesModel extends Model {
        public function add($table, $row){
            $this->database->table($table);
            $query = $this->database->runInsertQuery($row);
            return $query;
        }

        public function save_chat_message($from, $to, $message){

            $row = array(
                'chat_from' => $from,
                'chat_to' => $to,
                'message' => $message,
                'is_seen' => 0
            );

            $this->database->table('chat_messages');
            $id = $this->database->runInsertQuery( $row );
            $data = $this->get_chat_information($id);

            return $data;

        }

        public function get_chat_information($id){

            $this->database->table('chat_messages as t1');
            $this->database->join('left', 'users as t2', 't1.chat_from = t2.id');
            $this->database->join('left', 'users as t3', 't1.chat_to = t3.id');
            $this->database->where('t1.id', $id);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $data = $this->database->runSelectQuery('t1.*, t2.first_name as sender, t3.email');

            return $data;
        }

        public function admin_get_chats($user_id){
            
            $this->database->table('chat_messages as t1');
            $this->database->join('left', 'users as t2', 't1.chat_from = t2.id');
            $this->database->join('left', 'users as t3', 't1.chat_to = t3.id');
            $this->database->where('t1.chat_to', $user_id);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $admin_to_user = $this->database->runSelectQuery( 't1.*, t2.first_name as sender_name, t3.first_name as receiver_name' );

            $this->database->table('chat_messages as t1');
            $this->database->join('left', 'users as t2', 't1.chat_from = t2.id');
            $this->database->join('left', 'users as t3', 't1.chat_to = t3.id');
            $this->database->where('t1.chat_from', $user_id);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $user_to_admin = $this->database->runSelectQuery( 't1.*, t2.first_name as sender_name, t3.first_name as receiver_name' );

            $combined = array_merge($admin_to_user, $user_to_admin);
            usort($combined, function($a, $b){
                return $a['id'] - $b['id'];
            });

            return $combined;
        }

        public function get_unread_messages(){
            
            $this->database->table('chat_messages as t1');
            $this->database->join('left', 'users as t2', 't1.chat_from = t2.id');
            $this->database->join('left', 'users as t3', 't1.chat_to = t3.id');
            $this->database->where('t1.chat_to', '1');
            $this->database->where('t1.is_seen', '0', 'AND');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery( 't1.id, t1.chat_from, t2.first_name, t2.last_name, t1.message' );

            return $query;
        }

        public function is_seen_true_admin($uid){
            $row = array(
                'is_seen' => 1
            );

            $this->database->table('chat_messages');
            $this->database->where('chat_from', $uid);
            $this->database->runUpdateQuery( $row );

            return 1;
        }

        public function is_seen_true_trainee($uid){
            $row = array(
                'is_seen' => 1
            );

            $this->database->table('chat_messages');
            $this->database->where('chat_to', $uid);
            $this->database->runUpdateQuery( $row );

            return 1;
        }

        public function count_unseen_chats($id){
            $this->database->table('chat_messages as t1');
            $this->database->where('chat_to', $id);
            $this->database->where('is_seen', 0, 'AND');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('t1.id');
            return count($query);
        }

        public function get_one_conversation_by_where($where){
            $this->database->table('chat_conversation');
            $this->database->where($where[0], $where[1]);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery('*');
            return $query;
        }

        public function get_all_conversations() {
            $this->database->table('chat_conversation');
            $this->database->orderBy('date_created', 'desc');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('*');
            return $query;
        }

        public function get_all_conversation_by_where($where, $where0 = null) {
            $this->database->table('chat_conversation');
            $this->database->where($where[0], $where[1]);
            if($where0){
                $this->database->where($where0[0], $where0[1], 'AND');
            }

            $this->database->orderBy('date_created', 'desc');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('*');
            return $query;
        }

        public function get_all_chats_by_where($where){
            $this->database->table('chat_messages as t1');
            $this->database->join('left', 'users as t2', 't1.chat_from = t2.id');
            $this->database->join('left', 'users as t3', 't1.chat_to = t3.id');
            $this->database->where($where[0], $where[1]);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('t1.id, t1.chat_from, t1.chat_to, t1.message, t1.is_seen, t1.date_created, t2.first_name as from_fname, t2.last_name as from_lname, t3.first_name as to_fname, t3.last_name as to_lname');
            return $query;
        }

        public function get_all_conversation_of_user($id, $status = null){
            $ids_compiled = [];
            $convos_all = [];

            $this->database->table('chat_messages');
            $this->database->where('chat_from', $id);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $ids_from = $this->database->runSelectQuery('conversation_id');

            $this->database->table('chat_messages');
            $this->database->where('chat_to', $id);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $ids_to = $this->database->runSelectQuery('conversation_id');
            
            foreach($ids_from as $id){
                if(!in_array($id['conversation_id'], $ids_compiled)){
                    array_push($ids_compiled, $id['conversation_id']);
                }
            }

            foreach($ids_to as $id){
                if(!in_array($id['conversation_id'], $ids_compiled)){
                    array_push($ids_compiled, $id['conversation_id']);
                }
            }

            krsort($ids_compiled);

            foreach($ids_compiled as $id){
                if($id){
                    $convos = $this->get_one_conversation_by_where(['id', $id]);
                    $convos['chats'] = $this->get_all_chats_by_where(['conversation_id', $id]);
                    array_push($convos_all, $convos);
                }
            }

            return $convos_all;
        }

        public function add_conversation_log($row){
            $this->database->table('chat_conversation_logs');
            $query = $this->database->runInsertQuery($row);

            return $query;
        }

        public function set_conversation_status($where, $row){
            require_once('./classes/session.php');
			session_start();
			$session = new Session();

            $this->database->table('chat_conversation');
            $this->database->where($where[0], $where[1]);
            $query = $this->database->runUpdateQuery($row);

            $row2 = [
                'conversation_id' => $where[1],
                'status' => $row['status'],
                'updated_by' => $session->get('user_session'),
                'date_created' => $row['date_updated']
            ];

            $this->database->table('chat_conversation_logs');
            $query2 = $this->database->runInsertQuery( $row2 );

            return 1;
        }

        public function get_conversation_log_history($ticket){
            $this->database->table('chat_conversation');
            $this->database->where('ticket', $ticket);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery('id');

            $this->database->table('chat_conversation_logs as t1');
            $this->database->join('left', 'chat_conversation as t2', 't1.conversation_id = t2.id');
            $this->database->join('left', 'users as t3', 't1.updated_by = t3.id');
            $this->database->where('t1.conversation_id', $query['id']);
            $this->database->orderBy('t1.date_created', 'desc');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query0 = $this->database->runSelectQuery('t1.status, t3.first_name, t3.last_name, t1.date_created');

            return $query0;
        }

        public function delete_conversation_by_ticket($ticket){
            $this->database->table('chat_conversation');
            $this->database->where('ticket', $ticket);
            $this->database->runDeleteQuery();
            return 1;
        }

        public function get_department_by_keyword($id){
            $this->database->table('chat_keywords');
            $this->database->where('id', $id);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $keyword = $this->database->runSelectQuery('*');
            return $keyword;
        }

        public function update_chat_conversation_by_where($where, $row){
            $this->database->table('chat_conversation');
            $this->database->where($where[0], $where[1]);
            $query = $this->database->runUpdateQuery($row);
            return $query;
        }

        public function save_transfer_log($row){
            $this->database->table('transfer_message_logs');
            $query = $this->database->runInsertQuery($row);
            return $query;
        }

        public function get_transfer_message_logs_by_where($where){
            $this->database->table('transfer_message_logs');
            $this->database->where($where[0], $where[1]);
            $this->database->orderBy('date_created', 'desc');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('*');
            return $query;
        }

        public function get_transfer_message_logs_full_details_by_where($where){
            $this->database->table('transfer_message_logs as t1');
            $this->database->join('left', 'departments as t2', 't1.transfer_from = t2.id');
            $this->database->join('left', 'departments as t3', 't1.transfer_to = t3.id');
            $this->database->join('left', 'users as t4', 't1.transfer_by = t4.id');
            $this->database->where($where[0], $where[1]);
            $this->database->orderBy('date_created', 'desc');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery('t1.id, t1.ticket_id, t2.description as from_desc, t3.description as to_desc, t4.first_name, t4.last_name, t1.transfer_reason, t1.date_created');
            return $query;
        }
        

    }

?>

