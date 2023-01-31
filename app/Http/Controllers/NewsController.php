<?php


namespace App\Http\Controllers;

use App\Repository\BaseRepository;
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
        $resultNews = $this->newsRepository->getAll();
        $result['resultNews'] =$resultNews;
        return view('news.list_news',$result);
    }


    public function create_news(Request $request)
    {
        $data = $request->all();
        $result = $this->newsRepository->createNews($data);
        return Controller::sendResponse(Controller::HTTP_OK,'thêm bài viết thành công',$result);
        //return $result;
    }

    public function update_news(Request $request,$id)
    {
        $data = $request->all();
        $result = $this->newsRepository->updateNews($data,$id);
        return $result;
    }

    public function update_status($id)
    {
        $result = $this->newsRepository->updateStatus($id);
        return Controller::sendResponse(Controller::HTTP_OK,'update status success',$result);
    }

    public function view_create_news()
    {
        return view('news.create_news');
    }


    public function findOneNews($id)
    {
        $result = $this->newsRepository->find($id);
        return view('news.detail_news',compact('result'));
    }

    public function viewImage()
    {
        return view('news.test');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            //upload image
            $result = $request->file('image')->storeOnCloudinary();
            //get url image luu vao db
            $image = $result->getPath();
        }
        return Controller::sendResponse(Controller::HTTP_OK,'update status success',$image);
    }


}
