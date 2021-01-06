<?php

class Flasher
{
    // action = save/create, delete, update
    // type = success, warning, danger, info / error (toastr)

	public static function setNotifications($action, $description, $type)
    {
        $_SESSION['flash'] = [
            'action' => $action,
            'description' => $description,
            'type' => $type,
        ];
    }

    public static function flashData()
    {
        if ( isset($_SESSION['flash']) ) 
        {
            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>';

            echo '<script type="text/javascript">
                var msg = "'.$_SESSION['flash']['description'].'";
                var title = "'.$_SESSION['flash']['action'].'";

                Command: toastr["'.$_SESSION['flash']['type'].'"](msg, title);

                toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": true,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "2500",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                  "preventOpenDuplicates": true
                }
            </script>';

            unset($_SESSION['flash']);
        }
    }


}