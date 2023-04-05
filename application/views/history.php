<main class="container">
    <div class="h1 text-center text-primary">Truck History</div>
    <div class="h3 text-center text-danger"><?= $truck_number?></div>
    <table class="table table-responsive-md table-stripped">
            <thead class="table-primary">
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                    foreach($all_trips  as $all){
                        ?>
                        <tr>
                            <td><?= $all->trip_date ?></td>
                            <td><?= $all->trip_from ?></td>
                            <td><?= $all->trip_to ?></td>
                            <td><?= $all->trip_status ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
    </table>
</main>