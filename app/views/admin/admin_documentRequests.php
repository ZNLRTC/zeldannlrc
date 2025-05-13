<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <!-- Begin page -->

        <div class="wrapper">
            <?php include 'admin_leftsidebar.php'?>

            <div class="content-page">
                <div class="content">

                <?php include 'admin_topbar.php'?>

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right"></div>
                                    <h4 class="page-title">Document Request Changes</h4>
                                </div>
                            </div>
                        </div>

                        <table id="document-requests-table" class="table table-striped">
                            <thead>
                                <th class="col-2">Name</th>
                                <th class="col-2">Email</th>
                                <th class="col-2">File Name</th>
                                <th class="col-1">Type</th>
                                <th class="col-3">Message</th>
                                <th class="col-2">Action</th>
                            </thead>

                            <tbody>
                                <?php foreach($documents as $docs): ?>
                                    <tr>
                                        <td><?= ucwords($docs['first_name']) .' '. ucwords($docs['middlename']) .' '. ucwords($docs['last_name']) ?></td>
                                        <td><div class="break-long-text"><?= $docs['email'] ?></div></td>
                                        <td><div class="break-long-text"><a href="<?= BASE_URL_ASSETS .'documents/'. $docs['path']?>" target="_blank"><?= $docs['path'] ?></a></div></td>
                                        <td><?= $docs['description'] ?></td>
                                        <td><div class="scroll-long-text"><?= ucwords($docs['message']); ?></div></td>
                                        <td>
                                            <button class="btn btn-sm btn-success edit-document-request-btn" data-action="approve" data-document-id="<?= $docs['id'] ?>" >Approve</button>
                                            <button class="btn btn-sm btn-danger edit-document-request-btn" data-action="deny" data-document-id="<?= $docs['id'] ?>">Deny</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
</body>