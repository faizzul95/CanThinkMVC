<!DOCTYPE html>
<html>
<head>
	<title> Test Server Side DT </title>
</head>
<body>

	<table border="1" class="display" id="example" width="100%">
        <thead>
            <tr>
                <th width="40%">Full Name</th>
                <th width="40%">Name</th>
                <th width="10%">Username</th>
                <!-- <th width="10%">Password</th> -->
                <th width="10%">Action</th>
            </tr>
        </thead>
        <!-- <tbody>
            <tr>
                <td>loading...</td>
            </tr>
        </tbody> -->
    </table>

</body>
</html>

<script type="text/javascript">

    var table;

    $(document).ready(function(){
       listDt();
    });

    function listDt(){

        table = $('#example');
        table.DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'responsive' : true,
            'order': [[0, 'asc']],
            'ajax': {
                'url' : "<?= base_url; ?>user/getDataDt",
                'type': 'post'
            },
            'dataType' : "json",
            'deferRender': true,
            'aLengthMenu': [[15, 20, 50, 100], [15, 20, 50, 100]], 
            'columns': [
                {'data': 'user_fullname'},
                {'data': 'user_email'},
                {'data': 'user_username'},
                // {'data': 'user_password'},
                {'render': function(data, type, row){ 
                    var buttonAction = '<center>\
                                            <a class="btn btn-sm badge-success" href="' + 'edit/' + row.user_id + '">Edit</a>\
                                            <a class="btn btn-sm badge-danger" onclick="removeData(' + row.user_id + ')">Delete</a>\
                                        </center>';

                    return buttonAction;
                    }
                }
            ]
        });

    }

    function removeData(id){

    }

</script>