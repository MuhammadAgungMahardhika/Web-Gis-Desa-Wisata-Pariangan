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
<section class="section">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('manage_pariangan') ?>">Detail village</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit village</li>
        </ol>
    </nav>
    <form class="form form-vertical" action="<?= base_url('manage_pariangan/save_update/' . $parianganData->id); ?>" method="post">
        <div class="row">
            <!-- Object Detail Information -->
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= base_url('manage_pariangan'); ?>" role="button" class="btn btn-primary justify-item-center" title="edit pariangan info"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title text-center">Edit Tourism Village</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-body">

                                <!-- Form data nonspasial -->
                                <div class="form-group">
                                    <label for="name" class="col col-form-label">Name</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="name" value="<?= $parianganData->name; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col col-form-label">Type</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="type_of_tourism" value="<?= $parianganData->type_of_tourism; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col col-form-label">Adress</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="address" value="<?= $parianganData->address; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col col-form-label">Open</label>
                                    <div class="col">
                                        <input type="time" class="form-control" name="open" value="<?= $parianganData->open; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col col-form-label">Close</label>
                                    <div class="col">
                                        <input type="time" class="form-control" name="close" value="<?= $parianganData->close; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="price" class=" col col-form-label">Ticket</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="ticket" value="<?= $parianganData->ticket_price; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contact_person" class=" col col-form-label">Contact person</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="contact_person" value="<?= $parianganData->contact_person; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="facebook" class="col col-form-label"><i class="fa fa-facebook"></i> Facebook</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://facebook.com/</div>
                                            </div>
                                            <input type="text" class="form-control" name="facebook" placeholder="Username" value="<?= $parianganData->facebook; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tiktok" class="col col-form-label"><i class="fab fa-tiktok"></i> Tiktok</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://tiktok.com/</div>
                                            </div>
                                            <input type="text" class="form-control" name="tiktok" placeholder="username" value="<?= $parianganData->tiktok; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="instagram" class=" col col-form-label"><i class="fa fa-instagram"></i> Instagram</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://instagram.com/</div>
                                            </div>
                                            <input type="text" class="form-control" name="instagram" placeholder="username" value="<?= $parianganData->instagram; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="youtube" class=" col col-form-label"><i class="fa fa-youtube"></i> Youtube</label>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">https://youtube.com/</div>
                                            </div>
                                            <input type="text" class="form-control" name="youtube" placeholder="channel" value="<?= $parianganData->youtube; ?>">
                                        </div>

                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="row my-2">
                                    <div class="col">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Description" id="floatingTextarea" style="height: 150px" name="description"><?= $parianganData->description; ?></textarea>
                                            <label for="floatingTextarea">Description</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group  mb-4">
                                            <label for="gallery" class="form-label">Gallery</label>
                                            <input class="form-control" accept="image/*" type="file" name="gallery[]" id="gallery" multiple>
                                        </div>
                                        <div class="form-group  mb-4">
                                            <label for="video" class="form-label">Video</label>
                                            <input class="form-control" accept="video/*, .mkv" type="file" name="video" id="video">
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                <button type="reset" class="btn btn-danger btn-sm">cancel</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <!-- Object Location on Map -->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12 mb-3">
                                <h5 class="card-title">Google Maps</h5>
                            </div>
                        </div>

                    </div>
                    <!-- Object Map body -->
                    <?= $this->include('layout/map-body'); ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <!-- Form data spasial -->
                                <table class="table table-border">
                                    <thead>
                                        <th>Data spasial </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Village geom</td>
                                            <td colspan="2"><input type="text" id="geo-json" class="form-control" name="geojson" placeholder="GeoJSON" required value='<?= $parianganData->geoJSON; ?>'></td>
                                        </tr>
                                        <tr>
                                            <td>Center</td>
                                            <td><input type="text" class="form-control" id="latitude" name="latitude" value="<?= $parianganData->lat; ?>" autocomplete="off" required></td>
                                            <td>
                                                <a onclick="searchLatLang('<?= $url ?>')" data-bs-toggle="tooltip" data-bs-placement="bottom" title="search latlng" class="btn icon btn-outline-primary"> <i class="fa fa-search"></i></a>
                                            </td>

                                            <td><input type="text" class="form-control" id="longitude" name="longitude" value="<?= $parianganData->lng; ?>" autocomplete="off" required></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <small>*Edit spatial data on map above</small>
                                    <div class="col-sm-4">

                                    </div>
                                </div>
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
    $(document).ready(function() {
        initDrawingManager(url)
    });

    let datas = [<?= json_encode($parianganData) ?>]
    let url = '<?= $url ?>'
    let geomPariangan = JSON.parse('<?= $parianganData->geoJSON; ?>')
    let latPariangan = parseFloat(<?= $parianganData->lat; ?>)
    let lngPariangan = parseFloat(<?= $parianganData->lng; ?>)

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageResize,
        FilePondPluginMediaPreview,
    );

    // Get a reference to the file input element
    const photo = document.querySelector('input[id="gallery"]');
    const video = document.querySelector('input[id="video"]');

    // Create a FilePond instance
    const pond = FilePond.create(photo, {
        imageResizeTargetHeight: 720,
        imageResizeUpscale: false,
        credits: false,
    })
    const vidPond = FilePond.create(video, {
        credits: false,
    })
    <?php if (count($galleryData) > 0) : ?>
        pond.addFiles(
            <?php foreach ($galleryData as $gallery) : ?> "<?= base_url('media/photos/'); ?>/<?= $gallery->url; ?>", <?php endforeach; ?>
        );
    <?php endif; ?>
    pond.setOptions({
        server: "<?= base_url('upload/photo') ?>"
    })
    <?php if ($parianganData->video_url) : ?>
        vidPond.addFile(`<?= base_url('media/videos/' . $parianganData->video_url); ?>`)
    <?php endif; ?>
    vidPond.setOptions({
        server: "<?= base_url('upload/video') ?>"
    })
</script>
<script src="<?= base_url('/assets/js/map.js') ?>"></script>
<!-- Maps JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&callback=initMap&libraries=drawing"></script>
<?= $this->endSection() ?>