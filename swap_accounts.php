<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// Find and delete the old James accounts, plus any existing clerk/cashier to avoid duplicates
User::whereIn('Username', ['JamesPogi', 'JamesPogi1', 'clerk', 'cashier'])->delete();

// Create new Clerk user
User::create([
    'FullName' => 'Store Clerk',
    'Username' => 'clerk',
    'Password' => Hash::make('clerk123'),
    'Role' => 'Inventory Clerk',
    'Status' => 'Active',
    'DateAdded' => Carbon::now(),
    'DateModified' => Carbon::now(),
]);

// Create new Cashier user
User::create([
    'FullName' => 'Store Cashier',
    'Username' => 'cashier',
    'Password' => Hash::make('cashier123'),
    'Role' => 'Cashier',
    'Status' => 'Active',
    'DateAdded' => Carbon::now(),
    'DateModified' => Carbon::now(),
]);

echo "Successfully replaced the old accounts with clerk and cashier!\n";
