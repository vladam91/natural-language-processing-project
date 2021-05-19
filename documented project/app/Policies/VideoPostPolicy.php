<?php

namespace App\Policies;

use App\User;
use App\VideoPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the videoPost.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPost  $videoPost
     * @return mixed
     */
    public function view(User $user, VideoPost $videoPost)
    {
        if($videoPost->type == 'paid'){
            return $user->hasSubscriptionAcces();
        }

        return true;
    }

    /**
     * Determine whether the user can create videoPosts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->role->type === 'autor';
    }

    /**
     * Determine whether the user can update the videoPost.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPost  $videoPost
     * @return mixed
     */
    public function update(User $user, VideoPost $videoPost)
    {
        //
    }

    /**
     * Determine whether the user can delete the videoPost.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPost  $videoPost
     * @return mixed
     */
    public function delete(User $user, VideoPost $videoPost)
    {
        return $user->isAdmin() || $user->role->type === 'moderator' || $user->id === $videoPost->user->id;
    }
}
