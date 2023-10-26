<?php


namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class serviceModel extends Model
{
    protected $table = 'service_package';
    protected $columns = '
    service_package.id,
    service_package.name
    ';

    public function get_new_id()
    {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        if ($lastId != null) {
            $count = (int)substr($lastId['id'], 0);
            $id = sprintf('%02d', $count + 1);
            return $id;
        } else {
            return '01';
        }
    }

    public function getServices()
    {
        $query = $this->db->table($this->table)
            ->select("{$this->columns}")
            ->get();
        return $query;
    }
    public function getservice($id)
    {
        $query = $this->db->table($this->table)
            ->select("{$this->columns}")
            ->where('service.id', $id)
            ->get();
        return $query;
    }
  
    // --------------------------------------Admin-------------------------------------------
    public function addservice($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updateservice($id, $data)
    {
        $query = $this->db->table($this->table)
            ->where('service.id', $id)
            ->update($data);
        return $query;
    }

    public function deleteservice($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
    public function getTotal()
    {
        $query =  $this->db->table($this->table)
            ->selectCount("id")->get()
            ->getRow();
        return $query;
    }
}
