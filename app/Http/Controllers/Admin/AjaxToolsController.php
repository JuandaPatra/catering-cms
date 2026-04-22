<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxToolsController extends Controller
{
    public function ajaxRoles(Request $request)
    {
        if( $request->ajax()) {
            $datas = Role::get();
        }

        return $datas
    }
}
