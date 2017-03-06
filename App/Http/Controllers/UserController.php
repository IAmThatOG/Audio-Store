<?php

    namespace App\Http\Controllers;

    use App\AudioMessage;
    use App\Category;
    use Illuminate\Http\Request;

    use App\Http\Requests;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\File;

    /**
     * Class UserController
     * @package App\Http\Controllers
     */
    class UserController extends Controller
    {
        /**
         * UserController constructor.
         */
        public function __construct()
        {
            //specify the methods under each middleware
            //auth, admin, guest...
            $this->middleware('guest', ['only' => ['getSignIn', 'postSignIn']]);
            $this->middleware('admin', ['only' => ['getDashboard', 'getSignOut']]);
        }

        public function getSignIn()
        {
            //return signin view
            return view('admin.signin');
        }

        public function postSignIn(Request $request)
        {
            //validate the input values of the request variables
            $this->validate($request, [
                'username' => 'required|max:255',
                'password' => 'required|min:4|max:255'
            ]);

            $credentials = ['username' => $request->input('username'), 'password' => $request->input('password')];
            if(Auth::attempt($credentials))
            {
                flash('Login Successful', 'success');
//                redirect()->action('UserController@getDashboard');
                return redirect()->route('admin.dashboard');
            }
            flash('Invalid Credentials Provided', 'danger');
            return back();
        }

        /*public function getDashboard()
        {
            $categories = Category::all();
            return view('admin.dashboard', ['categories' => $categories]);
        }*/

        public function getDashboard()
        {
            $audio_messages = AudioMessage::all();
            $categories = Category::all();
            return view('admin.dashboard', [
                'audio_messages' => $audio_messages,
                'categories' => $categories
            ]);
        }

        public function getSignOut()
        {
            Auth::logout();
            return redirect()->route('store.index');
        }
    }
