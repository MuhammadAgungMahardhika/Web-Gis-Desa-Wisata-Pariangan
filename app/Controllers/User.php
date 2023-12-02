<?php

namespace App\Controllers;

use Myth\Auth\Password;
use CodeIgniter\Files\File;
use CodeIgniter\I18n\Time;

class User extends BaseController
{

    protected  $model, $validation, $config, $helpers = ['auth', 'url', 'filesystem'];
    protected $packageModel, $reservationModel, $reservationStatusModel;
    // Constructor
    public function __construct()
    {
        $this->model = new \App\Models\usersModel();
        $this->packageModel = new \App\Models\packageModel();
        $this->reservationModel = new \App\Models\reservationModel();
        $this->reservationStatusModel = new \App\Models\reservationStatusModel();
        $this->validation =  \Config\Services::validation();
        $this->config = config('Auth');
    }
    public function getUser($id)
    {
        $userData = $this->model->getUser($id);
        return json_encode($userData);
    }
    public function profile()
    {
        $data = [
            'title' => 'User | Tourism Village',
            'config' => config('Auth'),
            'validation' => \Config\Services::validation()
        ];
        return view('user/profile', $data);
    }
    public function reservation($id = null)
    {

        $users_reservation = $this->reservationModel->get_r_by_id_user_api($id)->getResultArray();

        $no = 0;
        // reservation status dan paket
        foreach ($users_reservation as $item) {
            $package_id = $item['id_package'];
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
                $users_reservation[$no]['id_reservation_status'] = 3;
                $this->reservationModel->update_r_api($id, $package_id, $request_date, ['id_reservation_status' => 3]);
            }

            if ($request_date  < $dateNow && $reservation_status != 3) {
                // update status
                $users_reservation[$no]['id_reservation_status'] = 5;
                $this->reservationModel->update_r_api($id, $package_id, $request_date, ['id_reservation_status' => 5]);
            }
            $reservation_status_id = $users_reservation[$no]['id_reservation_status'];

            $reservationStatus = $this->reservationStatusModel->get_s_by_id_api($reservation_status_id)->getRowArray();
            $package = $this->packageModel->getPackage($package_id)->getRowArray();
            $users_reservation[$no]['status'] = $reservationStatus['status'];
            $users_reservation[$no]['package_name'] = $package['name'];
            $no++;
        }


        $data = [
            'title' => 'User Reservation',
            'data' => $users_reservation,
        ];

        return view('user/reservation', $data);
    }
    public function checkout($id = null)
    {

        $users_reservation = $this->reservationModel->get_r_by_id_user_api($id)->getResultArray();

        $no = 0;
        // reservation status dan paket
        foreach ($users_reservation as $item) {
            $reservation_status_id = $item['id_reservation_status'];
            $package_id = $item['id_package'];
            $reservationStatus = $this->reservationStatusModel->get_s_by_id_api($reservation_status_id)->getRowArray();
            $package = $this->packageModel->getPackage($package_id)->getRowArray();
            $users_reservation[$no]['status'] = $reservationStatus['status'];
            $users_reservation[$no]['package_name'] = $package['name'];
            $no++;
        }


        $data = [
            'title' => 'User Reservation',
            'data' => $users_reservation,
        ];

        return view('user/reservation', $data);
    }
    public function edit_profile()
    {
        $data = [
            'title' => 'User | Tourism Village',
            'config' => config('Auth'),
            'validation' => \Config\Services::validation()
        ];
        return view('user/edit_profile', $data);
    }
    public function save_update($id = null)
    {
        $validateInput = $this->validate([
            'email' => 'valid_email',
            'username' => 'required|max_length[31]',
            'name' => 'max_length[50]',
            'contact' => 'max_length[14]',
            'address' => 'max_length[255]'
        ]);
        // ---------------------------Data request -------------------------
        $request = $this->request->getPost();
        $requestData = [
            'email' => $request['email'],
            'username' => $request['username'],
            'name' => $request['name'],
            'contact' => $request['contact'],
            'address' => $request['address']
        ];
        var_dump($requestData);

        if ($validateInput) {
            // -----------------------------Avatar -----------------------------------------

            if (isset($request['avatar'])) {
                if ($request['avatar'] != 'default.svg') {
                    $folder = $request['avatar'];
                    $filepath = WRITEPATH . 'uploads/' . $folder;
                    $filenames = get_filenames($filepath);
                    $avatar = new File($filepath . '/' . $filenames[0]);
                    $avatar->move(FCPATH . 'assets/images/user-photos');
                    $requestData['user_image'] = $avatar->getFilename();
                    delete_files($filepath);
                    rmdir($filepath);
                }
            }


            $update =  $this->model->update($id, $requestData);
            if ($update) {
                session()->setFlashdata('success', 'Success! User profile updated.');
                return redirect()->to(base_url('user/profile'));
            } else {
                session()->setFlashdata('failed', 'Failed! Failed to update user profile.');
                return redirect()->to(base_url('user/profile'));
            }
        } else {
            $listErrors = $this->validation->listErrors();
            session()->setFlashdata('failed', 'Failed! Failed' . json_encode($listErrors));
            return redirect()->to(base_url('user/profile'));
        }
    }
    public function change_password()
    {
        $data = [
            'title' => 'User | Tourism Village',
            'config' => config('Auth'),
            'validation' => \Config\Services::validation()
        ];
        return view('user/change_password', $data);
    }
    public function save_password($id = null)
    {
        $password = $this->request->getPost('password');
        $repeat_password = $this->request->getPost('repeat_password');
        $validateInput = $this->validate([
            'password' => 'required|strong_password',
            'repeat_password' => 'required|matches[password]'
        ]);
        if ($password == $repeat_password) {
            $new_password = $this->attributes['password_hash'] = Password::hash($password);
        }

        if ($validateInput) {
            $change_password = $this->model->updatePassword($id, $new_password);
            if ($change_password) {
                session()->setFlashdata('success', 'Success! Your password has been changed!.');
                return redirect()->to(base_url('user/profile'));
            } else {
                session()->setFlashdata('failed', 'Failed! Failed change your password');
                return redirect()->to(base_url('user/change_password'));;
            }
        } else {
            $listErrors = $this->validation->listErrors();
            session()->setFlashdata('failed', 'Failed! Failed' . json_encode($listErrors));
            return redirect()->to(base_url('user/change_password'));
        }
        $data = [
            'title' => 'User | Tourism Village',
            'config' => config('Auth'),
            'validation' => \Config\Services::validation()
        ];
        return view('user/change_password', $data);
    }
}
