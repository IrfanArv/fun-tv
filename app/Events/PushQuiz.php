<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushQuiz implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $quest;
    public $detailQuestion;

    public function __construct($quest,$detailQuestion)
    {
        $this->quest            = $quest;
        $this->detailQuestion   = $detailQuestion;
    }

    public function broadcastOn()
    {
        return new Channel('quiz');
    }

}
