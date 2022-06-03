@extends('layouts.masterLayout')

@section('title')
    Edit Feedback
@stop

@section('content')
    <div class="container" style="margin-top:100px;">

        {{ Breadcrumbs::render('feedbacks-edit',$accounts->confirmation_code,$feedbacks['feedback']) }}        

        <form method="post" action="{{ route('feedbacks-update', $accounts->confirmation_code) }}">
            <div class="form-group">
                @csrf

                <input type="hidden" name="id" value="{{ $feedbacks['feedback']->id }}">
                <label for="content">Content</label>
                <input type="text" class="form-control" name="content" id="content" value="{{ $feedbacks['feedback']->content }}">
                <label>User Email</label>
                <input type="text" class="form-control" value="{{ $feedbacks['feedback']->email }}" readonly>
                <label for="id_feedback_category">Feedback Category</label>
                <select name="id_feedback_category" id="id_feedback_category" class="form-control">
                    <option value="">--Select--</option>
                    @foreach ($feedbacks['category'] as $item)
                        <option value="{{ $item->id }}" @if ($feedbacks['feedback']->id_feedback_category == $item->id) selected @endif>
                            {{ $item->name }}
                        </option>
                    @endforeach 
                </select>
                  
                <br>
                <button class="btn btn-warning">Edit</button>
            </div>
        </form>
    </div>
@stop