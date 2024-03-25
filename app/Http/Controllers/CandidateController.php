<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->has('jobAppliedFor')) {
                $jobAppliedFor = $request->input('jobAppliedFor');
                $candidates = Candidate::where('jobAppliedFor', 'like', '%'.$jobAppliedFor.'%')->get();
                //$candidates = Candidate::where('jobAppliedFor', $jobAppliedFor)->get();
            } else {
                $candidates = Candidate::all();
            }

            return response()->json($candidates);
        } catch (\Exception $e) {
            // Return a generic error response
            return response()->json(['error' => 'Failed to fetch candidates.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'lastName' => 'required',
                'firstName' => 'required',
                'email' => 'required|email|unique:candidates,email',
                'mobile' => 'nullable|digits:10',
                'degree' => 'required',
                'resume' => 'required|file|mimes:pdf',
                'jobAppliedFor' => 'required|array|min:1',
                'jobAppliedFor.*' => 'required|in:PHP Developer,JAVA Developer,PYTHON Developer,ERP Support,Sales,Technician',
            ]);

            $candidate = new Candidate();
            $candidate->lastName = $request->lastName;
            $candidate->firstName = $request->firstName;
            $candidate->email = $request->email;
            $candidate->mobile = $request->mobile;
            $candidate->degree = $request->degree;
            $candidate->resume = $request->file('resume')->store('resumes');
            $candidate->jobAppliedFor = implode(',', $request->jobAppliedFor);
            $candidate->save();

            return response()->json(['message' => 'Candidate created successfully'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create candidate.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $candidate = Candidate::findOrFail($id);
            return response()->json($candidate);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Candidate not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $candidate = Candidate::findOrFail($id);

            $request->validate([
                'lastName' => 'required',
                'firstName' => 'required',
                'email' => 'required|email|unique:candidates,email,' . $candidate->id,
                'mobile' => 'nullable|digits:10',
                'degree' => 'required',
                'jobAppliedFor' => 'required|array|min:1',
                'jobAppliedFor.*' => 'required|in:PHP Developer,JAVA Developer,PYTHON Developer,ERP Support,Sales,Technician',
            ]);

            $candidate->update($request->all());

            return response()->json(['message' => 'Candidate updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update candidate.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $candidate = Candidate::findOrFail($id);
            $candidate->delete();

            return response()->json(['message' => 'Candidate deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete candidate.'], 500);
        }
    }
}



