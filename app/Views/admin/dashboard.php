<?= $this->extend('layout/template.php') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<style>
    .efek:hover {
        transform: translate(0px, -10px);
        transition: .5s;
    }

    .card-content:hover {
        box-shadow: 0 0 20px 5px #eaeaea;
    }
</style>
<div class="container-fluid">
    <!-- DataTales  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-center text-uppercase">Dashboard</h3>
        </div>
        <div class="card-body">
            <section id="groups">
                <div class="row d-flex ">
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="users">
                            <div class="card-content">
                                <a href="<?= base_url('manage_users') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/users.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Admin</h4>
                                        <p class="card-text"> Manage all admin </p>
                                        <p class="card-text"> Total : <?= $adminData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="village">
                            <div class="card-content">
                                <a href="<?= base_url('manage_pariangan') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/gerbang_masuk.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Village</h4>
                                        <p class="card-text">Manage village information </p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="at">
                            <div class="card-content">
                                <a href="<?= base_url('manage_atraction') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/kuburan_panjang.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Atraction</h4>
                                        <p class="card-text"> Manage atraction</p>
                                        <p class="card-text"> Total atraction : <?= $atractionData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="package">
                            <div class="card-content">
                                <a href="<?= base_url('manage_package') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/traking.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Package</h4>
                                        <p class="card-text">Manage tourism package</p>
                                        <p class="card-text"> Total package : <?= $packageData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="reservation">
                            <div class="card-content">
                                <a href="<?= base_url('manage_reservation') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/reservasi.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Reservation</h4>
                                        <p class="card-text">Manage reservation</p>
                                        <p class="card-text"> Total reservation : <?= $reservationData->created_at; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="event">
                            <div class="card-content">
                                <a href="<?= base_url('manage_event') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/pacu_jawi.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Event</h4>
                                        <p class="card-text">Manage tourism event</p>
                                        <p class="card-text"> Total event : <?= $eventData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="product">
                            <div class="card-content">
                                <a href="<?= base_url('manage_product') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/kawa_daun.png') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Product</h4>
                                        <p class="card-text">Manage culinary & souvenir</p>
                                        <p class="card-text"> Total culinary place : <?= $productData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="sp">
                            <div class="card-content">
                                <a href="<?= base_url('manage_souvenir_place') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/galery.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Souvenir place</h4>
                                        <p class="card-text">Manage souvenir place </p>
                                        <p class="card-text"> Total souvenir place : <?= $spData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="cp">
                            <div class="card-content">
                                <a href="<?= base_url('manage_culinary_place') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/tanjuang_indah.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Culinary place</h4>
                                        <p class="card-text">Manage culinary place</p>
                                        <p class="card-text"> Total culinary place : <?= $cpData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">


                        <div class="card  shadow-sm efek" id="wp">
                            <div class="card-content">
                                <a href="<?= base_url('manage_worship_place') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/masjid_islah.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Worship place</h4>
                                        <p class="card-text">Manage worship place</p>
                                        <p class="card-text"> Total worship place : <?= $wpData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="f">
                            <div class="card-content">
                                <a href="<?= base_url('manage_facility') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/facility.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Facility</h4>
                                        <p class="card-text"> Manage facility</p>
                                        <p class="card-text"> Total facility : <?= $fData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card  shadow-sm efek" id="f">
                            <div class="card-content">
                                <a href="<?= base_url('manage_homestay') ?>">
                                    <img class="card-img-top img-fluid" src="<?= base_url('assets/images/dashboard-images/Homestay_panduko_rajo.jpg') ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Homestay</h4>
                                        <p class="card-text"> Manage homestay</p>
                                        <p class="card-text"> Total homestay : <?= $hData->id; ?></p>
                                        <small class="text-muted">Click to go <i class="fa fa-arrow-right fa-xs"></i> </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>

<?= $this->endSection() ?>