<?php

namespace App\Policies;

use App\User;
use App\VideoPostComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the videoPostComment.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPostComment  $videoPostComment
     * @return mixed
     */
    public function view(User $user, VideoPostComment $videoPostComment)
    {
        return !$user->isBanned();
    }

    /**
     * Determine whether the user can create videoPostComments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !$user->isBanned();
    }

    /**
     * Determine whether the user can update the videoPostComment.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPostComment  $videoPostComment
     * @return mixed
     */
    public function update(User $user, VideoPostComment $videoPostComment)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the videoPostComment.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPostComment  $videoPostComment
     * @return mixed
     */
    public function delete(User $user, VideoPostComment $videoPostComment)
    {
        return $user->isAdmin() || $user->role->type === 'moderator';
    }
}
