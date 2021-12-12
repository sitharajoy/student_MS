
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
                
                    <div class="card"  style="margin-left:325px;">
                        <div class="card-header">
                            <h3>Update Student Marks</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('updateStudentMark') }}" method="post">
                                @csrf
                                    <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Subjects</th>
                                                    <th>Mark</th>
                                                </tr>
                                            </thead>
                                            @foreach($studentMarks AS $key => $studentMark)
                                                <input type="hidden" name="row[{{$key}}][mark_id]" value="{{ $studentMark->id }}" />
                                                    <tr>
                                                        <td><div class="form-group">
                                                                <input type="text" class="form-control" name="row[{{$key}}][subject]" value="{{ $studentMark->subjects->subject_name }}" disabled/>
                                                            </div>
                                                        </td>
                                                        <td> 
                                                            <div class="form-group {{ $errors->has('row.$key.obtain_marks') ? 'has-error' : '' }}">
                                                                <input type="number" class="form-control" name="row[{{$key}}][obtain_marks]" placeholder="Enter {{ $studentMark->subjects->subject_name }} Marks" value="{{ $studentMark->obtain_marks }}"/>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                    </table>        
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
        </div>
@endsection

@section('footer')
<script>
    $(document).ready(function () {
        $('#add-marks').on('click', function() {
            $('#add-marks-modal').modal('show');
        });
    });
</script>
 @endsection