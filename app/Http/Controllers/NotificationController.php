<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Carbon\Carbon;
use App\Notification;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $notifications = Notification::orderBy('id', 'DESC')->paginate(10);
        return view('admin.notification', compact('notifications'));
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
      $v = Validator::make($request->all(), ['title' => 'required','body' => 'required', 'will_be' => 'required']);

      if ($v->fails())
      {
          return redirect()->back()->withErrors($v->errors());
      }
        $notification = Notification::create($request->all());
        return Redirect::to('admin/notifications');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return 'deleted';
    }

    /**
     * Show notifications
     */
    public function showNotification()
    {
      $notifications = Notification::orderBy('id', 'DESC')->take(10)->get();
      return view('index', compact('notifications'));
    }

    //geting json data for callender app
    public function calenderNotification(Request $request)
    {
      $year = $request->get('year');
      $month = $request->get('month');

      if (!isset($year) && !isset($month)) {
        $year = date('Y');
        $month = date('m') - 1;
      }
      $notifications = Notification::whereBetween('will_be', $this->getYearsBetween($year, $month))->get();
      $dates = [];
      $info = [];
      //savinjson data in the format {22: {title: "", body: ""}}
      foreach ($notifications as $notification) {
        $day = intval(substr($notification->will_be, -2), 10); //convert 02 to 2
        $info[$day] = [
          'title' => $notification->title,
          'body' => $notification->body,
        ];
        $dates[]  = $day;
      }

      $info['dates'] = $dates;
      return $info;
    }

    //create whereBetwen statment for day in month
    public function getYearsBetween($year, $month){
      $lastDay = date("t", strtotime($year));
      $from = Carbon::createFromFormat('d-m-Y h:i', '01-' . ($month + 1) . '-' . $year . ' 00:00')
          ->startOfDay()
          ->toDateTimeString();

      $to = Carbon::createFromFormat('d-m-Y h:i', '' . $lastDay. '-' . ($month + 1)  . '-' . $year . ' 00:00')
          ->endOfDay()
          ->toDateTimeString();

      return ['from' => $from, 'to' => $to];
    }
}
