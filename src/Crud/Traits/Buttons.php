<?php


namespace Tessa\Admin\Crud\Traits;

trait Buttons
{
    public function buttons() {
        return $this->get('buttons', collect());
    }

    public function addButton($button) {
        $button = array_merge([
            'stack' => 'top',
            'view' => 'view',
            'content' => 'crud::buttons.show',
            'position' => 'end'
        ], $button);
        $this->addButtonToSetting($button);

        return $this;
    }

    public function addButtonToSetting($button) {
        $buttons = $this->buttons();
        $buttons->push($button);

        $this->set('buttons', $buttons);
    }
}