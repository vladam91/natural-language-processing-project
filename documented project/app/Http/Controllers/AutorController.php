<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TextPost;
use App\VideoPost;
use Illuminate\Support\Facades\Auth;

class AutorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
    }


    /**
     * Funkcija vraca pogled sa formom za unos video posta
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getVideoForm()
    {
        if(Auth::user()->can('create', VideoPost::class))
        {
            $cats = Category::all();
            return view("video.form", ['cats' => $cats]);
        }

        return redirect()->back();
    }

    /**
     * Funkcija kreira novi text post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadVideo(Request $request){
        if(Auth::user()->can('create', VideoPost::class))
        {
            $this->validate($request, [
                'title' => 'required|max:140|min:10',
                'description' => 'required|max:180|min:10',
                'video' => 'required',
            ]);

            $idUser = Auth::user()->id;
            $title = $request->title;
            $description = $request->description;
            $url = $request->video->store('videos');
            //$video = $request->file('video') ;
            //$url = '\public\Videos\\'.$idUser.time().'.mp4';
            $catId = $request->get('cat');

            VideoPost::create([
                'user-id' => $idUser,
                'title' => $title,
                'description' => $description,
                'url' => $url,
                'type' => $request->get('type'),
                'cat-id' => $catId,
            ]);
        }

        return redirect('video-tutorials');
    }


    /**
     * Funkcija vraca pogled sa formom za unos text posta
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTextForm()
    {
        if(Auth::user()->can('create', TextPost::class))
        {
            $cats = Category::all();
            return view("text.form", ['cats' => $cats]);
        }

        return redirect()->back();
    }


    /**
     * Funkcija kreira novi text post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadText(Request $request){
        if(Auth::user()->can('create', TextPost::class))
        {
            $this->validate($request, [
                'title' => 'required|max:140|min:10',
                'description' => 'required|max:180|min:10',
                'body' => 'required',
            ]);

            $idUser = Auth::user()->id;
            $title = $request->title;
            $description = $request->description;
            $body = $request->body;
            $catId = $request->get('cat');

           TextPost::create([
               'user-id' => $idUser,
               'title' => $title,
               'description' => $description,
               'body' => $body,
               'type' => $request->get('type'),
               'cat-id' => $catId,
           ]);
        }

       return redirect('text-tutorials');
    }
}
