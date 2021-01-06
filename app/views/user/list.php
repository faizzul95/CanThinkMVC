

<div class="container">
  <h2>Senarai Pengguna</h2>     
  <a href="<?php echo htmlspecialchars(base_url.'auth/logout');?>" class="btn btn-danger float-right" style="margin-bottom: 10px;"><span>Log Keluar</span></a>
  <button type="button" class="btn btn-primary float-right showAdd" data-toggle="modal" data-target="#userModal" style="margin-bottom: 10px;">
      Tambah Pengguna
  </button>    
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama Penuh</th>
        <th>Alamat Emel</th>
        <th>Peranan</th>
        <th>Status</th>
        <th>Sekolah</th>
        <th>Tindakan</th>
      </tr>
    </thead>
    <tbody>
        <?php 
            $count=1;
            foreach ($data['user'] as $row) { ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $row['user_fullname'] ?></td>
                    <td><?= $row['user_email'] ?></td>
                    <td><?= $row['role_name'] ?></td>
                    <td><?= $row['status_name'] ?></td>
                    <td><?= $row['school_name'] ?></td>
                    <td>
                        <a href="<?php echo htmlspecialchars(base_url.'user/update/'.$row['user_id']);?>" class="btn btn-success btn-sm showUpdate" data-toggle="modal" data-target="#userModal" data-id="<?= $row['user_id']; ?>">Kemaskini</a>
                        <a href="<?php echo htmlspecialchars(base_url.'user/delete/'.$row['user_id']);?>" class="btn btn-danger btn-sm" onclick="return confirm('Adakah anda pasti?')">Padam</a>
                    </td>
                    <?php $count++ ?>
                </tr>
    <?php       } ?>
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Tambah Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form id="formModal" action="<?php echo htmlspecialchars(base_url.'user/create');?>" method="post">

          <div class="form-group">
            <label for="user_fullname">Nama Penuh</label>
            <input type="text" class="form-control" id="user_fullname" name="user_fullname">
          </div>

          <div class="form-group">
            <label for="user_email">Alamat Emel</label>
            <input type="email" class="form-control" id="user_email" name="user_email">
          </div>

          <div class="form-group">
            <label for="user_username">Username</label>
            <input type="text" class="form-control" id="user_username" name="user_username">
          </div>

          <div class="form-group" id="passwordFill">
            <label for="user_password">Kata Laluan</label>
            <input type="password" class="form-control" id="user_password" name="user_password">
          </div>

          <div class="form-group">
            <label for="role_id">Peranan</label>
            <select class="form-control" id="role_id" name="role_id">
                <option value="1">Lembaga Peperiksaan Malaysia</option>
                <option value="2">Pentadbir</option>
                <option value="3">Guru</option>
                <option value="4">Ibu Bapa</option>
                <option value="5">Pelajar</option>
            </select>
          </div>

          <div class="modal-footer">
            <input type="text" name="user_id" id="user_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    $(function() {

        $('.showAdd').on('click', function() {
            
            $('#titleModal').html('Tambah Pengguna');
            $('.modal-footer button[type=submit]').html('Tambah');

        });

        $('#userModal').on('hidden.bs.modal', function () {
            // $(this).find('form').trigger('reset');
            document.getElementById("formModal").reset();
            $('#passwordFill').css('display', 'block');
        })

        $('.showUpdate').on('click', function() {

            $('#titleModal').html('Kemaskini Pengguna');
            $('.modal-footer button[type=submit]').html('Kemaskini');
            $('.modal-body form').attr('action', '<?= base_url; ?>user/update')

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url; ?>user/getupdate',
                data: {id : id},
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#user_fullname').val(data.user_fullname);
                    $('#user_email').val(data.user_email);
                    $('#user_username').val(data.user_username);
                    $('#user_password').val(data.user_password);
                    $('#role_id').val(data.role_id);
                    $('#user_id').val(data.user_id);
                    $('#passwordFill').css('display', 'none');
                }
            });

        });
    });

</script>





