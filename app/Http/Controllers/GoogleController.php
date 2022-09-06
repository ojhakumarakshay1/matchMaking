<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            // Get user details from Google
            $user = Socialite::driver('google')->stateless()->user();

            // Check if the user is already logged in with Google
            $findUser = User::where('google_id', $user->id)->first();

            if($findUser){
                // If user is already registered, just login
                Auth::login($findUser);
                return redirect()->intended('/home');

            }else{
                // Check if the user is already registered with email
                $newUser = User::where('email', $user->email)->first();
                if($newUser){
                    $newUser->google_id = $user->id;
                }else{
                    $newUser = User::create([
                        'first_name' => $user->offsetGet('given_name') ?? null,
                        'last_name' => $user->offsetGet('family_name') ?? null,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' =>  Hash::make('12345678'),
                        'is_active' => false,
                    ]);
                }
                // Mark email as verified 
                if($user->offsetGet('email_verified') && !isset($newUser->email_verified)){
                    $newUser->email_verified_at = Carbon::now()->toDateTimeString();
                }
                $newUser->save();

                Auth::login($newUser);

                return redirect()->intended('/home');
            }

        } catch (Exception $e) {
            dd($e->getMessage(), $e);
            return redirect('/login')->withErrors('Something went wrong or you have rejected the app!');
        }
    }
}
