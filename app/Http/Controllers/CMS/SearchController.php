<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function index(Request $request)
    {
        $search = $request->tag_id;
        $all = $this->searchRepository->searchTag($search);
        return view('search')->with('all', $all);
    }
}
