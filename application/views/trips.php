    <main class="container">
        <div class="d-md-flex justify-content-around m-2">
            <div>
                <div class="h5 text-center">Filter</div>
                <div class="d-flex justify-content-between gap-2">
                    <div >
                        From date. <br>
                        <input type="date" class="form-control">
                    </div>
                    <div class="ml-md-3">
                        To date. <br>
                        <input type="date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn-primary m-2 btn-md rounded" onclick="location.href='<?= base_url('new_trip')?>'">New Trip</button>
            </div>
        </div>

        <table class="table table-responsive-md table-stripped">
            <thead class="table-primary">
                <th>Trip ID</th>
                <th>Trip Date</th>
                <th>Truck</th>
                <th>From</th>
                <th>To</th>
                <th>Cargo</th>
                <th>Status</th>
                <th>update</th>
            </thead>
            <tbody>
                <?php
                    foreach($trips as $trip){
                        
                        $disableRoute = null;
                        $disableComplete = null;
                        $disableAll = null;
                        $trip_data = [
                                'id' => $trip->trip_id,
                                'truck' =>  $trip->truck   
                            ];
                        if($trip->trip_status == 'Loading'){
                            $txt = 'primary';
                            $disableComplete = 'disabled';
                        }elseif($trip->trip_status == 'On Route'){
                            $txt = 'primary';
                            $disableRoute = 'disabled';

                        }
                        elseif($trip->trip_status == 'Completed'){
                            $txt = 'danger';
                            $disableAll = 'disabled';
                        }
                        ?>
                        <tr>
                            <td><?= $trip->trip_id?></td>
                            <td><?= $trip->trip_date?></td>
                            <td><?= $trip->truck?></td>
                            <td><?= $trip->trip_from?></td>
                            <td><?= $trip->trip_to?></td>
                            <td><?= $trip->cargo_description?></td>
                            <td class="text-<?= $txt?>"><?= $trip->trip_status?></td>
                            <td class="d-block">
                                <button class="btn btn-sm btn-success" <?= $disableAll?> <?= $disableRoute?> onclick="location.href='onroute/<?=$trip->trip_id?>'">On Route</button>
                                <button class="btn btn-sm btn-danger" <?= $disableComplete ?> <?= $disableAll?> onclick="location.href='tripdone/<?= $trip->trip_id.' '.$trip->truck ?>'">Completed</button>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </main>