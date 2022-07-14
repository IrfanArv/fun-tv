<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class listenPlayers implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $getPlayer;
    public $count;
    public function __construct($getPlayer, $count)
    {
        $this->getPlayer         = $getPlayer;
        $this->count             = $count;
    }


    public function broadcastOn()
    {
        return new Channel('online-players');
    }
}
