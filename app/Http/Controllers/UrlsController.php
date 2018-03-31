<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urls;
use App\OAuthen;
use Google_Client;
use GuzzleHttp\Client;

class UrlsController extends Controller
{
    //Lists all data in urls table
    public function getUrls()
    {
      // $data = Urls::all();
      // $data = Urls::paginate(10);
      $data = Urls::orderBy('created_at', 'desc')->paginate(5);
      return view('urls', compact('data')); 
    }

    //Edit
    public function editById( $id )
    {
      $data = Urls::find($id);
      if(count($data) > 0)
      {
        //Co du lieu duoc tim thay
        return view('urlsAction', compact('data'));

      } else {
        //khong tim thay Id
      $data = Urls::orderBy('created_at', 'desc')->paginate(5);
        return view('urls', compact('data')); 
      }
    }

    //Delete
    public function deleteById($id)
    {
      Urls::find($id)->delete();

      return redirect()->route('show');
    }

    //Update (Modifies), Add
    public function action(Request $request)
    {
      // dd($request->input());
      if($request->has('update')){
        //Update 
        $data = Urls::find($request->input('id'));

        if(count($data) > 0)
        {
          //Tim thay Id, tien hanh update du lieu
          $data->url = $request->input('url');
          $data->urlshort = $request->input('urlshort');
          $data->title = $request->input('title');
          $data->tags = $request->input('tags');
          $data->save();

          return redirect()->route('show');

          } else {
            $data = Urls::orderBy('created_at', 'desc')->paginate(5);

            return view('urls', compact('data'));
          }
      } else if ($request->has('add')) {  
        
        //Add
        $data = new Urls();
        $data->url = $request->input('url');
        $data->urlshort = $request->input('urlshort');
        $data->title = $request->input('title');
        $data->tags = $request->input('tags');
        $data->save();

        //GET Request to new post Blogger 
        return redirect()->route('auth');

      } else {
        $data = Urls::orderBy('created_at', 'desc')->paginate(5);
        
        return view('urls', compact('data'));
      }
    }

    public function add()
    {
      $data = new Urls();

      return view('urlsAction', compact('data'));
    }


    public function getApiLink(Request $request)
    {
      $api_token = ''; // token 123-link here
      $long_url = urlencode($request['url']);
      $api_url = "http://123link.co/api?api={$api_token}&url={$long_url}";
      
      $result = @json_decode(file_get_contents($api_url), TRUE);

      return response()->json([
          'result' => $result
        ]);
    }

    public function newPost(Request $request)
    {
        $data = OAuthen::orderBy('created_at', 'desc')->first();

        //time now + expires_in = time life
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timeNow = strtotime(date('Y-m-d H:i:s')); 
        $timeLife = $data['timelife'];

        if ($timeNow > $timeLife) {
            //Expired
            $client = new Google_Client();
            $client->setAccessType('offline'); // default: offline
            $client->setApprovalPrompt('force');
            $client->setApplicationName('Mapdocs Blogger v3 API'); //name of the application
            $client->setClientId('');//client id
            $client->setClientSecret(''); // client secreti
            $client->setRedirectUri(url('/new-post'));  //redirects to url
            $client->setDeveloperKey(''); //api key
            $client->setScopes(array('https://www.googleapis.com/auth/blogger')); 

            //Check OAuth and Callback
            if (isset($_GET['logout'])) { // logout: destroy token
                unset($_SESSION['token']);
                die('Logged out.');
            }

            if (isset($_GET['code'])) { //auth callback, get the token and store it in session
                $client->authenticate($request->input('code'));
                $_SESSION['token'] = $client->getAccessToken();
            }

            if (isset($_SESSION['token'])) { // extract token from session and configure client
                $token = $_SESSION['token'];
                $client->setAccessToken($token);

                if ($client->isAccessTokenExpired()) {
                    $google_token = json_decode($_SESSION['token']);
                    $client->refreshToken($google_token->refresh_token);
                }
            }

            if (!$client->getAccessToken()) { // auth call to google
                $authUrl = $client->createAuthUrl();
                header("Location: ".$authUrl);
                die;
            }

            $auth = new OAuthen();
            $auth->access_token = $_SESSION['token']['access_token'];
            $auth->timelife = $timeNow + intval($_SESSION['token']['expires_in']);
            $auth->save();
        }

        return redirect()->route('auth');
    }

    private function ConvertToSeconds($date)
    {
      $time = explode(':', $date);
      return $time[0] * 3600 + $time[1] * 60 + $time[2];
    }
}
