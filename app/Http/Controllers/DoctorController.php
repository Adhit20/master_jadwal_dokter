<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $doctors = Doctor::all();
        
        return response()->json([
            'success' => true,
            'data' => $doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'doctor_name' => 'required|string|max:255'
        ]);
        
        $doctor = Doctor::create([
            'doctor_name' => $request->doctor_name
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Dokter berhasil ditambahkan',
            'data' => $doctor
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $doctor = Doctor::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $doctor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'doctor_name' => 'required|string|max:255'
        ]);
        
        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'doctor_name' => $request->doctor_name
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Dokter berhasil diperbarui',
            'data' => $doctor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Dokter berhasil dihapus'
        ]);
    }
}
