<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    /**
     * Melihat semua jadwal dokter
     */
    public function index(): JsonResponse
    {
        $schedules = Schedule::with('doctor')->get()->map(function($schedule) {
            return [
                'id' => $schedule->id,
                'doctor_id' => $schedule->doctor_id,
                'day' => $schedule->day,
                'time_start' => date('H:i', strtotime($schedule->time_start)),
                'time_finish' => date('H:i', strtotime($schedule->time_finish)),
                'quota' => $schedule->quota,
                'status' => true,
                'doctor_name' => $schedule->doctor->doctor_name,
                'date' => $schedule->schedule_date
            ];
        });
        
        return response()->json([
            'message' => 'berhasil',
            'body' => $schedules
        ]);
    }

    /**
     * Membuat jadwal dokter dengan looping by hari
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'day' => 'required|in:monday,senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'time_start' => 'required|date_format:H:i',
            'time_finish' => 'required|date_format:H:i|after:time_start',
            'quota' => 'required|integer|min:1',
            'date_range_start' => 'required|date',
            'date_range_end' => 'required|date|after_or_equal:date_range_start',
        ]);

        // Mapping hari dalam bahasa Indonesia ke angka
        $dayMapping = [
            'monday' => 1,
            'senin' => 1,
            'selasa' => 2,
            'rabu' => 3,
            'kamis' => 4,
            'jumat' => 5,
            'sabtu' => 6,
            'minggu' => 0,
        ];

        $dayNumber = $dayMapping[$request->day];
        // Ambil doctor_id dari database - misalnya doctor pertama
        $doctor = Doctor::first();
        if (!$doctor) {
            return response()->json([
                'message' => 'gagal',
                'body' => 'Tidak ada dokter yang tersedia'
            ], 400);
        }
        
        $doctor_id = $doctor->id;
        $startDate = Carbon::parse($request->date_range_start);
        $endDate = Carbon::parse($request->date_range_end);
        $createdSchedules = [];

        // Looping dari tanggal mulai sampai tanggal selesai
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Hanya buat jadwal pada hari yang sesuai
            if ($date->dayOfWeek == $dayNumber) {
                $schedule = Schedule::create([
                    'doctor_id' => $doctor_id,
                    'day' => $request->day,
                    'time_start' => $request->time_start,
                    'time_finish' => $request->time_finish,
                    'quota' => $request->quota,
                    'status' => true, // Set status selalu true
                    'schedule_date' => $date->format('Y-m-d'),
                ]);

                $createdSchedules[] = [
                    'id' => $schedule->id,
                    'doctor_id' => $schedule->doctor_id,
                    'day' => $schedule->day,
                    'time_start' => date('H:i', strtotime($schedule->time_start)),
                    'time_finish' => date('H:i', strtotime($schedule->time_finish)),
                    'quota' => $schedule->quota,
                    'status' => true, // Selalu tampilkan status true
                    'doctor_name' => $doctor->doctor_name,
                    'date' => $schedule->schedule_date
                ];
            }
        }

        return response()->json([
            'message' => 'berhasil',
            'body' => $createdSchedules
        ], 201);
    }
}
