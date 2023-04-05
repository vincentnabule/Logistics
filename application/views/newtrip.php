<main class="container">
    <div class="card mx-auto col-lg-10 shadow-lg mt-2">
        <div class="h1 text-info text-center mt-0 md-mt-4 mb-0">New Trip</div>
        <div class="h6 text-danger mt-0 text-center">Enter trip details</div>
        <form action="<?= base_url('add_trip') ?>" method="post">
            <div class="user_form">
                <div class="form-group">
                    <label for="" class="form-label">Trip From</label>
                    <input type="text" class="form-control" name="tripFrom" value="<?= set_value('tripFrom') ?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('tripFrom') ?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Trip To</label>
                    <input type="text" class="form-control" name="tripTo" value="<?= set_value('tripTo') ?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('tripTo') ?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Truck</label>
                    <select name="truck" class="form-control">
                        <option value="<?= set_value('truck') ?>" selected disabled>Select Truck</option>
                        <?php
                            foreach($trucks as $truck){
                                if($truck->truck_status == 'Available'){
                                    ?>
                                        <option value="<?= $truck->truck_reg?>"><?= $truck->truck_reg?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <small class="fs-1 text-danger m-0"><?= form_error('truck') ?></small>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Trip Date</label>
                    <input type="date" class="form-control" name="tripDate" value="<?= set_value('tripDate') ?>" min="<?= date('Y-m-d')?>">
                    <small class="fs-1 text-danger m-0"><?= form_error('tripDate') ?></small>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Cargo Description</label> <br>
                <textarea class="form-control" name="cargo" id="" cols="30" rows="3" value="<?= set_value('cargo') ?>"></textarea>
                <small class="fs-1 text-danger m-0"><?= form_error('cargo') ?></small>
            </div>
            <div class="d-flex justify-content-center mb-2">
                <button class="btn btn-primary btn-lg w-75" type="submit">Save Trip</button>
            </div>
        </form>
    </div>
</main>