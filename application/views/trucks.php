<main class="container">
    <?php
        if($this->session->userdata('authentication') == 'Admin'){
            ?>     
                <div class="modal fade" id="truckModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mx-auto text-primary" id="exampleModalLabel">New Truck</h5>
                            </div>
                            <div class="modal-body">
                                <small class="text-danger text-center mx-auto">Add truck owners and Drivers before adding their trucks</small>
                                <form action="<?= base_url('new_truck') ?>" method="post">
                                    <div class="form-group row">
                                        <label class="form-label col-6">Truck Reg</label>
                                        <input type="text" class="form-input col-5" name="truckReg" placeholder="KAC 120Y" required minlength="8" maxlength="8">
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="form-label col-6">Truck Owner</label>
                                        <select name="truckOwner" id="" class="col-5" required>
                                            <option value="" selected disabled>Select Truck Owner</option>
                                            <?php
                                                foreach ($users as $user) {
                                                    if ($user->user_role == 'Truck Owner') {
                                                    ?>
                                                            <option value="<?= $user->user_names ?>"><?= $user->user_names ?></option>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="form-label col-6">Truck Driver</label>
                                        <select name="truckDrive" id="" class="col-5" required>
                                            <option value="" selected disabled>Select Truck Driver</option>
                                            <?php
                                                foreach ($users as $user) {
                                                    if ($user->user_role == 'Driver') {
                                                    ?>
                                                            <option value="<?= $user->user_names ?>"><?= $user->user_names ?></option>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="form-label col-6">Truck Fuel</label>
                                        <select name="truckFuel" id="" class="col-5" required>
                                            <option value="" selected disabled>Select Fuel</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="Petrol">Petrol</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary btn-md w-75">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end m-2">
                    <button class="btn-primary m-2 btn-md" data-bs-toggle="modal" data-bs-target="#truckModal">Add Truck</button>
                </div>
                <table class="table table-responsivue table-stripped">
                    <thead class="table-primary">
                        <th>Truck Number</th>
                        <th>Truck Reg</th>
                        <th>Truck Fuel</th>
                        <th>Truck Driver</th>
                        <th>Added on</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($trucks as $truck){
                                $date = explode(' ', $truck->added_date);
                                if($truck->truck_status == 'Available'){
                                    $text = 'text-primary';
                                }else{
                                    $text = 'text-danger';
                                }
                                ?>
                                    <tr>
                                        <td><?= $truck->truck_id ?></td>
                                        <td><a href="<?= base_url('')?>truck/<?= $truck->truck_reg ?>"><?= $truck->truck_reg ?></a></td>
                                        <td><?= $truck->truck_fuel ?></td>
                                        <td><?= $truck->truck_driver ?></td> 
                                        <td><?= $date[0] ?></td>  
                                        <th class="<?= $text ?>"><?= $truck->truck_status ?></th>                      
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
        }else{
            ?>
                <div class="h2 text-center text-primary">My Trucks</div>
                <table class="table table-responsivue table-stripped">
                    <thead class="table-primary">
                        <th>Truck Number</th>
                        <th>Truck Reg</th>
                        <th>Truck Fuel</th>
                        <th>Truck Driver</th>
                        <th>Added on</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($my_trucks as $truck){
                                $date = explode(' ', $truck->added_date);
                                if($truck->truck_status == 'Available'){
                                    $text = 'text-primary';
                                }else{
                                    $text = 'text-danger';
                                }
                                ?>
                                    <tr>
                                        <td><?= $truck->truck_id ?></td>
                                        <td><a href="<?= base_url('')?>truck/<?= $truck->truck_reg ?>"><?= $truck->truck_reg ?></a></td>
                                        <td><?= $truck->truck_fuel ?></td>
                                        <td><?= $truck->truck_driver ?></td> 
                                        <td><?= $date[0] ?></td>  
                                        <th class="<?= $text ?>"><?= $truck->truck_status ?></th>                      
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
        }
    ?>
    <?php
        // var_dump($my_trucks);
    ?>
</main>