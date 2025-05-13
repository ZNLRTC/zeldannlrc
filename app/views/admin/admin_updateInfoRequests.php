<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

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

                                <h4 class="page-title">ZNLRC Information Update Requests</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <table id="update-info-requests-table" class="table table-striped">
                            <thead class="border-bottom">
                                <th>Name</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </thead>

                            <tbody>
                                <?php foreach($trainees as $trainee): ?>
                                    <?php 
                                        if($trainee['former_name'] == NULL){
                                            $name = ucwords($trainee['first_name']) ." ". ucwords($trainee['middlename']) ." ". ucwords($trainee['last_name']);
                                        }else{
                                            $name = ucwords($trainee['first_name']) ." ". ucwords($trainee['middlename']) ." ". ucwords($trainee['last_name']) ." (".ucwords($trainee['former_name']).")" ;
                                        }
                                    ?>
                                    <tr id="table-<?= $trainee['id'] ?>">
                                        <td class="col-lg-3"><?= $name ?></td>
                                        <td class="col-lg-7"><?= ucwords($trainee['message']) ?></td>
                                        <td class="col-2">
                                            <button data-inforeq-id="<?= $trainee['id'] ?>" data-name="<?= $name ?>"  class="btn btn-danger delete-inforeq-btn">Delete</button>
                                            <button user-id="<?= $trainee['user_id'] ?>" class="btn btn-primary view-user-btn">View</button></td>
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