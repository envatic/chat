<?php

namespace Envatic\Chat\Commanding;

interface CommandHandler
{
    public function handle($command);
}
