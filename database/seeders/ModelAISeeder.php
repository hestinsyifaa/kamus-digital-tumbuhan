<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelAI;

class ModelAISeeder extends Seeder
{
    public function run(): void
    {
        ModelAI::insert([
            [
                'name' => 'YOLO Leaf Classifier',
                'type' => 'YOLO',
                'file_path' => 'python/best.pt',
                'accuracy' => 92.5,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MNB Text Classifier',
                'type' => 'NLP',
                'file_path' => 'python/model_mnb.pkl',
                'accuracy' => 95.0,
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}