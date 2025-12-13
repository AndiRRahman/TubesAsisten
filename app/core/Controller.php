<<<<<<< HEAD
<?php

class Controller{
    public function view($view, $data = []){
        require_once '../app/views/' . $view . '.php';
    }
    public function model($model){
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
=======
<?php 

class Controller{
>>>>>>> 1712172c625f182224bd38de46fbfb387fbb0f33
    
}