<?php
    namespace App\Http\Service\Management;

    use App\Models\management\feedback_categories;

    class FeedbackCategoryService {
        //Get data from database and return
        public function list()
        {
            $category = feedback_categories::all();

            return $category;
        }

        //validate form
        public function validate($dataForm)
        {
            return $dataForm->validate([
                'name' => ['required', 'string', 'max:255', 'unique:feedback_categories']
            ]);
        }

        public function save(array $dataForm, feedback_categories $category)
        {
            $category->name = $dataForm['name'];
            $category->save();
        }

        //Remove feedback category from database
        public function delete(feedback_categories $category)
        {
            $category->delete();
        }

        public function search($dataForm)
        {
            $category = feedback_categories::where('name', 'like', '%'.$dataForm.'%')->get();
            return $category;
        }
    }