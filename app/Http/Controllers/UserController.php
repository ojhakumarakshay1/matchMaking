<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Repositories\PartnerPreferenceRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     * @var PartnerPreferenceRepository
     */
    protected $repository;
    protected $partnerPreferenceRepository;


    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param PartnerPreferenceRepository $partnerPreferenceRepository
     */
    public function __construct(
        UserRepository $repository,
        PartnerPreferenceRepository $partnerPreferenceRepository
    ) {
        $this->repository = $repository;
        $this->partnerPreferenceRepository = $partnerPreferenceRepository;
    }

    /**
     * Show the user profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->load('preference');
        return view('update-profile')->with(['user' => $user, 'preference' => $user->preference]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserProfileUpdaterequest $request)
    {
        try {
            $input = $request->all();
            $input['user_id'] = Auth::user()->id;
            $input['is_active'] = true;
            $input['dob'] = Carbon::createFromFormat('d/m/Y', $input['dob'])->toDateTimeString();
            $input['is_manglik'] = ($input['is_manglik'] == "yes");

            // Update in User
            $user = $this->repository->update($input, $input['user_id']);

            // Create data for Partner Preference
            $partnerInput = [
                'user_id' => $input['user_id'],
                'prefered_occupation' => implode(',', $input['prefered_occupation']),
                'prefered_annual_amount' => $input['prefered_annual_amount'],
                'prefered_family_type' => implode(',', $input['prefered_family_type']),
                'prefered_manglik' => $input['prefered_manglik'],
            ];

            $partner = $this->partnerPreferenceRepository->findByField('user_id', $input['user_id'])->first();
            if (!$partner) {
                $partner = $this->partnerPreferenceRepository->create($partnerInput);
            } else {
                $partner = $this->partnerPreferenceRepository->update($partnerInput, $partner->id);
            }

            $response = [
                'message' => 'Profile updated successfully.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect('home')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
