<?php

namespace Cbouvat\Envol\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisan;
use Mail;
use Exception;
 
class EnvolController extends Controller
{
 
    public function hook(Request $request)
    {
        // Input key
        $key = $request->input('key');

        // Check key
        if (config('envol.key') !== $key) {
            return response()
                ->json(['error' => 'This key is not allowed'], 403);
        }

        // Log
        $log = '';

        // Maintenance mode (down)
        try {
            $exitCode = Artisan::call('down');
        } catch (Exception $e) {
            //
        }

        // App base directory
        $appPath = base_path() . '/';

        // Git Reset hard
        $log .= shell_exec('git --git-dir=' . $appPath . '.git --work-tree=' . $appPath . ' reset --hard');

        // Git pull
        $log .= shell_exec('git --git-dir=' . $appPath . '.git --work-tree=' . $appPath . ' pull '. config('envol.remote') .' '. config('envol.branch'));

        // Composer
        $log .= shell_exec('composer install --no-suggest --no-dev --working-dir "' . $appPath . '"');

        // Cache clear
        try {
            $exitCode = Artisan::call('cache:clear');
        } catch (Exception $e) {
            $log .= $exitCode;
        }

        // Config cache
        try {
            $exitCode = Artisan::call('config:cache');
        } catch (Exception $e) {
            $log .= $exitCode;
        }

        // Route caching
        try {
            $exitCode = Artisan::call('route:cache');
        } catch (Exception $e) {
            $log .= $exitCode;
        }

        // Migration
        try {
            $exitCode = Artisan::call('migrate', [
                '--force' => true,
            ]);
        } catch (Exception $e) {
            $log .= $exitCode;
        }

        // Maintenance up
        try {
            $exitCode = Artisan::call('up');
        } catch (Exception $e) {
            $log .= $exitCode;
        }

        // If notification mail if define
        if (!empty(config('envol.mail'))) {
            $textMail = 'App deploy success';
            $textMail .= $log;

            // Send mail
            Mail::raw($textMail, function ($message) {
                $message->from(config('mail.from.address'));
                $message->to(config('envol.mail'));
                $message->subject('App deploy');
            });
        }

        return ['success' => 'App deploy'];
    }
}
