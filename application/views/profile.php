<main class="container">
    <div class="mx-auto">

    </div>
    <section id="infos" class="card cols-lg-6 shadow-md mx-auto">
        <div id="info">
            <div class="imgcontainer mt-2 d-flex justify-content-center">
                <img src="<?= base_url() ?>assets/images/P.png" alt="Avatar" class="avatar mx-auto ">
            </div>

            <p>Name: <?= $this->session->userdata('user_data')['names'];?></p>
            <p>Gender: <?= $this->session->userdata('user_data')['gender'];?></p>
            <p>Contact: 0<?= $this->session->userdata('user_data')['contact'];?></p>
            <p>Email: <?= $this->session->userdata('user_data')['email'];?></p>
            <p>Registration Date: <?= $this->session->userdata('user_data')['register'];?></p>
        </div>
    </section>
    <section class="card p-2 mb-5">
        <div class="row row-cols-md-2 row-cols-1  gap-2 mb-1">
            <div class="col icols-lg-4 shadow border rounded">
                <?php
                    if($this->session->flashdata('update')){
                        ?>
                            <div class="alert alert-danger text-dark text-center mt-2">
                                <?= $this->session->flashdata('update'); ?>
                            </div>
                        <?php
                    }                
                ?>
                <h6 class="text-center h3">Change password</h6>
                <div class="signup-form mb-2 p-2">
                    <form action="<?= base_url('change_password')?>" method="post">
                        <div class="form-group row">
                            <label class="col-6 form-label">Old password <b class="text-danger">*</b></label>
                            <div class="col-6">
                                <input type="password" class="form-input w-100" name="oldpass" >
                                <small class="fs-1 text-danger m-0 text-center"><?= form_error('oldpass')?></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-6 form-label">New password <b class="text-danger">*</b></label>
                            <div class="col-6">
                                <input type="password" class="form-input w-100" name="newpass" minlength="8">
                                <small class="fs-1 text-danger m-0 text-center"><?= form_error('newpass')?></small>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-6">Confirm password <b class="text-danger">*</b></label>
                            <div class="col-6">
                                <input type="password" class="form-input w-100" name="newpass2" minlength="8">
                                <small class="fs-1 text-danger m-0 text-center"><?= form_error('newpass2')?></small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-lg bg-primary mt-2" name="clientchange">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col icols-lg-8 cardy shadow border rounded">
                <h6 class="text-center h2">Update user details</h6>
                <div class="signup-form">
                    <form action="" method="POST">
                        <div class="form-group row">
                            <label class="col-5">Username (First and Last) <b class="text-danger">*</b></label>
                            <input type="text" class="form-control col-6" name="username" required="required" value="<?= $this->session->userdata('user_data')['names'];?>">
                        </div>
                        <div class="form-group row">
                            <label for="formFileMultiple" class="form-label col-5">Gender <b class="text-danger">*</b></label>
                            <select name="gender" class="form-select col-6" aria-label="Disabled select example" required>
                                <option selected value="<?= $this->session->userdata('user_data')['gender'];?>"></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-5">Phone Number <b class="text-danger">*</b></label>
                            <input type="text" class="form-input col-6" name="phone" required="required" value="0<?= $this->session->userdata('user_data')['contact'];?>">
                        </div>
                        <div class="form-group row">
                            <label class="col-5">Email Address <b class="text-danger">*</b></label>
                            <input type="email" class="form-input col-6" name="email" required="required" value="<?= $this->session->userdata('user_data')['email'];?>">
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-blocky btn-lg mt-2 mb-2 w-50" name="updateDetails">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <style>
        img.avatar {
            width: 7%;
            border-radius: 10%;
            margin-bottom: 0;
        }

        #info {
            padding: 10px;
            border: groove;
            text-align: center;
            margin: 0.5%;
            font-size: large;
        }
    </style>
</main>