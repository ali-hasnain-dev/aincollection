<?php

namespace App\Livewire\Web\Pages;

use Livewire\Component;
use App\Models\Category as ProductCategory;
use App\Models\Product;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    public $cateslug, $category;

    public function mount()
    {
        $this->category = ProductCategory::where('slug', $this->cateslug)->first();
    }

    public function render()
    {
        $products = Product::with('category')->where('category_id', $this->category->id)->paginate(10);
        return view('livewire.web.pages.category', get_defined_vars());
    }
}
