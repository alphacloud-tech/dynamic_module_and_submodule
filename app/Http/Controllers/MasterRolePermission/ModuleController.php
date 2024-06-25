<?php

namespace App\Http\Controllers\MasterRolePermission;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['modules'] = Module::latest()->get();
        return view('backend.masterRolePermission.module.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'moduleName' => 'required|regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/|max:1000|unique:modules,module',
        ]);

        $addModule = Module::create([
            'module' => $request->input('moduleName'),
            'module_rank' => $request->input('rank'),
        ]);

        if (!$addModule) {
            return redirect()->back()->with('error_message', 'Sorry, error occur during adding new module. Try again');
        }
        return redirect()->back()->with('message', 'Module Created Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'moduleName'        => 'required|regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/|max:1000',
            'moduleID'          => 'required|numeric',
        ]);

        $getUpdateModule        = Module::where('id', $request->input('moduleID'))->update([
            'module' => $request->input('moduleName'),
            'module_rank' => $request->input('rank'),
        ]);

        if ($getUpdateModule) {
            return redirect()->back()->with('message', 'Module Successfully Updated');
        } else {
            return redirect()->back()->with('error_message', 'Sorry, we cannot update this module');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $getUpdateModule = Module::where('id', $request->input('moduleID'));

        $getUpdateModule->delete();

        return redirect()->back()->with('message', 'Module Successfully deleted');
    }
}
