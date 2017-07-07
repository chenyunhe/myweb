请求
http://192.168.8.202/tank-server/public/index.php/api/stat/getlogin?a=1
请求 api/stat/getlogin.php下的getlogin方法
Application/routes.php 
Get请求
Route::get('api/stat/getlogin',array('as'=>'getlogin','uses'=>'api.stat.getlogin@getlogin'));
Post请求
Route::post('api/stat/getlogin',array('as'=>'getlogin','uses'=>'api.stat.getlogin@getlogin'));
