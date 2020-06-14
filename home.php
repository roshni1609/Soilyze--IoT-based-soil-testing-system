<?php
require('auth.php');
require('connection.php');
require('functions.php');
require('header.php');

$u_id=$_SESSION['user_id'];
$sql = "select * from tests where user_id='$u_id'";
$result = $conn->query($sql);
$count=1;
$values=["Surplus","Sufficient","Adequate","Deficient","Depleted"];
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <h5 class="card-title">Previous soil tests</h5>
                <div class="dt-responsive table-responsive">
                    <table id="user-list-table" class="table nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>N Value</th>
                                <th>P Value</th>
                                <th>K Value</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo date("D-M-Y",$row['timestamp']); ?></td>
                                <td><?php echo date("H:m:s",$row['timestamp']); ?></td>
                                <td><?php echo $values[--$row['n']]; ?></td>
                                <td><?php echo $values[--$row['p']]; ?></td>
                                <td><?php echo $values[--$row['k']]; ?></td>
                                <td>
                                    <div class="overlay-edit">
                                        <a href="result.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-icon btn-info"><i class="feather icon-eye"></i></button></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $count+=1; endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>N Value</th>
                                <th>P Value</th>
                                <th>K Value</th>
                                <th>View</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php

include('footer.php')
?>