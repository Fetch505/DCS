<?php

use Illuminate\Database\Seeder;

class MethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $methods = [
            [
                'title' => 'How to Tie Your Shoes',
                'description' => 'This video will show you how to tie your shoes.',
                'video_url' => 'https://www.youtube.com/watch?v=-7n5vt49e0g',
            ],
            [
                'title'  => 'How to Make a Paper Airplane',
                'description' => 'This video will show you how to make a paper airplane.',
                'video_url' => 'https://www.youtube.com/watch?v=9-s7u-0-57o',
            ],
            [
                'title' => 'How to Solve a Rubik\'s Cube',
                'description' => 'This video will show you how to solve a Rubik\'s Cube.',
                'video_url' => 'https://www.youtube.com/watch?v=7pUbt6X3q0o',
            ],
        ];

        foreach ($methods as $method) {
            \App\Methods::create($method);
        }
    }
}
