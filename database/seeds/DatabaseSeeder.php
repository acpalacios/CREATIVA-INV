<?php

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
//        $account = Account::create(['name' => 'CREATIVA']);

//        factory(User::class)->create([
//            'account_id' => 1,
//            'first_name' => 'Katherine',
//            'last_name' => 'Quintanilla',
//            'email' => 'abigail@gmail.com',
//            'owner' => true,
//        ]);
//
//        factory(User::class, 5)->create(['account_id' => 1]);
//
//        $organizations = factory(Organization::class, 100)
//            ->create(['account_id' => $account->id]);
//
//        factory(Contact::class, 100)
//            ->create(['account_id' => $account->id])
//            ->each(function ($contact) use ($organizations) {
//                $contact->update(['organization_id' => $organizations->random()->id]);
//            });
    }
}
