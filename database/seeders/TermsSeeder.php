<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Terms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var User $user */
        $user = User::where('email', '=', 'demo@server.com')->first();

        Terms::factory(2)->create()->each(function (Terms $model, $index) use ($user) {
            if ($index === 0) {
                // user accepted previous terms and conditions
                $model->update(['required_from' => now()->subMonth(1)]);
                $user->terms()->save($model);
            } else {
                // but since then there is new version
                $model->update(['required_from' => now()->subDay(1)]);
            }
        });
    }
}
