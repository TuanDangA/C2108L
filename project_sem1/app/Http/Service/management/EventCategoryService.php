<?php
    namespace App\Http\Service\Management;

use App\Models\management\event_categories;

class EventCategoryService {
    //Get data from database and return
    public function list()
    {
        $category = event_categories::all();

        return $category;
    }

    //validate form
    public function validate($dataForm)
    {
        return $dataForm->validate([
            'name' => ['required', 'string', 'max:255', 'unique:event_categories']
        ]);
    }

    public function save(array $dataForm, event_categories $category)
    {
        $category->name = $dataForm['name'];
        $category->save();
    }

    //Remove event category from database
    public function delete(event_categories $category)
    {
        $category->delete();
    }

    public function search($dataForm)
    {
        $category = event_categories::where('name', 'like', '%'.$dataForm.'%')
                                    ->get();

        return $category;
    }
}