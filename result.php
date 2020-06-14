<?php
require('auth.php');
require('connection.php');
require('functions.php');
require('header.php');

if (isset($_GET['id'])) { //check if id GET parameter is set
    $id = validate($_GET['id']);
    if (is_nan($id)) {
        http_response_code(404); //return 404
        include('404.php'); //custom 404 page
        die();
    } else {
        $sql = "select * from tests where id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $n = $row['n'] - 1;
            $p = $row['p'] - 1;
            $k = $row['k'] - 1;
            $ph = $row['ph'];
            $moisture = $row['moisture'];
            $values = ["Surplus", "Sufficient", "Adequate", "Deficient", "Depleted"]; //keyword array
            $colors = ['#1e751e', '#7ad835', '#ffc107', '#ff9800', '#f44336']; //colors for different values
            $percent = [100, 80, 60, 40, 20];
        } else {
            http_response_code(404);
            include('404.php');
            die(); //stop execution after 404
        }
    }
} else {
    header("Location: home.php");
}
?>

<div class="row">
    <div class="card col-md-12">
        <div class="card-body  card2 pt-3">
            <div class="row">
                <div class="col-lg-6 col-md-9 f-24 font-medium">Test Details</div>
                <div class="col-lg-6 col-md-9 text-right">
                    <a href="home.php"><button class="btn btn-primary">&lt;&lt;All tests</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-6 font-weight-bold text-dark">Test date</div>
                        <div class="col"><?php echo date("D-M-Y", $row['timestamp']); ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 font-weight-bold text-dark">Test time</div>
                        <div class="col"><?php echo date("H:m:s", $row['timestamp']); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card invite-card">
            <div class="card-header">
                <h5>Nitrogen level</h5>
            </div>
            <div class="card-body text-center">
                <div class="invite-card-chart">
                    <div id="chart-n" style="height:250px;"></div>
                    <div class="invite-card-cont">
                        <i class="fas fa-paper-plane" style="color: <?php echo $colors[$n]; ?>;"></i>
                        <span class="f-50"><?php echo $percent[$n]; ?>&percnt;</span>
                        <hr>
                    </div>
                </div>
                <h6 class="f-w-600">Nitrogen is <?php echo $values[$n]; ?> in this soil</h6>

            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-4">
        <div class="card invite-card">
            <div class="card-header">
                <h5>Phosphorous level</h5>
            </div>
            <div class="card-body text-center">
                <div class="invite-card-chart">
                    <div id="chart-p" style="height:250px;"></div>
                    <div class="invite-card-cont">
                        <i class="fas fa-paper-plane" style="color: <?php echo $colors[$p]; ?>;"></i>
                        <span class="f-50"><?php echo $percent[$p]; ?>&percnt;</span>
                        <hr>
                    </div>
                </div>
                <h6 class="f-w-600">Phosphorous is <?php echo $values[$p]; ?> in this soil</h6>

            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-4">
        <div class="card invite-card">
            <div class="card-header">
                <h5>Pottasium level</h5>
            </div>
            <div class="card-body text-center">
                <div class="invite-card-chart">
                    <div id="chart-k" style="height:250px;"></div>
                    <div class="invite-card-cont">
                        <i class="fas fa-paper-plane" style="color: <?php echo $colors[$k]; ?>;"></i>
                        <span class="f-50"><?php echo $percent[$k]; ?>&percnt;</span>
                        <hr>
                    </div>
                </div>
                <h6 class="f-w-600">Pottasium is <?php echo $values[$k]; ?> in this soil</h6>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card invite-card">
            <div class="card-header">
                <h5>Moisture level</h5>
            </div>
            <div class="card-body text-center">
                <div class="invite-card-chart">
                    <div id="chart-m" style="height:250px;"></div>
                    <div class="invite-card-cont">
                        <i class="fas fa-paper-plane" style="color: #43eeec;"></i>
                        <span class="f-50"><?php echo $moisture; ?>&percnt;</span>
                        <hr>
                    </div>
                </div>
                <h6 class="f-w-600">Moisture reading: <?php echo $moisture; ?></h6>

            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-4">
        <div class="card invite-card">
            <div id="chart-all" class="card-body text-center">
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-4">
        <div class="card invite-card">
            <div class="card-header">
                <h5>pH level</h5>
            </div>
            <div class="card-body text-center">
                <div class="invite-card-chart">
                    <div id="chart-ph" style="height:250px;"></div>
                    <div class="invite-card-cont">
                        <i class="fas fa-paper-plane text-c-green"></i>
                        <span class="f-50"><?php echo $ph; ?></span>
                        <hr>
                    </div>
                </div>
                <h6 class="f-w-600">pH level: <?php echo $ph; ?></h6>

            </div>
        </div>
    </div>
</div>

