<?php
class Pages extends Controller{
    public function __construct(){
    }

    // default method
    public function index(){
        $data = array(
            'title' => 'MVC Framework'
        );
        $this->view('pages/index',$data);
    }

    public function about(){
        $data = array('title' => 'About Us');
        $this->view('pages/about', $data);
    }
}
?>
