<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\ApiKeys as ApiKey;

class ApiKeys extends Component
{

    public $facebook_cookies;

    public function mount()
    {
        $api_key                                 = ApiKey::findOrFail(1);
        $this->facebook_cookies                  = $api_key->facebook_cookies;
    }

    public function render()
    {
        return view('livewire.admin.settings.api-keys');
    }


    public function onUpdateAPIKeys()
    {
        try {

            $api_key                                    = ApiKey::findOrFail(1);
            $api_key->facebook_cookies                  = $this->facebook_cookies;
            $api_key->updated_at                        = new DateTime();
            $api_key->save();
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
