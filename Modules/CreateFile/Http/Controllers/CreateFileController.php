<?php

namespace Modules\CreateFile\Http\Controllers;

use Modules\CreateFile\Http\Requests\CreateFileRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CreateFileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('createfile::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CreateFileRequest $request)
    {

        $fileName = $request->input('editor-filename');
        $fileType = $request->input('editor-filetype');

        $data = [
            'slug' => "$fileName.$fileType",
            'type' => 'document'
        ];
        
        DB::table('htn_stg_file')->insert($data);

        return back();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('createfile::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('createfile::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
