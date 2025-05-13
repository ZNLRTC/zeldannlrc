<?php

	class Clearance extends Controller {
        
		public function index() {
			$data ['html_title'] ='Clearance | Zeldan Nordic Language Review & Trainind Center';
            $data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
            $data ['html_body'] =$this->Model->getViewHtml( 'blogs/blogs_body',$data);
            $data ['html_footer'] =$this->Model->getViewHtml( 'blogs/blogs_footer',$data);
            $this->loadView('template/main_html',$data);
		}

	}

?>

