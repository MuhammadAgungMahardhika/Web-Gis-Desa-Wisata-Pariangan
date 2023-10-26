<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class ManagePackageController extends BaseController
{
    protected $model, $modelservices, $modelPariangan,  $modelFp, $validation, $helpers = ['auth', 'url', 'filesystem'];
    protected $atractionModel, $culinaryModel, $worshipModel, $souvenirModel, $packageDayModel, $detailPackageModel;
    protected $serviceModel, $detailServicePackageModel;
    protected $modelRating;
    protected $title = 'Manage-Packages | Tourism Village';
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->model = new \App\Models\packageModel();
        $this->modelPariangan = new \App\Models\parianganModel();
        $this->packageDayModel = new \App\Models\packageDayModel();
        $this->detailPackageModel = new \App\Models\DetailPackageModel();
        $this->detailServicePackageModel = new \App\Models\DetailServicePackageModel();
        $this->atractionModel = new \App\Models\atractionModel();
        $this->culinaryModel = new \App\Models\culinaryPlaceModel();
        $this->worshipModel = new \App\Models\worshipPlaceModel();
        $this->souvenirModel = new \App\Models\souvenirPlaceModel();
        $this->modelservices = new \App\Models\serviceModel();
        $this->modelFp = new \App\Models\facilityPackageModel();
        $this->modelRating  =  new \App\Models\ratingModel();
    }
    public function index()
    {
        $objectData = $this->model->getPackages();
        $data = [
            'title' => $this->title,
            'objectData' => $objectData
        ];
        return view('admin/manage_package', $data);
    }
    public function detail($id = null)
    {
        $objectData = $this->model->getPackage($id)->getRow();
        $parianganData = $this->modelPariangan->getPariangan();
        $facilityPackage = $this->modelFp->getFacilityPackage($id)->getResult();
        $servicesData = $this->modelservices->getPackageActivity($id)->getResult();

        if ($this->request->isAJAX()) {
            $user_id = $this->request->getGet('user_id');
            if ($id) {
                $countRating = $this->modelRating->getRating($id, 'id_package')->getRow();
                $userTotal = $this->modelRating->getUserTotal($id, 'id_package')->getRow();
                $userRating = $this->modelRating->getUserRating($user_id, 'id_package', $id)->getRow();
            }
            $data = [
                'countRating' =>  $countRating,
                'userTotal' =>  $userTotal,
                'userRating' => $userRating
            ];
            return json_encode($data);
        }
        $data = [
            'title' => $this->title,
            'objectData' => $objectData,
            'parianganData' => $parianganData,
            'facilityPackage' => $facilityPackage,
            'servicesData' => $servicesData

        ];
        return view('admin-detail/detail_package', $data);
    }

    public function edit($id = null)
    {
        // 
        $package = $this->model->getPackage($id)->getRowArray();
        // $homestayData = $this->HomestayModel->get_list_hm_api()->getResultArray();
        $serviceData = $this->modelservices->getServices()->getResultArray();

        $packageService = $this->detailServicePackageModel->get_service_by_package_api($id)->getResultArray();

        $selectedService = array();
        foreach ($packageService as $service) {
            $selectedService[] = $service['name'];
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
            $objectData[] = $atraction;
        }
        $culinaryData = $this->culinaryModel->getCulinaryPlaces();
        foreach ($culinaryData as $culinary) {
            $culinary->id = 'C' . $culinary->id;
            $objectData[] = $culinary;
        }
        $souvenirData = $this->souvenirModel->getSouvenirPlaces();
        foreach ($souvenirData as $souvenir) {
            $souvenir->id = 'S' . $souvenir->id;
            $objectData[] = $souvenir;
        }
        $worshipData = $this->worshipModel->getWorshipPlaces();
        foreach ($worshipData as $worship) {
            $worship->id = 'S' . $worship->id;
            $objectData[] = $worship;
        }


        $package['service_package'] =  $selectedService;
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
        return view('admin-edit/edit_package', $data);
    }

    public function save_update($id = null)
    {
        // 
        $request = $this->request->getPost();
        $url = null;
        if (isset($request['gallery'])) {
            $folder = $request['gallery'][0];
            $filepath = WRITEPATH . 'uploads/' . $folder;
            $filename = get_filenames($filepath)[0];
            $fileImg = new File($filepath . '/' . $filename);
            $fileImg->move(FCPATH . 'media/photos');
            delete_files($filepath);
            rmdir($filepath);
            $url = $fileImg->getFilename();
        }
        $requestData = [
            'name' => $request['name'],
            // 'id_homestay' => $request['id_homestay'],
            'price' => empty($request['price']) ? "0" : $request['price'],
            'capacity' => $request['capacity'],
            'cp' => $request['cp'],
            'url' => $url,
            'description' => $request['description'],
        ];

        $updateTp = $this->model->updatePackage($id, $requestData);
        if (isset($request['packageDetailData'])) {
            $deletePackageDay = $this->packageDayModel->delete_pd_by_package_id($id);

            foreach ($request['packageDetailData'] as $packageDay) {
                $packageDayId = $this->packageDayModel->get_new_id_api();
                $requestPackageDay = [
                    'day' => $packageDayId,
                    'id_package' => $id,
                    'description' => $packageDay['packageDayDescription']
                ];
                $addPackageDay = $this->packageDayModel->add_pd_api($requestPackageDay);

                if ($addPackageDay) {
                    if (isset($packageDay['detailPackage'])) {
                        foreach ($packageDay['detailPackage'] as $detailPackage) {
                            $detailPackageId = $this->detailPackageModel->get_new_id_api();
                            $requestDetailPackage = [
                                'activity' => $detailPackageId,
                                'id_day' => $packageDayId,
                                'id_package' => $id,
                                'id_object' => $detailPackage['id_object'],
                                'activity_type' => $detailPackage['activity_type'],
                                'description' => $detailPackage['description']
                            ];
                            $addDetailPackage =  $this->detailPackageModel->add_dp_api($requestDetailPackage);
                        }
                    } else {
                        $rollbackPackageDay = $this->packageDayModel->delete_pd_by_day_id($packageDayId);
                    }
                }
            }
        }

        $addService = true;

        if (isset($request['service_package'])) {
            $services = $request['service_package'];
            $addService = $this->detailServicePackageModel->update_service_api($id, $services);
        }

        if ($updateTp && $addService) {
            return redirect()->to(base_url('manage_package'));
        } else {
            return redirect()->back()->withInput();
        }

        // 

    }
    public function insert()
    {
        // $homestayData = $this->HomestayModel->get_list_hm_api()->getResultArray();
        $serviceData = $this->modelservices->getServices()->getResultArray();
        $objectData = [];


        $atractionData = $this->atractionModel->getAtractions();
        foreach ($atractionData as $atraction) {
            $atraction->id = 'A' . $atraction->id;
            $objectData[] = $atraction;
        }
        $culinaryData = $this->culinaryModel->getCulinaryPlaces();
        foreach ($culinaryData as $culinary) {
            $culinary->id = 'C' . $culinary->id;
            $objectData[] = $culinary;
        }
        $souvenirData = $this->souvenirModel->getSouvenirPlaces();
        foreach ($souvenirData as $souvenir) {
            $souvenir->id = 'S' . $souvenir->id;
            $objectData[] = $souvenir;
        }
        $worshipData = $this->worshipModel->getWorshipPlaces();
        foreach ($worshipData as $worship) {
            $worship->id = 'S' . $worship->id;
            $objectData[] = $worship;
        }


        $data = [
            'title' => $this->title,
            // 'homestayData' => $homestayData,
            'packageDayData' => null,
            'objectData' => $objectData,
            'serviceData' => $serviceData
        ];
        return view('admin-insert/insert_package', $data);
    }
    public function save_insert()
    {

        // ---------------------Data request------------------------------------
        $request = $this->request->getPost();


        $id_package = $this->model->get_new_id();

        $url = null;
        if (isset($request['gallery'])) {
            $folder = $request['gallery'][0];
            $filepath = WRITEPATH . 'uploads/' . $folder;
            $filename = get_filenames($filepath)[0];
            $fileImg = new File($filepath . '/' . $filename);
            $fileImg->move(FCPATH . 'media/photos');
            delete_files($filepath);
            rmdir($filepath);
            $url = $fileImg->getFilename();
        }

        $requestData = [
            'id' => $id_package,
            'name' => $request['name'],
            // 'id_homestay' => $request['id_homestay'],
            'price' => empty($request['price']) ? "0" : $request['price'],
            'capacity' => $request['capacity'],
            'cp' => $request['cp'],
            'url' => $url,
            'description' => $request['description'],
        ];


        $addtp = $this->model->addPackage($requestData);
        if (isset($request['packageDetailData'])) {
            foreach ($request['packageDetailData'] as $packageDay) {
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

        $addService = true;
        if (isset($request['service_package'])) {
            $services = $request['service_package'];
            $addService = $this->detailServicePackageModel->add_service_api($id_package, $services);
        }


        if ($addtp && $addService) {
            return redirect()->to(base_url('manage_package'));
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $delete =  $this->model->deletePackage($id);
        if ($delete) {
            session()->setFlashdata('success', 'Success! package Deleted.');
            return redirect()->to(site_url('manage_package'));
        } else {
            session()->setFlashdata('failed', 'Failed to delete package ');
            return redirect()->to(site_url('manage_package'));
        }
    }
}
