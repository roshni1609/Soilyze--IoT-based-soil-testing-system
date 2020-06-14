<?php
require('auth.php');
require('connection.php');
require('functions.php');

if (isset($_GET['id'])) {
    $id = validate($_GET['id']);
    if (is_nan($id)) {
        http_response_code(404);
        include('404.php');
        die();
    } else {
        $sql = "select * from crops where id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $index = 0;
            $row = $result->fetch_assoc();
        } else {
            http_response_code(404);
            include('404.php');
            die();
        }
    }
} else {
    $sql = "select * from crops";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $index = 1;
        // while ($row = $result->fetch_assoc()) {
        //     echo "<br> id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        // }
    }
}
require('header.php');
?>
<?php if ($index == 1) : ?>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) : ?>

            <div class="col-md-6 col-xl-4">
                <div class="card bg-dark">
                    <img class="img-fluid card-img" style="height: 250px;" src="assets/images/crops/<?php echo $row["image_src"]; ?>" alt="Card image">
                    <div class="card-img-overlay">
                        <h5 class="card-title text-white"><?php echo $row["name"]; ?></h5>
                        <p class="card-text text-white"><?php echo substr($row["description"], 0, 64); ?>...</p>
                        <p class="card-text text-white">Category: <?php echo $row["type"]; ?></p>
                        <a href="crops.php?id=<?php echo $row["id"]; ?>" class="btn  btn-primary"><?php echo $row["name"]; ?> &gt;&gt;</a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php if ($index == 0) : ?>
    <div class="row">
        <div class="card">
            <div class="card-body  card2 pt-3">
                <div class="row">
                    <div class="col-lg-6 col-md-9 f-24 font-medium">Crop Details</div>
                    <div class="col-lg-6 col-md-9 text-right f-16 font-weight-bold text-uppercase profile-social">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 m-b-20 text-center">
                        <img style="height: 250px;" src="assets/images/crops/<?php echo $row["image_src"]; ?>" class="img-fluid" alt="" title="">
                    </div>
                    <div class="col-md-6">
                        <h2 class="f-24 font-medium"><?php echo $row["name"]; ?></h2>

                        <div class="row mb-2">
                            <div class="col-6 font-weight-bold text-dark">Category</div>
                            <div class="col"><?php echo $row["type"]; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 font-weight-bold text-dark">N value</div>
                            <div class="col"><?php echo $row["n"]; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 font-weight-bold text-dark">P value</div>
                            <div class="col"><?php echo $row["p"]; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 font-weight-bold text-dark">K value</div>
                            <div class="col"><?php echo $row["k"]; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 font-weight-bold text-dark">pH Value</div>
                            <div class="col"><?php echo $row["ph_low"] . "-" . $row["ph_high"]; ?></div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 m-b-20">
                        <h2 class="f-24 font-medium">More Info</h2>
                    </div>
                    <div class="col-md-12 m-b-20">
                        <p><?php echo $row["description"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 m-b-20">
                        <h2 class="f-24 font-medium">Fertilizing</h2>
                    </div>
                    <div class="col-md-12 m-b-20">
                        <p><?php echo $row["fertilizer"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>