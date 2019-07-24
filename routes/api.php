<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('auth/login',['uses' => 'AuthController@userAuthenticate']);
$router->post('auth/register', 'AuthController@register');

$router->post('loans/{user_id}/create-loan', 'LoanController@createLoan');
$router->post('loans/{user_id}/{loan_id}/create-repayment', 'LoanController@createRepayment');

// use middleware jwt.auth to check token
/*$router->group(['middleware' => 'jwt.auth'],
    function() use ($router) {
        $router->post('loans/{user_id}/create-loan', 'LoanController@createLoan');
    }
);*/
