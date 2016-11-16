<?php

namespace App\Http\Controllers;
use Validator;
use File;
use Carbon\Carbon;
use Redirect;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'DESC')->paginate(10);
        return view('admin.article', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), ['title' => 'required','body' => 'required', 'year' => 'required']);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }

        $this->createArticle($request);

        // $notification = Article::create($request->all());
        return Redirect::to('admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), ['title' => 'required','body' => 'required']);

        if ($v->fails())
        {
            return "Prislo je do napake";
        }
        $article = Article::findOrFail($id);
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->save();

        return "Spremembe so bile shranjene";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      $notification = Article::find($id);
      File::deleteDirectory('photos/' . $notification->image_dir);
      $notification->delete();
      return Article::orderBy('id', 'DESC')->take(10)->get();
    }

    public function createArticle($request)
    {
      $article = Article::create(array(
        "title" => $request->get('title'),
        "body" => $request->get('body'),
        "image_dir" => $request->get('year') . "/" . str_replace(' ', '_', $request->get('title')) . "_" . time(),
      ));

      File::makeDirectory('photos/' . $article->image_dir, 0775, true);

    }
    public function pagination($id)
    {
      $count = $id - 1;
      $articles = Article::skip($count)->take(10)->get();
      return $articles;
    }

    public function parseData($ArticleCollection)
    {
      $images = [];
      foreach ($ArticleCollection as $value) {
        $images[] = $this->getImages($value);
      }
      return $images;
    }

    public function getImages($article)
    {
      $images = [];
      $dir = $article->image_dir;
      $path = public_path("photos/". $article->image_dir);
      $article->image_dir = [];
      if(File::exists($path)){
        foreach(File::allFiles($path) as $key => $image){
            $images[] = preg_replace('/.+\/public\//', "/", $image->getPathname());
        }
      }
      return $images;

    }
    public function showArticle($value='')
    {

      $maxYear = (int)substr(Article::max('created_at'), 0, 4);
      $minYear = (int)substr(Article::min('created_at'), 0, 4);
      $between = $this->getYearsBetween(date("Y"));
      $articles = Article::whereBetween('created_at', $between)->orderBy('id', 'DESC')->get();
      $lenght = count($articles)/10;
      $imageDir = $this->parseData($articles);

      return view('article', compact('articles', 'lenght', 'imageDir', 'maxYear', 'minYear'));
    }

    public function showArticleByYear($year)
    {
      $maxYear = (int)substr(Article::max('created_at'), 0, 4);
      $minYear = (int)substr(Article::min('created_at'), 0, 4);
      $between = $this->getYearsBetween($year);
      $articles = Article::whereBetween('created_at', $between)->orderBy('id', 'DESC')->get();
      $lenght = count($articles)/10;
      $imageDir = $this->parseData($articles);
      return view('article', compact('articles', 'lenght', 'imageDir', 'maxYear', 'minYear'));
    }

    public function getYearsBetween($year){
      $from = Carbon::createFromFormat('d-m-Y h:i', '01-01-' . $year . ' 00:00')
          ->startOfDay()
          ->toDateTimeString();

      $to = Carbon::createFromFormat('d-m-Y h:i', '30-12-' . $year . ' 00:00')
          ->endOfDay()
          ->toDateTimeString();

      return ['from' => $from, 'to' => $to];
    }
}
