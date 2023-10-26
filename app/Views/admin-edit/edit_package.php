<?= $this->extend('layout/template.php') ?>
<?= $this->section('head') ?>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/pages/form-element-select.css'); ?>">
<style>
    .filepond--root {
        width: 100%;
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
    <form class="form form-horizontal" action="<?= base_url('manage_package/save_update/') . '/' . $data['id']; ?>" method="post" onsubmit="checkRequired(event)" enctype="multipart/form-data">
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

                            <div class="form-group mb-4">
                                <label for="name" class="mb-2">Tourism Package Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" value="<?= $data['name'] ?>" class="form-control" name="name" placeholder="Tourism Package Name" value="" required>
                            </div>
                            <?php if (isset($homestayData)) : ?>
                                <fieldset class="form-group mb-4">
                                    <label for="id_homestay" class="mb-2">Homestay</label>
                                    <select class="form-select" id="id_homestay" name="id_homestay">
                                        <option value="" selected> </option>
                                        <?php if ($homestayData) : ?>
                                            <?php foreach ($homestayData as $homestay) : ?>
                                                <?php if ($edit && $homestay['id'] && $data['id_homestay']) : ?>
                                                    <option value="<?= $homestay['id'] ?>" <?= (esc($homestay['id']) == $data['id_homestay']) ? 'selected' : ''; ?>><?= $homestay['name']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= esc($homestay['id']); ?>"><?= esc($homestay['name']); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                        <?php endif; ?>
                                    </select>
                                </fieldset>
                            <?php endif; ?>
                            <div class="form-group mb-4">
                                <label for="price" class="mb-2">Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp </span>
                                    <input type="number" value="<?= $data['price'] ?>" id="price" class="form-control" name="price" placeholder="price" aria-label="price" aria-describedby="price" value="" required>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="capacity" class="mb-2">Capacity</label>
                                <input type="text" value="<?= $data['capacity'] ?>" id="capacity" class="form-control" name="capacity" placeholder="capacity" value="">
                            </div>
                            <div class="form-group mb-4">
                                <label for="contact_person" class="mb-2">Contact Person</label>
                                <input type="text" value="<?= $data['cp'] ?>" id="contact_person" class="form-control" name="cp" placeholder="Contact Person" value="">
                            </div>

                            <div class="form-group mb-4">
                                <label for="service_package" class="mb-2">Service Package</label>
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
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="gallery" class="form-label">Brosur url</label>
                                <input class="form-control" accept="image/*" type="file" name="gallery[]" id="gallery">
                            </div>

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
                                                            <td><input value="<?= $detailPackage['activity_type']; ?>" class="form-control" name="packageDetailData[<?= $noDay ?>][detailPackage][<?= $noDetail ?>][activity_type]"></td>
                                                            <td><input value="<?= $detailPackage['description']; ?>" class="form-control" name="packageDetailData[<?= $noDay ?>][detailPackage][<?= $noDetail ?>][description]" required></td>
                                                            <td><a class="btn btn-danger" onclick="removeObject('<?= $noDay ?>','<?= $noDetail ?>')"> <i class="fa fa-x"></i> </a></td>
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
                    <label for="detail-package-id-object" class="mb-2">Object</label>
                    <select class="form-select" id="detail-package-id-object" name="detail-package-id-object">
                                    <?php if ($objectData) : ?>
                                        <?php $no = 0; ?>       
                                        <?php foreach ($objectData as $object) : ?>
                                           
                                    <option value="<?= esc($object->id); ?>" <?= ($no == 0) ? 'selected' : ''; ?>> <?= $object->id ?> - <?= esc($object->name); ?></option>
                                        
                                            <?php $no++; ?>       
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value=" ">Homestay not found</option>
                                    <?php endif; ?>
                     </select>
        </div>
        <div class="form-group mb-4">
                    <label for="detail-package-activity-type" class="mb-2">Activity type</label>
                    <input type="text" id="detail-package-activity-type" class="form-control" name="detail-package-activity-type" placeholder="activity type" required>
        </div> 
        <div class="form-group mb-4">
                    <label for="detail-package-description" class="mb-2">Description</label>
                    <input type="text" id="detail-package-description" class="form-control" name="detail-package-description" placeholder="Detail package description" required>
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

    function saveDetailPackageDay(noDay) {
        //get data from modal input
        let noDetail = parseInt($(`#lastNoDetail${noDay}`).val())
        console.log(noDetail)
        let object_id = $("#detail-package-id-object").val()
        let activity_type = $("#detail-package-activity-type").val()
        let description = $("#detail-package-description").val()

        $(`#body-detail-package-${noDay}`).append(`
        <tr id="${noDay}-${noDetail}"> 
          <td><input class="form-control" value="${object_id}" name="packageDetailData[${noDay}][detailPackage][${noDetail}][id_object]" required readonly></td>
          <td><input class="form-control" value="${activity_type}" name="packageDetailData[${noDay}][detailPackage][${noDetail}][activity_type]"></td>
          <td><input class="form-control" value="${description}" name="packageDetailData[${noDay}][detailPackage][${noDetail}][description]" required></td>
          <td><a class="btn btn-danger" onclick="removeObject('${noDay}','${ noDetail }')"> <i class="fa fa-x"></i> </a></td>
        </tr>     
        `)
        $(`#lastNoDetail${noDay}`).val(noDetail + 1)
    }
</script>

<script>
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageResize,
        FilePondPluginMediaPreview,
    );

    // Get a reference to the file input element
    const photo = document.querySelector('input[id="gallery"]');

    // Create a FilePond instance
    const pond = FilePond.create(photo, {
        imageResizeTargetHeight: 720,
        imageResizeUpscale: false,
        credits: false,
    })

    pond.setOptions({
        server: {
            timeout: 3600000,
            process: {
                url: '<?= base_url("upload/photo") ?>',
                onload: (response) => {
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
    });

    // add new service gallery
    // Get a reference to the file input element
    const photoservice = document.querySelector('input[id="galleryservice"]');

    // Create a FilePond instance
    const pondservice = FilePond.create(photoservice, {
        imageResizeTargetHeight: 720,
        imageResizeUpscale: false,
        credits: false,
    })

    pondservice.setOptions({
        server: {
            timeout: 3600000,
            process: {
                url: '<?= base_url("upload/photo") ?>',
                onload: (response) => {
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

    function addNewFacility(val) {
        $('#listFacility').append(`<tr><td><input type="text" class="form-control" name="facility_package[]" required value="${val}"></td></tr>`)
        $('#facility').val('');

    }
</script>
<?= $this->endSection() ?>