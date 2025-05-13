<?php

class blogsModel extends Model{

    public function get($id = null){

        if($id){
            $this->database->where('id', $id);
        }

        $this->database->table('blogs');
        $this->database->orderBy('date_created', 'desc');
        $this->database->fetch(Database::PDO_FETCH_MULTI);
        $query = $this->database->runSelectQuery( '*' );

        if($id){
            return $query[0];
        }else{
            return $query;
        }
        
    }

	public function get_latest_blog(){
        $this->database->table('blogs');
        $this->database->orderBy('date_created', 'desc');
        $this->database->fetch(Database::PDO_FETCH_SINGLE);
        $query = $this->database->runSelectQuery( '*' );

        return $query;
        
    }

    public function save_blog($title, $content, $imageUrl){
        $row = array(
			'title' => $title,
			'image' => $imageUrl,
			'content' => $content
		);

		$this->database->table('blogs');
		$query = $this->database->runInsertQuery($row);
		return $query;
    }

    public function fetch_blog_data($id){
        $this->database->table('blogs');
		$this->database->where('id', $id);
		$this->database->fetch( Database::PDO_FETCH_SINGLE );
		$query = $this->database->runSelectQuery('*');
		return $query;
    }

    public function update_blog($id, $title, $content, $imageUrl){
        if($imageUrl != null){
			$row = array(
                'title' => $title,
				'content' => $content,
				'image' => $imageUrl,
				'date_updated' => date('Y-m-d h:i:s')
			);
		}else{
			$row = array(
				'title' => $title,
				'content' => $content,
				'date_updated' => date('Y-m-d h:i:s')
			);
		}

		$this->database->table('blogs');
		$this->database->where('id', $id);
		$this->database->runUpdateQuery( $row );
		return 1;
    }

	public function deleteBlog($id){
		$this->database->table('blogs');
		$this->database->where('id', $id);
		$this->database->runDeleteQuery();
		return 1;
	}
}
?>