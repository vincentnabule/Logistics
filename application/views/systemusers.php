    <main class="container">
        <table class="table table-striped table-responsive-md">
            <thead class="table-primary">
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Role</th>
                <th>Registration Date</th>
            </thead>
            <tbody>
                <?php
                    foreach($users as $user){
                        ?>
                            <tr>
                                <?php
                                    if($user->user_role == 'Truck Owner'){
                                        ?>
                                            <td><a href="#"><?= $user->user_names?></a></td>
                                        <?php
                                    }
                                    else{
                                        ?>
                                            <td><?= $user->user_names?></td>
                                        <?php
                                    }
                                ?>
                                <td><?= $user->user_email?></td>
                                <td>0<?= $user->user_contact?></td>
                                <td><?= $user->user_role?></td>
                                <td><?= $user->registration_date?></td>
                            </tr>
                        <?php   
                    }
                ?>
            </tbody>
        </table>
    </main>