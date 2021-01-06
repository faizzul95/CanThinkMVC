<!DOCTYPE html>
<html>
<head>

    <title> Canteen | <?= $data['title']; ?> </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

    <div class="container">

        <?php Flasher::flashData(); ?>

        <form action="<?php echo htmlspecialchars(base_url.'auth/authorize');?>" method="post">

            <div class="form-group">
                <label for="username">Nama Pengguna</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="form-group">
                <label for="password">Kata Laluan</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Log Masuk</button>
            </div>
            
        </form>
    </div>

</body>
</html>