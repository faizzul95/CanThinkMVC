<?php

class Controller
{
    public function view($view, $data = [])
    {
        require_once '../app/views/'.$view . '.php';
    }

    public function render($view, $data = [])
    {
        include '../app/views/templates/header.php';
        include '../app/views/'.$view . '.php';
        include '../app/views/templates/footer.php';
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

    // set notification Toastr
    public function setToastr($type, $result)
    {
        
        if ($type == 'create') {

            if ($result > 0) {
                Flasher::setNotifications('Berjaya !', 'Berjaya Disimpan', 'success');
            }else{
                Flasher::setNotifications('Gagal !', 'Tidak Berjaya Disimpan', 'error');
            }

        }else if ($type == 'update') {

            if ($result > 0) {
                Flasher::setNotifications('Berjaya !', 'Berjaya Dikemaskini', 'success');
            }else{
                Flasher::setNotifications('Gagal !', 'Tidak Berjaya Dikemaskini', 'error');
            }

        }else if ($type == 'delete') {

            if ($result > 0) {
                Flasher::setNotifications('Berjaya !', 'Berjaya dihapus', 'success');
            }else{
                Flasher::setNotifications('Gagal !', 'Tidak Berjaya Dihapus', 'error');
            }
            
        }
        
    }

    // return result in json
    public function jsonResult($result){
        header("Content-type:application/json");
        echo json_encode($result);
    }

    private function encode_base64($sData) {
        $sBase64 = base64_encode($sData);
        return strtr($sBase64, '+/', '-_');
    }

    private function decode_base64($sData) {
        $sBase64 = strtr($sData, '-_', '+/');
        return base64_decode($sBase64);
    }

    public function normalcomma($array){
        $str = implode (",", $array);
        return $str;
    }

    public function explode($array){
        $str = explode(',', $array);
        return $str;
    }

    public function merge($array,$array2){
        $str = array_merge($array,$array2);
        return $str;
    }

    public function addcomma($array){
        $comma_separated = implode(',', array_map(function($i) { return $i; }, $array));
        return $comma_separated;
    }

    public function countcomma($str){
        if($str!=NULL){
            $count = substr_count( $str, ",") +1;
            return $count;
        }else{
            return 0;
        }
    }

    public function date_format($str, $type){
        if($str!=NULL){
            if($type==1){
                $date = date('d-m-Y',strtotime($str));
            }
            if($type==2){
                $date = date('Y-m-d',strtotime($str));
            }
            if($type==3){
                $date = date('d F Y',strtotime($str));
            }
            if($type==4){ 
                $date = date('Ymd',strtotime($str));
            }
            if($type==5){
                $date = date('d-M-Y',strtotime($str));
            }
            return $date;
        }else{
            return 0;
        }
    }

    public function error($type = NULL){

        if ($type == '403') {

            $data = [
                'title' => '403 ACCESS FORBIDDEN',
            ];

            $this->view('error/403', $data);

        }else if ($type == '404') {

            $data = [
                'title' => '404 Page Not Found',
            ];

            $this->view('error/404', $data);

        }else if ($type == '500') {

            $data = [
                'title' => '500 Internal Errors',
            ];

            $this->view('error/500', $data);
        }

    }

}