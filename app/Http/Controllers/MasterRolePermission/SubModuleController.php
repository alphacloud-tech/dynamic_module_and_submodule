<?php

namespace App\Http\Controllers\MasterRolePermission;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Submodule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['submodules'] = Submodule::with(['module' => function ($query) {
            $query->orderBy('module_rank', 'ASC')->orderBy('module', 'ASC');
        }])
            ->orderBy('rank', 'ASC')
            ->orderBy('submodule', 'ASC')
            ->get();
        $data['modules']    = Module::all();

        // dd($data);
        return view('backend.masterRolePermission.subModule.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'module'        => 'required|string',
            'subModule'     => 'required|regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/|max:1000|unique:submodules,submodule',
            'route'         => 'required|string',
            'rank'         => 'required|string',
        ]);
        $route = ltrim(rtrim($request['route'], "/"),  "/");
        $addSubModule = Submodule::create([
            'moduleid' => $request->input('module'),
            'submodule' => $request->input('subModule'),
            'links' => $route,
            'rank' => $request->input('rank'),
        ]);
        if (!$addSubModule) {
            return redirect()->back()->with('error_message', 'Sorry, we cannot add new submodule. Try again');
        }
        return redirect()->back()->with('message', 'Sub Module added Successfully');
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
            'subModule'     => 'required|regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/|max:1000',
            'module'        => 'required|numeric',
            'submoduleID'   => 'required|numeric',
        ]);

        $submoduleID = $request['submoduleID'];
        $route       = ltrim(rtrim($request['route'], "/"), "/");

        Submodule::where('id', $submoduleID)->update([
            'moduleid' => $request->input('module'),
            'submodule' => $request->input('subModule'),
            'links' => $route,
            'rank' => $request->input('rank'),
        ]);
        return redirect()->back()->with('message', 'Sub Module Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $getUpdateModule = Submodule::where('id', $request->input('submoduleID'));

        $getUpdateModule->delete();

        return redirect()->back()->with('message', 'Sub Module Successfully deleted');
    }
}
