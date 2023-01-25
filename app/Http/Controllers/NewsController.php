<?php


namespace App\Http\Controllers;

use App\Repository\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getAllNews()
    {
        $result = $this->newsRepository->getAll();
        return $result;
    }


    public function create_news(Request $request)
    {
        $data = $request->all();
        $result = $this->newsRepository->createNews($data);
        return $result;
    }
}
