<?php

namespace Envatic\Chat\Models;

use Envatic\Chat\BaseModel;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Envatic\Chat\ConfigurationManager;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participation extends BaseModel
{
//    use SoftDeletes;

    protected $table = ConfigurationManager::PARTICIPATION_TABLE;
    protected $fillable = [
        'conversation_id',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Conversation.
     *
     * @return BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function messageable()
    {
        return $this->morphTo()->with('participation');
    }
}
