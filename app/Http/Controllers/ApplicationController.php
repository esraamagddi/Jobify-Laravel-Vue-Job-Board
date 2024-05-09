<?php

namespace App\Http\Controllers;
use App\Models\Application;

use Illuminate\Http\Request;
use App\Http\Resources\ApplicationResource;
use Illuminate\Support\Facades\Validator;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::all();

        return ApplicationResource::collection($applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|integer',
            // 'job_id' => 'required|integer',
            'resume' => 'required|file|mimes:pdf|max:2048',
            'contact_details' => 'nullable|string',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('resume');
        $path = $file->store('resumes', 'public');

        $application = Application::create([
            'candidate_id' => $request->candidate_id,
            'applicable_id' => $request->job_id,
            'resume' => $path,
            'contact_details' => $request->contact_details,
        ]);

        return new ApplicationResource($application);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
