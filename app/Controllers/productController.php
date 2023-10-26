<?php

namespace App\Controllers;


class productController extends BaseController
{
    protected $model, $modelPariangan;
    protected $title =  'Tourism Package | Tourism Village';
    public function __construct()
    {
        $this->model = new \App\Models\productModel();
        $this->modelPariangan = new \App\Models\parianganModel();
    }

    public function culinary()
    {
        //direct biasa
        $objectData = $this->model->getCulinary()->getResult();
        $parianganData = $this->modelPariangan->getPariangan();
        $data = [
            'title' => $this->title,
            'objectData' => $objectData,
            'parianganData' => $parianganData
        ];
        return view('user-menu/culinary', $data);
    }
    public function souvenir()
    {
        $objectData = $this->model->getSouvenir()->getResult();
        $parianganData = $this->modelPariangan->getPariangan();
        $data = [
            'title' => $this->title,
            'objectData' => $objectData,
            'parianganData' => $parianganData
        ];
        return view('user-menu/souvenir', $data);
    }
}
