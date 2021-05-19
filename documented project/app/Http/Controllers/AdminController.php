<?php

namespace App\Http\Controllers;

use App\Role;
use App\TextPost;
use App\VideoPost;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Prikazuje administratorski panel
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminPanel(){
        $users = User::all();
        $posts = TextPost::all();
        $videos = VideoPost::all();
        return view('admin.panel', ['users' => $users, 'posts' => $posts, 'videos' => $videos]);
    }

    /**
     * Deletes user if user is not an admin
     *
     * @param User $user
     */
    public function deleteUser(User $user){
        if($user && !$user->isAdmin()){
            $user->delete();
        }
        return redirect('admin-panel');
    }

    /**
     * Banuje korisnika ukoliko korisnik nije admin
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function banUser(User $user){
        if($user && !$user->isAdmin()){
            $user->banned = true;
            $user->save();
        }
        return redirect('admin-panel');
    }

    /**
     * Unbanuje korsinika ukoliko korisnik nije admin
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unbanUser(User $user){
        if($user && !$user->isAdmin()){
            $user->banned = false;
            $user->save();
        }
        return redirect('admin-panel');
    }


    /**
     *Vraca stranicu na kojoj se dituje rola za korisnika :)
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRole(User $user){
        $roles = Role::all();
        return view('user.editrole', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Updejtuje rolu datog korisnika :)
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editRole(User $user, Request $request){
        $roleId = $request->get('type');
        $user->update(['role-id' => $roleId]);
        return redirect('admin-panel');
    }

    /**
     * Brise post iz adminskog panela
     *
     * @param TextPost $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteTextPost(TextPost $post){
        $post->delete();
        return redirect('admin-panel');
    }
}
