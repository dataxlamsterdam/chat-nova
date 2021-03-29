<?php

return [
    'messages_table' => 'messages',

    'recipients_table' => 'users',

    'recipients_model' => \Dataxl\NovaChat\Models\RecipientModel::class,

    'messages_model' => \Dataxl\NovaChat\Models\MessageModel::class,

    'realtime' => false,
];
