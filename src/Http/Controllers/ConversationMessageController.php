<?php

namespace Envatic\Chat\Http\Controllers;

use Chat;
use Envatic\Chat\Http\Requests\ClearConversation;
use Envatic\Chat\Http\Requests\DeleteMessage;
use Envatic\Chat\Http\Requests\GetParticipantMessages;
use Envatic\Chat\Http\Requests\StoreMessage;

class ConversationMessageController extends Controller
{
    protected $messageTransformer;

    public function __construct()
    {
        $this->setUp();
    }

    private function setUp()
    {
        if ($messageTransformer = config('envatic_chat.transformers.message')) {
            $this->messageTransformer = app($messageTransformer);
        }
    }

    private function itemResponse($message)
    {
        if ($this->messageTransformer) {
            return fractal($message, $this->messageTransformer)->respond();
        }

        return response($message);
    }

    public function index(GetParticipantMessages $request, $conversationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        $message = Chat::conversation($conversation)
            ->setParticipant($request->getParticipant())
            ->setPaginationParams($request->getPaginationParams())
            ->getMessages();

        if ($this->messageTransformer) {
            return fractal($message, $this->messageTransformer)->respond();
        }

        return response($message);
    }

    public function show(GetParticipantMessages $request, $conversationId, $messageId)
    {
        $message = Chat::messages()->getById($messageId);

        return $this->itemResponse($message);
    }

    public function store(StoreMessage $request, $conversationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        $message = Chat::message($request->getMessageBody())
            ->from($request->getParticipant())
            ->to($conversation)
            ->send();

        return $this->itemResponse($message);
    }

    public function deleteAll(ClearConversation $request, $conversationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        Chat::conversation($conversation)
            ->setParticipant($request->getParticipant())
            ->clear();

        return response('');
    }

    public function destroy(DeleteMessage $request, $conversationId, $messageId)
    {
        $message = Chat::messages()->getById($messageId);
        Chat::message($message)
            ->setParticipant($request->getParticipant())
            ->delete();

        return response('');
    }
}
