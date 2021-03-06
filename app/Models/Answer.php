<?php

namespace App\Models;

use Parsedown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mews\Purifier\Facades\Purifier;

class Answer extends Model
{
    use HasFactory;
    use VotableTrait;

    protected $guarded = [];

    protected $appends = ['created_date', 'body_html', 'is_best'];

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute(){
        return Purifier::clean(Parsedown::instance()->text($this->body));
    }

    public static function boot(){

        parent::boot();

        static::created(function($answer){
            $answer->question->increment('answers_count');
            $answer->question->save();
        });

        static::deleted(function($answer){
            $answer->question->decrement('answers_count');
        });

    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        return $this->isBest() ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute(){
        return $this->isBest();
    }

    public function isBest(){
        return $this->id === $this->question->best_answer_id;
    }

}
