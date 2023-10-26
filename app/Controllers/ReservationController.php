<?php

namespace App\Controllers;

use App\Models\reservationModel;

class ReservationController extends BaseController
{
    protected $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new reservationModel();
    }

    public function show($id = null)
    {
        //
    }

    public function new()
    {
        //
    }

    public function create()
    {
        $request = $this->request->getRawInput();

        $id = $this->reservationModel->get_new_id_api();
        $requestData = [
            'id' => $id,
            'id_user' => $request['id_user'],
            'id_package' => $request['id_package'],
            'id_reservation_status' => $request['id_reservation_status'],
            'request_date' => $request['reservation_date'],
            'number_people' => $request['number_people'],
            'comment' => $request['comment']
        ];

        $addR = $this->reservationModel->add_r_api($requestData);
        if ($addR) {
        }
    }

    public function edit($id = null)
    {
        //
    }


    public function update($id = null)
    {
        $request = $this->request->getRawInput();
        $requestData = [
            'id_reservation_status' => $request['id_reservation_status'],
            'id_user' => $request['id_user'],
            'id_package' => $request['id_package'],
            'request_date' => $request['request_date']
        ];

        $updateFC = $this->reservationModel->update_r_api($id, $requestData);
        if ($updateFC) {
            $response = [
                'status' => 200,
                'message' => [
                    "Success update Service"
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'message' => [
                    "Fail update Service",
                ]
            ];
            return $this->respond($response, 400);
        }
    }

    public function delete($id = null)
    {
        $delete = $this->reservationModel->delete(['id' => $id]);
        return json_encode($delete);
    }
    public function check($user_id, $date)
    {
        $isDuplicate = $this->reservationModel->checkIsDateDuplicate($user_id, $date);
        return json_encode($isDuplicate);
    }
}
