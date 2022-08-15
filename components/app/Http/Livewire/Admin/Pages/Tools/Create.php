<?php

namespace App\Http\Livewire\Admin\Pages\Tools;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\PageCategory;

class Create extends Component
{
    public $slug;
    public $tool_name;
    public $icon_image;
    public $featured_image;
    public $type;
    public $category_id;
    protected $listeners = ['onSetFeaturedImage', 'onSetIconImage'];
    public $tools = [];
    public $categories = [];

    public function mount()
    {
        $this->tools = Storage::disk('local')->get('tools.json');
        $this->categories = PageCategory::orderBy('sort','ASC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.pages.tools.create');
    }

    private function resetInputFields()
    {
        $this->reset(['slug', 'tool_name', 'icon_image', 'featured_image']);
    }

    public function createSlug()
    {
        $this->slug = SlugService::createSlug(Page::class, 'slug', $this->slug);
    }
    
    public function onSetFeaturedImage($value)
    {
        $this->featured_image = $value;
    }

    public function onSetIconImage($value)
    {
        $this->icon_image = $value;
    }

    public function onCreatePage()
    {

        $this->validate([
            'slug'      => 'required|unique:pages',
            'tool_name' => 'required',
        ]);

        try {

            $page                 = new Page;
            $page->slug           = strip_tags($this->slug);
            $page->type           = 'tool';
            $page->icon_image     = strip_tags($this->icon_image);
            $page->featured_image = strip_tags($this->featured_image);
            $page->tool_name      = $this->tool_name;
            $page->category_id    = $this->category_id;
            $page->created_at     = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewPage']);
            $this->resetInputFields();
            $this->emit('sendUpdatePageStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
