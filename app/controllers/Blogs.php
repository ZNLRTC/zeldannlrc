<?php

	class Blogs extends Controller {
        
		public function index() {
            $data['blogs'] = $this->blogsModel->get();

			$data ['html_title'] ='Blogs | Zeldan Nordic Language Review & Trainind Center';
            $data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
            $data ['html_body'] =$this->Model->getViewHtml( 'blogs/blogs_body',$data);
            $data ['html_footer'] =$this->Model->getViewHtml( 'blogs/blogs_footer',$data);
            $this->loadView('template/main_html',$data);
		}

		public function blog(){
            $id = $_GET['id'];

            if(!$id){
                header('Location: https://www.nlrc.ph/blogs');
            }

            $data['blog'] = $this->blogsModel->get($id);
            $data['blogs'] = $this->blogsModel->get();
            $data['is_blog_post'] = true;

            // echo '<pre>';
            // print_r([$this->blogsModel->get($id), $this->blogsModel->get()]);

			$data ['html_title'] ='Blogs | Zeldan Nordic Language Review & Trainind Center';
            $data ['html_head'] =$this->Model->getViewHtml( 'guest/head_html',$data);
            $data ['html_body'] =$this->Model->getViewHtml( 'blogs/blogs_content',$data);
            $data ['html_footer'] =$this->Model->getViewHtml( 'blogs/blogs_footer',$data);
            $this->loadView('template/main_html',$data);
		}

	}

?>

