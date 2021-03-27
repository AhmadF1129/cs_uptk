<!-- HEADER -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $title ?>
    </title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ICON -->
    <link rel="icon shortcut" href="<?= base_url('assets/IMAGES/polban.png') ?>">

    <!-- STYLE -->
    <!-- Icon | Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/PLUGINS') ?>/FontAwesome_5.11.2/css/all.min.css">
    <!-- Font | Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme | AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/PLUGINS') ?>/AdminLTE/css/adminlte.min.css">


    <!-- SCRIPT -->
    <!-- JQuery -->
    <script src="<?= base_url('assets/PLUGINS/jQuery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/PLUGINS/jQuery/jquery-validate.js') ?>"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
    <style>
        .error {
            color: red;
        }

        label,
        input {
            border: 0;
            margin-bottom: 3px;
            display: block;
            width: 100%;
        }
    </style>
</head>

<body class="hold-transition login-page bg-dark">