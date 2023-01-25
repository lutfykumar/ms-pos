<?php

namespace App\Http\Middleware;

use Closure;
use Modules\Superadmin\Entities\Subscription;

class ModuleMiddleware
{
    public function handle($request, Closure $next, $module)
    {
        $business_id = request()->session()->get('user.business_id');
        $modules = is_array($module)
            ? $module
            : explode('|', $module);

        $otorize = false;
        $data = Subscription::active_subscription($business_id);
        if (!empty($data->module_internal)) {
            $active_module = explode(',', str_replace('"', '', $data->module_internal));
            foreach ($modules as $v) {
                if (in_array($v, $active_module)) {
                    $otorize = true;
                    break;
                }
            }
        }
        if (!$otorize) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
