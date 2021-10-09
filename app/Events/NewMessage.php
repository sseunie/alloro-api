<?php

namespace App\Events;

use App\Models\Incidence;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $incidenceId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($incidenceId)
    {
        $this->incidenceId = $incidenceId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('incidences.user.'. $this->incidenceId);
    }

    public function broadcastAs()
    {
        return 'newMessage';
    }

    public function broadcastWith()
    {
        return [
            "incidence" => Incidence::with('messages')
                ->with('messages.files')
                ->with('files')
                ->with('residence')
                ->with('incidence_area')
                ->where('id', $this->incidenceId)->first()
        ];
    }
}
