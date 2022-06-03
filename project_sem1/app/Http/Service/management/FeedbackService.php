<?php
    namespace App\Http\Service\Management;

    use App\Models\management\feedback;
    use App\Models\management\feedback_categories;

    class FeedbackService {
        public function list()
        {
            $feedbacks = feedback::join('feedback_categories', 'feedback_categories.id', '=', 'feedbacks.id_feedback_category')
                                ->join('accounts', 'accounts.id', '=', 'feedbacks.id_user')
                                ->select('feedbacks.*', 'feedback_categories.name', 'accounts.email')
                                ->get();

            return $feedbacks;
        }

        public function edit(string $id)
        {
            $category = feedback_categories::select('name', 'id')
                                                    ->get();

            $feedback = Feedback::join('accounts', 'accounts.id', '=', 'feedbacks.id_user')
                                    ->select('feedbacks.*', 'accounts.email')
                                    ->where('feedbacks.id', $id)
                                    ->first();

            return ['category' => $category,
                    'feedback' => $feedback];
        }

        public function update(array $dataForm)
        {
            $feedbacks = feedback::find($dataForm['id']);

            $feedbacks->content = $dataForm['content'];
            $feedbacks->id_feedback_category = $dataForm['id_feedback_category'];
            $feedbacks->save();
        }

        public function delete(Feedback $feedbacks)
        {
            $feedbacks->delete();
        }

        public function search($dataForm)
        {
            $feedbacks = feedback::join('feedback_categories', 'feedback_categories.id', '=', 'feedbacks.id_feedback_category')
                                    ->join('accounts', 'accounts.id', '=', 'feedbacks.id_user')
                                    ->select('feedbacks.*', 'feedback_categories.name', 'accounts.email')
                                    ->where('feedbacks.content', 'like', '%'.$dataForm.'%')
                                    ->orWhere('feedback_categories.name', 'like', '%'.$dataForm.'%')
                                    ->orWhere('accounts.email', 'like', '%'.$dataForm.'%')
                                    ->get();

            return $feedbacks;
        }
    }