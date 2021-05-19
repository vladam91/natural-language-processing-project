<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class TextPost extends Model
{

    use Searchable;

    protected $fillable = ['user-id', 'cat-id','title','description','type','body'];

    /**
     * Veza koja vraca usera kojem dati text post pirpada
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User', 'user-id');
    }

    /**
     * Vraca kategoriju kojo post pripada
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo('App\Category', 'cat-id');
    }

    /**
     * Vraca komentare koji pripadaju datom postu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany('App\TextPostComment', 'post_id');
    }
}
