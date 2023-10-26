<?= $this->extend('layout/template.php') ?>
<?= $this->section('content') ?>
<!-- Modal  -->
<div class="modal fade text-left" id="reservationModal" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer" id="modalFooter">
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Reservation</h3>
            <a title="find package" class="btn btn-success" href="<?= base_url('package') ?>"><i class="fa fa-search"></i></a>
            <a title="Checkout" class="btn btn-primary" href="<?= base_url('user/checkout') ?>"><i class="fa fa-shopping-cart"></i> Checkout </a>
        </div>
        <div class="card-body">
            <table class="table table-border ">
                <thead>
                    <tr>
                        <th class="text-start"> #</th>
                        <th class="text-start"> Tourism package name </th>
                        <th class="text-start"> Reservation date </th>
                        <th class="text-start"> Number of people </th>
                        <th class="text-start"> Status </th>
                        <th class="text-start"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if ($data != null) : ?>
                        <?php foreach ($data as $item) : ?>
                            <tr>
                                <td class="text-start"> <?= $no; ?> </td>
                                <td class="text-start"> <?= $item['package_name']; ?> </td>
                                <td class="text-start"> <?= $item['request_date']; ?> </td>
                                <td class="text-start"> <?= $item['number_people']; ?> </td>
                                <td class="text-start">
                                    <span class="badge bg-<?php if ($item['id_reservation_status'] == 1) {
                                                                echo "warning";
                                                            } else if ($item['id_reservation_status'] == 2) {
                                                                echo "success";
                                                            } else if ($item['id_reservation_status'] == 3) {
                                                                echo "danger";
                                                            }; ?>">
                                        <?= $item['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-success"><i class="fa fa-ticket" title="deposit"></i> </a>
                                    <?php if ($item['id_reservation_status'] != 2) : ?>
                                        <a title="cancel reservation" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reservationModal" onclick="showModalDelete('<?= $item['id'] ?>')"> <i class="fa fa-x"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                No reservation found!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    function showModalDelete(id) {
        $('#modalTitle').html("Abort reservation")
        $('#modalBody').html(`Are you sure delete this reservation?`)
        $('#modalFooter').html(`<a class="btn btn-danger" onclick="deleteReservation('${id}')"> Delete </a>`)
    }

    function deleteReservation(id_reservation) {
        $.ajax({
            url: `<?= base_url('reservation/delete') ?>/${id_reservation}`,
            type: "DELETE",
            async: false,
            contentType: "application/json",
            success: function(response) {
                console.log("masuk sini")
                console.log(response)
                Swal.fire(
                    'Reservation deleted',
                    '',
                    'success'
                ).then(() => {
                    window.location.replace("<?= base_url('user/reservation') ?>" + "/" + "<?= user()->id ?>")
                });
            },
            error: function(err) {
                console.log(err.responseText)
            }
        });
    }
</script>

<?= $this->endSection() ?>