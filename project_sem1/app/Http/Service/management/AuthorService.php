<?php
    namespace App\Http\Service\management;
    use App\Models\management\author;

    class AuthorService{
        //select author
        public function SelectOne($criteria){
            $author = author::Find($criteria);
            return $author;
        }

        //list all authors
        public function listAll(){
            $List = author::all();
            return $List;
        }

        public function validateAdd($dataForm)
        {
            return $dataForm->validate([
                'name' => ['required'],
                'DOB' => ['required'],
                'title' => ['required']
            ]);
        }

        //update database: add new authors
        public function post_add($request){
            $author = new author();
            $author->name = $request->name;
            $author->DOB = $request->DOB;
            $author->title = $request->title;
            $author->save();
        }

        //update database: edit authors
        public function post_edit($request){
            $author = author::Find($request->id);
            $author->name = $request->name;
            $author->DOB = $request->DOB;
            $author->title = $request->title;
            $author->save();
        }

        //update database: delete authors
        public function post_delete($request){
            $author = author::Find($request->id)->delete();
        }

        //search authors
        public function search($request){
            $search = $request->search;
            $authors = author::where('name', 'like', '%'.$search.'%')
            ->orWhere('title','like','%'.$search.'$')
            ->get();
            return $authors;
        }
    }