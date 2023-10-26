<?php

namespace App\Controllers;

class Pages extends BaseController
{
    protected $modelPariangan, $modelUsers, $modelProducts, $modelPackages, $modelReservation, $modelEvent, $modelAtraction, $modelSouvenir, $modelCulinary, $modelWorship, $modelFacility, $modelHomestay;
    protected $title =  'List Object | Tourism Village';
    public function __construct()
    {
        $this->modelPariangan = new \App\Models\parianganModel();
        $this->modelUsers = new \App\Models\usersModel();
        $this->modelAtraction = new \App\Models\atractionModel();
        $this->modelPackages = new \App\Models\packageModel();
        $this->modelReservation = new \App\Models\reservationModel();
        $this->modelProducts = new \App\Models\productModel();
        $this->modelEvent = new \App\Models\eventModel();
        $this->modelSouvenir = new \App\Models\souvenirPlaceModel();
        $this->modelCulinary = new \App\Models\culinaryPlaceModel();
        $this->modelWorship = new \App\Models\worshipPlaceModel();
        $this->modelFacility = new \App\Models\facilityModel();
        $this->modelHomestay = new \App\Models\homestayModel();
    }
    // Masuk halaman landing page
    public function index()
    {
        $parianganData = $this->modelPariangan->getPariangan();
        $galleryData = $this->modelPariangan->getGallery('1')->getResult();;
        $data = [
            'title' => 'LandingPage | Tourism Village',
            'parianganData' => $parianganData,
            'galleryData' => $galleryData,
            'config' => config('Auth')
        ];
        return view('pages/index', $data);
    }
    // Masuk halaman landing page
    public function landing_page()
    {
        $data = [
            'title' => 'LandingPage | Tourism Village',
            'config' => config('Auth')
        ];
        return view('pages/landing_page', $data);
    }


    // Masuk Halaman about
    public function about()
    {

        $parianganData = $this->modelPariangan->getPariangan();
        $data = [
            'title' => 'About | Tourism Village',
            'parianganData' => $parianganData
        ];
        return view('user-menu/about', $data);
    }

    // Masuk Halaman Dashboard
    public function dashboard()
    {
        $parianganData = $this->modelPariangan->getPariangan();
        $adminData = $this->modelUsers->getTotal();
        $atractionData = $this->modelAtraction->getTotal();
        $packageData = $this->modelPackages->getTotal();
        $reservationData = $this->modelReservation->getTotal();
        $eventData = $this->modelEvent->getTotal();
        $productData = $this->modelProducts->getTotal();
        $spData = $this->modelSouvenir->getTotal();
        $cpData = $this->modelCulinary->getTotal();
        $wpData = $this->modelWorship->getTotal();
        $fData = $this->modelFacility->getTotal();
        $hData = $this->modelHomestay->getTotal();
        $data = [
            'title' => 'Dashboard | Tourism Village',
            'parianganData' => $parianganData,
            'adminData' => $adminData,
            'atractionData' => $atractionData,
            'packageData' => $packageData,
            'reservationData' => $reservationData,
            'eventData' => $eventData,
            'productData' => $productData,
            'spData' => $spData,
            'cpData' => $cpData,
            'wpData' => $wpData,
            'fData' => $fData,
            'hData' => $hData
        ];
        return view('admin/dashboard', $data);
    }
}
