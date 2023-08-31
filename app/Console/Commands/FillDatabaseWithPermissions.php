<?php

namespace App\Console\Commands;

use App\Tbuy\User\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class FillDatabaseWithPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected array $users = [
        'oleg@admin.com',
        'ivan@admin.com',
        'vlad@admin.com',
        'aleksander@admin.com',
        'michel@admin.com',
        'gleb@admin.com',
        'tilek@admin.com',
        'jasur@admin.com',
        'backend@admin.com',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $permissionsList = Permission::all();

        foreach (config('permission.list') as $permissions) {
            $permissions = $permissions::cases();

            $permissions = Arr::where($permissions, function ($permission) use ($permissionsList) {
                return $permissionsList->where("name", $permission->value)->count() === 0;
            });

            $date = now()->toDateTimeString();

            Permission::query()->insert(array_map(function ($item) use ($date) {
                return [
                    'name' => $item->value,
                    'guard_name' => 'web',
                    'created_at' => $date,
                    'updated_at' => $date
                ];
            }, $permissions));
        }

        foreach ($this->users as $user) {
            User::query()->firstOrCreate([
                'email' => $user
            ], [
                'name' => 'Admin Adminov',
                'password' => bcrypt('password'),
            ])->permissions()->sync(Permission::all()->pluck('id')->toArray());
        }

        Artisan::call('cache:forget spatie.permission.cache');
    }
}
