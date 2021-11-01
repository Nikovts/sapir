<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Player;

class BattleController extends Controller
{

    
    public function load()
    {
        $finish=false;
        $vaderus = Player::vaderus();
        $beast = Player::beast();
        return view('welcome', ['finish'=>$finish, 'properties' => $vaderus->name,'valueVaderus' => $vaderus->value,'valueBeast' => $beast->value, 'attack'=> 0]);
    
    }

    public function start(Request $request)
    {
        $finish=false;
        $valVad=$request->all()['valVad'];
        $valBeast=$request->all()['valBeast'];
        if ($valVad[3]>$valBeast[3]) {
            $attacking='Vaderus';
        } elseif ($valVad[3]<$valBeast[3]){
            $attacking='Beast';
        } else {
            if ($valVad[4]>$valBeast[4]) {
                $attacking='Vaderus';
            } else {
                $attacking='Beast';
            }           
        }
        $attack=$request->all()['attack']+1;
        $result = Player::battle($attacking,$valVad,$valBeast);
        // dd($result);
        return view('welcome', ['finish'=>$finish, 'properties' => $result->name,'valueVaderus' => $result->vaderus,'valueBeast' => $result->beast, 'damage'=>$result->damage, 'attacking'=>$attacking, 'health'=> $result->health, 'attack'=> $attack, 'skill'=>$result->skill]);
    
    }

    public function continue(Request $request)
    {
        $finish=false;
        $valVad=$request->all()['valVad'];
        $valBeast=$request->all()['valBeast'];
        $attack=$request->all()['attack']+1;
        $attacking=$request->all()['attacking'];
        if ( $attacking=='Vaderus') {
            $attacking ='Beast';
        } else {
            $attacking ='Vaderus';
        }
        

        $result = Player::battle($attacking,$valVad,$valBeast);
        if ($result->health<=0) {
           $finish=true;           
        }        

        return view('welcome', ['finish'=>$finish, 'properties' => $result->name,'valueVaderus' => $result->vaderus,'valueBeast' => $result->beast, 'damage'=>$result->damage, 'attacking'=>$attacking, 'health'=> $result->health, 'attack'=> $attack, 'skill'=>$result->skill]);
    
    }
}