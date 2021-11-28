<?php

namespace App\Models;

use Parsedown;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    use VotableTrait;

    protected $fillable = ['title','body'];

    protected $appends = ['created_date', 'is_favorited', 'favorites_count', 'body_html'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = Purifier::clean($value);
    }

    public function getUrlAttribute(){
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute(){
        return clean($this->bodyHtml());
    }

    public function answers(){
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');
    }

    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites(){
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function isFavorited(){
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute(){
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute(){
        return $this->favorites()->count();
    }

    public function getExcerptAttribute()
    {
        return $this->excerpt(250);
        // return Str::limit(strip_tags($this->bodyHtml(), 300));
    }

    public function excerpt($length)
    {
        return Str::limit(strip_tags($this->bodyHtml(), $length));
    }

    private function bodyHtml()
    {
        return Parsedown::instance()->text($this->body);
    }
}