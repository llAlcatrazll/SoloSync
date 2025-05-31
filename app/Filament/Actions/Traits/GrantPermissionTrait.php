<?php

namespace App\Filament\Actions\Traits;

use App\Enums\Permissions;
use App\Models\Members;

trait GrantPermissionTrait
{
    protected function setUp(): void
    {

        parent::setUp();

        $this->name ??= 'accept';

        $this->color('success');

        $this->visible(function (Members $record) {
            return $record->status != Permissions::OnLeave;
        });

        // $this->icon(Permissions::OnLeave->getIcon());

        $this->action(function ($record, $action) {
            $record->update([
                'status' => Permissions::OnLeave,
            ]);
        });

        $this->requiresConfirmation();

        $this->successNotificationTitle('Request Accepted');
    }
}
