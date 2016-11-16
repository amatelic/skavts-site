<?php

namespace App\Http\Controllers;
use Storage;
use File;
use Illuminate\Http\Request;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Carbon\Carbon;

class ImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $allDirectoryiesByYear = Storage::disk('public')->directories('photos');
      $articles = $this->getByYear(date('Y'));
      return view('images.index', compact('articles'));
    }

    public function getByYear($year)
    {
      return Article::orderBy('id', 'DESC')->whereYear('created_at', '=', $year)->get();
    }

    public function dataByYear($year)
    {
      $data = Article::where('image_dir', 'LIKE' ,$year.'/%')->get();
      return $data->toArray();
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
        $file = $request->file('file');
        $id = $request->input('article_id');

        $article  =  Article::where('id', $id)->first();
        $name = time() . str_replace(' ', '_', $file->getClientOriginalName());

        $file->move('photos/' . $article->image_dir, $name);

        return "Slika je bila dodana.";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $article = Article::where('id', $id)->first();
        $directory = Article::getImagesPath($article->image_dir);
        return ["article" => $article, "images" => $directory];
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
      $article = Article::where('id', $id)->first();
      $img_file = $request->input('img');
      Article::DeleteImage('photos/' . $article->image_dir. '/' . $img_file);
      return 'Slika je bila zbrisana';
    }

    /**
     * Display gallery by years
     *
     * @param  int  $id
     * @return Response
     */
    public function showGallerys($data = null)
    {

        $year = date("Y");
        $imagesByYear = $this->selectGalleryByYears($year);
        // $imagesByYear = $imagesByYear['collection'];
        return view('main.gallery', compact('imagesByYear', 'year'));
    }


    public function selectGalleryByYears($year)
    {
      $imagesByYear = [];
      $foleders= Storage::disk('public')->allDirectories('photos');
      $dirs = Storage::disk('public')->allDirectories('photos/' .$year);
      foreach ($dirs as $key => $dir) {
        $images = File::allFiles("./" . $dir);
        foreach ($images as $key => $image) {
          $imagesByYear[] = (string)$image;
        }
      }
      if (count($imagesByYear) != 0) {
        return ['collection' => $imagesByYear, 'year' => $year];
      }else if (count($imagesByYear) == 0  && in_array("./photos/" . $year, File::directories('./photos/'))) {
        return ["repeat" => true];
      }else{
        return ["repeat" => false];
      }
    }
}
