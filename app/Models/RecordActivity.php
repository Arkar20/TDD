<?php

namespace App\Models;

trait RecordActivity
{
    protected static function bootRecordActivity()
    {
        foreach (static::getActivityEvent() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }
    public static function getActivityEvent()
    {
        return ['created'];
    }
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'type' => $this->getAcitvityType($event),
            'user_id' => auth()->id(),
        ]);
    }
    protected function getAcitvityType($event)
    {
        return $event . '_' . (new \ReflectionClass($this))->getShortName();
    }
}
