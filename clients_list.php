<?php include('./connections/connection.php'); ?>
<?php include('./connections/global.php'); ?>
<?php include('./connections/functions.php'); ?>
<?php include('./components/header.php'); ?>

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
                    <div class="">
                        <div class="">
                            <div class="home-tab">
                                <div class="">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="card-body">
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Client List</h4>
                                                            <div class="row">
                                                                <form action="./clients_list.php" method="get">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="client_name" class="form-control" placeholder="Search Client Name" onblur="this.form.submit()" id="client_name">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <a href="./clients_list.php" class="btn btn-outline-danger col-md-12">Reset</a>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                            <div id="notification"></div>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Username</th>
                                                                            <th>Email</th>
                                                                            <th>Phone</th>
                                                                            <th>Created</th>
                                                                            <th>Action(s)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $client_name = @$_GET['client_name'];
                                                                        if ($client_name) {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM client WHERE username LIKE '%$client_name%'");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        } else {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM client");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        }
                                                                        while ($row = mysqli_fetch_array($get_client)) {
                                                                            $client_code = $row['client_code'];
                                                                            $client_name = $row['username'];
                                                                            $client_email = $row['email'];
                                                                            $client_phone = $row['phone'];
                                                                            $created_at = $row['created_at'];
                                                                            if ($count = 0) {
                                                                                echo 'No user Found!';
                                                                            } else {
                                                                                echo '<tr>
                                                                                <td>' . $client_name . '</td>
                                                                                <td>' . $client_email . '</td>
                                                                                <td>' . $client_phone . '</td>
                                                                                <td><label class="badge badge-danger">' . $created_at . '</label></td>
                                                                                <td>'; ?>
                                                                                <button type="submit" class="btn btn-outline-primary">Edit Client</button>
                                                                                <button type="submit" class="btn btn-outline-danger" onclick="doConfirm(<?php echo $client_code; ?>);">Delete Client</button>
                                                                        <?php echo '
                                                                                </td>
                                                                                </tr>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                                <script>
                                                                    function doConfirm(code) {
                                                                        var ok = confirm("Are you sure to Delete?")
                                                                        if (ok) {

                                                                            var xmlhttp = new XMLHttpRequest();
                                                                            xmlhttp.onreadystatechange = function() {
                                                                                if (this.readyState == 4 && this.status == 200) {
                                                                                    document.getElementById("notification").innerHTML = this.responseText;
                                                                                }
                                                                            };
                                                                            xmlhttp.open("GET", "./helpers/client_delete.php?client_code=" + code);
                                                                            xmlhttp.send();
                                                                        }
                                                                    }
                                                                </script>
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
            <?php include('./components/footer.php') ?>
            <?php include('./components/scripts.php') ?>