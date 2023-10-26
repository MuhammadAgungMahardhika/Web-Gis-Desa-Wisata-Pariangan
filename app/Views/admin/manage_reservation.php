<?= $this->extend('layout/template.php') ?>
<?= $this->section('content') ?>
<!-- Modal reservation -->
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
<!-- Begin Page Content -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">List reservation</li>
        </ol>
    </nav>
    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary text-center">List reservation Package</h5>
            <a class="btn btn-success" onclick="showReservationModal()" data-bs-toggle="modal" data-bs-target="#reservationModal"> add <i class="fa fa-plus"></i> </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <?php $no = 1; ?>
                        <tr>
                            <th>No</th>
                            <th>Request Package Name</th>
                            <th>Username</th>
                            <th>Request date</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objectData as $reservation) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $reservation['package_name']; ?></td>
                                <td><?= $reservation['username']; ?></td>
                                <td>
                                    <?= $reservation['request_date']; ?>
                                </td>
                                <td>
                                    <span class="<?php if ($reservation['id_reservation_status'] == "1") {
                                                        echo "badge bg-warning";
                                                    } elseif ($reservation['id_reservation_status'] == "2") {
                                                        echo "badge bg-success";
                                                    } else {
                                                        echo "badge bg-danger";
                                                    } ?>"> <?= $reservation['status']; ?></span>
                                </td>
                                <td class="text-center">

                                    <a class="btn btn-outline-success btn-sm  <?= ($reservation['id_reservation_status'] == "2") ? "invisible" : "" ?>" title="confirm" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $reservation['id']; ?>">
                                        <i class="fa fa-check"></i>
                                    </a>

                                    <a class="btn btn-outline-danger btn-sm" title="cancel" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $reservation['id']; ?>">
                                        <i class="fa fa-x"></i>
                                    </a>

                                    <!-- Delete Modal-->
                                    <div class="modal fade" id="deleteModal<?= $reservation['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cancel Reservation</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Are you sure cancel <b>" <?= $reservation['id']; ?> - <?= $reservation['package_name']; ?> from <?= $reservation['username']; ?> "</b> reservation?</div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-danger" onclick="cancelReservation('<?= $reservation['id']; ?>')">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Confirm Modal-->
                                    <div class="modal fade" id="confirmModal<?= $reservation['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Reservation</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"> Confirm this <b>" <?= $reservation['id']; ?> - <?= $reservation['package_name']; ?> from <?= $reservation['username']; ?> "</b> reservation?</div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-success" onclick="confirmReservation('<?= $reservation['id']; ?>')">Confirm</a>
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
<!--container-fluid -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    function cancelReservation(id) {
        $.ajax({
            url: "<?= base_url('manage_reservation/save_update') ?>" + "/" + `${id}`,
            type: "PATCH",
            data: {
                id_reservation_status: "3"
            },
            async: false,
            success: function(response) {
                Swal.fire(
                    'Reservation cancel',
                    '',
                    'danger'
                ).then(() => {
                    window.location.replace("<?= base_url('manage_reservation') ?>")
                });
            },
            error: function(e) {
                console.log(e.responseText)
            }
        })
    }

    function confirmReservation(id) {
        $.ajax({
            url: "<?= base_url('manage_reservation/save_update') ?>" + "/" + `${id}`,
            type: "PATCH",
            data: {
                id_reservation_status: "2"
            },
            async: false,
            success: function(response) {
                Swal.fire(
                    'Reservation confirmed',
                    '',
                    'success'
                ).then(() => {
                    window.location.replace("<?= base_url('manage_reservation') ?>")
                });
            },
            error: function(e) {
                console.log(e.responseText)
            }
        })
    }
