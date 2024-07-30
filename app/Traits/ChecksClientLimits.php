<?php

namespace App\Traits;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;

trait ChecksClientLimits
{
    /**
     * Check if the authenticated user has reached their client limit.
     *
     * @return bool
     */
    public function checkClientLimit(): bool
    {
        $user = Auth::user();
        
        if (!$user || !$user->plan) {
            return false;
        }

        $currentClientCount = $user->clients()->count();
        $planLimit = $user->plan->client_limit;

        return $currentClientCount < $planLimit;
    }

    /**
     * Get the number of remaining client slots for the authenticated user.
     *
     * @return int
     */
    public function getRemainingClientSlots(): int
    {
        $user = Auth::user();
        
        if (!$user || !$user->plan) {
            return 0;
        }

        $currentClientCount = $user->clients()->count();
        $planLimit = $user->plan->client_limit;

        return max(0, $planLimit - $currentClientCount);
    }

    /**
     * Check if the user can add a specific number of clients.
     *
     * @param int $numberOfClients
     * @return bool
     */
    public function canAddClients(int $numberOfClients): bool
    {
        return $this->getRemainingClientSlots() >= $numberOfClients;
    }
}