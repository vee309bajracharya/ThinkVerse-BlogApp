<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\ParentCategory;
use App\Models\Category;

class Categories extends Component
{
    public $isUpdateParentCategoryMode = false;
    public $pcategory_id, $pcategory_name;
    public $showToast = false;
    public $toastType = 'info';
    public $toastMessage = '';

    protected $listeners = [
        'updateCategoryOrdering'
    ];

    public function showToast($type, $message)
    {
        $this->toastType = $type;
        $this->toastMessage = $message;
        $this->showToast = true;
    
        $this->dispatch('toast-shown', [
            'duration' => 3000
        ]);
    }

    public function addParentCategory(){
        $this->pcategory_id = null;
        $this->pcategory_name = null;
        $this->isUpdateParentCategoryMode = false;
        $this->showParentCategoryModalForm();
    }

    public function createParentCategory(){
        $this->validate([
            'pcategory_name' => 'required|unique:parent_categories,name'
        ],[
            'pcategory_name.required'=>'Parent category field is required',
            'pcategory_name.unique'=> 'Parent category name already exists'
        ]);

        // store new parent category
        $pcategory = new ParentCategory();
        $pcategory->name = $this->pcategory_name;
        $saved = $pcategory->save();

        if($saved){
            $this->hideParentCategoryModalForm();
            // $this->dispatch('showToast', ['type'=>'success', 'message'=>'New parent category has created']);
            $this->showToast('success', 'New Parent Category Added');
        }else{
            $this->showToast('error', 'Something went wrong');
        }
    }

    public function editParentCategory($id){
        $pcategory = ParentCategory::findOrFail($id);
        $this->pcategory_id = $pcategory->id;
        $this->pcategory_name = $pcategory->name;
        $this->isUpdateParentCategoryMode = true;
        $this->showParentCategoryModalForm();

    }

    public function updateParentCategory(){
        $pcategory = ParentCategory::findOrFail($this->pcategory_id);
        $this->validate([
            'pcategory_name'=> 'required|unique:parent_categories,name,'.$pcategory->id
        ],[
            'pcategory_name.required'=>'Parent category field is required',
            'pcategory_name.unique'=>'Parent category field must be unique ',
        ]);

        // parent category update details
        $pcategory->name = $this->pcategory_name;
        $pcategory->slug = null;
        $updated = $pcategory->save();
        if($updated){
            $this->hideParentCategoryModalForm();
            $this->showToast('success', 'Parent Category Updated');
        }else{
            $this->showToast('error', 'Something went wrong');
        }
    }

    public function updateCategoryOrdering($positions){
        foreach($positions as $position){
            $index = $position[0];
            $new_position = $position[1];
            ParentCategory::where('id',$index)->update([
                'ordering'=>$new_position
            ]);
            $this->showToast('success', 'Parent Category Ordering Updated');
        }
    }

    public function deleteParentCategory($id)
    {
        try {
            ParentCategory::findOrFail($id)->delete();
            $this->showToast('success', 'Parent Category deleted');
        } catch (\Exception $e) {
            $this->showToast('error', 'Failed to delete');
        }
    }

    public function showParentCategoryModalForm(){
        $this->resetErrorBag();
        $this->dispatch('showParentCategoryModalForm');
    }

    public function hideParentCategoryModalForm(){
        $this->dispatch('hideParentCategoryModalForm');
        $this->isUpdateParentCategoryMode = false;
        $this->pcategory_id = $this->pcategory_name = null;
    }



    public function render()
    {
        return view('livewire.user.categories',[
            'pcategories'=> ParentCategory::orderBy('ordering','asc')->get(),
            'showToast' => $this->showToast,
            'toastType' => $this->toastType,
            'toastMessage' => $this->toastMessage
        ]);
    }
}
