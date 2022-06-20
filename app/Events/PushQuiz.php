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

    public $roomId;
    // public $quest;
    // public $detailQuestion;

    public function __construct($roomId)
    {
        // $this->roomId           = $roomId;
        // $this->quest            = $quest;
        // $this->detailQuestion   = $detailQuestion;
    }

    public function broadcastOn()
    {
        return new Channel('room');
    }

    public function broadcastAs()
    {
        return "room.stream";
    }
}
