
@extends('layouts.app')

@section('content')
    <div class="container pt-5">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> {{Session::get('success')}}</strong>
                    </div>
                @endif 
        <div class="row col-md-12">
                
            <div class="card"  style="margin-left:325px">
                <div class="card-header">
                    <h3>Update student</h3>
                </div>
                <div class="card-body">
                    <div class="row col-md-12 ml-1">
                
                        <form action="{{ route('updateStudent', $studentDetails->id) }}" method="post">
                            @csrf
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name"  name="name" value="{{ $studentDetails->name}}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="row">
                                <div class=" col-md-6 form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                                    <label>Age</label>
                                    <input type="number" class="form-control" id="age" name="age"  value="{{ $studentDetails->age}}"/>
                                    <span class="text-danger">{{ $errors->first('age') }}</span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Gender</label><br/>
                                    <label class="radio-inline pr-3"><input type="radio" name="gender" value="M" @if($studentDetails->gender == 'M') checked @endif> M</label>
                                    <label class="radio-inline pr-3"><input type="radio" name="gender" value="F" @if($studentDetails->gender == 'F') checked @endif> F</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="Others" @if($studentDetails->gender == 'Others') checked @endif> Others </label>
                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Reporting Teacher</label>
                                <select class="form-control" name="reporting_teacher">
                                    <option disabled>Select teacher</option>
                                    @foreach($teachers as $teacher) 
                                        <option value="{{ $teacher->id }}" @if($studentDetails->teacher_id == $teacher->id) selected @endif >{{ $teacher->name }}</option>
                                    @endforeach 
                                </select>
                                <span class="text-danger">{{ $errors->first('reporting_teacher') }}</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection