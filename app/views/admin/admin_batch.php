<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <div class="wrapper">
        <?php include 'admin_leftsidebar.php'?>

        <div class="content-page">
            <div class="content">
            <?php include 'admin_topbar.php'?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 bg-white p-3 mt-3 rounded">
                            <div class="page-title-box mb-3">
                                <div class="page-title-right d-flex align-items-center">
                                    <input type="search" id="applicant-batches-search" class="form-control me-2" placeholder="Search">
                                    <button title="Add new batch" class="btn btn-success add-batch-btn"><i class="fas fa-plus"></i></button>
                                </div>
                                <h4 class="page-title">Batches</h4>
                            </div>

                            <table id="applicant-batches" class="table table-striped">
                                <thead>
                                    <th class="col-2">Code</th>
                                    <th class="col-6">Last update by</th>
                                    <th class="col-4">Action</th>
                                </thead>

                                <tbody>
                                    <?php foreach($batch_names as $batch): ?> 
                                        <tr>
                                            <td><span class="text-uppercase"><?= $batch['name'] ?></span></td>
                                            <td><?= ucwords($batch['first_name'] .' '. ucwords($batch['last_name'])) ?></td>
                                            <td class="d-flex align-items-center">
                                                <a href="<?= BASE_URL ?>" class="text-primary batch-edit-btn me-3 pointer" data-batch-id="<?= $batch['id'] ?>" data-batch-name="<?= $batch['name'] ?>"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="<?= BASE_URL ?>" class="text-danger batch-delete-btn pointer" data-batch-id="<?= $batch['id'] ?>" data-batch-name="<?= $batch['name'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-8 p-3 mt-3 rounded">
                            <div class="page-title-box mb-3">
                                <div class="page-title-right d-flex align-items-center">
                                    <input type="search" id="applicant-batch-number-search" class="form-control me-2" placeholder="Search">
                                    <button title="Add batch number" class="btn btn-success add-batch-number-btn"><i class="fas fa-plus"></i></button>
                                </div>
                                <h4 class="page-title">Batch Number</h4>
                            </div>

                            <table id="applicant-batch-number" class="table table-striped">
                                <thead>
                                    <th class="col-1">Batch</th>
                                    <th class="col-4">Count</th>
                                    <th class="col-3">Last update by</th>
                                    <th class="col-4">Action</th>
                                </thead>

                                <tbody>
                                    <?php foreach($batch_numbers as $num): $batch_combi = $num['name']."-".$num['batch_number']; ?>
                                        <?php 
                                            $status = array(
                                                ['active', 'success', 'white'], 
                                                ['inactive', 'warning', 'white'],
                                                ['on-hold', 'orange', 'white'],
                                                ['quit', 'red', 'white'],
                                                ['deployed', 'info', 'white']
                                            ); 
                                        ?>
                                        
                                        <tr>
                                            <td><a href="applicants?batch=<?= $num['name'].'-'.$num['batch_number'] ?>"><span class="text-uppercase"><?= $num['name'] .' '. $num ['batch_number'] ?></span> </a></td>
                                            <td class="text-left">
                                                <?php $i = 0; foreach($status as $stat):  ?>
                                                    <a title="View <?= ucwords($stat[0]) ?> Batch From <?= strtoupper($num['name']) .' '. $num ['batch_number'] ?>" class="bg-<?= $stat[1] ?> text-<?= $stat[2] ?> rounded-1-25 px-1 me-1" href="<?= BASE_URL ?>admin/applicants?batch=<?= $batch_combi .'&status='. $stat[0] ?>"><?= $num['trainee_count'][$i] ?> </a>
                                                <?php $i++; endforeach ?>
                                            </td>
                                            <td><?= ucwords($num['first_name']) .' '. ucwords($num['last_name']) ?></td>
                                            <td>
                                                <a href="<?= BASE_URL ?>" class="text-primary batch-number-edit-btn me-3 pointer" data-batch-id="<?= $num['id'] ?>" data-batch-name="<?= $num['name'] ?>" data-batch-number="<?= $num['batch_number'] ?>"><i class="fas fa-edit"></i> Edit</button>
                                                <a href="<?= BASE_URL ?>" class="text-danger batch-number-delete-btn pointer" data-batch-number-id="<?= $num['id'] ?>"><i class="fas fa-trash-alt"></i> Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>


                        
                    </div>

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>document.write(new Date().getFullYear())</script> © ZNLRC
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>
</body>