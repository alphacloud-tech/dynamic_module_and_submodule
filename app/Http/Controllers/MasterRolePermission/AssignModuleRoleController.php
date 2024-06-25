<?php

namespace App\Http\Controllers\MasterRolePermission;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;

class AssignModuleRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['role'] = $request->input('role');

        if ($data['role'] == '') {
            $data['role'] = Session::get('role');
        }

        Session(['role' => $data['role']]);

        $data['roles']         = UserRole::all();

        $data['submodules']    = DB::table('modules')->where('submodules.status', 1)
            ->join('submodules', 'submodules.moduleid', '=', 'modules.id')
            ->selectRaw('submodules.id as modID, modules.id as moduleID, submodules.id, modules.module, submodules.submodule')
            ->orderBy('moduleID')
            ->get();

        foreach ($data['submodules'] as $b) {
            $b->active = (DB::table('assign_role_modules')->where('roleid', $data['role'])->where('submoduleid', $b->modID)->first()) ? 1 : 0;
        }

        return view('backend.masterRolePermission.assignModule.index', $data);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
