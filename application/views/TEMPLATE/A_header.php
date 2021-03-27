<!-- ADMIN - HEADER -->

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
    <!-- Theme | Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/PLUGINS') ?>/Bootstrap_4.4.1/css/bootstrap.min.css">

    <!-- JQUERY -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->

    <!-- JQUERY -->
    <script src="<?= base_url('assets/PLUGINS/jQuery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/PLUGINS/jQuery/jquery-validate.js') ?>"></script>
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

<body class="hold-transition">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://www.polban.ac.id/">
                <img src="<?= base_url('assets/IMAGES/polban.png') ?>" width="30" height="30" class="d-inline-block align-top mr-3" alt="">
                CS UPTK
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown ml-5">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            MASTER
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url('ADMIN/cDosen') ?>">Dosen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item disabled" href="#">Jurusan</a>
                            <a class="dropdown-item disabled" href="#">Program Studi</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown ml-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            SETUP
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url('ADMIN/cUser') ?>">Users</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown ml-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            LAB
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item disabled" href="#">Jadwal</a>
                            <a class="dropdown-item" href="<?= base_url('ADMIN/cHistory') ?>">History</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown ml-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            LAYANAN
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item disabled" href="#">Pengaduan Fasilitas</a>
                            <a class="dropdown-item" href="<?= base_url('ADMIN/cKetinggalan') ?>">Barang Ketinggalan</a>
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?= strtoupper($user) ?>
                            </span>
                        </a>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#modal-logout-confirmation" data-toggle="modal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>