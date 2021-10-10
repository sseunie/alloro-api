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

    public $incidence;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Incidence $incidence)
    {
        $this->incidence = $incidence;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('incidences.user.'. $this->incidence->user_id);
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
                ->where('id', $this->incidence->id)->first()
        ];
    }
}
