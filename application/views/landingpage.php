<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="container">

    </header>
    <main class="container">
        <div class="mt-5 text-light text-center">.</div>
        <div class="card mt-5 mx-auto col-lg-6 shadow-lg">
            <div class="h1 text-center text-danger">M <span class="h2 text-primary">Logistics</span></div>
            <?php
                if($this->session->flashdata('fail')){
                    ?>
                        <div class="alert alert-danger text-dark text-center">
                            <?= $this->session->flashdata('fail'); ?>
                        </div>
                    <?php
                }                
            ?>
            <form action="<?= base_url('log_in')?>" method="post">
                <div class="form-group pl-1 pr-1">
                    <label for="" class="form-label">Email Address <span class="text-danger h4">*</span></label>
                    <input type="text" class="form-control" name="userMail" value="<?= set_value('userMail')?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('userMail')?></small>
                </div>
                <div class="form-group pl-1 pr-1 mt-0">
                    <label for="" class="form-labely">Password <span class="text-danger h4">*</span></label>
                    <input type="password" class="form-control" name="userPassword">
                    <small class="fs-1 text-danger m-0"><?= form_error('userPassword')?></small>
                </div>
                <div class="d-flex justify-content-around mt-1 mb-2">
                        <div>
                            <button type="submit" class="btn btn-lg bg-primary p-1 w-100" name="Request" type="submit">Log In</button>
                        </div>
                        <div class="mt-1 text-center p-0">
                            Forgot password ? <br>
                            <a href="#">Reset Here</a>
                        </div>
                    </div>
            </form>
        </div>

    </main>
    <footer class="container">
        <div class="bg-dark text-center text-light fs-0 fixed-bottom">
            Copyright <?= date('Y')?><br>
            M Logistics
        </div>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/jquery/jquery.min.js')?>"></script>
</body>
</html>