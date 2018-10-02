<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Feedbacks extends Eloquent {

    protected $table = "feedback"; // table name

    protected $fillable = [
        'text',
        'approved',
        'people_name',
        'feedbackType_id',
        'chapter_id'
    ];
    protected $touches = ['type'];

    public function type()
    {
        return $this->belongsTo('FeedbackTypes','feedbackType_id','id');
    }
    public function Chapter()
    {
        return $this->belongsTo('Chapters','chapter_id','id');
    }
}
