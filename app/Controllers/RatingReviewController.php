<?php

namespace App\Controllers;



class RatingReviewController extends BaseController
{
    protected $modelReview;
    protected $modelComment;
    protected $modelReservation;
    public function __construct()
    {
        $this->modelReview = new \App\Models\ratingModel();
        $this->modelComment = new \App\Models\reviewModel();
        $this->modelReservation = new \App\Models\reservationModel();
    }
    public function rating_atraction()
    {
        $data = $this->request->getPOST();
        $user_id = $this->request->getPOST('user_id');
        $atraction_id = $this->request->getPOST('atraction_id');

        if ($user_id && $atraction_id) {
            $check = $this->modelReview->check($user_id, 'atraction_id', $atraction_id)->getRow();
            // check rating alredy exist or not // if exist update // if not insert
            if ($check) {
                date_default_timezone_set('Asia/Jakarta');
                $data['updated_date'] =  date('Y-m-d H:i:s');
                $updateRating = $this->modelReview->updateAtractionRating($data, $user_id, 'atraction_id', $atraction_id);
                if ($updateRating == true) {
                    return json_encode($updateRating);
                }
            } else {
                $addRating = $this->modelReview->addRating($data);
                if ($addRating == true) {
                    return json_encode($addRating);
                }
            }
        }
    }
    public function comment_atraction()
    {
        $user_id = $this->request->getPOST('user_id');
        $atraction_id = $this->request->getPOST('object_id');
        $comment = $this->request->getPOST('comment');

        $rating_id = $this->modelReview->getRatingId($user_id, 'atraction_id', $atraction_id)->getRow();

        // Check if rating_id is there or not 
        if ($rating_id != null) {
            $addComment = $this->modelComment->updateComment($user_id, $rating_id->rating, $comment);
            return json_encode($addComment);
        } else {
            $addRating = $this->modelReview->addRating(['review_atraction.user_id' => $user_id, 'review_atraction.atraction_id' => $atraction_id]);
            $rating_id = $this->modelReview->getRatingId($user_id, 'atraction_id', $atraction_id)->getRow();
            if ($addRating) {
                $addComment = $this->modelComment->addComment($user_id, $rating_id->rating, $comment);
                return json_encode($addComment);
            }
        }
    }
    public function get_atraction_comment()
    {
        $object_id = $this->request->getVar('object_id');
        $comment = $this->modelComment->getObjectComment('atraction_id', $object_id)->getResult();
        return json_encode($comment);
    }

    public function rating_event()
    {
        $data = $this->request->getPOST();
        $user_id = $this->request->getPOST('user_id');
        $event_id = $this->request->getPOST('event_id');

        if ($user_id && $event_id) {
            $check = $this->modelReview->check($user_id, 'event_id', $event_id)->getRow();
            // check rating alredy exist or not // if exist update // if not insert
            if ($check) {
                date_default_timezone_set('Asia/Jakarta');
                $data['updated_date'] =  date('Y-m-d H:i:s');
                $updateRating = $this->modelReview->updateAtractionRating($data, $user_id, 'event_id', $event_id);
                if ($updateRating == true) {
                    return json_encode($updateRating);
                }
            } else {
                $addRating = $this->modelReview->addRating($data);
                if ($addRating == true) {
                    return json_encode($addRating);
                }
            }
        }
    }
    public function comment_event()
    {
        $user_id = $this->request->getPOST('user_id');
        $event_id = $this->request->getPOST('object_id');
        $comment = $this->request->getPOST('comment');

        $rating_id = $this->modelReview->getRatingId($user_id, 'event_id', $event_id)->getRow();

        // Check if rating_id is there or not 
        if ($rating_id != null) {
            $addComment = $this->modelComment->updateComment($user_id, $rating_id->rating, $comment);
            return json_encode($addComment);
        } else {
            $addRating = $this->modelReview->addRating(['review_atraction.user_id' => $user_id, 'review_atraction.event_id' => $event_id]);
            $rating_id = $this->modelReview->getRatingId($user_id, 'event_id', $event_id)->getRow();
            if ($addRating) {
                $addComment = $this->modelComment->addComment($user_id, $rating_id->rating, $comment);
                return json_encode($addComment);
            }
        }
    }
    public function get_event_comment()
    {
        $object_id = $this->request->getVar('object_id');
        $comment = $this->modelComment->getObjectComment('event_id', $object_id)->getResult();
        return json_encode($comment);
    }
    public function rating_comment_package()
    {
        $data = $this->request->getPOST();
        $user_id = $data['id_user'];
        $package_id = $data['id_package'];
        $request_date = $data['request_date'];
        $review = $data['review'];
        $rating = $data['rating'];
        // dd($data);
        $requestData = [
            'rating' =>  $rating,
            'review' => $review
        ];

        $updateRating = $this->modelReservation->update_r_api($user_id, $package_id, $request_date, $requestData);
        if ($updateRating) {
            session()->setFlashdata('success', 'Thanks for your rated.');
            return redirect()->to(site_url('user/reservation/' . $user_id));
        } else {
            session()->setFlashdata('failed', 'Failed to rate, please try again');
            return redirect()->to(site_url('user/reservation/' . $user_id));
        }
    }
}
