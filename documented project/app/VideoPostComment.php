<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPostComment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'body'];


    /**
     * Vraca autora datog komentara
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Vraca post koje komentar pripada
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo('App\VideoPost', 'post_id');
    }
}
