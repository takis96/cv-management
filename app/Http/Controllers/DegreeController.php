<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DegreeController extends Controller
{
    public function index()
    {
        try {
            $degrees = Degree::all();
            return response()->json($degrees);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch degrees.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'degreeTitle' => 'required|unique:degrees,degreeTitle',
            ]);

            Degree::create($request->all());

            return response()->json(['message' => 'Degree created successfully'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create degree.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $degree = Degree::findOrFail($id);
            return response()->json($degree);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Degree not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $degree = Degree::findOrFail($id);

            $request->validate([
                'degreeTitle' => 'required|unique:degrees,degreeTitle,' . $degree->id,
            ]);

            $degree->update($request->all());

            return response()->json(['message' => 'Degree updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update degree.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $degree = Degree::findOrFail($id);

            // Check if the degree is used in any candidate record
            $usedInCandidates = Candidate::where('degree', $degree->degreeTitle)->exists();

            if ($usedInCandidates) {
                return response()->json(['message' => 'Cannot delete degree because it is used in candidate records'], 403);
            }

            $degree->delete();

            return response()->json(['message' => 'Degree deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete degree.'], 500);
        }
    }

}
