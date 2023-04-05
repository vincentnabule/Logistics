
<main class="container">
    <div class="card mx-auto col-lg-10 shadow-lg mt-2">
        <div class="h1 text-info text-center mt-0 md-mt-4 mb-0">New User</div>
        <div class="h6 text-danger mt-0 text-center">Fill all the details to create account</div>
        <form action="<?= base_url('register') ?>" method="post">
            <div class="user_form p-2">
                <div class="form-group">
                    <label for="" class="form-label">First Name <span class="text-danger h5"> * </span></label>
                    <input type="text" class="form-control" name="userFirstName" value="<?= set_value('userFirstName')?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('userFirstName')?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Last Name <span class="text-danger h5"> * </span></label>
                    <input type="text" class="form-control" name="userLastName" value="<?= set_value('userLastName')?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('userLastName')?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Gender <span><b class="text-danger">*</b></span></label>
                    <select name="usersGender" class="form-control" value="<?= set_value('usersGender')?>">
                        <option value=" " selected disabled>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <small class="fs-1 text-danger m-0"><?= form_error('usersGender')?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email Address <span><b class="text-danger">*</b></span></label>
                    <input type="text" class="form-control" name="userMail" value="<?= set_value('userMail')?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('userMail')?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Phone Number <span><b class="text-danger">*</b></span></label>
                    <input type="text" class="form-control" name="userPhone" value="<?= set_value('userPhone')?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('userPhone')?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">User Role <span><b class="text-danger">*</b></span></label>
                    <select name="userRole" class="form-control">
                        <option value="" selected disabled>Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                        <option value="Driver">Driver</option>
                        <option value="Truck Owner">Truck Owner</option>
                    </select>
                    <small class="fs-1 text-danger m-0"><?= form_error('userRole')?></small>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-2 mt-2">
                <button class="btn btn-primary btn-lg" name="add-user" type="submit">Add User</button>
            </div>
        </form>
    </div>
</main>