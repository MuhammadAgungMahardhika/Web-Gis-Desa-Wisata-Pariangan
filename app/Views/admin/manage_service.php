<?= $this->extend('layout/template.php') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('manage_package') ?>">List Package</a></li>
            <li class="breadcrumb-item active" aria-current="page">List service</li>
        </ol>
    </nav>
    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary text-center">List Service Package</h5>
            <a href="<?= base_url('manage_service/insert') ?> " title="Add" role="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-border" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <?php $no = 1; ?>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objectData as $service) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $service->name; ?></td>

                                <td class="text-center">
                                    <a class="btn btn-outline-danger btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $service->id; ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <!-- Delete Modal-->
                                    <div class="modal fade" id="deleteModal<?= $service->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Are you sure delete <b>" <?= $service->name; ?> "</b> service?</div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-danger" href="<?= base_url('manage_service/delete/' . $service->id) ?>">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    new DataTable("#dataTable")
</script>
<?= $this->endSection() ?>