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
}