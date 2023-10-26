<?php

namespace App\Controllers;

use App\Models\DetailPackageModel;

class packageController extends BaseController
{


    protected $model, $modelPariangan, $serviceModel, $modelAc;
    protected $reservationModel;
    protected $detailServicePackageModel;
    protected $packageDayModel;
    protected $detailPackageModel;
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

        // service
        $list_service = $this->detailServicePackageModel->get_service_by_package_api($id)->getResultArray();
        $services = array();
        foreach ($list_service as $service) {
            $services[] = $service['name'];
        }

        // package homestay
        // if ($package['id_homestay'] != null) {
        //     $homestayData = $this->HomestayModel->get_hm_by_id_api($package['id_homestay'])->getRowArray();
        //     $package['homestay_name'] = $homestayData['name'];
        // }

        // package day
        $package_day = $this->packageDayModel->get_pd_by_package_id_api($id)->getResultArray();


        for ($i = 0; $i < count($package_day); $i++) {
            $package_day[$i]['package_day_detail'] = $this->detailPackageModel->get_detail_package_by_dp_api($package_day[$i]['day'])->getResultArray();
        }


        $package['avg_rating'] = $objectRating;
        $package['services'] = $services;
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
}
