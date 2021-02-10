<?php

class Model
{
   public function __construct()
   {
       $this->session = new \Configuration\SessionManager();

       if (!$this->session->has('userID')) {
          header('Location: ' . base_url . 'auth/logout');
       }

   }

   public function model($model)
   {
        require_once '../app/models/'.$model . '.php';
        return new $model;
   }

   public function session()
   {
       $this->session = new \Configuration\SessionManager();

       if (!$this->session->has('userID')) {
          header('Location: ' . base_url . 'auth/logout');
       }
       
   }
}