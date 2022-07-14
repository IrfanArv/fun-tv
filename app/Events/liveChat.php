<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class liveChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $playerId;
    public $playerImage;
    public $conversations;
    public $sendTime;

    public function __construct($playerId, $playerImage, $conversations, $sendTime)
    {
        $this->playerId         = $playerId;
        $this->playerImage      = $playerImage;
        $this->conversations    = $conversations;
        $this->sendTime         = $sendTime;
    }

    public function broadcastOn()
    {
        return new Channel('conversations');
    }
}
