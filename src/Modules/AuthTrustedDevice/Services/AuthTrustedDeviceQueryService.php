<?php

namespace Modules\AuthTrustedDevice\Services;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\UserTrustedDevice;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceViewDto;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceQueryDto;

final class AuthTrustedDeviceQueryService
{
    public function query(AuthTrustedDeviceQueryDto $request): CursorPaginator
    {
        return UserTrustedDevice::query()
            ->where('user_id', $request->userId)
            ->cursorPaginate(cursor: $request->cursor);
    }

    public function view(AuthTrustedDeviceViewDto $request): UserTrustedDevice
    {
        return UserTrustedDevice::findOrFail($request->deviceId);
    }
}
