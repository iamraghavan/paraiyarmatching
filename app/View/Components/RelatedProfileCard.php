<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RelatedProfileCard extends Component
{
    public $profile;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $profile
     * @return void
     */
    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.related-profile-card');
    }
}