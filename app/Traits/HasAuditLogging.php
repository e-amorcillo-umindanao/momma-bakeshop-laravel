<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

trait HasAuditLogging
{
    /**
     * Log an audit trail entry.
     */
    private function logAudit($tableEdited, $action, $previousChanges, $savedChanges)
    {
        Audit::create([
            'UserID' => Auth::id(),
            'TableEdited' => $tableEdited,
            'PreviousChanges' => $previousChanges ? json_encode($previousChanges) : null,
            'SavedChanges' => $savedChanges ? json_encode($savedChanges) : null,
            'Action' => $action,
            'DateAdded' => now(),
        ]);
    }
}
