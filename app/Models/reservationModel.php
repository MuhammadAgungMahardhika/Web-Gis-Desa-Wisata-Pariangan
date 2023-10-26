<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class reservationModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reservation';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'id_user', 'id_package', 'id_reservation_status', 'request_date', 'deposit', 'total_price', ''];

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
    public function get_list_r_api()
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }

    public function getTotal()
    {
        $query =  $this->db->table($this->table)
            ->selectCount("id")->get()
            ->getRow();
        return $query;
    }

    public function get_r_by_id_user_api($id_user = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('id_user', $id_user)
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }


    public function get_new_id_api()
    {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');

        if ($lastId != null) {
            $count = (int)substr($lastId['id'], 2);
            $id = sprintf('RS%02d', $count + 1);
        } else {
            $count = 0;
            $id = sprintf('RS%02d', $count + 1);
        }
        return $id;
    }

    public function add_r_api($reservation = null)
    {
        foreach ($reservation as $key => $value) {
            if (empty($value)) {
                unset($reservation[$key]);
            }
        }
        $reservation['created_at'] = Time::now();
        $reservation['updated_at'] = Time::now();
        $insert = $this->db->table($this->table)
            ->insert($reservation);
        return $insert;
    }

    public function update_r_api($id = null, $data = null)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }
        $data['updated_at'] = Time::now();
        $query = $this->db->table($this->table)
            ->where('id', $id)
            ->update($data);
        return $query;
    }
    public function getRating($id)
    {
        $query = $this->db->table($this->table)
            ->select('sum(rating) as rating')
            ->where('id_package', $id)
            ->get();
        return $query;
    }

    public function getUserTotal($id)
    {
        $query = $this->db->table($this->table)
            ->select('COUNT(id_user) as userTotal')
            ->where('id_package', $id)
            ->where('rating!=', 'null')
            ->get();
        return $query;
    }

    public function getUserRating($user_id, $id)
    {
        $query = $this->db->table($this->table)
            ->select('rating,updated_at')
            ->where('id_user', $user_id)
            ->where('id_package', $id)
            ->get();
        return $query;
    }
    public function getObjectComment($id)
    {
        $query = $this->db->table($this->table)
            ->select('reservation.review,reservation.rating,users.username as name , reservation.created_at as date')
            ->join('users', 'users.id = id_user')
            ->where('id_package', $id)
            ->orderBy('reservation.created_at', 'ASC')
            ->get();
        return $query;
    }
    public function checkIsDateDuplicate($user_id, $date)
    {
        $query = $this->db->table($this->table)
            ->select('COUNT(request_date) as dateCount')
            ->where('request_date', $date)
            ->where('id_user', $user_id)
            ->get()->getRowArray();
        if ($query['dateCount'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
