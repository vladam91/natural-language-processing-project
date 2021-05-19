<?php

namespace App\Policies;

use App\User;
use App\TextPostComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class TextPostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the textPostComment.
     *
     * @param  \App\User  $user
     * @param  \App\TextPostComment  $textPostComment
     * @return mixed
     */
    public function view(User $user, TextPostComment $textPostComment)
    {
        return !$user->isBanned();
    }

    /**
     * Determine whether the user can create textPostComments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !$user->isBanned();
    }

    /**
     * Determine whether the user can update the textPostComment.
     *
     * @param  \App\User  $user
     * @param  \App\TextPostComment  $textPostComment
     * @return mixed
     */
    public function update(User $user, TextPostComment $textPostComment)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the textPostComment.
     *
     * @param  \App\User  $user
     * @param  \App\TextPostComment  $textPostComment
     * @return mixed
     */
    public function delete(User $user, TextPostComment $textPostComment)
    {
        return $user->isAdmin() || $user->role->type === 'moderator';
    }
}