<?php
$sql = "select * from crops where $ph>=ph_low and $ph<=ph_high";
$res = $conn->query($sql);
?>

<div class="row">
    <div class="card col-md-12">
        <div class="card-body  card2 pt-3">
            <div class="row">
                <div class="col-lg-6 col-md-9 f-24 font-medium">Suitable crops: <?php echo $res->num_rows." crops found"; ?> </div>
                <div class="col-lg-6 col-md-9 text-right">
                    <a href="crops.php"><button class="btn btn-primary">All crops&gt;&gt;</button></a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <?php while ($crops = $res->fetch_assoc()) : ?>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-dark">
                <img class="img-fluid card-img" style="height: 250px;" src="assets/images/crops/<?php echo $crops["image_src"]; ?>" alt="Card image">
                <div class="card-img-overlay">
                    <h5 class="card-title text-white"><?php echo $crops["name"]; ?></h5>
                    <p class="card-text text-white"><?php echo substr($crops["description"], 0, 128); ?>...</p>
                    <p class="card-text text-white">Category: <?php echo $crops["type"]; ?></p>
                    <a href="crops.php?id=<?php echo $crops["id"]; ?>" class="btn  btn-primary"><?php echo $crops["name"]; ?> &gt;&gt;</a>
                </div>
            </div>
        </div>

    <?php endwhile; ?>
</div>
<script src="/assets/js/plugins/apexcharts.min.js"></script>
<script>
    var optionph = {
        chart: {
            height: 300,
            type: 'radialBar',
            offsetY: -10,
            sparkline: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'solid',
            colors: ['#7ad835'],
            opacity: 1,
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: "80%",
                },
                dataLabels: {
                    name: {
                        fontSize: '0',
                    },
                    value: {
                        fontSize: '0',
                    }
                }
            }
        },
        series: [<?php echo $ph * 7.14; ?>],
    };
    var optionm = {
        chart: {
            height: 300,
            type: 'radialBar',
            offsetY: -10,
            sparkline: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'solid',
            colors: ['#43eeec'],
            opacity: 1,
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: "80%",
                },
                dataLabels: {
                    name: {
                        fontSize: '0',
                    },
                    value: {
                        fontSize: '0',
                    }
                }
            }
        },
        series: [<?php echo $moisture; ?>],
    };

    var optionn = {
        chart: {
            height: 300,
            type: 'radialBar',
            offsetY: -10,
            sparkline: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'solid',
            colors: ['<?php echo $colors[$n]; ?>'],
            opacity: 1,
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: "80%",
                },
                dataLabels: {
                    name: {
                        fontSize: '0',
                    },
                    value: {
                        fontSize: '0',
                    }
                }
            }
        },
        series: [<?php echo $percent[$n]; ?>],
    };

    var optionp = {
        chart: {
            height: 300,
            type: 'radialBar',
            offsetY: -10,
            sparkline: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'solid',
            colors: ['<?php echo $colors[$p]; ?>'],
            opacity: 1,
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: "80%",
                },
                dataLabels: {
                    name: {
                        fontSize: '0',
                    },
                    value: {
                        fontSize: '0',
                    }
                }
            }
        },
        series: [<?php echo $percent[$p]; ?>],
    };

    var optionk = {
        chart: {
            height: 300,
            type: 'radialBar',
            offsetY: -10,
            sparkline: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'solid',
            colors: ['<?php echo $colors[$k]; ?>'],
            opacity: 1,
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: "80%",
                },
                dataLabels: {
                    name: {
                        fontSize: '0',
                    },
                    value: {
                        fontSize: '0',
                    }
                }
            }
        },
        series: [<?php echo $percent[$k]; ?>],
    };
    var chart = new ApexCharts(document.querySelector("#chart-n"), optionn);
    chart.render();

    var chart = new ApexCharts(document.querySelector("#chart-p"), optionp);
    chart.render();

    var chart = new ApexCharts(document.querySelector("#chart-k"), optionk);
    chart.render();

    var chart = new ApexCharts(document.querySelector("#chart-m"), optionm);
    chart.render();

    var chart = new ApexCharts(document.querySelector("#chart-ph"), optionph);
    chart.render();

    var options = {
        series: [{
            name: 'Series 1',
            data: [<?php echo $percent[$n]; ?>, <?php echo $ph * 7.14; ?>, <?php echo $percent[$p]; ?>, <?php echo $moisture; ?>, <?php echo $percent[$k]; ?>],
        }],
        chart: {
            height: 350,
            type: 'radar',
        },
        title: {
            text: 'NPK pH Moisture Chart'
        },
        xaxis: {
            categories: ['Nitrogen', 'pH', 'Phosphorous', 'Moisture', 'Pottasium']
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-all"), options);
    chart.render();
</script>
<?php
require('footer.php');
?>