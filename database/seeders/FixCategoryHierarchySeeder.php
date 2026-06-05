<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FixCategoryHierarchySeeder extends Seeder
{
    public function run(): void
    {
        // ID 1: set group_type = 'primary', parent_id = null
        Category::where('id', 1)->update(['group_type' => 'primary', 'parent_id' => null]);
        
        // ID 2: set group_type = 'secondary', parent_id = null
        Category::where('id', 2)->update(['group_type' => 'secondary', 'parent_id' => null]);
        
        // ID 3: set group_type = 'luar_bintaro', parent_id = null
        Category::where('id', 3)->update(['group_type' => 'luar_bintaro', 'parent_id' => null]);
        
        // ID 4 s/d 19: set group_type = 'primary', parent_id = 1
        Category::whereBetween('id', [4, 19])->update(['group_type' => 'primary', 'parent_id' => 1]);
        
        // ID 20 ke atas
        $categories = Category::where('id', '>=', 20)->get();
        foreach ($categories as $category) {
            $name = strtolower($category->name);
            if (Str::contains($name, ['bintaro', 'sektor', 'menteng', 'emerald', 'kebayoran', 'discovery'])) {
                $category->update(['group_type' => 'secondary', 'parent_id' => 2]);
            } else {
                $category->update(['group_type' => 'luar_bintaro', 'parent_id' => 3]);
            }
        }
    }
}