</script>
<script>
    function showReservationModal() {
        <?php if (in_groups('admin')) : ?>
            $('#modalTitle').html("Reservation")
            $('#modalBody').html(`
            <label for="id_user" class="mb-2">User</label>
                    <select class="form-select" id="id_user" required>
                                    <?php if ($userData) : ?>
                                        <?php $no = 0; ?>       
                                        <?php foreach ($userData as $user) : ?>
                                           
                                    <option value="<?= esc($user->id); ?>" <?= ($no == 0) ? 'selected' : ''; ?>>  <?= esc($user->username); ?></option>
                                        
                                            <?php $no++; ?>       
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">User not found</option>
                                    <?php endif; ?>
                     </select>
            <label for="id_package" class="mb-2"> Package name </label>
                    <select class="form-select" id="id_package" required>
                        <?php if ($packageData) : ?>
                           <?php $no = 0; ?>       
                           <?php foreach ($packageData as $package) : ?>
                                           
                             <option value="<?= esc($package->id); ?>" <?= ($no == 0) ? 'selected' : ''; ?>>  <?= esc($package->name); ?></option>
                                
                           <?php $no++; ?>       
                           <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Package not found</option>
                        <?php endif; ?>
                     </select>
                        <?php if ($packageData) : ?>
                            <?php $no = 0; ?>       
                            <?php foreach ($packageData as $package) : ?>
                                <input type="hidden" value="<?= esc($package->capacity); ?>" id="capacity_of_package<?= esc($package->id); ?>" required >   
                             <?php $no++; ?>       
                            <?php endforeach; ?>
                        <?php endif ?>
            <div class="form-group mb-2">
                <label for="reservation_date" class="mb-2">Reservation date </label>
                <input type="date" id="reservation_date" class="form-control" required >
            </div>
            <div class="form-group mb-2">
                <label for="number_people" class="mb-2"> Number of people </label>
                <input type="number" id="number_people" class="form-control" required >
            </div>
            <div class="form-group mb-2">
                <label for="comment" class="mb-2"> Comment </label>
                <input type="text" id="comment" class="form-control"  >
            </div>
            <div class="form-group mb-2">
                <label for="status" class="mb-2"> Status reservation </label>
                <select class="form-select" id="status" required>
                            <?php if ($statusData) : ?>
                            <?php $no = 0; ?>       
                            <?php foreach ($statusData as $status) : ?>
                                            
                                <option value="<?= esc($status->id); ?>" <?= ($no == 1) ? 'selected' : ''; ?>>  <?= esc($status->status); ?></option>
                                    
                            <?php $no++; ?>       
                            <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Package not found</option>
                            <?php endif; ?>
            </div>
            `)
            $('#modalFooter').html(`<a class="btn btn-success" onclick="makeReservation()"> Make reservation </a>`)
        <?php endif; ?>
    }

    function makeReservation() {
        let userId = $("#id_user").val()
        let packageId = $("#id_package").val()
        let status = $("#status").val()
        let capacityOfPackage = $(`#capacity_of_package${packageId}`).val()
        let reservationDate = $("#reservation_date").val()
        let numberPeople = $("#number_people").val()
        let comment = $("#comment").val()
        let numberCheckResult = checkNumberPeople(numberPeople, capacityOfPackage)
        let dateCheckResult = checkIsDateExpired(reservationDate)
        let sameDateCheckResult = "true"
        if (reservationDate) {
            sameDateCheckResult = checkIsDateDuplicate(userId, reservationDate)
        }

        if (!reservationDate) {
            Swal.fire('Please select reservation date', '', 'warning');
        } else if (numberPeople <= 0) {
            Swal.fire('Need 1 people at least', '', 'warning');
        } else if (numberCheckResult == false) {
            Swal.fire('Out of capacity, maksimal ' + `${capacityOfPackage}` + ' people', '', 'warning');
        } else if (dateCheckResult == false) {
            Swal.fire('Cannot Reserve, out of date, maksimal H-1 reservation', '', 'warning');
        } else if (sameDateCheckResult == "true") {
            Swal.fire('Already chose the same date! please select another date', '', 'warning');
        } else {
            <?php if (in_groups('admin')) : ?>
                let requestData = {
                    reservation_date: reservationDate,
                    id_user: userId,
                    id_package: packageId,
                    id_reservation_status: status, // pending status
                    number_people: numberPeople,
                    comment: comment
                }
                $.ajax({
                    url: `<?= base_url('reservation'); ?>/create`,
                    type: "POST",
                    data: requestData,
                    async: false,
                    contentType: "application/json",
                    success: function(response) {
                        console.log(response)
                        Swal.fire(
                            'Success to make reservation request',
                            '',
                            'success'
                        ).then(() => {
                            window.location.replace('<?= base_url('manage_reservation') ?>')
                        });

                    },
                    error: function(err) {
                        console.log(err.responseText)
                    }
                });
            <?php endif; ?>
        }
    }

    function checkNumberPeople(numberPeople, capacityOfPackage) {
        let packageCapacity = parseInt(capacityOfPackage)
        let peopleNumberRequest = parseInt(numberPeople)

        if (peopleNumberRequest > packageCapacity) {
            return false
        } else {
            return true
        }
    }

    function checkIsDateExpired(reservation_date) {
        let result

        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        let yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        if (reservation_date > today) {
            result = true
        } else {
            result = false
        }
        return result
    }

    function checkIsDateDuplicate(user_id, reservation_date) {
        let result
        $.ajax({
            url: `<?= base_url('reservation') ?>/check/${user_id}/${reservation_date}`,
            type: "GET",
            async: false,
            success: function(response) {
                result = response
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })
        return result
    }
</script>
<?= $this->endSection() ?>