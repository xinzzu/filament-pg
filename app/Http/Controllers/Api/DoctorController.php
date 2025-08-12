<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\ApiResponse;

class DoctorController extends Controller
{
    use ApiResponse;

    /**
     * Get all doctors with pagination.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::with('specialization')->paginate(10);

        return $this->successResponse(
            'doctors retrieved successfully',
            DoctorResource::collection($doctors->items()),
            [
                'current_page' => $doctors->currentPage(),
                'per_page' => $doctors->perPage(),
                'total' => $doctors->total(),
                'last_page' => $doctors->lastPage(),
            ]
        );
    }

    /**
     * Get a single doctor by ID.
     */
    public function show($id)
    {
        $doctor = Doctor::with('specialization')->find($id);

        if (!$doctor) {
            return $this->errorResponse('doctor not found', 404, 404);
        }

        return $this->successResponse(
            'Detail dokter berhasil diambil',
            new DoctorResource($doctor)
        );
    }
}
