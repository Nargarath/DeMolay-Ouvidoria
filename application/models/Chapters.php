<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Chapters extends Eloquent {

    protected $table = "chapter"; // table name
    protected $fillable = ['name','number','region','emblem'];
    public function Feedbacks()
    {
        return $this->hasMany('Feedbacks','chapter_id');
    }
}
