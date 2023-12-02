<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailPackageModel;
use App\Models\detailServicePackageModel;
use App\Models\packageDayModel;
use App\Models\packageModel;
use App\Models\reservationModel;
use Dompdf\Dompdf;

class PdfGenerator extends BaseController
{
    protected $modelPackage, $packageDayModel, $detailPackageModel, $detailServicePackageModel;
    protected $reservationModel;
    public function __construct()
    {
        $this->modelPackage = new packageModel();
        $this->packageDayModel = new packageDayModel();
        $this->detailPackageModel = new DetailPackageModel();
        $this->detailServicePackageModel = new detailServicePackageModel();
        $this->reservationModel = new reservationModel();
    }
    public function invoice($parse)
    {
        $invoiceData = json_decode($parse, true);
        $dompdf = new Dompdf();
        $data = [
            'imageSrc'    => $this->imageToBase64(ROOTPATH . '\public\assets\images\pariangan.jpg'),
            'packageData' => $invoiceData
        ];
        // dd($data);
        $html = view('user-menu/invoice', $data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('invoice.pdf', ['Attachment' => false]);
    }
    public function ticket($parse)
    {
        $invoiceData = json_decode($parse, true);
        $dompdf = new Dompdf();
        $data = [
            'imageSrc'    => $this->imageToBase64(ROOTPATH . '\public\assets\images\pariangan.jpg'),
            'packageData' => $invoiceData
        ];

        $html = view('user-menu/ticket', $data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('ticket.pdf', ['Attachment' => false]);
    }
    public function getInvoiceData()
    {
        if ($this->request->isAJAX()) {
            $id_user = $this->request->getPost('id_user');
            $id_package = $this->request->getPost('id_package');
            $request_date = $this->request->getPost('request_date');

            $reservation  = $this->reservationModel->get_r_by_id_api($id_user, $id_package, $request_date)->getRowArray();

            // package
            $package = $this->modelPackage->getPackage($id_package)->getRowArray();

            // service include
            $list_service = $this->detailServicePackageModel->get_service_by_package_api($id_package)->getResultArray();
            $services = array();
            foreach ($list_service as $service) {
                $services[] = $service['name'];
            }
            // service exclude
            $list_service_exclude = $this->detailServicePackageModel->get_service_by_package_api_exclude($id_package)->getResultArray();
            $servicesExclude = array();
            foreach ($list_service_exclude as $serviceEx) {
                $servicesExclude[] = $serviceEx['name'];
            }

            $package_day = $this->packageDayModel->get_pd_by_package_id_api($id_package)->getResultArray();

            for ($i = 0; $i < count($package_day); $i++) {
                $package_day[$i]['package_day_detail'] = $this->detailPackageModel->get_detail_package_by_dp_api($package_day[$i]['day'])->getResultArray();
            }

            $package['reservation'] = $reservation;
            $package['services'] = $services;
            $package['services_exclude'] = $servicesExclude;
            $package['package_day'] = $package_day;

            return json_encode($package);
        }
    }
    public function getTicketData()
    {
        if ($this->request->isAJAX()) {
            $id_user = $this->request->getPost('id_user');
            $id_package = $this->request->getPost('id_package');
            $request_date = $this->request->getPost('request_date');

            $reservation  = $this->reservationModel->get_r_by_id_api($id_user, $id_package, $request_date)->getRowArray();

            // package
            $package = $this->modelPackage->getPackage($id_package)->getRowArray();

            // service include
            $list_service = $this->detailServicePackageModel->get_service_by_package_api($id_package)->getResultArray();
            $services = array();
            foreach ($list_service as $service) {
                $services[] = $service['name'];
            }
            // service exclude
            $list_service_exclude = $this->detailServicePackageModel->get_service_by_package_api_exclude($id_package)->getResultArray();
            $servicesExclude = array();
            foreach ($list_service_exclude as $serviceEx) {
                $servicesExclude[] = $serviceEx['name'];
            }

            $package_day = $this->packageDayModel->get_pd_by_package_id_api($id_package)->getResultArray();

            for ($i = 0; $i < count($package_day); $i++) {
                $package_day[$i]['package_day_detail'] = $this->detailPackageModel->get_detail_package_by_dp_api($package_day[$i]['day'])->getResultArray();
            }

            $package['reservation'] = $reservation;
            $package['services'] = $services;
            $package['services_exclude'] = $servicesExclude;
            $package['package_day'] = $package_day;

            return json_encode($package);
        }
    }
    private function imageToBase64($path)
    {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}
