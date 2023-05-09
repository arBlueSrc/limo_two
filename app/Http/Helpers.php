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
