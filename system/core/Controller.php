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

}