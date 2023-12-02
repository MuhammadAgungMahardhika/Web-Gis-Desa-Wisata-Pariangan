<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class packageController extends BaseController
{


    protected $model, $modelPariangan, $serviceModel, $modelAc;
    protected $reservationModel;
    protected $detailServicePackageModel;
    protected $packageDayModel;
    protected $detailPackageModel;
    protected $atractionModel, $culinaryModel, $worshipModel, $souvenirModel, $homestayModel;
    protected $title =  'Tourism Package | Tourism Village';
    public function __construct()
    {
        $this->model = new \App\Models\packageModel();
        $this->modelPariangan = new \App\Models\parianganModel();
        $this->serviceModel = new \App\Models\serviceModel();
        $this->reservationModel = new \App\Models\reservationModel();
        $this->detailServicePackageModel = new \App\Models\detailServicePackageModel();
        $this->packageDayModel = new \App\Models\packageDayModel();
        $this->detailPackageModel = new \App\Models\DetailPackageModel();

        $this->atractionModel = new \App\Models\atractionModel();
        $this->culinaryModel = new \App\Models\culinaryPlaceModel();
        $this->worshipModel = new \App\Models\worshipPlaceModel();
        $this->souvenirModel = new \App\Models\souvenirPlaceModel();
        $this->homestayModel = new \App\Models\homestayModel();
    }

    public function packages()
    {
        //direct biasa
        $objectData = $this->model->getPackages();
        $parianganData = $this->modelPariangan->getPariangan();
        $data = [
            'title' => $this->title,
            'objectData' => $objectData,
            'parianganData' => $parianganData
        ];
        return view('user-menu/package', $data);
    }

    public function package_api($id)
    {
        $package = $this->model->getPackage($id)->getRowArray();
        // package day
        $package_day = $this->packageDayModel->get_pd_by_package_id_api($id)->getResultArray();
        for ($i = 0; $i < count($package_day); $i++) {
            $package_day[$i]['package_day_detail'] = $this->detailPackageModel->get_detail_package_by_dp_api($package_day[$i]['day'])->getResultArray();
        }
        $package['package_day'] = $package_day;
        return json_encode($package);
    }
    public function package($id)
    {
        $package = $this->model->getPackage($id)->getRowArray();
        $parianganData = $this->modelPariangan->getPariangan();
        if (empty($package)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        //untuk ajax
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getGet('user_id');
            if ($id) {
                $countRating = $this->reservationModel->getRating($id)->getRow();
                $userTotal = $this->reservationModel->getUserTotal($id)->getRow();
                $userRating = $this->reservationModel->getUserRating($user_id, $id)->getRow();
            }
            $data = [
                'countRating' =>  $countRating,
                'userTotal' =>  $userTotal,
                'userRating' => $userRating
            ];
            return json_encode($data);
        }

        // avg rating
        $objectRating = $this->reservationModel->getRating($id)->getRowArray()['rating'];
        // review
        $list_review = $this->reservationModel->getObjectComment($id)->getResultArray();

        // service include
        $list_service = $this->detailServicePackageModel->get_service_by_package_api($id)->getResultArray();
        $services = array();
        foreach ($list_service as $service) {
            $services[] = $service['name'];
        }
        // service exclude
        $list_service = $this->detailServicePackageModel->get_service_by_package_api_exclude($id)->getResultArray();
        $servicesExclude = array();
        foreach ($list_service as $service) {
            $servicesExclude[] = $service['name'];
        }


        // package day
        $package_day = $this->packageDayModel->get_pd_by_package_id_api($id)->getResultArray();


        for ($i = 0; $i < count($package_day); $i++) {
            $package_day[$i]['package_day_detail'] = $this->detailPackageModel->get_detail_package_by_dp_api($package_day[$i]['day'])->getResultArray();
        }


        $package['avg_rating'] = $objectRating;
        $package['services'] = $services;
        $package['servicesExclude'] = $servicesExclude;
        $package['reviews'] = $list_review;
        $package['package_day'] = $package_day;
        $package['gallery'] = [$package['url']];
        $package['video_url'] = null;


        $data = [
            'title' => $package['name'],
            'data' => $package,
            'parianganData' => $parianganData,
            'url' => 'package',
        ];

        return view('user-menu/detail_package', $data);
    }

    public function getActivityGallery($id)
    {
        $objectData = $this->modelAc->getActivity($id)->getResult();
        $galleryData = $this->modelAc->getGallery($id)->getResult();
        $data['galleryData'] = $galleryData;
        $data['objectData'] = $objectData;
        return json_encode($data);
    }

    function getObjectsByPackageDayId($id_day)
    {

        $objectsData = $this->detailPackageModel->get_objects_by_package_day_id($id_day)->getResultArray();
        return json_encode($objectsData);
    }

    // costum package

    function newCostume()
    {
        $serviceData = $this->serviceModel->getServices()->getResultArray();
        $objectData = [];


        $atractionData = $this->atractionModel->getAtractions();
        foreach ($atractionData as $atraction) {
            $atraction->id = 'A' . $atraction->id;
            $atraction->geoJSON = null;
            $objectData[] = $atraction;
        }
        $culinaryData = $this->culinaryModel->getCulinaryPlaces();
        foreach ($culinaryData as $culinary) {
            $culinary->id = 'C' . $culinary->id;
            $culinary->geoJSON = null;
            $objectData[] = $culinary;
        }
        $souvenirData = $this->souvenirModel->getSouvenirPlaces();
        foreach ($souvenirData as $souvenir) {
            $souvenir->id = 'S' . $souvenir->id;
            $souvenir->geoJSON = null;
            $objectData[] = $souvenir;
        }
        $worshipData = $this->worshipModel->getWorshipPlaces();
        foreach ($worshipData as $worship) {
            $worship->id = 'W' . $worship->id;
            $worship->geoJSON = null;
            $objectData[] = $worship;
        }
        $homestayData = $this->homestayModel->getHomestays();
        foreach ($homestayData as $homestay) {
            $homestay->id = 'H' . $homestay->id;
            $homestay->geoJSON = null;
            $objectData[] = $homestay;
        }

        $data = [
            'title' => 'Tourism Village | Costume Package',
            // 'homestayData' => $homestayData,
            'packageDayData' => null,
            'objectData' => $objectData,
            'serviceData' => $serviceData
        ];
        return view('user-menu/costum_package', $data);
    }
    public function saveCostume()
    {

        // ---------------------Data request------------------------------------
        $request = $this->request->getPost();

        // create package
        $id_package = $this->model->get_new_id();
        $requestData = [
            'id' => $id_package,
            'name' => 'Costume Package By -' . $request['username'],
            'price' => empty($request['price']) ? "0" : $request['price'],
            'capacity' => $request['reservationData']['number_people'],
            'url' => 'costum_package.jpg',
            'costum' => $request['reservationData']['costum'],
        ];
        $addtp = $this->model->addPackage($requestData);

        // create package day + detail package
        if (isset($request['packageDetailData'])) {
            foreach ($request['packageDetailData'] as $packageDay) {
                if (isset($packageDay['detailPackage'])) {
                    $packageDayId = $this->packageDayModel->get_new_id_api();
                    $requestPackageDay = [
                        'day' => $packageDayId,
                        'id_package' => $id_package,
                        'description' => $packageDay['packageDayDescription']
                    ];
                    $addPackageDay = $this->packageDayModel->add_pd_api($requestPackageDay);

                    if ($addPackageDay) {

                        foreach ($packageDay['detailPackage'] as $detailPackage) {
                            $detailPackageId = $this->detailPackageModel->get_new_id_api();
                            $requestDetailPackage = [
                                'activity' => $detailPackageId,
                                'id_day' => $packageDayId,
                                'id_package' => $id_package,
                                'id_object' => $detailPackage['id_object'],
                                'activity_type' => $detailPackage['activity_type'],
                                'description' => $detailPackage['description']
                            ];
                            $addDetailPackage =  $this->detailPackageModel->add_dp_api($requestDetailPackage);
                        }
                    }
                }
            }
        }

        // create detail service
        $addService = true;
        if (isset($request['service_package'])) {
            $services = $request['service_package'];
            $addService = $this->detailServicePackageModel->add_service_api($id_package, $services, 'include');
        }

        // create reservation
        $addR = true;
        if (isset($request['reservationData'])) {
            $requestData = [
                'id_user' => $request['id_user'],
                'id_package' => $id_package,
                'request_date' => $request['reservationData']['reservation_date'],
                'total_price' => empty($request['price']) ? "0" : $request['price'],
                'id_reservation_status' => '1',
                'number_people' => $request['reservationData']['number_people'],
                'comment' => $request['reservationData']['comment']
            ];

            $addR = $this->reservationModel->add_r_api($requestData);
        }

        if ($addtp && $addService && $addR) {
            return redirect()->to(base_url('user/reservation/') . '/' . $request['id_user']);
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function costumExisting($id)
    {
        // 
        $package = $this->model->getPackage($id)->getRowArray();

        $serviceData = $this->serviceModel->getServices()->getResultArray();

        // get include service package
        $packageService = $this->detailServicePackageModel->get_service_by_package_api($id)->getResultArray();
        $selectedService = array();
        foreach ($packageService as $service) {
            $selectedService[] = $service['name'];
        }

        // get exclude service package
        $packageServiceExclude = $this->detailServicePackageModel->get_service_by_package_api_exclude($id)->getResultArray();
        $selectedServiceExclude = array();
        foreach ($packageServiceExclude as $service) {
            $selectedServiceExclude[] = $service['name'];
        }

        $packageDay = $this->packageDayModel->get_pd_by_package_id_api($id)->getResultArray();
        $no = 0;
        foreach ($packageDay as $day) {
            $packageDay[$no]['detailPackage'] = $this->detailPackageModel->get_objects_by_package_day_id($day['day'])->getResultArray();
            $no++;
        }

        $objectData = [];


        $atractionData = $this->atractionModel->getAtractions();
        foreach ($atractionData as $atraction) {
            $atraction->id = 'A' . $atraction->id;
            $atraction->geoJSON = null;
            $objectData[] = $atraction;
        }
        $culinaryData = $this->culinaryModel->getCulinaryPlaces();
        foreach ($culinaryData as $culinary) {
            $culinary->id = 'C' . $culinary->id;
            $culinary->geoJSON = null;
            $objectData[] = $culinary;
        }
        $souvenirData = $this->souvenirModel->getSouvenirPlaces();
        foreach ($souvenirData as $souvenir) {
            $souvenir->id = 'S' . $souvenir->id;
            $souvenir->geoJSON = null;
            $objectData[] = $souvenir;
        }
        $worshipData = $this->worshipModel->getWorshipPlaces();
        foreach ($worshipData as $worship) {
            $worship->id = 'W' . $worship->id;
            $worship->geoJSON = null;
            $objectData[] = $worship;
        }
        $homestayData = $this->homestayModel->getHomestays();
        foreach ($homestayData as $homestay) {
            $homestay->id = 'H' . $homestay->id;
            $homestay->geoJSON = null;
            $objectData[] = $homestay;
        }


        $package['service_package'] =  $selectedService;
        $package['service_package_exclude'] = $selectedServiceExclude;
        $package['gallery'] = [$package['url']];
        $package['video_url'] = null;

        $data = [
            'title' => 'Edit Package',
            'data' => $package,
            // 'homestayData' => $homestayData,
            'packageDayData' => $packageDay,
            'objectData' => $objectData,
            'serviceData' => $serviceData
        ];
        return view('user-menu/costum_existing_package', $data);
    }

    public function saveCostumExisting()
    {

        // ---------------------Data request------------------------------------
        $request = $this->request->getPost();

        // create package
        $id_package = $this->model->get_new_id();
        $requestData = [
            'id' => $id_package,
            'name' =>  $request['reservationData']['package_name'] . ' + Costum By -' . $request['username'],
            'price' => empty($request['price']) ? "0" : $request['price'],
            'capacity' => $request['reservationData']['number_people'],
            'url' => 'costum_package.jpg',
            'costum' => $request['reservationData']['costum'],
        ];
        $addtp = $this->model->addPackage($requestData);

        // create package day + detail package
        if (isset($request['packageDetailData'])) {
            foreach ($request['packageDetailData'] as $packageDay) {
                if (isset($packageDay['detailPackage'])) {
                    $packageDayId = $this->packageDayModel->get_new_id_api();
                    $requestPackageDay = [
                        'day' => $packageDayId,
                        'id_package' => $id_package,
                        'description' => $packageDay['packageDayDescription']
                    ];
                    $addPackageDay = $this->packageDayModel->add_pd_api($requestPackageDay);

                    if ($addPackageDay) {

                        foreach ($packageDay['detailPackage'] as $detailPackage) {
                            $detailPackageId = $this->detailPackageModel->get_new_id_api();
                            $requestDetailPackage = [
                                'activity' => $detailPackageId,
                                'id_day' => $packageDayId,
                                'id_package' => $id_package,
                                'id_object' => $detailPackage['id_object'],
                                'activity_type' => $detailPackage['activity_type'],
                                'description' => $detailPackage['description']
                            ];
                            $addDetailPackage =  $this->detailPackageModel->add_dp_api($requestDetailPackage);
                        }
                    }
                }
            }
        }

        // create detail service
        $addService = true;
        if (isset($request['service_package'])) {
            $services = $request['service_package'];
            $addService = $this->detailServicePackageModel->add_service_api($id_package, $services, 'include');
        }

        // create reservation
        $addR = true;
        if (isset($request['reservationData'])) {
            $requestData = [
                'id_user' => $request['id_user'],
                'id_package' => $id_package,
                'request_date' => $request['reservationData']['reservation_date'],
                'total_price' => empty($request['price']) ? "0" : $request['price'],
                'id_reservation_status' => '1',
                'number_people' => $request['reservationData']['number_people'],
                'comment' => $request['reservationData']['comment']
            ];

            $addR = $this->reservationModel->add_r_api($requestData);
        }

        if ($addtp && $addService && $addR) {
            return redirect()->to(base_url('user/reservation/') . '/' . $request['id_user']);
        } else {
            return redirect()->back()->withInput();
        }
    }
}
