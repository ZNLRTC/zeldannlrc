<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">

        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include __DIR__ . '/../admin_topbar.php'; ?>

                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6 ">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="page-title-box">
                                    <h4 class="page-title">FAQ Keywords</h4>
                                </div>

                                <div class="d-flex">
                                    <div>
                                        <button class="btn btn-success add-faq-keyword-btn"><i class="fas fa-plus"></i> Add New</button>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Description</th>
                                        <th>Icon</th>
                                        <th>Department</th>
                                    </thead>

                                    <tbody>
                                        <?php foreach($keywords as $key): ?>
                                            <tr>
                                                <td><?= $key['description'] ?></td>
                                                <td><?= $key['icon'] ?></td>
                                                <td><?= $key['dept_desc'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


