<?php

	class documentTypeModel extends Model {
        public function getDocumentTypes(){
            $select = '*';
            $this->database->table('document_type');
            $this->database->where('status', 'active');
            $this->database->fetch(Database::PDO_FETCH_MULTI);

            $types = $this->database->runSelectQuery( $select );
            return $types;
        }
    }

?>

