<?php
	
	class maintenanceModel extends Model {
		
        public function getPageText() {
			// get page text from database or code
			return USE_DATABASE ? $this->getPageTextFromDatabase() : $this->getPageTextFromCode();
		}

	
		public function getPageTextFromCode() {
			print_r( array( // page info
				'info' => array(
					'title' => 'ZNLRC-Logout',
					'content' => ' content',
				),
			));
		}
        public function getPageTextFromDatabase() {
		
        }

    }
