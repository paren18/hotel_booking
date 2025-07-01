<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller {
    public function index(): JsonResponse {
        $bookings = Booking::with(['client', 'room'])->get();
        return response()->json($bookings);
    }

    public function show($id): JsonResponse {
        $booking = Booking::with(['client', 'room'])->find($id);
        if (!$booking) {
            return response()->json(['error' => 'Бронь не найдена'], 404);
        }
        return response()->json($booking);
    }

    public function store(Request $request): JsonResponse {
        $data = $request->only(['client_id', 'room_id', 'start_date', 'end_date']);

        $validator = Validator::make($data, [
            'client_id' => 'required|exists:clients,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Невозможно создать бронь', 'details' => $validator->errors()], 400);
        }

        $booking = Booking::create($data);
        return response()->json(['message' => 'Бронь успешно создана', 'booking' => $booking], 201);
    }
}
