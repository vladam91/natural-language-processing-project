<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoPost;
use Illuminate\Support\Facades\Auth;
use App\VideoPostComment;
use App\User;
use App\Category;

class VideoTutorialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
    }


    /**
     * Vraca view sa listom video postova
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getVideoTutorials()
    {
        $videoposts = VideoPost::paginate(10);
        return view('video.list', ['videoposts' => $videoposts]);
    }



    /**
     * Dohvata video postove na osnovu kategorije
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPostsByCategory(Category $category){
        $videoposts = VideoPost::where('cat-id', $category->id)->paginate(10);
        return view('video.list', ['videoposts' => $videoposts]);
    }


/* Dohvata sve besplatne postove
*
* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
*/
    public function getAllFreePosts(){
        $videoposts = VideoPost::where('type', 'free')->paginate(10);
        return view('video.list', ['videoposts' => $videoposts]);
    }



    /**
     * Dohvata sve placene postove
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllPaidPosts(){
        $videoposts = VideoPost::where('type', 'paid')->paginate(10);
        return view('video.list', ['videoposts' => $videoposts]);
    }

    /**
     * Prikazuje sve video postove koji pripadaju jednom korisniku
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllPostsByUser(User $user){
        $videoposts = $user->videoPosts()->paginate(10);
        return view('video.list', ['videoposts' => $videoposts]);
    }


    /**
     * Funkcija koja pretrazuje postove na osnovu naslova, tipa, opisa, tela...
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchPosts(Request $request){
        $this->validate($request,
            [
                'search' => 'required|min:3|max:120'
            ]
        );

        $post = VideoPost::search($request->search)->paginate(10);
        return view('video.list', ['videoposts' => $post]);
    }



    /**
     * Korisniku prikazuje besplatan post
     *
     * @param VideoPost $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getvideoPost(VideoPost $post){
        if(Auth::user()->can('view', $post)) {
            $comments = $post->comments;
            return view('video.post', ['post' => $post, 'comments' => $comments]);
        }
        return redirect('subscription');
    }



    /**
     * Brise specifican post
     *
     * @param VideoPost $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteVideoPost(VideoPost $post){
        if(Auth::user()->can('delete', $post))
        {
            $post->delete();
        }
        return redirect()->back();
    }



    /**
     * Funkcija brise izabrani komentar
     *
     * @param VideoPostComment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteVideoPostComment(VideoPostComment $comment){
        if(Auth::user()->can('delete', $comment))
        {
            $comment->delete();
        }
        return redirect()->back();
    }



    /**
     * Funkcija kreira novi komentar za dati tekstualni post
     *
     * @param VideoPost $post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createComment(VideoPost $post, Request $request){
        if(Auth::user()->can('create', VideoPostComment::class)) {
            $this->validate($request,
                [
                    'body' => 'required|max:720'
                ]
            );

            VideoPostComment::create(
                [
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'body' => $request->body,
                ]
            );
        }
        return redirect()->back();
    }



}














