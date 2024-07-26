<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTask;
use App\Mail\FestivalNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendFestivalEmails extends Command
{
    protected $signature = 'emails:send-festivals';
    protected $description = 'Send emails for scheduled festivals';

    public function handle()
    {
        Log::info('SendFestivalEmails command started at ' . now());

        $emailTasks = EmailTask::where('status', 'pending')
            ->get();

        Log::info('Found ' . $emailTasks->count() . ' email tasks to process');

        foreach ($emailTasks as $task) {
            try {
                Mail::to($task->client->email)->send(new FestivalNotification($task->festival));
                $task->update(['status' => 'sent']);
                Log::info('Email sent to ' . $task->client->email . ' for festival ' . $task->festival->name);
            } catch (\Exception $e) {
                $task->update(['status' => 'failed']);
                Log::error('Failed to send email to ' . $task->client->email . ': ' . $e->getMessage());
            }
        }

        Log::info('SendFestivalEmails command completed at ' . now());
    }
}