
@extends('layouts.app')

@section('content')
        <div class="container pt-5" style="margin-right:156px;">
        

            <div class="row col-md-12">
          
                <div class="card"  style="margin-left:160px">
                  <!--success notification -->
            @if(Session::has('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong> {{Session::get('success')}}</strong>
                </div>
             @endif 
         <!--error notification -->
             @if(Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong> {{Session::get('error')}}</strong>
                </div>
             @endif 
                    <div class="card-header">
                        <h3>Students Mark List</h3>
                    </div>
                    <div class="card-body">
                        <div class="row col-md-12 ml-1">
                            <a href="#" class="btn btn-success btn-xs float-right" id="add-marks">
                                <i class="fa fa-plus"> Add Marks</i>
                            </a>
                        
                            <table class="table table-striped stud-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="5%">Name</th>
                                         <!-- subject list -->
                                        @foreach($subjects AS $subject)
                                            <th>{{ $subject->subject_name }}</th>
                                        @endforeach
                                        <th>Term</th>
                                        <th width="5%">Total Marks</th>
                                        <th width="15%">Created On</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                    $totalMarks = 0;
                                    $termId = '';
                                @endphp
                                <tbody>
                                
                                    @foreach($studentDetails AS $markDetails)
                                        <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $markDetails->students->name }}</td>

                                                @foreach($markDetails->students->marks AS $marks)
                                              
                                                    @if($marks->term_id == $markDetails->terms->id)
                                                            @php 
                                                                $createdDate = $marks->created_at; 
                                                                $totalMarks += $marks->obtain_marks;
                                                                $term = $marks->terms->term;
                                                                $termId = $marks->terms->id;
                                                            @endphp

                                                            <td>{{ $marks->obtain_marks }}</td>
                                                    @endif
                                                @endforeach
                                            
                                                <td>{{$term}}</td>
                                                <td>{{ $totalMarks }}</td>
                                                <td>{{date('M d,Y H:i A',strtotime($createdDate))}}</td>
                                                <td class="text-center"><a class='btn btn-info btn-xs' href="{{ route('updateStudentMarkView', ['id' => $markDetails->students->id,'term' => $termId]) }}">
                                                    <i class="fa fa-pencil"> Edit</i></a>
                                                    <a href="#" class="btn btn-danger btn-xs delete-student-marks" data-toggle="modal" data-id="{{ $markDetails->students->id }}"
                                                        data-term="{{ $termId }}" data-target="#deleteMarkModal"> 
                                                    <i class="fa fa-trash"> Delete</i></a>
                                                </td>
                                        </tr>
                                       
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- delete student mark modal -->
    <div class="modal fade" id="delete-student-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" > 
                    <h4 class="modal-title">Confirm</h4> 
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                </div> 
                <div class="modal-body">
                    <form action="{{ route('deleteStudentMark') }}" method="post">
                            @csrf
                            @method('DELETE')
                        <div >
                            <input type=hidden id="student-id" name="student_id">
                            <input type=hidden id="term" name="term">
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
 <!-- delete student mark modal -->


    <!-- add marks modal -->
        <div class="modal fade" id="add-marks-modal" role="dialog">
            <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Student Marks</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                
                        <form action="{{ URL::Route('addStudentMark') }}" method="post">
                            @csrf
                            <div class="form-group {{ $errors->has('student') ? 'has-error' : '' }}">
                                <label>Students</label>
                                <select class="form-control" name="student">
                                    <option selected = "true" disabled>Select student</option>
                                    <!-- student list -->
                                    @foreach($students AS $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('student') ? 'has-error' : '' }}">
                                <label>Term</label>
                                <select class="form-control" name="term_id">
                                    <option selected = "true" disabled>Select term</option>
                                    <!-- term list -->
                                    @foreach($terms AS $term)
                                        <option value="{{ $term->id }}">{{ $term->term }}</option>
                                    @endforeach
                                </select>
                            </div>

                             <!-- subject list -->    
                            @foreach($subjects AS $key => $subject)
                                <div class="row">
                                    <input type="hidden" name="row[{{$key}}][subject_id]" value="{{ $subject->id }}" />
                                    <div class=" col-md-6 form-group">
                                        <label></label>
                                        <input type="text" class="form-control"  name="row[{{$key}}][subject]" value="{{ $subject->subject_name }}" disabled/>
                                    </div>
                                
                                    <div class="col-md-6 form-group  {{ $errors->has('row.$key.obtain_marks') ? 'has-error' : '' }}">
                                        <label></label>
                                        <input type="number" class="form-control" name="row[{{$key}}][obtain_marks]" placeholder="Enter {{ $subject->subject_name }} Marks"/>
                                        <span class="text-danger">{{ $errors->first("row.$key.obtain_marks") }}</span>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>    
                </div>
            </div>
        </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            //add marks modal
            $('#add-marks').on('click', function() {
                $('#add-marks-modal').modal('show');
            });

            //delete student mark
            $('.delete-student-marks').on('click', function() {
                var id = $(this).data('id');
                var term_id = $(this).data('term');        
                $('#student-id').val(id); 
                $('#term').val(term_id); 
                $('#delete-student-modal').modal('show');
            });
        });
    </script>
@endsection