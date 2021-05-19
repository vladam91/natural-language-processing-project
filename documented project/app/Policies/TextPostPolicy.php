<?php

namespace App\Policies;

use App\User;
use App\TextPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class TextPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the textPost.
     *
     * @param  \App\User  $user
     * @param  \App\TextPost  $textPost
     * @return mixed
     */
    public function view(User $user, TextPost $textPost)
    {
        if($textPost->type == 'paid'){
            return $user->hasSubscriptionAcces();
        }

        return true;
    }

    /**
     * Determine whether the user can create textPosts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->role->type === 'autor';
    }

    /**
     * Determine whether the user can update the textPost.
     *
     * @param  \App\User  $user
     * @param  \App\TextPost  $textPost
     * @return mixed
     */
    public function update(User $user, TextPost $textPost)
    {
        //Nema opcije updejtovanja... :) :P
    }

    /**
     * Determine whether the user can delete the textPost.
     *
     * @param  \App\User  $user
     * @param  \App\TextPost  $textPost
     * @return mixed
     */
    public function delete(User $user, TextPost $textPost)
    {
        return $user->isAdmin() || $user->role->type === 'moderator' || $user->id === $textPost->user->id;
    }
}
