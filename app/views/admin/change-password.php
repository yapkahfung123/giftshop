<?php
require_once APPROOT .'/views/admin/inc/header.php';
?>
<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <?php require_once APPROOT .'/views/admin/inc/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php require APPROOT .'/views/admin/inc/topbar.php'; ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php
                if(isset($data['success_msg'])){
                    flash_template($data['success_msg'], 'alert alert-success text-center');
                }
                ?>
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Change Password</h1>

                <div class="col-md-6" style="padding-top: 5em">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Username:</label>
                            <h2><?= $_SESSION['name']; ?></h2>
                        </div>
                        <div class="form-group" style="padding-top: 2em">
                            <label for="pw">Password:</label>
                            <input type="password" class="form-control form-control-user" placeholder="Password" name="pword"">
                        </div>
                        <input type="submit" class="btn btn-primary btn-md" value="Update Password" style="margin-top: 2em">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require_once APPROOT .'/views/admin/inc/footer.php';
?>