<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ControllerUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class User_controllerInfo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        
        $user=User::find(auth()->user()->id);
        return view('USER.profile',compact('user'));

   
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find(auth()->User()->id);
        return view('User.profile',compact('user'));
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
        $user=User::find(auth()->User()->id);
        $user->update($request->all());
        return redirect()->route('profile')->with([
            'success'=>'Utilisateur modifier avec succès'
        ]);
    }


    public function editPassword(Request $request )
    {
        //

        $request->validate([
            'oldpassword'=>'required|min:8',
            'password'=>'required|min:8|confirmed',
        ]);
        $id=auth()->user()->id;
        $user=User::find($id);

        $hashedPassword=$user->password;

        if(Hash::check($request->oldpassword, $hashedPassword)){

                $user->password=Hash::make($request->password);
                $user->save();
                
                //toast('Votre Modification  a été bien enregistré!','success');
                return redirect()->back();

        }else{
            //toast('incorrecte mot de passe','warning');
            return redirect()->back();
        }

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
