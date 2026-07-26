<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;

use App\Models\User;



class SpaAuthController extends Controller

{

    public function register(Request $request)

    {

        $rules = [

            'name'      => ['required','string','max:255'],

            'email'     => ['required','string','email','max:255','unique:users,email'],

            'password'  => ['required','string','min:6'],

            'referrer'  => ['nullable','string','max:50'],

        ];

        if ($request->has('password_confirmation')) {

            $rules['password'][] = 'confirmed';

        }



        $v = $request->validate($rules);



        $user = User::create([

            'name'     => $v['name'],

            'email'    => $v['email'],

            'password' => Hash::make($v['password']),

        ]);



        event(new Registered($user));

        Auth::login($user);

        $request->session()->regenerate();



        return response()->noContent(); // 204

    }



    public function login(Request $request)

    {

        $credentials = $request->validate([

            'email'    => ['required','string','email'],

            'password' => ['required','string'],

        ]);



        if (! Auth::attempt($credentials, true)) {

            return response()->json(['message' => 'Invalid credentials'], 401);

        }



        $request->session()->regenerate();

        return response()->noContent(); // 204

    }



    public function logout(Request $request)

    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent(); // 204

    }

}

