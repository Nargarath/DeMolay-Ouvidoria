<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class FeedbackTypes extends Eloquent {

    protected $table = "feedback_type"; // table name

    public function Feedbacks()
    {
        return $this->hasMany('Feedbacks','feedbackType_id');
    }
    
}
