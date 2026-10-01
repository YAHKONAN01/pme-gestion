<?php

namespace App\Traits;

use App\Models\AuditLog;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            self::logAudit('CREATE', $model, null, $model->getAttributes());
        });

        static::updated(function ($model) {
            self::logAudit('UPDATE', $model, $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function ($model) {
            self::logAudit('DELETE', $model, $model->getOriginal(), null);
        });
    }

    private static function logAudit($action, $model, $oldValues, $newValues)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model' => class_basename($model),
            'model_id' => $model->id ?? null,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'ip_address' => request()->ip(),
        ]);
    }
}