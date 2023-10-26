<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class DetailPackageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_package';
    protected $primaryKey       = 'activity';
    protected $returnType       = 'array';
    // protected $allowedFields    = ['id_detail_service_package', 'id_service_package', 'id_package'];

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
    public function get_detail_package_by_package_api($day = null)
    {
        $query = $this->db->table($this->table)
            ->select('activity as id, id_day, id_package, id_object, activity_type, detail_package.description as detailDescription')
            ->where('id_package', $day)
            ->get();
        return $query;
    }

    public function get_detail_package_by_dp_api($id_day = null)
    {
        $query = $this->db->table($this->table)
            ->select('activity as id, id_day, id_package, id_object, activity_type, detail_package.description as detailDescription')
            ->where('id_day', $id_day)
            ->get();
        return $query;
    }

    public function get_objects_by_package_day_id($id_day = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('detail_package.id_day', $id_day)
            ->get();
        return $query;
    }


    public function get_new_id_api()
    {
        $lastId = $this->db->table($this->table)->select('activity')->orderBy('activity', 'ASC')->get()->getLastRow('array');
        if ($lastId != null) {
            $count = (int)substr($lastId['activity'], 0);
            $id = sprintf('%02d', $count + 1);
        } else {
            $count = 0;
            $id = sprintf('%02d', $count + 1);
        }

        return $id;
    }

    public function add_dp_api($datas = null)
    {
        $query = $this->db->table($this->table)->insert($datas);
        return $query;
    }

    public function update_dp_api($id = null, $data = null)
    {
        $queryDel = $this->db->table($this->table)->delete(['activity' => $id]);
        $new_id = $this->get_new_id_api();
        $data['activity'] = $new_id;
        $queryIns = $this->add_dp_api($data);
        return $queryDel && $queryIns;
    }
}
