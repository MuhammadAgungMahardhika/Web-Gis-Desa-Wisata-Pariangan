<?= $this->extend('layout/template.php') ?>
<?= $this->section('head') ?>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/pages/form-element-select.css'); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .filepond--root {
        width: 100%;
    }
</style>
<style>
    input[type=date]::-webkit-inner-spin-button,
    input[type=date]::-webkit-calendar-picker-indicator {
        display: none;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- modal detail -->
<div class="modal fade text-left" id="modalPackage" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader"> </h5>
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
    <form class="form form-horizontal" action="<?= base_url('package/saveCostumExisting/') ?>" method="post" onsubmit="checkRequired(event)" enctype="multipart/form-data">
        <div class="form-body">
            <div class="row">
                <script>
                    currentUrl = '<?= current_url(); ?>';
                </script>
                <!-- Object Detail Information -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center"><?= $title; ?></h4>
                        </div>
                        <div class="card-body">
                            <?php if ($data['date'] != null) : ?>
                                <div class="form-group mb-4">
                                    <label for="reservation_date" class="mb-2"> Package date</label>
                                    <input type="date" value="<?= $data['date'] ?>" id="reservation_date" name="reservationData[reservation_date]" class="form-control" required readonly>
                                </div>
                            <?php else : ?>
                                <div class="form-group mb-4">
                                    <label for="reservation_date" class="mb-2"> Select reservation date<span class="text-danger">*</span> <span class="text-primary">( H-7 )</span></label>
                                    <input type="date" id="reservation_date" name="reservationData[reservation_date]" class="form-control" required>
                                </div>
                            <?php endif;  ?>
                            <div class="form-group mb-4">
                                <label for="number_people" class="mb-2"> Number of people<span class="text-danger">*</span> <span class="text-primary"> ( Max <?= $data['capacity'] ?> people ) </span> </label>
                                <input type="number" id="number_people" placeholder="Maksimum <?= $data['capacity'] ?> people only" name="reservationData[number_people]" class="form-control" required>
                            </div>
                            <!-- service package include -->
                            <div class="form-group mb-4">
                                <label for="service_package" class="mb-2">Service Package </label>
                                <select class="choices form-select multiple-remove" multiple="multiple" id="service_package" name="service_package[]">
                                    <?php foreach ($serviceData as $service) : ?>
                                        <?php if (in_array(esc($service['name']), $data['service_package'])) : ?>
                                            <option value="<?= esc($service['id']); ?>" selected><?= esc($service['name']); ?></option>
                                        <?php else : ?>
                                            <option value="<?= esc($service['id']); ?>"><?= esc($service['name']); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="comment" class="mb-2"> Additional information </label>
                                <input type="text" id="comment" name="reservationData[comment]" class="form-control">
                            </div>

                            <input type="hidden" name="reservationData[package_name]" value="<?= $data['name'] ?>">
                            <input type="hidden" name="reservationData[costum]" value="1">
                            <input type="hidden" name="username" value="<?= user()->username ?>">
                            <input type="hidden" name="id_user" value="<?= user()->id ?>">

                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">Detail package</h4>
                        </div>
                        <div class="card-body">
                            <button type="button" onclick="openPackageDayModal(`${noDay}`)" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#modalPackage"> New package day
                            </button>

                            <div class="p-4" id="package-day-container">
                                <?php $noDay = 1; ?>
                                <?php if ($packageDayData) : ?>

                                    <?php foreach ($packageDayData as $packageDay) : ?>
                                        <div class="border shadow-sm p-4 mb-4 table-responsive">
                                            <span> Day </span> <input value="<?= $noDay ?>" type="text" name="packageDetailData[<?= $noDay ?>][day]" class="d-block" id="input-day-<?= $noDay ?>" readonly>
                                            <span> Object count </span> <input disabled type="text" id="lastNoDetail<?= $noDay ?>" class="d-block">
                                            <!-- give day order -->
                                            <span> Description </span> <input value="<?= $packageDay['description'] ?>" name="packageDetailData[<?= $noDay ?>][packageDayDescription]" class="d-block">

                                            <br>
                                            <br>
                                            <?php $noDetail = 0; ?>

                                            <a class="btn btn-outline-success btn-sm" onclick="openDetailPackageModal(<?= $noDay ?>)" data-bs-toggle="modal" data-bs-target="#modalPackage"> <i class="fa fa-plus"> </i> </a>
                                            <table class="table table-sm table-border" id="table-day">
                                                <thead>
                                                    <tr>
                                                        <th>Object code <span class="text-danger">*</span> </th>
                                                        <th>Activity type</th>
                                                        <th>Activity description <span class="text-danger">*</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="body-detail-package-<?= $noDay ?>">
                                                    <?php foreach ($packageDay['detailPackage'] as $detailPackage) : ?>
                                                        <tr id="<?= $noDay ?>-<?= $noDetail ?>">
                                                            <td><input value="<?= $detailPackage['id_object']; ?>" class="form-control" name="packageDetailData[<?= $noDay ?>][detailPackage][<?= $noDetail ?>][id_object]" required readonly></td>
                                                            <td><input value="<?= $detailPackage['activity_type']; ?>" class="form-control" name="packageDetailData[<?= $noDay ?>][detailPackage][<?= $noDetail ?>][activity_type]" readonly></td>
                                                            <td><input value="<?= $detailPackage['description']; ?>" class="form-control" name="packageDetailData[<?= $noDay ?>][detailPackage][<?= $noDetail ?>][description]" required readonly></td>

                                                        </tr>
                                                        <?php $noDetail++ ?>
                                                    <?php endforeach; ?>
                                                    <script>
                                                        $(`#lastNoDetail<?= $noDay ?>`).val(<?= $noDetail ?>)
                                                    </script>

                                                </tbody>
                                            </table>
                                        </div>
                                        <?php $noDay++ ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="<?= base_url('assets/js/extensions/form-element-select.js'); ?>"></script>
<script>
    <?php if ($data['date'] == null) : ?>
        let dateNow = new Date();
        $('#reservation_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: new Date(dateNow.getFullYear(), dateNow.getMonth(), dateNow.getDate() + 7),
            todayHighlight: true
        });
    <?php endif; ?>

    function checkRequired(event) {
        let reservationDate = $('#reservation_date').val()
        let numberPeople = $('#number_people').val()
        let peopleMax = parseInt('<?= $data['capacity']; ?>')
        console.log(numberPeople)
        console.log(peopleMax)
        let today = new Date();
        let dd = String(today.getDate() - 7).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        let yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        if (reservationDate <= today) {
            event.preventDefault();
            Swal.fire('Cannot create costume package, out of date, Maximum H-1 reservation', '', 'warning');
        } else if (numberPeople <= 0) {
            event.preventDefault();
            Swal.fire('Need 1 people at least', '', 'warning');
        } else if (numberPeople > peopleMax) {
            event.preventDefault();
            Swal.fire(`Out of capacity, max ${peopleMax} only', '', 'warning`);
        }
    }

    function removeObject(noDay, noDetail) {
        console.log("masuk sini")
        $(`#${noDay}-${noDetail}`).remove()
        let current = $(`#lastNoDetail${noDay}`).val()
        $(`#lastNoDetail${noDay}`).val(current - 1)

    }
    //open modal package day

    function openPackageDayModal(noDay) {
        $("#modalHeader").html(`New package day`)
        $("#modalBody").html(
            `<div class="form-group mb-4">
                <label for="package-day" class="mb-2">Day</label>
                <input type="text" value="${noDay}" id="package-day" class="form-control" name="description" placeholder="package day" readonly>
            </div>
            <div class="form-group mb-4">
                <label for="package-day-description" class="mb-2">Description</label>
                <input type="text" id="package-day-description" class="form-control" name="description" placeholder="package day description" required>
            </div>`
        )
        $("#modalFooter").html(
            `<button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" onclick="addPackageDay()" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
             </button>`
        )
    }

    let noDay = <?= $noDay ?>

    // add package day to container
    function addPackageDay() {
        console.log(noDay)
        let packageDayDescription = $("#package-day-description").val()
        $("#package-day-container").append(`
        <div class="border shadow-sm p-2 mb-2">
        <span> Day </span>  <input type="text" value="${noDay}" name="packageDetailData[${noDay}][day]"  class="d-block" readonly> 
        <span> Object count </span> <input disabled value="0" type="text" id="lastNoDetail${noDay}" class="d-block">
        <span> Description </span>  <input value="${packageDayDescription}" name="packageDetailData[${noDay}][packageDayDescription]" class="d-block" >  
        <br>
        <br>
        <a class="btn btn-outline-success btn-sm" onclick="openDetailPackageModal('${noDay}')" data-bs-toggle="modal" data-bs-target="#modalPackage"> <i class="fa fa-plus"> </i> </a>
        <table class="table table-border" id="table-day"> 
            <thead>
                <tr>
                    <th>Object code <span class="text-danger">*</span></th>
                    <th>Activity type</th>
                    <th>Description <span class="text-danger">*</span></th>
                </tr>  
            </thead>
            <tbody id="body-detail-package-${noDay}">

            </tbody>     
        </table>
        </div>`)
        noDay++
    }

    function openDetailPackageModal(noDay) {
        $("#modalHeader").html(`Add Day ${noDay} Detail`)
        $("#modalBody").html(`
        <input type="text" id="detail-package-day" class="form-control" name="detail-package-day" value="${noDay}" readonly placeholder="object" required>
        <div class="form-group mb-4">
                    <label for="select-object" class="mb-2">Object</label>
                    <select class="form-select" onchange="addObjectValue(this.value)" required>
                                     <option >Pilih objek</option>
                                    <?php if ($objectData) : ?>
                                        <?php $no = 0; ?>       
                                        <?php foreach ($objectData as $object) : ?>
                                            
                                    <option value="<?= esc(json_encode($object)) ?>"> <?= $object->id ?> - <?= esc($object->name); ?></option>
                                        
                                            <?php $no++; ?>       
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                       
                                    <?php endif; ?>
                     </select>
        </div>
        <input id="detail-package-id-object" type="hidden" required>
        <input id="detail-package-price-object" type="hidden" type="number" value="0" required>
       
        <div class="form-group mb-4">
                    <label for="detail-package-description" class="mb-2">Description</label>
                    <input type="text" id="detail-package-description" class="form-control" name="detail-package-description" placeholder="Detail package description">
        </div>
        `)
        $("#modalFooter").html(
            `<button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" onclick="saveDetailPackageDay(${noDay})" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
            </button>`
        )
    }

    function addObjectValue(object) {

        console.log(object)
        let objectData = JSON.parse(object)
        let objectId = objectData.id
        let objectName = objectData.name
        $("#detail-package-id-object").val(objectId)
        $("#detail-package-description").val("Visit " + objectName)
        let objectPrice = objectData.price == null ? 0 : parseInt(objectData.price)
        $("#detail-package-price-object").val(objectPrice)
    }

    function saveDetailPackageDay(noDay) {
        //get data from modal input
        let noDetail = parseInt($(`#lastNoDetail${noDay}`).val())
        console.log(noDetail)
        let object_id = $("#detail-package-id-object").val()
        let activity_type = ''
        let description = $("#detail-package-description").val()

        if (object_id.substring(0, 1) == 'A') {
            activity_type = 'Atraksi'
        } else if (object_id.substring(0, 1) == 'C') {
            activity_type = 'Culinary Place'
        } else if (object_id.substring(0, 1) == 'S') {
            activity_type = 'Souvenir Place'
        } else if (object_id.substring(0, 1) == 'W') {
            activity_type = 'Worship Place'
        } else if (object_id.substring(0, 1) == 'H') {
            activity_type = 'Homestay'
        }
        $(`#body-detail-package-${noDay}`).append(`
        <tr id="${noDay}-${noDetail}"> 
          <td><input class="form-control" value="${object_id}" name="packageDetailData[${noDay}][detailPackage][${noDetail}][id_object]" required readonly></td>
          <td>
          <input class="form-control" value="${activity_type}" name="packageDetailData[${noDay}][detailPackage][${noDetail}][activity_type]"  readonly>
          </td>
          <td><input class="form-control" value="${description}" name="packageDetailData[${noDay}][detailPackage][${noDetail}][description]" required></td>
          <td><a class="btn btn-danger" onclick="removeObject('${noDay}','${ noDetail }')"> <i class="fa fa-x"></i> </a></td>
        </tr>     
        `)
        $(`#lastNoDetail${noDay}`).val(noDetail + 1)
    }
</script>

<?= $this->endSection() ?>