<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Begin page -->

    <div class="wrapper">
        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>

        <div class="content-page">
            <div class="content">
            <?php include __DIR__ . '/../admin_topbar.php'; ?>
                <!-- Start Content-->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right"></div>
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <th>Employee Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Purpose</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                <?php foreach($requests as $r): ?>
                                    <tr>
                                        <td><?= $r['first_name'] .' '. $r['last_name']  ?></td>
                                        <td><?= date('F d, Y', strtotime($r['date'])) ?></td>
                                        <td><?= date('h:i A', strtotime($r['access_from'])) .' - '.  date('h:i A', strtotime($r['access_to'])) ?></td>
                                        <td><?= $r['purpose'] ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-success me-1 approve-access-request" data-request-id=<?= $r['id'] ?>>Approve</button>
                                                <button class="btn btn-danger">Deny</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>