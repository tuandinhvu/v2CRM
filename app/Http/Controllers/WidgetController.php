<?php

namespace App\Http\Controllers;

use App\Http\Requests\WidgetRequest;
use App\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function getIndex()
    {
        $data['leftside']   =   Widget::orderBy('order','ASC')->where('position','leftside')->get();
        $data['mainside']   =   Widget::orderBy('order','ASC')->where('position','mainside')->get();
        return v('widget.index', compact('data'));
    }

    public function postAdd(WidgetRequest $request)
    {
        $data   =   new Widget();
        $data->source   =   $request->input('source');
        $data->name     =   $request->input('name');
        $data->order    =   $request->input('order');
        $data->position =   $request->input('position');
        $data->save();
        set_notice(trans('widgets.addsuccess'), 'success');
        return redirect()->back();
    }

    public function postEdit(WidgetRequest $request)
    {
        $data   =   Widget::find(request('id'));
        if(!empty($data)){
            $data->source   =   $request->input('source');
            $data->name     =   $request->input('name');
            $data->order    =   $request->input('order');
            $data->position =   $request->input('position');
            $data->save();
            set_notice(trans('widgets.editsuccess'), 'success');
        }
        return redirect()->back();
    }
    public function getDelete()
    {
        $data   =   Widget::find(request('id'));
        if(!empty($data)){
            $data->delete();
            set_notice(trans('widgets.deletesuccess'), 'success');
        }
        return redirect()->back();
    }
}
