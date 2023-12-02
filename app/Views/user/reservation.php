<?= $this->extend('layout/template.php') ?>
<?= $this->section('head'); ?>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/pages/form-element-select.css'); ?>">
<style>
    .filepond--root {
        width: 100%;
    }

    .background-effect {
        font-family: 'Bodoni Moda', serif;
        background-image: url('<?= base_url('media/photos/landing-page/ticket.jpg') ?>');
        background-size: cover;
        background-position-y: 20%;
    }

    .gold {
        text-transform: uppercase;
        line-height: 1;
        text-align: center;
        background: linear-gradient(90deg, rgba(186, 148, 62, 1) 0%, rgba(236, 172, 32, 1) 20%, rgba(186, 148, 62, 1) 39%, rgba(249, 244, 180, 1) 50%, rgba(186, 148, 62, 1) 60%, rgba(236, 172, 32, 1) 80%, rgba(186, 148, 62, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s infinite;
        background-size: 200%;
        background-position: left;
    }

    @keyframes shine {
        to {
            background-position: right
        }

    }
</style>
<?= $this->endSection() ?>
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
            <h3 class="card-title">My Booking</h3>
            <span id="multipleButton">
                <!-- <a title="Print multiple reservation" class="btn btn-primary" onclick="openMultipleCheckOut()"> <i class="fa-solid fa-print"></i> Print in Group </a> -->
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-border" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-start"> #</th>
                            <th class="text-start"> Tourism package name / ID </th>
                            <th class="text-start"> Booking date </th>
                            <th class="text-start"> Booking status </th>
                            <th class="text-start"> Progress detail</th>
                            <th class="text-center  checkSingle"> Action </th>
                            <th class="text-center  d-none checkAll"> Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php if ($data != null) : ?>

                            <?php foreach ($data as $item) : ?>
                                <?php
                                $userId = $item['id_user'];
                                $packageId = $item['id_package'];
                                $request_date = $item['request_date'];
                                $packageName = $item['package_name'];
                                $numberPeople = $item['number_people'];
                                $reservationIdStatus = $item['id_reservation_status'];
                                $statusReservation = $item['status'];
                                $rating = $item['rating'];
                                $review = $item['review'];
                                $dateNow = date("Y-m-d");
                                $depositDate = $item['deposit_date'];
                                $paymentDate = $item['payment_accepted_date'];
                                $refundDate = $item['refund_date'];

                                $proggres = "";
                                if ($reservationIdStatus == 1) {
                                    $proggres = "Please wait admin to confirm your reservation";
                                } else if ($reservationIdStatus == 2 && $depositDate == null) {
                                    $proggres = "Please upload your payment document";
                                } else if ($reservationIdStatus == 2 && $depositDate != null) {
                                    $proggres = "Document Uploaded! Please Wait admin to check your payment";
                                } else if ($reservationIdStatus == 3 && $paymentDate == null) {
                                    $proggres = "Sorry, your reservation is not accepted";
                                } else if ($reservationIdStatus == 3 && $paymentDate != null && $refundDate == null) {
                                    $proggres = "Your Booking has been canceled, Please wait Admin refund your money!";
                                } else if ($reservationIdStatus == 3 && $paymentDate != null && $refundDate != null) {
                                    $proggres = "Your Booking has been canceled, Admin has been refund your money!";
                                } else if ($reservationIdStatus == 4) {
                                    $proggres = "Transaction success, enjoy your jorney";
                                } else if ($reservationIdStatus == 5 && $rating == null) {
                                    $proggres = "Transaction finish, please rate and comment ";
                                } else if ($reservationIdStatus == 5 && $rating != null) {
                                    $proggres = "Transaction finish, thank you for visiting";
                                }
                                ?>
                                <tr>
                                    <td class="text-start text-sm"> <?= $no; ?> </td>
                                    <td class="text-start text-sm"> <?= $packageName; ?></td>
                                    <td class="text-start text-sm"> <?= $requestDate; ?> </td>
                                    <td class="text-start text-sm" style="min-width: 250px;">
                                        <a class="btn  btn-sm text-sm">
                                            <?= $reservationIdStatus == 1  ?  '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '' ?>
                                            Pending
                                        </a>
                                        <i class="fa fa-arrow-right fa-sm" aria-hidden="true"></i>
                                        <?php if ($reservationIdStatus == 3) : ?>
                                            <a class="btn btn-sm text-sm">
                                                <?= $reservationIdStatus == 3  ?  '<i class="fa fa-x text-danger" aria-hidden="true"></i> ' : '' ?>
                                                Cancel
                                            </a>
                                            <i class="fa fa-arrow-right fa-sm" aria-hidden="true"></i>
                                        <?php else : ?>
                                            <a class="btn btn-sm text-sm">
                                                <?= $reservationIdStatus == 2  ?  '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i> ' : '' ?>
                                                Commit
                                            </a>
                                            <i class="fa fa-arrow-right fa-sm" aria-hidden="true"></i>
                                        <?php endif; ?>
                                        <a class="btn btn-sm text-sm">
                                            <?= $reservationIdStatus == 4  ?  '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '' ?>
                                            Paid
                                        </a>
                                        <i class="fa fa-arrow-right fa-sm" aria-hidden="true"></i>
                                        <a class="btn btn-sm">
                                            <?= $reservationIdStatus == 5  ?  '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '' ?>
                                            Finish
                                        </a>

                                    </td>
                                    <td class="text-start text-sm">
                                        <?= $proggres ?>
                                    </td>
                                    <td class="text-start checkSingle text-sm" style="width: 150px;">

                                        <a class="btn btn-outline-primary btn-sm " title="detail booking" data-bs-toggle="modal" data-bs-target="#reservationModal" onclick="showInfoReservation('<?= $userId ?>','<?= $packageId ?>','<?= $request_date ?>')">
                                            <i title="detail booking" class="fa fa-info"></i>
                                        </a>
                                        <a class='btn btn-outline-primary btn-sm ' title="transaction history" data-bs-toggle='modal' data-bs-target='#reservationModal' onclick="showHistory('<?= $userId ?>','<?= $packageId ?>','<?= $request_date ?>')">
                                            <i title="transaction history" class="fa fa-history"></i>
                                        </a>

                                        <a title="rate and comment" class="btn btn-outline-primary  btn-sm <?= $reservationIdStatus == 5 && $rating == null ? '' : 'd-none' ?>" data-bs-toggle="modal" data-bs-target="#reservationModal" onclick="openModalRatingReservation('<?= $userId ?>','<?= $packageId ?>','<?= $request_date ?>')"> <i class="fa fa-star-o"></i></a>

                                        <a title="rate and comment info" class="btn btn-outline-primary btn-sm <?= $reservationIdStatus == 5 && $rating != null ? '' : 'd-none' ?> " data-bs-toggle="modal" data-bs-target="#reservationModal" onclick="openInfoRating('<?= $rating ?>','<?= $review ?>','<?= $item['updated_at']; ?>')"> <i class="fa fa-star"></i></a>


                                    </td>
                                    <td class="d-none text-center checkAll text-sm">
                                        <input type="checkbox" <?= $reservationIdStatus == 2 && $requestDate > $dateNow ? '' : 'disabled' ?> name="idPackage[]" value="<?= $userId . $packageId . $request_date  ?>">
                                    </td>

                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="<?= base_url('assets/js/extensions/form-element-select.js'); ?>"></script>
<script>
    new DataTable('#dataTable')
    let photo, pond, galleryValue

    function showHistory(id_user, id_package, request_date) {
        let result, historyData = ""
        $.ajax({
            url: `<?= base_url('reservation/show'); ?>/${id_user}/${id_package}/${request_date}`,
            type: "GET",
            async: false,
            contentType: "application/json",
            success: function(response) {
                result = JSON.parse(response)

            },
            error: function(err) {
                console.log(err.responseText)
            }
        });


        let idReservationStatus = result.id_reservation_status

        // booking request history
        let requestAt = result.created_at
        let requestBy = result.username
        if (requestAt != null && requestBy != null) {
            historyData += `<tr><td>Booking at</td><td>${requestAt}</td><td>by</td><td>${requestBy}</td></tr>`
        }
        if (idReservationStatus == 3) {
            // cancel history
            let canceledAt = result.canceled_at
            let canceledBy = result.canceled_by
            let cancelData = getUser(canceledBy)
            let canceledByName = cancelData.fullname
            if (canceledAt != null) {
                historyData += `<tr><td>Canceled at</td><td>${canceledAt}</td><td>by</td><td>${canceledByName}</td></tr>`
            }

        } else {
            // confirm history
            let confirmedAt = result.confirmed_at
            let confirmedBy = result.confirmed_by

            if (confirmedAt != null && confirmedBy != null) {
                let confirmatorData = getUser(confirmedBy)
                let confirmatorName = confirmatorData.fullname

                historyData += `<tr><td>Confirmed at</td><td>${confirmedAt}</td><td>by</td><td>${confirmatorName} (Admin)</td></tr>`
            }

            // deposit history
            let depositAt = result.deposit_date
            if (depositAt != null) {
                historyData += `<tr><td>Deposit at</td><td>${depositAt}</td><td>by</td><td>${requestBy}</td></tr>`
            }

            // payment history
            let accPaymentAt = result.payment_accepted_date
            let accPaymentBy = result.payment_accepted_by

            if (accPaymentAt != null && accPaymentBy != null) {
                let acceptorPaymentData = getUser(confirmedBy)
                let acceptorPaymentName = acceptorPaymentData.fullname
                historyData += `<tr><td>Accepted at</td><td>${accPaymentAt}</td><td>by</td><td>${acceptorPaymentName} (Admin)</td></tr>`
            }

            // finish
            if (idReservationStatus == 5) {
                historyData += `<tr><td>Finish</td></tr>`
            }
        }


        $('#modalTitle').html("Transaction History")
        $('#modalBody').html(
            `<table class="table table-border text-sm fst-italic">
                <tbody>
                    ${historyData}
                </tbody>
            </table>`
        )
    }


    function showInfoReservation(id_user, id_package, request_date) {
        let result
        $.ajax({
            url: `<?= base_url('reservation/show'); ?>/${id_user}/${id_package}/${request_date}`,
            type: "GET",
            async: false,
            contentType: "application/json",
            success: function(response) {
                result = JSON.parse(response)

            },
            error: function(err) {
                console.log(err.responseText)
            }
        });
        let reservationStatus = result['id_reservation_status']
        let buttonDelete =
            reservationStatus == '1' ? `<a class="btn btn-outline-danger" onclick="deleteReservation('${id_user}','${id_package}','${request_date}')"> Abort booking</a>` : '';

        $('#modalTitle').html("Booking Info")
        $('#modalBody').html(`
        <div class="p-2">
                <div id="userRating">
                </div>

                <div id="adminRefund">

                </div>
                <div id="userTicket">
                </div>
                
                <div id="userDeposit">
                </div>
                <div class="mb-2 shadow-sm p-4 rounded">
                    <p class="text-center fw-bold text-dark"> Booking Information </p>
                    <table class="table table-borderless text-dark ">
                        <tbody>
                            <tr>
                                <td id="buttonRefund">

                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">${buttonDelete}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Your booking status</td>
                                <td>${result['status']}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Request By</td>
                                <td>${result['username']}</td>
                            </tr>
                            
                            <tr>
                                <td class="fw-bold">Package name </td>
                                <td>${result['package_name']}</td>
                            </tr>
                                                
                            <tr>
                                <td class="fw-bold">Booking Date</td>
                                <td>${result['request_date']}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Total people</td>
                                <td>${result['number_people']}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Costum package</td>
                                <td class="${result['package_costum'] == '1' ? 'badge bg-success' : ''}">${result['package_costum'] == '2' ? 'no' : 'yes'}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Additional Information</td>
                                <td>${result['comment']!= null ? result['comment'] : '-'}</td>
                            </tr>               
                        </tbody>
                    </table>
                </div>
            
            </div>
        `)

        // user payment
        if (reservationStatus == '2') {

            let dat = new Date(request_date);
            let dd = String(dat.getDate() - 3).padStart(2, '0');
            let mm = String(dat.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = dat.getFullYear();

            dat = yyyy + '-' + mm + '-' + dd;

            let proofDeposit = result['proof_of_deposit']
            let deposit = result['deposit']
            $("#userDeposit").addClass("mb-2 shadow-sm p-4 rounded")
            $("#userDeposit").html(`
                <p class="text-center fw-bold text-dark"> Upload Your Payment </p>
                <p ></p>
                <p>Note <br><span class="text-danger">*</span> You must pay before <span class="text-primary"> ${dat} </span> ( H-3 )</span>  or booking will be cancel by the system<br><span class="text-danger">*</span> Before uploading proof of deposit, make sure the payment amount is the same as the invoice, please print the invoice to see the deposit amount</p>
                <div class="text-start mb-4">
                    <a class="btn btn-primary" onclick="openInvoice('${id_user}','${id_package}','${request_date}')" > <i class="fa fa-print"> </i> print invoice</a>
                </div>
                <div class="form-group mb-4">
                   <label for="deposit" class="mb-2"> Deposit <span class="text-danger">*</span></label>
                   <div class="input-group">
                   <span class="input-group-text">Rp </span>
                      <input type="number" id="deposit" class="form-control" name="deposit" placeholder="deposit" aria-label="deposit" value="${deposit}" aria-describedby="deposit" required>
                   </div>
                </div>
                <div class="form-group mb-4">
                    <label for="gallery" class="form-label"> Upload Proof of Deposit <span class="text-danger">*</span></label>
                    <input class="form-control" accept="image/*" type="file" name="gallery[]" id="gallery">
                </div>
                <div class="text-end">
                    <a class="btn btn-success" onclick="saveDeposit('${id_user}','${id_package}','${request_date}')" > save</a>
                </div>
           
            `)
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImagePreview,
                FilePondPluginImageResize,
                FilePondPluginMediaPreview,
            );
            // Get a reference to the file input element
            photo = document.querySelector('input[id="gallery"]');

            // Create a FilePond instance
            pond = FilePond.create(photo, {
                maxFileSize: '1920MB',
                maxTotalFileSize: '1920MB',
                imageResizeTargetHeight: 720,
                imageResizeUpscale: false,
                credits: false,
            });
            if (proofDeposit != null) {
                pond.addFiles(
                    `<?= base_url('media/photos/reservation') ?>/${proofDeposit}`
                );
            }
            pond.setOptions({
                server: {
                    timeout: 3600000,
                    process: {
                        url: '<?= base_url("upload/photo") ?>',
                        onload: (response) => {
                            galleryValue = response
                            console.log("processed:", response);
                            return response
                        },
                        onerror: (response) => {
                            console.log("error:", response);
                            return response
                        },
                    },
                    revert: {
                        url: '<?= base_url("upload/photo") ?>',
                        onload: (response) => {
                            console.log("reverted:", response);
                            return response
                        },
                        onerror: (response) => {
                            console.log("error:", response);
                            return response
                        },
                    },
                }
            })

        }

        // user refund information
        if (reservationStatus == '4' && result['payment_accepted_date'] != null) {
            $("#buttonRefund").html(`<a class="btn btn-outline-danger" onclick="openModalCancelAndRefund('${id_user}','${id_package}','${request_date}')">Cancel and Refund</a>`)
        }
        // admin refund info
        if (reservationStatus == '3' && result['proof_of_refund'] != null) {
            let deposit = result['deposit']
            let refundTotal = deposit / 2
            let proofRefund = result['proof_of_refund']
            $("#adminRefund").addClass("mb-2 shadow-sm p-4 rounded")
            $("#adminRefund").html(`
                <p class="text-center fw-bold text-dark"> Proof of Refund </p>
                <p ></p>
                <p>Note <br><span class="text-danger">*</span> Refund only 50% of your payment ( 50%*${rupiah(deposit)} )</p>
                <p> Refund total : <span class="text-primary"> ${rupiah(refundTotal)} </span></p>
                <div class="mb-2">
                    <img class="img-fluid img-thumbnail rounded" src="${'<?= base_url() ?>' + '/media/photos/refund/' + proofRefund }" width="100%">
                </div>
            `)
        }

        // user tiket
        if (reservationStatus == '4' && result['payment_accepted_date'] != null) {
            $("#userTicket").addClass("background-effect mb-2 shadow-sm p-4 rounded border border-warning")
            $("#userTicket").css('height', '250px');
            $("#userTicket").html(`
                <a class="btn" onclick="printTicket('${id_user}','${id_package}','${request_date}')">
                    <h1 class=" gold text-center fw-bold text-dark"> Print Your Ticket Here </h1>
                </a>
            `)
        }

        // user rating
        if (reservationStatus == '5' && result['rating'] != null) {
            let rating = result['rating']
            let updatedRating = result['updated_at']
            let review = result['review'] != null ? result['review'] : ''

            $("#userRating").addClass("mb-2 shadow-sm p-4 rounded")
            $("#userRating").html(`
                <p class="text-center fw-bold text-dark"> Rated And Reviewed </p>
                <p> Rated on : ${updatedRating} </p>
                <div class="star-containter mb-3 text-start">
                <i class="fa-solid fa-star fs-10" id="star-1" ></i>
                <i class="fa-solid fa-star fs-10" id="star-2" ></i>
                <i class="fa-solid fa-star fs-10" id="star-3" ></i>
                <i class="fa-solid fa-star fs-10" id="star-4" ></i>
                <i class="fa-solid fa-star fs-10" id="star-5" ></i>
                </div>
                <p> ${review} </p>
            `)
            setStar(rating)
        }

        $('#modalFooter').html(``)
    }

    const rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
        }).format(number);
    }

    function openModalCancelAndRefund(id_user, id_package, request_date) {
        Swal.fire({
            title: "Are you sure to canceled and refund it?",
            text: "Your refund only 50% of your payment",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, cancel and refund 50%"
        }).then((result) => {
            if (result.isConfirmed) {
                cancelAndRefundReservation(id_user, id_package, request_date)

            }
        });
    }

    function cancelAndRefundReservation(id_user, id_package, request_date) {
        let requestData = {
            id_reservation_status: 3,
            canceled_at: "true",
            canceled_by: '<?= user()->id ?>'
        }

        $.ajax({
            url: `<?= base_url('reservation/update'); ?>/${id_user}/${id_package}/${request_date}`,
            type: "PUT",
            data: requestData,
            async: false,
            contentType: "application/json",
            success: function(response) {
                Swal.fire({
                    title: "Canceled! ",
                    text: "Your booking has been canceled, wait admin to refund your money!",
                    icon: "success"
                });
                window.location.reload()
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })

    }

    function printTicket(id_user, id_package, request_date) {

        $.ajax({
            url: '<?= base_url("pdf/ticket-data") ?>',
            type: "POST",
            dataType: "json",
            data: {
                id_user: id_user,
                id_package: id_package,
                request_date: request_date
            },
            success: function(response) {
                window.open('<?= base_url('pdf/ticket'); ?>' + '/' + JSON.stringify(response));
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })
    }

    function saveDeposit(id_user, id_package, request_date) {
        let deposit = $("#deposit").val()
        let proofDeposit = galleryValue
        if (deposit <= 0) {
            Swal.fire(
                'Please input the deposit amount',
                '',
                'warning'
            )
        } else if (proofDeposit == null) {
            Swal.fire(
                'Please input the proof of deposit',
                '',
                'warning'
            )
        } else {
            let requestData = {
                deposit: deposit,
                proof_of_deposit: proofDeposit
            }
            $.ajax({
                url: `<?= base_url('reservation/update'); ?>/${id_user}/${id_package}/${request_date}`,
                type: "PUT",
                data: requestData,
                async: false,
                contentType: "application/json",
                success: function(response) {
                    Swal.fire(
                        'Booking updated',
                        '',
                        'success'
                    ).then(() => {
                        window.location.reload()
                    });
                },
                error: function(err) {
                    console.log(err.responseText)
                }
            });
        }

    }

    function openInfoRating(rating, review, updated_at) {

        $('#modalTitle').html("Thanks for rating and reviewed")
        $('#modalBody').html(`
            <p>  ${updated_at} </p>
            <div class="star-containter mb-3 text-start">
            <i class="fa-solid fa-star fs-10" id="star-1" ></i>
            <i class="fa-solid fa-star fs-10" id="star-2" ></i>
            <i class="fa-solid fa-star fs-10" id="star-3" ></i>
            <i class="fa-solid fa-star fs-10" id="star-4" ></i>
            <i class="fa-solid fa-star fs-10" id="star-5" ></i>
            </div>
            <p>  ${review} </p>
        `)
        setStar(rating)
        $("#modalFooter").html()
    }

    function openModalRatingReservation(id_user, id_package, request_date) {
        let url = `<?= base_url('review/package') ?>`
        $('#modalTitle').html("Please rate and review")
        $("#modalBody").html(`
        <?php if (in_groups('user')) : ?>
            <form class="form form-vertical" action="${url}" method="post" onsubmit="checkStar(event);">
                <div class="form-body">
                    <div class="star-containter mb-3 text-center">
                        <i class="fa-solid fa-star fs-4" id="star-1" onclick="setStar('1');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-2" onclick="setStar('2');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-3" onclick="setStar('3');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-4" onclick="setStar('4');"></i>
                        <i class="fa-solid fa-star fs-4" id="star-5" onclick="setStar('5');"></i>
                        <input type="hidden" id="star-rating" value="0" name="rating">
                        <input type="hidden" value="${id_user}" name="id_user">
                        <input type="hidden" value="${id_package}" name="id_package">
                        <input type="hidden" value="${request_date}" name="request_date">
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a review here" id="floatingTextarea" style="height: 150px;" name="review"></textarea>
                            <label for="floatingTextarea">Leave a review here</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
        `)
        $('#modalFooter').html()

    }
    // Validate if star rating picked yet
    function checkStar(event) {
        const star = document.getElementById('star-rating').value;
        if (star == '0') {
            event.preventDefault();
            Swal.fire('Please put rating star');
        }
    }

    function setStar(star) {
        $("#star-rating").val(star)
        switch (star) {
            case '1':
                $("#star-1").addClass('star-checked')
                $("#star-2,#star-3,#star-4,#star-5").removeClass('star-checked')
                break
            case '2':
                $("#star-1,#star-2").addClass('star-checked')
                $("#star-3,#star-4,#star-5").removeClass('star-checked')
                break
            case '3':
                $("#star-1,#star-2,#star-3").addClass('star-checked')
                $("#star-4,#star-5").removeClass('star-checked')
                break
            case '4':
                $("#star-1,#star-2,#star-3,#star-4").addClass('star-checked')
                $("#star-5").removeClass('star-checked')
                break
            case '5':
                $("#star-1,#star-2,#star-3,#star-4,#star-5").addClass('star-checked')
                break
        }
    }


    function showModalDelete(id_user, id_package, request_date) {
        $('#modalTitle').html("Abort booking")
        $('#modalBody').html(`Are you sure delete this booking?`)
        $('#modalFooter').html(`<a class="btn btn-danger" onclick="deleteReservation('${id_user}','${id_package}','${request_date}')"> Delete </a>`)
    }

    function deleteReservation(id_user, id_package, request_date) {
        $.ajax({
            url: `<?= base_url('reservation/delete') ?>/${id_user}/${id_package}/${request_date}`,
            type: "DELETE",
            async: false,
            contentType: "application/json",
            success: function(response) {
                Swal.fire(
                    'Booking deleted',
                    '',
                    'success'
                ).then(() => {
                    window.location.reload()
                });
            },
            error: function(err) {
                console.log(err.responseText)
            }
        });
    }

    function openInvoice(id_user = null, id_package = null, request_date = null) {
        $.ajax({
            url: '<?= base_url("pdf/invoice-data") ?>',
            type: "POST",
            dataType: "json",
            data: {
                id_user: id_user,
                id_package: id_package,
                request_date: request_date
            },
            success: function(response) {

                window.open('<?= base_url('pdf/invoice'); ?>' + '/' + JSON.stringify(response));
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })

    }

    function getUser(id) {
        let result
        $.ajax({
            url: `<?= base_url('user/getUser'); ?>/${id}`,
            type: "GET",
            async: false,
            contentType: "application/json",
            success: function(response) {
                result = JSON.parse(response)
            },
            error: function(err) {
                console.log(err.responseText)
            }
        });
        return result
    }
</script>

<?= $this->endSection() ?>