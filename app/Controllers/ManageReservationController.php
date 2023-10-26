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
            $reservation_status_id = $item['id_reservation_status'];
            $package_id = $item['id_package'];
            $user_id = $item['id_user'];
            $user = $this->userModel->get_u_by_id_api($user_id)->getRowArray();
            $reservationStatus = $this->reservationStatusModel->get_s_by_id_api($reservation_status_id)->getRowArray();
            $package = $this->packageModel->getPackage($package_id)->getRowArray();
            $contents[$no]['username'] = $user['username'];
            $contents[$no]['status'] = $reservationStatus['status'];
            $contents[$no]['package_name'] = $package['name'];
            $no++;
        }
        $data = [
            'title' => $this->title,
            'objectData' => $contents,
            'userData' => $userData,
            'packageData' => $packageData,
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

    public function save_update($id = null)
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
        $update =  $this->model->update_r_api($id, $updateRequest);
        if ($update) {
            return json_encode($update);
        } else {
            return false;
        }
    }
    public function insert()
    {
        $categoryData = $this->model->getCategory()->getResult();
        $data = [
            'title' => $this->title,
            'categoryData' => $categoryData
        ];
        return view('admin-insert/insert_product', $data);
    }
    public function save_insert()
    {
        // ---------------------Data request------------------------------------
        $request = $this->request->getPost();
        $id = $this->model->get_new_id();

        // ----------------Gallery-----------------------------------------

        // check if gallery have empty string then make it become empty array
        foreach ($request['gallery'] as $key => $value) {
            if (!strlen($value)) {
                unset($request['gallery'][$key]);
            }
        }
        if ($request['gallery']) {
            $folders = $request['gallery'];
            foreach ($folders as $folder) {
                $filepath = WRITEPATH . 'uploads/' . $folder;
                $filenames = get_filenames($filepath);
                $fileImg = new File($filepath . '/' . $filenames[0]);
                $fileImg->move(FCPATH . 'media/photos/product');
                delete_files($filepath);
                rmdir($filepath);
                $gallery = $fileImg->getFilename();
            }
        } else {
            $gallery = '';
        }

        $insertRequest = [
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'product_category_id' => $this->request->getPost('category'),
            'price' => $this->request->getPost('price'),
            'brosur_url' => $gallery,
            'description' => $this->request->getPost('description')
        ];
        // unset empty value
        foreach ($insertRequest as $key => $value) {
            if (empty($value)) {
                unset($insertRequest[$key]);
            }
        }

        $insert =  $this->model->addProduct($insertRequest);

        if ($insert) {
            session()->setFlashdata('success', 'Success! Data Added.');
            return redirect()->to(site_url('manage_product'));
        } else {
            session()->setFlashdata('failed', 'Failed! Failed to add data.');
            return redirect()->to(site_url('manage_product/insert'));
        }
    }
    public function delete($id)
    {
        $delete =  $this->model->deleteProduct($id);
        if ($delete) {
            session()->setFlashdata('success', 'Success! product Deleted.');
            return redirect()->to(site_url('manage_product'));
        } else {
            session()->setFlashdata('failed', 'Failed to delete product ');
            return redirect()->to(site_url('manage_product'));
        }
    }
}
