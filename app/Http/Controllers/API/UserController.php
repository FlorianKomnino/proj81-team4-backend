<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $apiToken;
    public function __construct()
    {
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }

    /** 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function login(Request $request)
    {
        //User check
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            //Setting login response 
            $success['user_id'] = $user->id;
            $success['token'] = $this->apiToken;
            $success['name'] =  $user->name;
            $success['surname'] = $user->surname;
            $success['email'] = $user->email;
            $success['subscribed_from'] = Str::of($user->created_at)->limit(4, '');
            return response()->json([
                'status' => 'success',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Unauthorized Access'
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'name' => ['string', 'max:255'],
                'surname' => ['string', 'max:40'],
                'birth_date' => ['date'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,

                // ? un metodo che restituisce un array letterale di errori in cui
                // § la chiave è l'elemento della validazione convalidato
                // # e il valore è l'errore relativo a quell'elemento
                'errors' => $validator->errors(),
            ]);
        }

        $data['password'] = Hash::make($data['password']);
        $newUser = new User();
        $newUser->fill($data);
        $newUser->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::findOrFail($user->id);
        return response()->json([
            'success' => true,
            'results' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
