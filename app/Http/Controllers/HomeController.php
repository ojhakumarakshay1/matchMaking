<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Repositories\PartnerPreferenceRepository;

class HomeController extends Controller
{

     /**
     * @var UserRepository
     * @var PartnerPreferenceRepository
     */
    protected $userRepository;
    protected $partnerPreferenceRepository;


    /**
     * HomeController constructor.
     *
     * @param UserRepository $userRepository
     * @param PartnerPreferenceRepository $partnerPreferenceRepository
     */
    public function __construct(UserRepository $userRepository, PartnerPreferenceRepository $partnerPreferenceRepository)
    {
        $this->middleware('auth');
        $this->repository = $userRepository;
        $this->partnerPreferenceRepository = $partnerPreferenceRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Check id the user profile is complete
        $user = Auth::user()->load('preference');
        $preferences = $user->preference;
        if(!$user->is_active){
            return view('update-profile')->with(['user' => $user, 'preference' => $preferences]);
        }else{
            //find the best match

            return view('home');
        }
    }
}
