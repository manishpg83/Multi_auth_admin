<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTracking;
use Illuminate\Support\Facades\Log;

class EmailTrackingController extends Controller
{
    public function track($id)
    {
        Log::info('Tracking request received for ID: ' . $id);  // Add this line for debugging

        $tracking = EmailTracking::where('tracking_id', $id)->first();
        if ($tracking && !$tracking->opened) {
            $tracking->update([
                'opened' => true,
                'opened_at' => now(),
            ]);
            Log::info('Email marked as opened: ' . $id);  // Add this line for debugging
        }

        return response()->file(public_path('tracking-pixel.png'));
    }
}