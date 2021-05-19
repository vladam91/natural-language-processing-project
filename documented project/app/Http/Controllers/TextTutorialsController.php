<?php

namespace App\Http\Controllers;

use App\Category;
use App\TextPost;
use App\TextPostComment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextTutorialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
    }

    /**
     * Vraca view sa listom postova
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTextTutorials()
    {
        $posts = TextPost::paginate(10);
        return view('text.list', ['posts' => $posts]);
    }

    /**
     * Dohvata postove na osnovu kategorije
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPostsByCategory(Category $category){
        $posts = TextPost::where('cat-id', $category->id)->paginate(10);
        return view('text.list', ['posts' => $posts]);
    }

    /**
     * Dohvata sve besplatne postove
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllFreePosts(){
        $posts = TextPost::where('type', 'free')->paginate(10);
        return view('text.list', ['posts' => $posts]);
    }

    /**
     * Dohvata sve placene postove
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllPaidPosts(){
        $posts = TextPost::where('type', 'paid')->paginate(10);
        return view('text.list', ['posts' => $posts]);
    }

    /**
     * Prikazuje sve postove koji pripadaju jednom korisniku
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllPostsByUser(User $user){
        $posts = $user->textPosts()->paginate(10);
        return view('text.list', ['posts' => $posts]);
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

        $posts = TextPost::search($request->search)->paginate(10);
        return view('text.list', ['posts' => $posts]);
    }

    /**
     * Korisniku prikazuje besplatan post
     *
     * @param TextPost $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPost(TextPost $post){
        if(Auth::user()->can('view', $post)) {
            $comments = $post->comments;
            return view('text.post', ['post' => $post, 'comments' => $comments]);
        }
        return redirect('subscription');
    }


    /**
     * Brise specifican post
     *
     * @param TextPost $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePost(TextPost $post){
        if(Auth::user()->can('delete', $post))
        {
            $post->delete();
        }
        return redirect()->back();
    }

    /**
     * Funkcija brise izabrani komentar
     *
     * @param TextPostComment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTextPostComment(TextPostComment $comment){
        if(Auth::user()->can('delete', $comment))
        {
            $comment->delete();
        }
        return redirect()->back();
    }

    /**
     * Funkcija kreira novi komentar za dati tekstualni post
     *
     * @param TextPost $post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createComment(TextPost $post, Request $request){
        if(Auth::user()->can('create', TextPostComment::class)) {
            $this->validate($request,
                [
                    'body' => 'required|max:720'
                ]
            );

            TextPostComment::create(
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
