<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<body>
    <header class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid mx-auto">
                <a class="navbar-brand" href="<?= base_url() ?>dashboard"><span class="h1 text-primary"> M </span> <span class="h3 text-danger"> Logistics</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php
                            if($this->session->has_userdata('authentication') && $this->session->userdata('authentication') == 'Admin'){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>all_trips">Trips</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= base_url() ?>all_users">Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= base_url() ?>new_user">Add User</a>
                                </li>
                                <?php
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url()?>trucks">Trucks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url() ?>my_profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active">
                                <button class="btn-outline-danger rounded" onclick="location.href='<?= base_url('logout')?>'">Sign Out</button>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>