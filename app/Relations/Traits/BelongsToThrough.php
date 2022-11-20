<?php

namespace App\Relations\Traits;

use App\Relations\BelongsToThrough as Relationship;

trait BelongsToThrough
{
    public function belongsToThrough($farModel, $closeModel, $localKey = null, $closeKey = null, $farKey = null, $closeLocalKey = null, $localPrimaryKey = null) {
        return new Relationship($this, app($farModel), app($closeModel), $localKey, $closeKey, $farKey, $closeLocalKey, $localPrimaryKey);
        // like.timeline_id -> timeline.post_id -> post.id
    }
}
