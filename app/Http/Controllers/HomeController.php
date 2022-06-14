<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\tache;

class HomeController extends Controller
{

    
    public function redirect(){
       
        if(Auth::id()){
            if(Auth::user()->user_type=='2'){
                return redirect()->route('dashboardBu');
            }elseif(Auth::user()->user_type=='1'){
                return redirect()->route('dashboard');
            }elseif(Auth::user()->user_type=='0'){
                $user = User::find(1);
                return redirect()->route('tacheaujourd');
            }

        }else{
            return redirect()->back();
        }
    }
    
}
