<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ParentCategory;
use App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    // parent category
    public $isUpdateParentCategoryMode = false;
    public $pcategory_id, $pcategory_name;

    // category
    public $isUpdateCategoryMode = false;
    public $category_id, $parent = 0, $category_name;

    //multiple pagination
    public $pcategoriesPerPage = 6;
    public $categoriesPerPage = 6;

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

    // Parent category section starts

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

    public function deleteParentCategory($id){
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
    // Parent category section ends


    // category section starts
    public function addCategory(){
        $this->category_id = null;
        $this->parent = 0;
        $this->category_name = null;
        $this->isUpdateCategoryMode = false;
        $this->showCategoryModalForm();
    }

    public function createCategory(){
        // validate
        $this->validate([
            'category_name'=>'required|unique:categories,name'
        ],[
            'category_name.required'=>'Category field is required',
            'category_name.unique'=>'Category name already exists',
        ]);
        //store
        $category = new Category();
        $category->parent = $this->parent;
        $category->name = $this->category_name;
        $saved = $category->save();
        if($saved){
            $this->hideCategoryModalForm();
            $this->showToast('success', 'Category Added');
        }else{
            $this->showToast('error', 'Something went wrong');
        }

    }

    public function editCategory($id){
        $category = Category::findOrFail($id);
        $this->category_id = $category->id;
        $this->parent = $category->parent;
        $this->category_name = $category->name;
        $this->isUpdateCategoryMode = true;
        $this->showCategoryModalForm();
    }

    public function updateCategory(){
        // validate
        $category = Category::findOrFail($this->category_id);
        $this->validate([
            'category_name'=>'required|unique:categories,name,'.$category->id
        ],[
            'category_name.required'=>'Category name field is required',
            'category_name.unique'=>'Category name already exists',
        ]);
        // update
        $category->name = $this->category_name;
        $category->parent = $this->parent;
        $category->slug = null;
        $updated = $category->save();
        if($updated){
            $this->hideCategoryModalForm();
            $this->showToast('success', 'Category Added');
        }else{
            $this->showToast('error', 'Something went wrong');
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
    
        if ($category->posts()->count() > 0) {
            $count = $category->posts()->count();
            $this->dispatch('showToast', [
                'type' => 'error',
                'message' => "This category has ({$count}) related post(s). Cannot be deleted."
            ]);
            return;
        }
    
        try {
            $category->delete();
            $this->dispatch('showToast', [
                'type' => 'success',
                'message' => 'Category deleted.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('showToast', [
                'type' => 'error',
                'message' => 'Failed to delete category.'
            ]);
        }
    }
    
  
    public function showCategoryModalForm(){
        $this->resetErrorBag();
        $this->dispatch('showCategoryModalForm');
    }

    public function hideCategoryModalForm(){
        $this->dispatch('hideCategoryModalForm');
        $this->isUpdateCategoryMode = false;
        $this->category_id = $this->category_name = null;
        $this->parent = 0;
    }
    // category section ends



    public function render()
    {
        return view('livewire.admin.categories',[
            'pcategories'=> ParentCategory::orderBy('ordering','asc')->paginate($this->pcategoriesPerPage,['*'],'pcat_page'),
            'categories'=>Category::orderBy('ordering','asc')->paginate($this->categoriesPerPage,['*'],'cat_page'),
            'showToast' => $this->showToast,
            'toastType' => $this->toastType,
            'toastMessage' => $this->toastMessage
        ]);
    }
}
