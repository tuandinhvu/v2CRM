<?php
/**
 * Created by PhpStorm.
 * User: tuandv
 * Date: 12/11/2020
 * Time: 5:29 PM
 */

namespace App\Services;



class RouteService
{
    const __IGRONE  =   ['_debugbar', 'oauth'];
    public function getAll()
    {
        $routes =   \Route::getRoutes();
        $result = [];
        foreach($routes as $k=>$route){
            $ig =   0;
            foreach(RouteService::__IGRONE as $ignore){
//                var_dump((strpos($route->uri, $ignore)));
//                echo $ignore.' - '. $route->uri.'<br/>';
                if(strpos($route->uri, $ignore)!==false){
                    $ig ++;
                }
            }
            if($ig == 0)
                $result[]   =   $route;
        }
        return $result;
    }
}
