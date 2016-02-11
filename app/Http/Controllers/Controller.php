<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function pageSetting($data)
    {

        if($data['menu_id'] && $data['menu_group_id']) {
            if(!menu_access($data['menu_id'],$data['menu_group_id']))
                abort(404);
        }

        view()->share('page_setting', $data);
    }

}
