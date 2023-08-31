<?php

namespace App\Console\Commands;

use App\Jobs\ImportJobs\AttributesImport;
use App\Jobs\ImportJobs\AttributeValueImport;
use App\Jobs\ImportJobs\CategoriesImport;
use App\Jobs\ImportJobs\ProductsImport;
use App\Jobs\ImportJobs\UsersImport;
use App\Tbuy\Attribute\Models\Attribute;
use App\Tbuy\AttributeValue\Models\AttributeValue;
use App\Tbuy\Category\Models\Category;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Product\Models\Product;
use App\Tbuy\User\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class ParseOldDatabase extends Command
{
    const ATTRIBUTE_TABLE = 'nv_main_filtr';
    const ATTRIBUTE_VALUE_TABLE = 'nv_filtres';
    const USERS_TABLE = 'users';
    const CATEGORIES_TABLE = 'nv_catlist';
    const PRODUCTS_TABLE = 'nv_product';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:parse-old';

    protected Connection $connection;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        ini_set('memory_limit', -1);
        parent::__construct();
        $this->connection = DB::connection('mysql_old');
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $users = [
            [
                'email' => 'gendirektor@tbuy.am',
                'name' => "Հովհաննես Խաչատրյան",
                'password' => '1b4fb9e0c4042411f309073815a7da63'
            ],
            [
                'name' => 'Anun Azganun',
                'email' => 'araqummanager@tbuy.am',
                'password' => '5c7a27b5025633ad047a3f76990714b0'
            ],
            [
                'name' => 'Vazgen araqich1',
                'email' => 'araqich1@tbuy.am',
                'password' => '202cb962ac59075b964b07152d234b70'
            ],
            [
                'name' => 'Mrdo araqich3',
                'email' => 'araqich2@tbuy.am',
                'password' => '202cb962ac59075b964b07152d234b70'
            ],
            [
                'name' => 'Mrdo araqich3',
                'email' => 'araqich3@tbuy.am',
                'password' => '202cb962ac59075b964b07152d234b70'
            ],
            [
                'name' => 'Vardkes araqich41',
                'email' => 'araqich4@tbuy.am',
                'password' => '202cb962ac59075b964b07152d234b70'
            ],
            [
                'name' => 'marketolog_tbuy MarkMark',
                'email' => 'mark@mail.ru',
                'password' => '202cb962ac59075b964b07152d234b70'
            ]
        ];

        foreach ($users as $user)
        {
            User::query()->create($user)->permissions()->sync(Permission::all()->pluck('id')->toArray());
        }



        $users = "Hasmik,operator3,a2d3effc1e0e09111c7ffe85e4266a3e
Մարինե,operator1,54621b46c1664db5ba7127d8f22aff00
Irina,operator2,caf1a3dfb505ffed0d024130f58c5cfa
Hripsime,operator4,5a9d0be90228d5d4f664e27139e977e7
Arusik,operator5,148e3ff32f3d162813e8acdc28d7db66
Haykuhi,operator6,cf12d6dfd53f85c67eb1da2f79afb9bf
operator7,operator7,05a5cf06982ba7892ed2a6d38fe832d6
Artificial Intelligence,AI,202cb962ac59075b964b07152d234b70";
        foreach (explode("\n", $users) as $user) {
            $user = explode(',', $user);


            User::query()->create([
                'name' => $user[0],
                'email' => "$user[1]@tuy.am",
                'password' => $user[2]
            ])->permissions()->sync(Permission::all()->pluck('id')->toArray());
        }


        $users = "mdavit
hovik
elen
pargev59
tigran
Hamlet
liraa
liza
levong
narekma7
targmanich
narek
Tigran93
monika";
        foreach (explode("\n", $users) as $user)
        {
            User::query()->create([
                'name' => $user,
                'email' => "$user@tbuy.am",
                'password' => Hash::make("6QakPah2")
            ])->permissions()->sync(Permission::all()->pluck('id')->toArray());
        }


        $this->parseUsers();
        $this->parseCategories();
        $this->parseProducts();
        Artisan::call("db:permissions");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    protected function parseProducts(): void
    {
        Product::query()->truncate();
        dump("Products deleted");

        ProductsImport::dispatch();


    }

    protected function parseCategories(): void
    {
        Category::query()->truncate();
        dump('Categories deleted');
        CategoriesImport::dispatch($this->connection->table(self::CATEGORIES_TABLE)->get());
    }

    protected function parseUsers(): void
    {
        User::query()->truncate();
        Company::query()->truncate();
        dump("Start");
        UsersImport::dispatch();
    }
}
