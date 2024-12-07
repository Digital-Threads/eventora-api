<?php

namespace Modules\Auth\AuthTrustedDevice\Services;

use Modules\Auth\AuthTrustedDevice\Dto\AuthTrustedDeviceQueryDto;
use Modules\Auth\AuthTrustedDevice\Dto\AuthTrustedDeviceViewDto;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\UserTrustedDevice;

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
