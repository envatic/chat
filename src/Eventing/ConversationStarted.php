<?php

namespace Envatic\Chat\Eventing;

use Envatic\Chat\Models\Conversation;

class ConversationStarted extends Event
{
    /**
     * @var Conversation
     */
    public $conversation;

    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }
}
