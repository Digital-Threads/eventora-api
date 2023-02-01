<?php

namespace Modules\AuthTrustedDevice\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\UserTrustedDevice;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceCreateDto;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceDeleteDto;

final class AuthTrustedDeviceCommandService
{
    public function create(AuthTrustedDeviceCreateDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $device = UserTrustedDevice::updateOrCreate([
                'user_id' => $request->userId,
                'ip' => $request->ip,
                'user_agent' => $request->userAgent,
            ], [
                'valid_to' => now()->addMonth(),
            ]);

            if ($device->wasRecentlyCreated) {
                Event::dispatch('auth_trusted_device.created', [$device->id]);
            } else {
                Event::dispatch('auth_trusted_device.prolonged', [$device->id]);
            }
        });
    }

    public function delete(AuthTrustedDeviceDeleteDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $device = UserTrustedDevice::findOrFail($request->deviceId);
            $device->delete();

            Event::dispatch('auth_trusted_device.deleted', [$request->deviceId]);
        });
    }
}
