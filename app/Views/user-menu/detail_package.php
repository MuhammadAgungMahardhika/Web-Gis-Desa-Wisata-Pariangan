<?= $this->extend('layout/template.php') ?>
<?= $this->section('content') ?>
<script src="<?= base_url('/assets/js/map.js') ?>"></script>
<!-- Modal reservation -->
<div class="modal fade text-left " id="reservationModal" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-white" id="modalTitle"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body " id="modalBody">
            </div>
            <div class="modal-footer" id="modalFooter">
            </div>
        </div>
    </div>
</div>
<section class="section">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="<?= base_url('package') ?>"> List package</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Detail package</li>

        </ol>
    </nav>
    <div class="row">
        <!-- Object Detail Information -->
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Tourism Package Information</h4>
                    <a class="btn btn-primary" onclick="showReservationModal()" data-bs-toggle="modal" data-bs-target="#reservationModal"> Reservation <i class="fa fa-ticket"></i> </a>
                    <div class="text-center">
                        <span class="material-symbols-outlined rating-color" id="s-1">star</span>
                        <span class="material-symbols-outlined rating-color" id="s-2">star</span>
                        <span class="material-symbols-outlined rating-color" id="s-3">star</span>
                        <span class="material-symbols-outlined rating-color" id="s-4">star</span>
                        <span class="material-symbols-outlined rating-color" id="s-5">star</span>
                    </div>
                    <p id="userTotal" class="text-center text-sm"></p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Name</td>
                                        <td><?= esc($data['name']); ?></td>
                                    </tr>
                                    <?php if (isset($data['id_homestay'])) : ?>
                                        <?php if ($data['id_homestay'] != null) : ?>
                                            <tr>
                                                <td class="fw-bold">Homestay </td>
                                                <td><?= esc($data['homestay_name']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td class="fw-bold">Price</td>
                                        <td><?= 'Rp ' . number_format(esc($data['price']), 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacity</td>
                                        <td><?= esc($data['capacity']) ?> people</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Contact Person</td>
                                        <td><?= esc($data['cp']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="fw-bold">Description</p>
                            <p><?= esc($data['description']); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p class="fw-bold">Service</p>
                            <?php $i = 1; ?>
                            <?php foreach ($data['services'] as $service) : ?>
                                <p class="px-1"><?= esc($i) . '. ' . esc($service); ?></p>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col border p-2">
                            <p class="fw-bold">Detail Packages </p>
                            <?php if ($data['package_day'] != null) : ?>
                                <div class="list-group list-group-horizontal-sm mb-4 text-center" role="tablist">
                                    <?php $dayNumber = 1; ?>
                                    <?php foreach ($data['package_day'] as $day) : ?>
                                        <a onclick="getObjectsByPackageDayId('<?= $day['day'] ?>')" class="list-group-item list-group-item-action <?= $dayNumber == 1 ? "active" : "" ?>" id="list-<?= $dayNumber; ?>-list" data-bs-toggle="list" href="#list-<?= $dayNumber; ?>" role="tab" aria-selected="<?= $dayNumber == 1 ? "true" : "false" ?>"> Day <?= $dayNumber; ?></a>
                                        <?php $dayNumber++; ?>
                                    <?php endforeach; ?>
                                </div>
                                <p class="fw-bold">Activities </p>
                                <div class="tab-content text-justify px-1">
                                    <?php $detailNumber = 1 ?>
                                    <?php foreach ($data['package_day'] as $day) : ?>
                                        <?php $i = 1; ?>
                                        <div class="tab-pane fade <?= $detailNumber == 1 ? "active show" : "" ?> " id="list-<?= $detailNumber ?>" role="tabpanel" aria-labelledby="list-<?= $detailNumber ?>-list">
                                            <?php foreach ($day['package_day_detail'] as $activities) : ?>
                                                <p><?= esc($i) . '. ' . esc($activities['detailDescription']); ?></p>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php $detailNumber++; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <p>Activities not found</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

            <!--Rating and Review Section-->
            <?= $this->include('layout/review-package'); ?>
        </div>

        <div class="col-md-6 col-12">
            <!-- Object Location on Map -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Google Maps</h5>
                </div>

                <?= $this->include('layout/map-body'); ?>

            </div>

            <!-- Object Media -->

        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    // Global variabel
    let datas = [<?= json_encode($data) ?>]
    let url = '<?= $url ?>'
    let id = "<?= $data['id'] ?>"
    let geomPariangan = JSON.parse('<?= $parianganData->geoJSON; ?>')
    let latPariangan = parseFloat(<?= $parianganData->lat; ?>)
    let lngPariangan = parseFloat(<?= $parianganData->lng; ?>)
    currentObjectRating()
    <?php if (in_groups('user')) : ?>
        currentUserRating()
    <?php endif; ?>
    getObjectComment()

    function currentObjectRating() {
        $.ajax({
            url: "<?= base_url('package'); ?>" + "/" + "/detail/" + id,
            method: "get",
            dataType: "json",
            success: function(response) {
                if (response) {

                    let countRating = response.countRating.rating
                    let userTotal = response.userTotal.userTotal
                    let avgRating = Math.ceil(countRating / userTotal)

                    $('#userTotal').html(userTotal + ' people rate this ' + url)
                    if (avgRating == 5) {
                        $("#s-1,#s-2,#s-3,#s-4,#s-5").addClass('star-checked');
                    }
                    if (avgRating == 4) {
                        $("#s-1,#s-2,#s-3,#s-4").addClass('star-checked');
                        $("#s-5").removeClass('star-checked');
                    }
                    if (avgRating == 3) {
                        $("#s-1,#s-2,#s-3").addClass('star-checked');
                        $("#s-4,#s-5").removeClass('star-checked');
                    }
                    if (avgRating == 2) {
                        $("#s-1,#s-2").addClass('star-checked');
                        $("#s-3,#s-4,#s-5").removeClass('star-checked');
                    }
                    if (avgRating == 1) {
                        $("#s-1").addClass('star-checked');
                        $("#s-2,#s-3,#s-4,#s-5").removeClass('star-checked');
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" +
                    xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function currentUserRating() {
        <?php if (in_groups('user')) : ?>
            $.ajax({
                url: "<?= base_url('package'); ?>" + "/detail/" + id,
                method: "get",
                data: {
                    user_id: '<?= user()->id ?>'
                },
                dataType: "json",
                success: function(response) {
                    if (response.userRating) {

                        let userRating = response.userRating.rating
                        let updatedDate = response.userRating.updated_date
                        $('#rateText').html('Last updated at: ' + updatedDate)
                        return setStar(userRating)
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" +
                        xhr.responseText + "\n" + thrownError);
                }
            });
        <?php endif; ?>
    }

    function getObjectComment() {
        $.ajax({
            url: "<?= base_url() ?>" + "/" + "review" + "/" + "get_" + url + "_comment",
            method: "GET",
            data: {
                'object_id': '<?= $data['id'] ?>'
            },
            dataType: "json",
            success: function(response) {
                if (response) {
                    console.log(response)
                    $('#commentBody').html('')
                    for (i in response) {
                        $('#commentBody').prepend(`<tr><td><p class="mb-0">${response[i].name}</p><p class="fw-light">${response[i].date}</p><p class="fw-bold">${response[i].comment}</p></td></tr>`);
                    }
                }
            }
        });
    }
    $("#formReview").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url() ?>" + "/" + "review" + "/" + "comment_" + url,
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                console.log("apakah masuk sini")
                document.getElementById("formReview").reset();
                getObjectComment()
            },
            error: function(e) {
                console.log(e.responseText)
            }
        });
    });
</script>
<script>
    let latBefore = ''
    let lngBefore = ''
    let routeArray = []

    <?php if ($data['package_day'] != null) : ?>
        getObjectsByPackageDayId('<?= $data['package_day'][0]['day'] ?>')
    <?php endif; ?>

    function getObjectsByPackageDayId(id_day) {
        $.ajax({
            url: `<?= base_url('package'); ?>/objects/package_day/${id_day}`,
            type: "GET",
            contentType: "application/json",
            success: function(response) {
                let objects = JSON.parse(response)
                getObjectById(objects)
            },
            error: function(err) {
                console.log(err.responseText)
            }
        });
    }

    function getObjectById(objects = null) {
        let objectNumber = 1
        let flightPlanCoordinates = []
        clearMarker()
        clearRadius()
        clearRoutes()

        objects.forEach(object => {
            let id_object = object['id_object']

            let URI = "<?= base_url('list_object') ?>";
            let url = ""
            if (id_object.charAt(0) == 'H') {
                url = "homestay"
                URI = URI + '/homestay/' + `${id_object.substring(1,3)}`
            } else if (id_object.charAt(0) == 'E') {
                url = "event"
                URI = URI + '/event/' + `${id_object.substring(1,3)}`
            } else if (id_object.charAt(0) == 'C') {
                url = "culinary_place"
                URI = URI + '/culinary_place/' + `${id_object.substring(1,3)}`
            } else if (id_object.charAt(0) == 'W') {
                url = "worship_place"
                URI = URI + '/worship_place/' + `${id_object.substring(1,3)}`
            } else if (id_object.charAt(0) == 'S') {
                url = "souvenir_place"
                URI = URI + '/souveni_place/' + `${id_object.substring(1,3)}`
            } else if (id_object.charAt(0) == 'A') {
                url = "atraction"
                URI = URI + '/atraction/' + `${id_object.substring(1,3)}`
            }

            $.ajax({
                url: URI,
                type: "GET",
                async: false,
                dataType: 'json',
                success: function(response) {

                    let data = response.objectData[0]
                    showObjectOnMap(objectNumber, data)

                }
            })
            objectNumber++
        })

    }

    // Display marker for loaded object
    function showObjectOnMap(objectNumber, data, anim = true) {
        let id = data.id
        let lat = data.lat
        let lng = data.lng
        google.maps.event.clearListeners(map, 'click');
        let pos = new google.maps.LatLng(lat, lng);
        let marker = new google.maps.Marker();
        let icon = `https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_red${objectNumber}.png`;

        markerOption = {
            position: pos,
            icon: icon,
            animation: google.maps.Animation.DROP,
            map: map,
        }
        marker.setOptions(markerOption);
        if (!anim) {
            marker.setAnimation(null);
        }
        marker.addListener('click', () => {
            openInfoWindow(marker, infoMarkerData(data, url = null))
        });
        markerArray[id] = marker;
        if (objectNumber == 1) {
            latBefore = lat
            lngBefore = lng
        } else {
            // boundToObject()
            routeAll(lat, lng)
        }
    }

    function routeAll(lat, lng) {
        google.maps.event.clearListeners(map, 'click')
        let directionsService = new google.maps.DirectionsService();
        let start, end;
        start = new google.maps.LatLng(latBefore, lngBefore);
        end = new google.maps.LatLng(lat, lng)
        let request = {
            origin: start,
            destination: end,
            travelMode: 'DRIVING'
        };
        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                directionsRenderer = new google.maps.DirectionsRenderer({
                    suppressMarkers: true
                })
                directionsRenderer.setDirections(result);

                directionsRenderer.setMap(map);
                routeArray.push(directionsRenderer);
            }
        });
    }

    function clearRoutes() {
        for (i in routeArray) {
            routeArray[i].setMap(null);
        }
        routeArray = [];
    }

    function showReservationModal() {
        <?php if (in_groups('user')) : ?>
            $('#modalTitle').html("Reservation form")
            $('#modalBody').html(`
            <div class=" p-2">
                <div class="mb-2 shadow-sm p-4 rounded">
                    <p class="text-center fw-bold text-dark"> Package Information </p>
                    <table class="table table-borderless text-dark ">
                                        <tbody>
                                        <?php if ($data['url'] != null) : ?>
                                            <tr>
                                                <td colspan="2"><img class="img-fluid img-thumbnail rounded" src="<?= base_url('media/photos') . '/' . $data['url'] ?>" width="100%"></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td class="fw-bold">Name</td>
                                                <td><?= esc($data['name']); ?></td>
                                            </tr>
                                            <?php if (isset($data['id_homestay'])) : ?>
                                                <?php if ($data['id_homestay'] != null) : ?>
                                                    <tr>
                                                        <td class="fw-bold">Homestay </td>
                                                        <td><?= esc($data['homestay_name']); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td class="fw-bold">Price</td>
                                                <td><?= 'Rp ' . number_format(esc($data['price']), 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Maks Capacity</td>
                                                <td><?= esc($data['capacity']) ?> people</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Contact Person</td>
                                                <td><?= esc($data['cp']); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Day total</td>
                                                <td><?= esc(count($data['package_day'])); ?></td>
                                            </tr>
                                        </tbody>
                    </table>
                </div>
                <div class="shadow p-4 rounded">
                    <div class="form-group mb-2">
                        <label for="reservation_date" class="mb-2"> Select reservation date </label>
                        <input type="date" id="reservation_date" class="form-control" required >
                    </div>
                    <div class="form-group mb-2">
                        <label for="number_people" class="mb-2"> Number of people </label>
                        <input type="number" id="number_people" placeholder="masimum capacity is <?= esc($data['capacity']) ?>" class="form-control" required >
                    </div>
                    <div class="form-group mb-2">
                        <label for="comment" class="mb-2"> Additional information </label>
                        <input type="text" id="comment" class="form-control" >
                    </div>
                </div>
            </div>
            `)
            $('#modalFooter').html(`<a class="btn btn-success" onclick="makeReservation(${<?= user()->id ?>})"> Make reservation </a>`)
        <?php else : ?>
            $('#modalTitle').html('Login required')
            $('#modalBody').html('Login as user for reservation')
            $('#modalFooter').html(`<a class="btn btn-primary" href="/login"> Login </a> <a class="btn btn-primary" href="/regiter"> Register </a>`)
        <?php endif; ?>
    }

    function makeReservation(user_id) {
        let reservationDate = $("#reservation_date").val()
        let numberPeople = $("#number_people").val()
        let comment = $("#comment").val()
        let numberCheckResult = checkNumberPeople(numberPeople)
        let dateCheckResult = checkIsDateExpired(reservationDate)
        let sameDateCheckResult = "true"
        if (reservationDate) {
            sameDateCheckResult = checkIsDateDuplicate(user_id, reservationDate)
        }

        if (!reservationDate) {
            Swal.fire('Please select reservation date', '', 'warning');
        } else if (numberPeople <= 0) {
            Swal.fire('Need 1 people at least', '', 'warning');
        } else if (numberCheckResult == false) {
            Swal.fire('Out of capacity, maksimal ' + '<?= $data['capacity'] ?>' + 'people', '', 'warning');
        } else if (dateCheckResult == false) {
            Swal.fire('Cannot Reserve, out of date, maksimal H-1 reservation', '', 'warning');
        } else if (sameDateCheckResult == "true") {
            Swal.fire('Already chose the same date! please select another date', '', 'warning');
        } else {
            console.log("masuk sini??")
            <?php if (in_groups('user')) : ?>
                let requestData = {
                    reservation_date: reservationDate,
                    id_user: user_id,
                    id_package: '<?= $data['id'] ?>',
                    id_reservation_status: 1, // pending status
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
                            window.location.replace(base_url + '/user/reservation/' + user_id)
                        });

                    },
                    error: function(err) {
                        console.log(err.responseText)
                    }
                });
            <?php endif; ?>
        }
    }

    function checkNumberPeople(numberPeople) {
        let packageCapacity = parseInt('<?= $data['capacity'] ?>')
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
<script>
    const myModal = document.getElementById('videoModal');
    const videoSrc = document.getElementById('video-play').getAttribute('data-src');

    myModal.addEventListener('shown.bs.modal', () => {
        console.log(videoSrc);
        document.getElementById('video').setAttribute('src', videoSrc);
    });
    myModal.addEventListener('hide.bs.modal', () => {
        document.getElementById('video').setAttribute('src', '');
    });
</script>
<!-- Maps JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&callback=initMap"></script>
<?= $this->endSection() ?>