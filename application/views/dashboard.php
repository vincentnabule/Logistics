<main class="container">
    <?php
        if($this->session->userdata('authentication') == 'Admin'){
            ?>
                <div class="row">
                    <div class="col bg-primary text-center rounded m-2">
                        <div class="h4 text-center"><?= $trips_today?> <br> <span class="h5 text-light">Trips</span></div>
                    </div>
                    <div class="col bg-primary text-center rounded m-2">
                        <div class="h4 text-center"> <?= $trucks_count?> <br> <span class="h5 text-light">Trucks</span></div>
                    </div>
                    <div class="col bg-primary text-center rounded m-2">
                        <div class="h4 text-center"><?= $drivers?> <br> <span class="h5 text-light">Drivers</span></div>
                    </div>
                    <div class="col bg-primary text-center rounded m-2">
                        <div class="h4 text-center"><?= $staff ?> <br> <span class="h5 text-light">Staff</span></div>
                    </div>
                    <div class="col bg-primary text-center rounded m-2">
                        <div class="h4 text-center"><?= $owners ?> <br> <span class="h5 text-light">Truck Owners</span></div>
                    </div>
                </div>
                <div class="d-lg-flex justify-content-around">
                    <div class="card col-lg-7">
                        <div class="h2 text-center">Today Tips</div>
                        <table class="table">
                            <thead>
                                <th>Truck</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($trips as $trip){
                                        if($trip->trip_date == date('Y-m-d')){
                                            if($trip->trip_status != 'Completed'){
                                                $txt = 'primary';
                                            }else{
                                                $txt = 'danger';
                                            }
                                            ?>
                                                <tr>
                                                    <td><?= $trip->truck?></td>
                                                    <td><?= $trip->trip_from?></td>
                                                    <td><?= $trip->trip_to?></td>
                                                    <td class="text-<?= $txt?>"><?= $trip->trip_status?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card col-lg-5">
                        <div class="h3 text-center">Trucks</div>
                        <table class="table table-stripped">
                            <thead>
                                <th>Truck</th>
                                <th>Driver</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($trucks as $truck){
                                        if($truck->truck_status == 'Available'){
                                            $text = 'text-primary';
                                        }else{
                                            $text = 'text-danger';
                                        }
                                        ?>
                                            <tr>
                                                <td><?= $truck->truck_reg?></td>
                                                <td><?= $truck->truck_driver?></td>
                                                <td class="<?= $text ?>"><?= $truck->truck_status?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
        }elseif($this->session->userdata('authentication') == 'Truck Owner'){
            ?>
                <div class="row">
                    <div class="col bg-primary text-center rounded m-2">
                        <div class="h4 text-center"> C <br> <span class="h5 text-light">Trips</span></div>
                    </div>
                    <div class="col bg-primary text-center rounded m-2">
                        <div class="h4 text-center"> B <br> <span class="h5 text-light">Trucks</span></div>
                    </div>
                </div>
                <div class="d-lg-flex justify-content-around">
                    <div class="card col-lg-7">
                        <div class="h2 text-center">Today Tips</div>
                        <table class="table">
                            <thead>
                                <th>Truck</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($trips as $trip){
                                        if($trip->trip_date == date('Y-m-d')){
                                            if($trip->trip_status != 'Completed'){
                                                $txt = 'primary';
                                            }else{
                                                $txt = 'danger';
                                            }
                                            ?>
                                                <tr>
                                                    <td><?= $trip->truck?></td>
                                                    <td><?= $trip->trip_from?></td>
                                                    <td><?= $trip->trip_to?></td>
                                                    <td class="text-<?= $txt?>"><?= $trip->trip_status?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card col-lg-5">
                        <div class="h3 text-center">Trucks</div>
                        <table class="table table-stripped">
                            <thead>
                                <th>Truck</th>
                                <th>Driver</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($trucks as $truck){
                                        if($truck->truck_status == 'Available'){
                                            $text = 'text-primary';
                                        }else{
                                            $text = 'text-danger';
                                        }
                                        ?>
                                            <tr>
                                                <td><?= $truck->truck_reg?></td>
                                                <td><?= $truck->truck_driver?></td>
                                                <td class="<?= $text ?>"><?= $truck->truck_status?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
        }
    ?>
</main>