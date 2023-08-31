<?php

namespace App\Jobs\ImportJobs;

use App\Tbuy\Company\Enums\CompanyStatus;
use App\Tbuy\Company\Enums\CompanyType;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const USERS_TABLE = 'users';


    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connection = DB::connection('mysql_old');
        $created_at = now();

        $connection->table(self::USERS_TABLE)->where('email', 'like', "%@%")->orderBy('id', 'desc')->chunk(1000, function ($usersOld) use ($created_at) {
            dump("DAta got");
            $users = [];

            foreach ($usersOld as $user) {

                $name = $user->fname . ' ' . $user->lname;
                $users[] = [
                    'id' => $user->id,
                    'name' => $name,
                    'email' => $user->email,
                    'email_verified_at' => $created_at,
                    'password' => $user->pass,
                    'balance' => 0,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ];
            }

            dump("INSERT users:" . sizeof($users));

            try {
                User::query()->insert($users);
                dump("Insert OK");
            } catch (\Exception $exception) {
                dump($exception->getMessage());
            }
        });

        $userId = User::query()->count() + 1;

        $connection->table('matakarar')->where('email', 'like', "%@%")->orderBy('id', 'desc')->chunk(1000, function ($usersOld) use ($created_at, &$userId) {
            dump("DAta got");

            $users = [];
            $companies = [];

            foreach ($usersOld as $user) {

                $name = $user->fname . ' ' . $user->lname;
                $slug = $name . '-id-' .  $userId;

                if (!User::query()->where('email', $user->email)->exists())
                {
                    $users[] = [
                        'id' => $userId,
                        'name' => $name,
                        'email' => $user->email,
                        'email_verified_at' => $created_at,
                        'password' => $user->pass,
                        'balance' => $user->wallet,
                        'created_at' => $created_at,
                        'updated_at' => $created_at,
                    ];
                }


                $companies[] = [
                    'name' => json_encode([
                        'ru' => $user->zap,
                        'en' => $user->zap,
                        'hy' => $user->zap,
                    ]),
                    'legal_name_company' => $user->zap,
                    'type' => CompanyType::SALES->value,
                    'inn' => $user->av1,
                    'company_address' => $user->adres,
                    'director' => json_encode([
                        'first_name' => $user->fname,
                        'last_name' => $user->lname
                    ]),
                    'phones' => json_encode([
                        'phone_director' => $user->phone
                    ]),
                    'email' => $user->zip,
                    'registered_at' => $created_at,
                    'slug' => $slug,
                    'status' => CompanyStatus::ACTIVE->value,
                    'legal_entity' => true,
                    'user_id' => $userId++,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                    'balance' => $user->wallet,
                ];

            }

            dump("INSERT users:" . sizeof($users) . ", companies: " . sizeof($companies));

            try {
                User::query()->insert($users);
                Company::query()->insert($companies);
                dump("Insert OK");
            } catch (\Exception $exception) {
                dump($exception->getMessage());
            }
        });
    }
}
