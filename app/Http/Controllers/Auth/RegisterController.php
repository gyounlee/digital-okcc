<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\UserRegistered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Exception;

use App\User;
use App\Http\Services\Log\SystemLog;

class RegisterController extends Controller {
    private $TABLE_NAME = "USERS";
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data) {
        //
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data) {
        //
    }

    /**
     * regist a new user
     */
    public function register(Request $request) {
        $input = $request->all();
        $validator = Validator::make( $input, [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|min:6|max:30',
            'member_id'             => '',
            'privilege_id'          => ''
        ], [
            'name.required'         => 'The user name field can not be blank.',
            'email.required'        => 'The email field can not be blank.',
        ]);
        $input['password'] = Hash::make($request->password);

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $user = User::create($input);
                if ( !empty(\Auth::user()->id) ) { // Don't save a Log if it is first user
                    SystemLog::write(110003, $this->TABLE_NAME . ' [ID] ' . $user->id); 
                }
                $user->notify(new UserRegistered($user));
                return response()->json([ 'user' => $user ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
        }
    }
}
