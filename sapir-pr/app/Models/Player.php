<?php


namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Player extends Model
{
   
    public static function vaderus(){       
        include 'PlayerData.php';        
        $vaderus = new \stdClass();
        $vaderus->name=$name;
        $vaderus->value=[];
        $length=count($name);
        for ($i=0; $i <$length ; $i++) { 
            $prop=rand($minValueVaderus[$i],$maxValueVaderus[$i]);
            array_push($vaderus->value, $prop);
        }
        // $vaderus->maxValue=$maxValueVaderus;
        // $vaderus->minValue=$minValueVaderus;
        // dd($vaderus->name);
        // echo $vaderus->name;
        return $vaderus;
    }

    public static function beast(){       
        include 'PlayerData.php';        
        $beast = new \stdClass(); 
        $beast->value=[];
        $length=count($name);
        for ($i=0; $i <$length ; $i++) { 
            $prop=rand($minValueBeast[$i],$maxValueBeast[$i]);
            array_push($beast->value, $prop);
        }       
        // $beast->maxValue=$maxValueBeast;
        // $beast->minValue=$minValueBeast;
        // dd($vaderus->name);
        // echo $vaderus->name;
        return $beast;
    }
    
    public static function battle($attacking,$valVad,$valBeast){       
        include 'PlayerData.php';        
        $result = new \stdClass();
        $result->name=$name; 
        $result->skill='';
        $randum=rand(1,100);
        $randumSkill=rand(1,100); 
        if ($attacking == 'Vaderus') {                      
            if ($randum>$valBeast[4]){
                $damage=$valVad[1]-$valBeast[2];
                $valBeast[0]=$valBeast[0]-$damage;
                $result->health=$valBeast[0];
            } else {
                $damage=0;
                $result->health=$valBeast[0];
            }

            if ($randumSkill<11) {
                $valBeast[0]=$valBeast[0]-$damage;
                $damage=$damage*2;
                $result->health=$valBeast[0];
                $result->skill='Rapid strike';
            }    
        } else {
            if ($randum>$valVad[4]){
                $damage=$valBeast[1]-$valVad[2];
                $valVad[0]=$valVad[0]-$damage;
                $result->health=$valVad[0];
            } else {
                $damage=0;
                $result->health=$valVad[0];
            }
            if ($randumSkill<21) {
                if ($damage>0) {
                    $damage=$damage/2;
                    $valVad[0]=$valVad[0]+$damage;                    
                    $result->health=$valVad[0];
                }
                
                $result->skill='Magic shield';
            }    
            
        }
        $result->vaderus=$valVad;
        $result->beast=$valBeast;
        $result->damage=$damage;       
        
        // dd($result);
        
        return $result;
    }
}
