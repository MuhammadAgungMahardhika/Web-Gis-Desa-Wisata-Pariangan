<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class ManageServiceController extends BaseController
{
    protected $model, $modelPariangan, $validation, $helpers = ['auth', 'url', 'filesystem'];
    protected $title = 'Manage-Services | Tourism Village';
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->model = new \App\Models\serviceModel();
        $this->modelPariangan = new \App\Models\parianganModel();
    }
    public function index()
    {
        $objectData = $this->model->getServices()->getResult();
        $data = [
            'title' => $this->title,
            'objectData' => $objectData
        ];
        // dd($data);
        return view('admin/manage_service', $data);
    }
    public function detail($id = null)
    {
        $objectData = $this->model->getService($id)->getRow();
        $data = [
            'title' => $this->title,
            'config' => config('Auth'),
            'objectData' => $objectData,
        ];
        return view('admin-detail/detail_Service', $data);
    }

    public function edit($id = null)
    {
        $objectData = $this->model->getService($id)->getRow();
        $categoryData = $this->model->getCategory()->getResult();
        $data = [
            'title' => $this->title,
            'config' => config('Auth'),
            'objectData' => $objectData,
            'categoryData' => $categoryData
        ];
        return view('admin-edit/edit_Service', $data);
    }

    public function save_update($id = null)
    {
        // ---------------------Data request-----------------------------
        $request = $this->request->getPost();
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
                $fileImg->move(FCPATH . 'media/photos/Service');
                delete_files($filepath);
                rmdir($filepath);
                $gallery = $fileImg->getFilename();
            }
        } else {
            $gallery = '';
        }

        $updateRequest = [
            'name' => $this->request->getPost('name'),
        ];

        // unset empty value
        foreach ($updateRequest as $key => $value) {
            if (empty($value)) {
                unset($updateRequest[$key]);
            }
        }
        $update =  $this->model->updateService($id, $updateRequest);
        if ($update) {
            session()->setFlashdata('success', 'Success! Service updated.');
            return redirect()->to(site_url('manage_Service/edit/' . $id));
        } else {
            session()->setFlashdata('failed', 'Failed! Failed to update Service.');
            return redirect()->to(site_url('manage_Service/edit/' . $id));
        }
    }
    public function insert()
    {
       
        $data = [
            'title' => $this->title
        ];
        // dd($data);
        return view('admin-insert/insert_service', $data);
    }
    public function save_insert()
    {
        // ---------------------Data request------------------------------------
        $request = $this->request->getPost();
        $id = $this->model->get_new_id();

        $insertRequest = [
            'id' => $id,
            'name' => $this->request->getPost('name')
        ];
        // unset empty value
        foreach ($insertRequest as $key => $value) {
            if (empty($value)) {
                unset($insertRequest[$key]);
            }
        }

        $insert =  $this->model->addService($insertRequest);

        if ($insert) {
            session()->setFlashdata('success', 'Success! Data Added.');
            return redirect()->to(site_url('manage_service'));
        } else {
            session()->setFlashdata('failed', 'Failed! Failed to add data.');
            return redirect()->to(site_url('manage_service/insert'));
        }
    }
    public function delete($id)
    {
        $delete =  $this->model->deleteService($id);
        if ($delete) {
            session()->setFlashdata('success', 'Success! Service Deleted.');
            return redirect()->to(site_url('manage_service'));
        } else {
            session()->setFlashdata('failed', 'Failed to delete Service ');
            return redirect()->to(site_url('manage_service'));
        }
    }
}
