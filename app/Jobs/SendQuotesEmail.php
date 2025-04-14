<?php

namespace App\Jobs;
use Mail;
use App\Mail\quotesRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendQuotesEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail_list, $buyer;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_list, $buyer)
    {
        $this->mail_list = $mail_list;
        $this->buyer = $buyer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->mail_list as $key => $item) {
            foreach ($item['suppliers'] as $key => $supplier) {
                Mail::to($supplier->email)
                      ->queue(new quotesRequest($supplier->name,$supplier->email,$item->name,$item->quantity,$this->buyer));
            }
        }
    }
}
