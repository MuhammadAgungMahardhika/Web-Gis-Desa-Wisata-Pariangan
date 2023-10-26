<?php

namespace App\Models;

use CodeIgniter\Model;

class detailServicePackageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_service_package';
    protected $primaryKey       = ['id_detail_service_package', 'id_package'];
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_service_package', 'id_package'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // API
    public function get_service_by_package_api($package_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('service_package.id, service_package.name')
            ->where('id_package', $package_id)
            ->join('service_package', 'detail_service_package.id_service_package = service_package.id')
            ->get();
        return $query;
    }

    public function get_service_by_fc_api($service_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('id_service_package', $service_id)
            ->get();
        return $query;
    }


    public function get_new_id_api()
    {
        $lastId = $this->db->table($this->table)->select('id_detail_service_package')->orderBy('id_detail_service_package', 'ASC')->get()->getLastRow('array');
        if ($lastId != null) {
            $count = (int)substr($lastId['id_detail_service_package'], 0);
            $id = sprintf('%03d', $count + 1);
        } else {
            $count = 0;
            $id = sprintf('%03d', $count + 1);
        }

        return $id;
    }

    public function add_service_api($id = null, $data = null)
    {
        $query = false;
        foreach ($data as $service) {

            $content = [
                'id_package' => $id,
                'id_service_package' => $service
            ];
            $query = $this->db->table($this->table)->insert($content);
        }
        return $query;
    }

    public function update_service_api($id = null, $data = null)
    {
        $queryDel = $this->db->table($this->table)->delete(['id_package' => $id]);
        $queryIns = $this->add_service_api($id, $data);
        return $queryDel && $queryIns;
    }
    public function delete_service_api($id_package)
    {
        $queryDel = $this->db->table($this->table)->delete(['id_package' => $id_package]);
        return $queryDel;
    }
}
