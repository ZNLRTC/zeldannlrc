<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">

        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include __DIR__ . '/../admin_topbar.php'; ?>

                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6 bg-white p-3 mt-3 rounded">
                            <div class="row">
                                <div class="col-4">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Departments</h4>
                                    </div>
                                </div>
                                <div class="col-8 d-flex align-items-center justify-content-end">
                                    <div class="me-1">
                                        <button class="btn btn-success add-department-btn"><i class="fas fa-plus"></i></button>
                                    </div>

                                    <div class="">  
                                        <input id="search-department-table" type="search" class="form-control" placeholder="Search department">
                                    </div>
                                </div>

                                <hr class="mt-0">

                                <table id="departments-table" class="table table-striped">
                                    <thead>
                                        <th></th>
                                        <th>Department</th>
                                        <th>Last Update By</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($departments as $dept): ?>
                                            <tr id="dept-<?= $dept['id'] ?>" data-department-description="<?= ucwords($dept['description']) ?>" data-department-id="<?= $dept['id'] ?>">
                                                <td><input type="radio" name="radio-department" class="pointer" value="<?= $dept['id'] ?>"></td>
                                                <td><?= ucwords($dept['description']) ?></td>
                                                <td><?= ucwords($dept['admin_fname']) .' '. ucwords($dept['admin_lname']) ?></td>
                                                <td class="text-left">
                                                    <button class="btn bg-none text-primary edit-department-btn"><i class="fas fa-pen"></i> Edit</button>
                                                    <button class="btn bg-none text-danger delete-department-btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="col-md-6 p-3 mt-3">
                            <?php foreach($departments as $dept): ?>
                                <div id="department-<?= $dept['id'] ?>-container" class="row mb-5 multi-departments-container">
                                    <div class="col-4">
                                        <div class="page-title-box">
                                            <h4 class="page-title"><?= ucwords($dept['description']) ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-8 d-flex align-items-center justify-content-end">
                                        <div class="me-1">
                                            <button data-department-description="<?= ucwords($dept['description']) ?>" data-department-id="<?= $dept['id'] ?>" class="btn btn-success add-department-employee-btn"><i class="fas fa-plus"></i> Add to <?= $dept['description'] ?></button>
                                        </div>

                                        <!-- <div class="">  
                                            <input id="search-department-table" type="search" class="form-control" placeholder="Search <?= $dept['description'] ?>">
                                        </div> -->
                                    </div>

                                    <hr class="mt-0">

                                    <table id="department-<?= strtolower(str_replace(' ', '-', $dept['description'])) ?>-table" class="table table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($dept['employees'] as $emp): ?>
                                                <tr id="dept-employee-<?= $emp['emp_id'] ?>" data-employee-id=<?= $emp['emp_id'] ?> data-employee-name="<?= $emp['emp_first_name'] ." ". $emp['emp_last_name'] ?>" data-employee-department=<?= $dept['description'] ?> data-department-id=<?= $dept['id'] ?>>
                                                    <td><?= ucwords($emp['emp_first_name']) ." ". ucwords($emp['emp_last_name']) ?></td>
                                                    <td><?= $emp['emp_email'] ?></td>
                                                    <td><button class="btn bg-none text-danger remove-employee-from-department-btn"><i class="fas fa-trash-alt"></i> Remove</button></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endforeach ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


