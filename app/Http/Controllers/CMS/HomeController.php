<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\IMailRepository;
use App\Repositories\IPostRepository;
use App\Repositories\ITagRepository;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct(
        IPostRepository $postRepository,
        ITagRepository $tagRepository,
        IMailRepository $mailRepository
    ) {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->mailRepository = $mailRepository;
    }

    public function index()
    {
        $tag = $this->tagRepository->all();
        $all = $this->postRepository->all();
        $mail = $this->mailRepository->all();
//        dd($mail);
        return view('index')->with('tag', $tag)->with('all', $all)->with('mail', $mail);
    }

    public function dashboard()
    {
        $post = $this->postRepository->all();
        $tag = $this->tagRepository->all();
//        return view('dashboard')->with('data',$data);
        return view('dashboard')->with('tag', $tag)->with('post', $post);
    }

    public function editPost()
    {
        $tag = $this->tagRepository->all();
        return view('editpost')->with('tag', $tag);
    }

    public function detail($id)
    {
        $post = $this->postRepository->all($id);
        return view('detail')->with('post', $post);
    }

    public function log()
    {
        Log::channel('customLog')->error('hello world');
        return view('log');
    }
}
