<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use Myth\Auth\Models\UserModel;

class ManageReservationController extends BaseController
{
    protected $model, $modelPariangan, $validation, $helpers = ['auth', 'url', 'filesystem'];
    protected $reservationStatusModel;
    protected $packageModel;
    protected $userModel;
    protected $title = 'Manage-Reservation | Tourism Village';
    public function __construct()
    {
        $this->modelPariangan = new \App\Models\parianganModel();
        $this->validation = \Config\Services::validation();
        $this->model = new \App\Models\reservationModel();
        $this->reservationStatusModel = new \App\Models\reservationStatusModel();
        $this->packageModel = new \App\Models\packageModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $contents = [];
        if (in_groups('admin')) {
            $contents = $this->model->get_list_r_api()->getResultArray();
        }
        $userData = $this->userModel->get_users()->getResultObject();
        $packageData = $this->packageModel->getPackages();
        $statusData = $this->reservationStatusModel->get_list_s_api()->getResultObject();
        $no = 0;
        // reservation status dan paket
        foreach ($contents as $item) {
            $package_id = $item['id_package'];
            $user_id = $item['id_user'];
            $request_date = $item['request_date'];
            $reservation_status = $item['id_reservation_status'];
            $deposit_date = $item['deposit_date'];
            //check if date is passed
            $dateNow = date('Y-m-d');
            $dateConvert = getDate(strtotime($request_date));
            $yearConvert = $dateConvert['year'];
            $monthConvert = $dateConvert['mon'];

            $dayConvert = $dateConvert['mday'] - 3;
            $requestDateMin3 = $yearConvert . "-" . $monthConvert . "-" . $dayConvert;

            if ($dateNow == $requestDateMin3 && ($reservation_status == 2 || $reservation_status == 1) && $deposit_date == null) {
                // update status
                $contents[$no]['id_reservation_status'] = 3;
                $this->model->update_r_api($user_id, $package_id, $request_date, ['id_reservation_status' => 3]);
            }
            if ($request_date < $dateNow && $reservation_status != 3) {
                // update status
                $contents[$no]['id_reservation_status'] = 4;
                $this->model->update_r_api($user_id, $package_id, $request_date, ['id_reservation_status' => 4]);
            }
            $reservation_status_id = $contents[$no]['id_reservation_status'];
            $user = $this->userModel->get_u_by_id_api($user_id)->getRowArray();
            $reservationStatus = $this->reservationStatusModel->get_s_by_id_api($reservation_status_id)->getRowArray();
            $package = $this->packageModel->getPackage($package_id)->getRowArray();
            $contents[$no]['username'] = $user['username'];
            $contents[$no]['status'] = $reservationStatus['status'];
            $contents[$no]['package_name'] = $package['name'];
            $no++;
        }
        $parianganData = $this->modelPariangan->getPariangan();
        $data = [
            'title' => $this->title,
            'data' => $contents,
            'userData' => $userData,
            'packageData' => $packageData,
            'parianganData' => $parianganData,
            'statusData' => $statusData
        ];

        return view('admin/manage_reservation', $data);
    }
    public function detail($id = null)
    {
        $objectData = $this->model->getProduct($id)->getRow();
        $data = [
            'title' => $this->title,
            'config' => config('Auth'),
            'objectData' => $objectData
        ];
        return view('admin-detail/detail_product', $data);
    }

    public function edit($id = null)
    {
        $objectData = $this->model->getProduct($id)->getRow();
        $categoryData = $this->model->getCategory()->getResult();
        $data = [
            'title' => $this->title,
            'config' => config('Auth'),
            'objectData' => $objectData,
            'categoryData' => $categoryData
        ];
        return view('admin-edit/edit_product', $data);
    }

    public function save_update($id_user = null, $id_package = null, $request_date = null)
    {
        // ---------------------Data request-----------------------------
        $request = $this->request->getRawInput();

        $updateRequest = [
            'id_reservation_status' => $request['id_reservation_status']
        ];

        // unset empty value
        foreach ($updateRequest as $key => $value) {
            if (empty($value)) {
                unset($updateRequest[$key]);
            }
        }
        $update =  $this->model->update_r_api($id_user, $id_package, $request_date, $updateRequest);
        if ($update) {
            return json_encode($update);
        } else {
            return false;
        }
    }
}
