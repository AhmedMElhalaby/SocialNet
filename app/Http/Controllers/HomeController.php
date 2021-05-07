<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\VerifyAccounts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
//    public function index(){
//        return view('welcome');
//    }

    public function privacy(){
        return view('privacy');
    }

    public function verify(Request $request){
        if($request->has('token')){
            $verify = VerifyAccounts::where('token',$request->token)->first();
            if($verify){
                $User = User::where('id',$verify->user_id)->first();
                if($User->email_verified_at == null){
                    $User->email_verified_at = now();
                    $User->save();
                    $message = 'Email Verified Successfully';
                }else
                    $message = 'Email Verified Before !';
            }else
                $message = 'Verification Token is invalid !';
        }else
            $message = 'Verification Token is required !';
        return view('verification',compact('message'));
    }
    /*
|--------------------------------------------------------------------------
| Home Controller
|--------------------------------------------------------------------------
|
| This controller renders your application's "dashboard" for users that
| are authenticated. Of course, you are free to change or remove the
| controller as you wish. It is just here to get your app started!
|
*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $Friends = Friend::where('user_id',Auth::user()->id)->pluck('friend_id')->toArray();
        (!in_array(Auth::user()->id,$Friends))?array_push($Friends,Auth::user()->id): "";

        $PeopleYouMayKnow = User::whereNotIn('id',$Friends)->take(4)->get();
        $Posts = Post::whereIn('user_id',$Friends)->orderBy('created_at','desc')->get();
        return view('home',compact('PeopleYouMayKnow','Posts'));
    }
    public function CompleteRegister()
    {
        return view('auth.complete_register');
    }
    public function PostCompleteRegister(Request $request)
    {
        $image_name = Auth::user()->image;
        if($request->hasFile('image')){
            $image = $request->file('image');

            $image_name = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads');

            $image->move($destinationPath, $image_name);
        }
        Auth::user()->update(array(
            'date_of_birth'=>$request->date_of_birth,
            'nationality'=>$request->nationality,
            'information'=>$request->information,
            'image'=>$image_name,
        ));
        return redirect('/');
    }
    public function Profile($id){
        $User = User::where('id',$id)->first();
        return view('profile',compact('User'));
    }
    public function Search(Request $request){
        $Friends = Friend::where('user_id',Auth::user()->id)->get();
        if(count($Friends)>0)
        {
            $tepArr=array();
            foreach($Friends as $item)
            {
                (!in_array($item->friend_id,$tepArr))?array_push($tepArr,$item->friend_id): "";
            }
            (!in_array(Auth::user()->id,$tepArr))?array_push($tepArr,Auth::user()->id): "";
        }
        else
        {
            $tepArr= array(Auth::user()->id);
        }
        $PeopleYouMayKnow = User::whereNotIn('id',$tepArr)->take(4)->get();
        $Posts = Post::where('text','Like', '%'. $request->search .'%')->get();
        $Users = User::where('name','Like','%'. $request->search .'%')->get();
        return view('search',compact('Posts','Users','PeopleYouMayKnow'));
    }
    public function AddPost(Request $request){

        $image_name = '';
        if($request->hasFile('image')){
            $image = $request->file('image');

            $image_name = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads');

            $image->move($destinationPath, $image_name);
        }

        $x = Post::create(array('user_id'=>Auth::user()->id,'text'=>$request->text,'image'=>$image_name));
        return redirect('/');
    }
    public function postLike(Request $request){

        $x = Like::create(array('user_id'=>Auth::user()->id,'post_id'=>$request->post_id));
        return redirect()->back();
    }
    public function postDisLike(Request $request){
        $x = Like::where('user_id',Auth::user()->id)->where('post_id',$request->post_id)->first();
        $x->delete();
        return redirect()->back();
    }
    public function AddFriend(Request $request){
        $x = Friend::create(array('user_id'=>Auth::user()->id,'friend_id'=>$request->friend_id));
        return redirect()->back();
    }
    public function DeleteFriend(Request $request){
        $x = Friend::where('user_id',Auth::user()->id)->where('friend_id',$request->friend_id)->first();
        $x->delete();
        return redirect()->back();
    }
    public function EditProfile($id){
        $User = User::where('id',$id)->first();
        return view('edit_profile',compact('User'));
    }
    public function UpdateProfile(Request $request){
        $rules     = array(
            'password'=>'required',
            'email'=>'required',
            'name'=>'required',
        );
        $messages  = array(
            'password'=>'يجب ادخال كلمة المرور',
            'email'=>'يجب ادخال بريد الكتروني صحيح',
            'name'=>'يجب ادخال اسم شخصي صحيح',
        );
        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        $image_name = Auth::user()->image;
        if($request->hasFile('image')){
            $image = $request->file('image');

            $image_name = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads');

            $image->move($destinationPath, $image_name);
        }
        Auth::user()->update(array(
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'name'=>$request->name,
            'date_of_birth'=>$request->date_of_birth,
            'nationality'=>$request->nationality,
            'information'=>$request->information,
            'image'=>$image_name,
        ));
        return redirect('profile/'.Auth::user()->id);
    }
    public function PostShare(Request $request){
        $post = Post::where('id',$request->post_id)->first();
        $x = Post::create(array('user_id'=>Auth::user()->id,'text'=>$post->text,'image'=>$post->image));
        return redirect()->back();
    }
    public function DeleteAccount($id){
        $likes = Like::where('user_id',$id)->delete();
        $Friends = Friend::where('user_id',$id)->delete();
        $Posts = Post::where('user_id',$id)->delete();
        $User = User::where('id',$id)->delete();
        return redirect('/');
    }
}
