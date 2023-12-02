<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class packageDayModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'package_day';
    protected $primaryKey       = 'day';
    protected $returnType       = 'array';
    protected $allowedFields    = ['day', 'id_package', 'description'];

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
    public function get_list_pd_api()
    {
        $query = $this->db->table($this->table)
            ->select('day as id, package.name, id_package, package_day.description')
            ->join('package', 'package_day.id_package = package.id')
            ->get();
        return $query;
    }

    public function get_pd_by_id_api($id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('day', $id)
            ->get();
        return $query;
    }
    public function get_pd_by_package_id_api($id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('id_package', $id)
            ->get();
        return $query;
    }

    public function get_new_id_api()
    {
        $lastId = $this->db->table($this->table)->select('day')->orderBy('day', 'ASC')->get()->getLastRow('array');
        if ($lastId != null) {
            $count = (int)substr($lastId['day'], 0);
            $id = sprintf('%02d', $count + 1);
        } else {
            $count = 0;
            $id = sprintf('%02d', $count + 1);
        }
        return $id;
    }

    public function add_pd_api($packageDay = null)
    {
        foreach ($packageDay as $key => $value) {
            if (empty($value)) {
                unset($packageDay[$key]);
            }
        }
        $insert = $this->db->table($this->table)
            ->insert($packageDay);
        return $insert;
    }

    public function update_pd_api($id = null, $day = null)
    {
        foreach ($day as $key => $value) {
            if (empty($value)) {
                unset($day[$key]);
            }
        }
        $day['updated_at'] = Time::now();
        $query = $this->db->table($this->table)
            ->where('day', $id)
            ->update($day);
        return $query;
    }
    public function delete_pd_by_package_id($id_package)
    {
        $query = $this->db->table($this->table)->delete(['id_package' => $id_package]);
        return $query;
    }
    public function delete_pd_by_day_id($id_day)
    {
        $query = $this->db->table($this->table)->delete(['day' => $id_day]);
        return $query;
    }
}
