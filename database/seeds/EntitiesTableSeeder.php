<?php

use Illuminate\Database\Seeder;

use App\Entity;

class EntitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Entity::truncate();
        App\NavGroup::truncate();
        
        App\NavGroup::create([
            'name' => 'Admin',
        ]);
        
        App\NavGroup::create([
            'name' => 'Website',
        ]);

        Entity::create([
            'name' => 'Matchday',
            'nav_group_id' => '2',
            'title' => 'Speeldagen',
            'description' => 'Beheer hier de speeldagen',
            'icon' => 'date_range',
        ]);    


        Entity::create([
            'name' => 'Match',
            'nav_group_id' => '2',
            'title' => 'Wedstrijden',
            'description' => 'Beheer hier de wedstrijden',
            'icon' => 'gamepad',
        ]);    
      
    }
}
