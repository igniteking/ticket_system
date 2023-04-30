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
                                                            <h4 class="card-title">Category List</h4>
                                                            <div class="row">
                                                                <form action="./category_list.php" method="get">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="category_name" class="form-control" placeholder="Search Category Name" onblur="this.form.submit()" id="client_name">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <a href="./category_list.php" class="btn btn-outline-danger col-md-12">Reset</a>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                            <div id="notification"></div>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Category Id</th>
                                                                            <th>Category Name</th>
                                                                            <th>Category Description</th>
                                                                            <th>Created</th>
                                                                            <th>Action(s)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $category_name = @$_GET['category_name'];
                                                                        if ($category_name) {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM category WHERE category_name LIKE '%$category_name%'");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        } else {
                                                                            $get_client = mysqli_query($conn, "SELECT * FROM category");
                                                                            $count = mysqli_num_rows($get_client);
                                                                        }
                                                                        while ($row = mysqli_fetch_array($get_client)) {
                                                                            $category_id = $row['category_id'];
                                                                            $category_name = $row['category_name'];
                                                                            $category_description = $row['category_description'];
                                                                            $created_at = $row['created_at'];
                                                                            if ($count = 0) {
                                                                                echo 'No user Found!';
                                                                            } else {
                                                                                echo '<tr>
                                                                                <td>' . $category_id . '</td>
                                                                                <td>' . $category_name . '</td>
                                                                                <td>' . $category_description . '</td>
                                                                                <td><label class="badge badge-danger">' . $created_at . '</label></td>
                                                                                <td>'; ?>
                                                                                <button type="submit" class="btn btn-outline-primary">Edit Category</button>
                                                                                <button type="submit" class="btn btn-outline-danger" onclick="doConfirm(<?php echo $client_code; ?>);">Delete Category</button>
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