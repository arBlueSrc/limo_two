<?php
use Illuminate\Support\Facades\Route;
if ( !function_exists('isActive')){
    function isActive($key,$activeClassName='active'){
        if (is_array($key)){
            return in_array(Route::currentRouteName(),$key)?$activeClassName : '';
        }
        return Route::currentRouteName()==$key?$activeClassName : '';
    }
}

if ( !function_exists('isCorrect')){
    function isCorrect($status,$correctClassName='callout-success',$notCorrectClassName='callout-danger'){
        if ($status){
            return $correctClassName;
        }else{
            return $notCorrectClassName;
        }
    }
}

function convertToPersianNumber($str){
    $english = array('0','1','2','3','4','5','6','7','8','9');
    $persian = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');

    $convertedStr = str_replace($english, $persian, $str);
    return $convertedStr;
}


