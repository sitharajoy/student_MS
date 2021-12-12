@extends('layouts.app')

@section('content')
    
    <div class="row col-md-12">
    
        <div class="card"  style="margin-left: 157px;margin-right: 172px;">
        <img src="https://www.kindergartenglobalacademy.com/images/resources/ms-img4.jpg" width="988" height="300" >
            @if(Session::has('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong> {{Session::get('success')}}</strong>
                </div>
             @endif

             @if(Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong> {{Session::get('error')}}</strong>
                </div>
             @endif 

                <div class="card-body">
                    <div class="row col-md-12 ml-1">
                        <a href="#" class="btn btn-success btn-xs float-right" id="add-student" title="Add New Student" >
                            <i class="fa fa-plus"> Add New Student</i>
                        </a>
                    
                        <table class="table table-striped stud-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th width="16">Reporting Teacher</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp 

                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>{{ $student->teacher->name }}</td>
                                    <td class="text-center">
                                    <a class='btn btn-info btn-xs' href="{{ route('updateStudentView', $student->id) }}" title="Edit">
                                        <i class="fa fa-pencil"> Edit</i></a>
                                    <a class='btn btn-danger btn-xs delete-student' data-toggle="modal" data-id='{{ $student->id }}' 
                                        data-target="#deleteModal" href="#" title="Delete">
                                        <i class="fa fa-trash"> Delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
               
                </div>
        </div>
    </div>


    <!-- delete student modal -->
        <div class="modal fade" id="delete-student-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" > 
                        <h4 class="modal-title">Confirm</h4> 
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                    </div> 
                    <div class="modal-body">
                        <form action="{{ route('deleteStudent') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div >
                                <input type=hidden id="student-id" name="student_id">
                                <h5>Are you sure want to delete?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    <!-- delete student Modal -->

    <!-- add student modal -->
        <div class="modal fade" id="add-student-modal" role="dialog">
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h4 class="modal-title">Add New Student</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ URL::Route('addStudent') }}" method="post">
                                @csrf
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name"  name="name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="row">
                                    <div class=" col-md-6 form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                                        <label>Age</label>
                                        <input type="number" class="form-control" id="age" name="age"/>
                                        <span class="text-danger">{{ $errors->first('age') }}</span>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Gender</label><br/>
                                        <label class="radio-inline pr-3"><input type="radio" name="gender" value="M"> M</label>
                                        <label class="radio-inline pr-3"><input type="radio" name="gender" value="F"> F</label>
                                        <label class="radio-inline"><input type="radio" name="gender" value="Others"> Others </label>
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Reporting Teacher</label>
                                    <select class="form-control" name="reporting_teacher">
                                        <option selected = "true" disabled>Select teacher</option>
                                        @foreach($teachers as $teacher) 
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
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
        <!-- add student modal -->
  @endsection

    @section('footer')
        <script>
            $(document).ready(function () {
                //add student modal
                $('#add-student').on('click', function() {
                    $('#add-student-modal').modal('show');
                });

                //delete student 
                $('.delete-student').on('click', function() {
                    var id = $(this).data('id');      
                    $('#student-id').val(id); 
                    $('#delete-student-modal').modal('show');
                });
            });
        </script>
    @endsection