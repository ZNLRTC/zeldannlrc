<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<div class="wrapper">
            <div class="leftside-menu"><?php include 'admin_leftsidebar.php'?></div>
            <div class="content-page">
                <div class="content">
                <?php include 'admin_topbar.php'?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/employees">Trainees</a></li>
                                            <li class="breadcrumb-item active">Add</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Trainees</h4>
                                </div>
                            </div>
                        </div>
                        
                        <form id="add-trainee">
                            <div class="row">
                                <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="#last_name" class="form-label">Last name:</label><br>
                                        <input type="text" class="form-control" name="last-name" id="last_name" placeholder="Enter last name here" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="#first_name" class="form-label">First name:</label><br>
                                        <input type="text" class="form-control" name="first-name" id="first_name" placeholder="Enter first name here" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="#middle_name" class="form-label">Middle name:</label><br>
                                        <input type="text" class="form-control" name="middle-name" id="middle_name" placeholder="Enter middle name here">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="#email" class="form-label">Email:</label><br>
                                        <div class="alert alert-danger email-in-use d-none">Email is already in use</div>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email here" required>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-4"></div>

                                <div class="col-md-3 offset-md-3 col-lg-2 offset-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="#batch" class="form-label">Batch:</label><br>
                                        <select name="batch" id="batch" class="form-control" required>
                                            <option disabled selected>Select batch</option>
                                            <?php foreach($batch_names as $name): ?>
                                                <option value="<?= $name['name'] ?>" class="batch-<?= $name['name'] ?> text-uppercase"><?= $name['name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-2">
                                    <div class="form-group mb-3">
                                        <label for="#batch-num" class="form-label">Batch Number:</label><br>
                                        <select name="batch-number" id="batch" class="form-control" required>
                                            <option disabled selected>Select batch number</option>
                                            <?php foreach($batch_numbers as $num): ?>
                                                <option value="<?= $num['batch_number'] ?>" class="bat-<?= $num['name'] ?> d-none"><?= $num['batch_number'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-4"></div>

                                <div class="col-md-3 offset-md-3 col-lg-4 offset-lg-4">
                                    <button type="submit" class="btn btn-primary d-block w-100">Add</button>
                                </div>
                            </div>
                        </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </body>