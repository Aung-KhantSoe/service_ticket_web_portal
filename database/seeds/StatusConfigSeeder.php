<?php

use Illuminate\Database\Seeder;

class StatusConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('status_configs')->insert([
            [
            'status' => 'order',
            'name' => 'Order',
            'status_color' => 'primary',
            ],
            [
            'status' => 'pending',
            'name' => 'Pending',
            'status_color' => 'secondary',
            ],
            [
            'status' => 'running',
            'name' => 'Running',
            'status_color' => 'warning',
            ],
            [
            'status' => 'smooth',
            'name' => 'Smooth',
            'status_color' => 'info',
            ],
            [
            'status' => 'done',
            'name' => 'Done',
            'status_color' => 'success',
            ],
            [
            'status' => 'cancel',
            'name' => 'Cancel',
            'status_color' => 'danger',
            ]
            
    ]);
    }
}
