<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\File as Files;
use Response;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Http\Resources\FileCollection;
use App\Http\Resources\FileResource;
use Carbon\Carbon;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::all();
        return new FileCollection($files);
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
     * @param  \App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $fileName = Carbon::now()->timestamp.'.'.$request->file->extension();

        $request->file->move(public_path('files'), $file);
        
        $file = File::create([
            'title' => $request->title,
            'file' => $fileName,
          
        ]);
        return (new FileResource($file))->additional([
            'status' => 201
        ]);
    }
    public function getFile($filename) {
  
        $file = public_path('files/' . $filename);
        return response()->download($file);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return new FileResource($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFileRequest  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        $fileName = $file->file;
        if($request->file) {
        $fileName = Carbon::now()->timestamp.'.'.$request->file->extension();

        $request->file->move(public_path('files'), $file);
        
        }
        $file->update([
            'title' => $request->title,
            'file' => $fileName,
          
        ]);
        return response()->json(['status' => 201]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();
        return response()->json(['status' => 201]);

    }
}
