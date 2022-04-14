<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    $serverName = "PC2020-103\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"Northwind", "UID"=>"danmer", "PWD"=>"123456");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     //die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT * FROM Categories";
$res = sqlsrv_query($conn,$sql);
dd(sqlsrv_fetch_array($res));

$dsn = "sqlsrv:Server=PC2020-103\SQLEXPRESS,1433;Database=Northwind";

dd(new PDO($dsn, "danmer", "123456", [0,2,0,false]));
dd(\DB::connection()->getPdo());
    return view('welcome');
});


Route::get('/', function () {
    return view('welcome');
});
