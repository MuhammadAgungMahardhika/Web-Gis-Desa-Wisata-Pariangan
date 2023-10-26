<?php


namespace App\Models;

use CodeIgniter\Model;

class reviewModel extends Model
{
    protected $table = 'review_atraction';
    protected $primaryKey = 'id';

    public function getObjectComment($object, $object_id)
    {
        $query = $this->db->table($this->table)
            ->select('review_atraction.comment,users.username as name , review_atraction.created_date as date')
            ->join('users', 'users.id = review_atraction.user_id')
            ->where($object, $object_id)
            ->orderBy('review_atraction.created_date', 'ASC')
            ->get();
        return $query;
    }
    public function getUserComment($user_id, $object, $object_id)
    {
        $query = $this->db->table($this->table)
            ->select('review_atraction')
            ->join('review_atraction', 'review_atraction.id = review_atraction.review_atraction_id')
            ->where('review_atraction.user_id', $user_id)
            ->where('review_atraction.' + $object, $object_id)
            ->get();
        return $query;
    }
    public function addComment($user_id, $id, $comment)
    {
        $query = $this->db->table($this->table)->insert(['review_atraction.user_id' => $user_id, 'review_atraction.id' => $id, 'review_atraction.comment' => $comment]);
        return $query;
    }
    public function updateComment($user_id, $id, $comment)
    {
        $query = $this->db->table($this->table)->update(['review_atraction.user_id' => $user_id, 'review_atraction.comment' => $comment], ['review_atraction.id' => $id]);
        return $query;
    }
}
