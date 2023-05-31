<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include('./components/navbar.php'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include('./components/sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Total Admin</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `user_data` WHERE `user_type` = 'admin'"))); ?></h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Food Stalls</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `user_data` WHERE `user_type` = 'food_stall'"))); ?></h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Tickets</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `ticket`"))); ?></h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Users</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `client`"))); ?></h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total Products</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `product`"))); ?></h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Total Category</p>
                                                        <h3 class="rate-percentage"><?php echo mysqli_num_rows((mysqli_query($conn, "SELECT * FROM `category`"))); ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Performance Line Chart</h4>
                                                                        <h5 class="card-subtitle card-subtitle-dash">Lorem Ipsum is simply dummy text of the printing</h5>
                                                                    </div>
                                                                    <div id="performance-line-legend"></div>
                                                                </div>
                                                                <div class="chartjs-wrapper mt-5">
                                                                    <canvas id="performaneLine"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 grid-margin stretch-card">
                                                <div class="card card-rounded table-darkBGImg">
                                                    <div class="card-body">
                                                        <div class="col-sm-8">
                                                            <h3 class="text-white upgrade-info mb-0">
                                                                Click Here <br><span class="fw-bold">To Create</span><br> New Tickets!
                                                            </h3>
                                                            <a href="./index.php" class="btn btn-info upgrade-btn">Create Ticket!</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <ul class="nav nav-tabs" role="tablist">
                                                                                <li class="nav-item">
                                                                                    <button class="nav-link ps-0" id="taday" onclick="fetch_data('today')">Today</button>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <button class="nav-link" id="weekly" onclick="fetch_data('weekly')">Weekly</button>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <button class="nav-link" id="monthly" onclick="fetch_data('monthly')">Monthly</button>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <button class="nav-link border-0" id="yearly" onclick="fetch_data('yearly')">Yearly</button>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-md-3 d-flex justify-content-end d-flex justify-content-end">
                                                                            <select name="ticket_type" id="ticket_type" class="form-control form-control-lg">
                                                                                <option value="AMUSEMENT PARK" selected>AMUSEMENT PARK</option>
                                                                                <option value="WUNDER WATER">WUNDER WATER</option>
                                                                                <option value="COMBO – AMUSEMENT PARK + WATER PARK">COMBO – AMUSEMENT PARK + WATER PARK</option>
                                                                                <option value="Yearly Membership – Couple">Yearly Membership – Couple</option>
                                                                                <option value="Yearly Membership – Family">Yearly Membership – Family</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 row d-flex justify-content-end">
                                                                            <input type="date" class="form-control d-flex justify-content-end" id="date_from" name="from" id="date_from">
                                                                            <input type="date" class="form-control d-flex justify-content-end mb-2" id="date_to" name="to" id="date_to">
                                                                            <script>
                                                                                datePickerId = new Date().toISOString().split("T")[0];
                                                                                document.getElementById("date_to").max = datePickerId;
                                                                                document.getElementById("date_from").max = datePickerId;
                                                                            </script>
                                                                        </div>
                                                                        <div class="btn-wrapper col-md-2">
                                                                            <button onclick="printReport()" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</button>
                                                                            <button onclick="onSubmitButton()" class="btn btn-primary text-white me-0"> Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="row" id="notification">
                                                                            <?php
                                                                            $today = date("Y-m-d");
                                                                            $fetch_data = mysqli_query($conn, "SELECT * FROM ticket WHERE created_at LIKE '$today'");
                                                                            $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE created_at LIKE '$today'"));
                                                                            if ($count == 0) {
                                                                                echo '<div class="col-md-12 btn btn-danger text-white">
                                                                                    <h6 class="mt-2">No Record Found!</h6>
                                                                                    </div>
                                                                                    </div>';
                                                                            } else if ($fetch_data) {
                                                                                echo '
                                                                            <div class="">
                                                                                <table class="table table-hover table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Ticket Code</th>
                                                                                            <th>Username</th>
                                                                                            <th>User Email</th>
                                                                                            <th>Quantity</th>
                                                                                            <th>Type</th>
                                                                                            <th>Check In Date</th>
                                                                                            <th>Date</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>';
                                                                                while ($row = mysqli_fetch_array($fetch_data)) {
                                                                                    $ticket_code = $row['ticket_code'];
                                                                                    $ticket_username = $row['ticket_username'];
                                                                                    $ticket_user_email = $row['ticket_user_email'];
                                                                                    $ticket_quantity = $row['ticket_quantity'];
                                                                                    $ticket_name = $row['ticket_name'];
                                                                                    $ticket_check_in_date = $row['ticket_check_in_date'];
                                                                                    $ticket_user_email = $row['ticket_user_email'];
                                                                                    $created_at = $row['created_at'];
                                                                                    echo '
                                                                                        <tr>

                                                                                            <td class="">' . $ticket_code . '</td>
                                                                                            <td class="">' . $ticket_username . '</td>
                                                                                            <td class="">' . $ticket_user_email . '</span></td>
                                                                                            <td class="">' . $ticket_quantity . '</span></td>
                                                                                            <td class="">' . $ticket_name . '</span></td>
                                                                                            <td class="">' . $ticket_check_in_date . '</span></td>
                                                                                            <td class="">' . $created_at . '</span></td>
                                                                                        </tr>';
                                                                                }
                                                                                echo '
                                                                                    </tbody>
                                                                                </table>';
                                                                            } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function fetch_data(str) {
                    if (str == 'today') {
                        var today = new Date();
                        var year = today.getFullYear();
                        var month = today.getMonth() + 1; // Months are zero-based, so add 1
                        var day = today.getDate();
                        var formattedDate = year + '-' + month.toString().padStart(2, '0') + '-' + day.toString().padStart(2, '0');
                        console.log(formattedDate);
                        // Create a new XMLHttpRequest object
                        const xhr = new XMLHttpRequest();

                        // Define the AJAX request
                        xhr.open("GET", "./helpers/today.php?today=" + formattedDate);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                const response = xhr.responseText;
                                document.getElementById('notification').innerHTML = response;
                                console.log(response);
                                // Do something with the response data
                            }
                        }
                        // Send the AJAX request with the data
                        xhr.send();
                    } else if (str == 'weekly') {
                        var today = new Date();
                        var currentDay = today.getDay(); // Get the current day of the week (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
                        var startDate = new Date(today); // Create a new Date object with today's date
                        var endDate = new Date(today); // Create a new Date object with today's date

                        // Calculate the difference in days between the current day and Sunday (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
                        var daysUntilSunday = (currentDay + 7 - 0) % 7;

                        // Set the start date to the previous Sunday
                        startDate.setDate(today.getDate() - daysUntilSunday);

                        // Set the end date to the following Sunday
                        endDate.setDate(startDate.getDate() + 6);

                        // Format the start and end dates as desired
                        var formattedStartDate = startDate.toISOString().slice(0, 10); // Format: "YYYY-MM-DD"
                        var formattedEndDate = endDate.toISOString().slice(0, 10); // Format: "YYYY-MM-DD"

                        console.log(formattedStartDate + " - " + formattedEndDate);
                        // Create a new XMLHttpRequest object
                        const xhr = new XMLHttpRequest();

                        // Define the AJAX request
                        xhr.open("GET", "./helpers/week_year.php?date_from=" + formattedStartDate + "&&date_to=" + formattedEndDate);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                const response = xhr.responseText;
                                document.getElementById('notification').innerHTML = response;
                                console.log(response);
                                // Do something with the response data
                            }
                        }
                        // Send the AJAX request with the data
                        xhr.send();
                    } else if (str == 'monthly') {
                        var today = new Date();
                        var year = today.getFullYear(); // Get the current year
                        var month = today.getMonth(); // Get the current month (0 - January, 1 - February, ..., 11 - December)

                        // Set the start date to the first day of the month
                        var startDate = new Date(year, month, 1);

                        // Set the end date to the last day of the month
                        var endDate = new Date(year, month + 1, 0);

                        // Format the start and end dates as desired
                        var formattedStartDate = startDate.toISOString().slice(0, 10); // Format: "YYYY-MM-DD"
                        var formattedEndDate = endDate.toISOString().slice(0, 10); // Format: "YYYY-MM-DD"

                        console.log(formattedStartDate + " - " + formattedEndDate);
                        // Create a new XMLHttpRequest object
                        const xhr = new XMLHttpRequest();

                        // Define the AJAX request
                        xhr.open("GET", "./helpers/week_year.php?date_from=" + formattedStartDate + "&&date_to=" + formattedEndDate);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                const response = xhr.responseText;
                                document.getElementById('notification').innerHTML = response;
                                console.log(response);
                                // Do something with the response data
                            }
                        }
                        // Send the AJAX request with the data
                        xhr.send();
                    } else if (str == 'yearly') {
                        var today = new Date();
                        var currentYear = today.getFullYear(); // Get the current year

                        // Calculate the start and end years of the range
                        var startYear = currentYear; // Example: 10 years before the current year
                        var endYear = currentYear + 1; // Example: 10 years after the current year

                        console.log(startYear + " - " + endYear);
                        // Create a new XMLHttpRequest object
                        const xhr = new XMLHttpRequest();

                        // Define the AJAX request
                        xhr.open("GET", "./helpers/week_year.php?date_from=" + startYear + "&&date_to=" + endYear);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                const response = xhr.responseText;
                                document.getElementById('notification').innerHTML = response;
                                console.log(response);
                                // Do something with the response data
                            }
                        }
                        // Send the AJAX request with the data
                        xhr.send();
                    }

                }

                function printReport() {
                    var report = document.getElementById('notification').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = report;
                    window.print();
                    document.body.innerHTML = originalContents;
                }



                function onSubmitButton() {
                    var ticket_type = document.getElementById('ticket_type').value;
                    var date_from = document.getElementById('date_from').value;
                    var date_to = document.getElementById('date_to').value;


                    // Create a new XMLHttpRequest object
                    const xhr = new XMLHttpRequest();

                    // Define the AJAX request
                    xhr.open("GET", "./helpers/reports.php?ticket_type=" + ticket_type + "&&date_from=" + date_from + "&&date_to=" + date_to);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            const response = xhr.responseText;
                            document.getElementById('notification').innerHTML = response;
                            console.log(response);
                            // Do something with the response data
                        }
                    }
                    // Send the AJAX request with the data
                    xhr.send();
                }



                const ctx = document.getElementById('performaneLine');
                const data = {
                    labels: [
                        'AMUSEMENT PARK',
                        'WUNDER WATER',
                        'COMBO – AP + WP',
                        'Yearly – Couple',
                        'Yearly – Family',
                    ],
                    datasets: [{
                        type: 'line',
                        label: 'Ticket Sold',
                        data: [<?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name = 'AMUSEMENT PARK'")) ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name = 'WUNDER WATER'")) ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name = 'COMBO – AMUSEMENT PARK + WATER PARK'")) ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name = 'Yearly Membership – Couple'")) ?>, <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ticket WHERE ticket_name = 'Yearly Membership – Family'")) ?>],
                        fill: true,
                    }]
                };
                var salesTopOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                drawBorder: false,
                                color: "#F0F0F0",
                                zeroLineColor: '#F0F0F0',
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 4,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 7,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                    },
                    legend: false,
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<div class="chartjs-legend"><ul>');
                        for (var i = 0; i < chart.data.datasets.length; i++) {
                            console.log(chart.data.datasets[i]); // see what's inside the obj.
                            text.push('<li>');
                            text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                            text.push(chart.data.datasets[i].label);
                            text.push('</li>');
                        }
                        text.push('</ul></div>');
                        return text.join("");
                    },

                    elements: {
                        line: {
                            tension: 0.4,
                        }
                    },
                    tooltips: {
                        backgroundColor: 'rgba(31, 59, 179, 1)',
                    }
                }
                const mixedChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: salesTopOptions,
                    tension: 1,
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    borderWidth: 1,
                    tension: 0.4, // Set tension to create curved lines
                    fill: true // Fill area under the line
                });
            </script>
            <?php include('./components/footer.php') ?>
            <?php include('./components/scripts.php') ?>