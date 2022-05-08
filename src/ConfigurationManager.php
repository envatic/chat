<?php

namespace Envatic\Chat;

class ConfigurationManager
{
    public const CONVERSATIONS_TABLE = 'chat_conversations';
    public const MESSAGES_TABLE = 'chat_messages';
    public const MESSAGE_NOTIFICATIONS_TABLE = 'chat_message_notifications';
    public const PARTICIPATION_TABLE = 'chat_participation';

    public static function paginationDefaultParameters()
    {
        $pagination = config('envatic_chat.pagination', []);

        return [
            'page' => $pagination['page'] ?? 1,
            'perPage' => $pagination['perPage'] ?? 25,
            'sorting' => $pagination['sorting'] ?? 'asc',
            'columns' => $pagination['columns'] ?? ['*'],
            'pageName' => $pagination['pageName'] ?? 'page',
        ];
    }
}
