<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OAuthen;
use GuzzleHttp\Client;
use App\Urls;

class OAuthenController extends Controller
{
    private function ConvertToSeconds($date)
    {
      $time = explode(':', $date);
      return $time[0] * 3600 + $time[1] * 60 + $time[2];
    }

    public function blogger()
    {
        $data = OAuthen::orderBy('created_at', 'desc')->first();
        $url = Urls::orderBy('created_at', 'desc')->first();


        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timeNow = strtotime(date('Y-m-d H:i:s')); 
        $timeLife = $data['timelife'];

        if($timeNow <= $timeLife) {
          // expire in
          $auth = $data['access_token'];

          // The data to send to the API
          $blogID = "8855353451941102775";
          $tags = explode(',', $url['tags']);
          $postData = array(
              'kind' => 'blogger#post',
              'blog' => array('id' => $blogID),
              'title' => $url['title'],
              'labels' => $tags,
              'content' => '<div class="post-id" dir="ltr" style="text-align: center; style" trbidi="on"><br/><a href="' . $url["urlshort"] . '" title="Redirect link"> DOWNLOAD HERE </a></div>'
          );

          //The headers to send to API
          // $auth = $_SESSION['token']['access_token'];
          $headers = array(
              'Authorization' => 'Bearer ' . $auth,
              'Accept'        => 'application/json;ver=1.0',
              'Content-Type'  => 'application/json; charset=UTF-8',
              'Host'          => 'www.googleapis.com'
          );

          //Send Request 
          $Guzzle = new Client();
          $response = $Guzzle->post('https://www.googleapis.com/blogger/v3/blogs/8855353451941102775/posts/', [
              'headers' => $headers, 
              'json' => $postData,
          ]);

          $message = true;
          return view('urlsAction', compact('message', 'data'));
        } //if expired

      return redirect()->route('new-post');
    }
}
