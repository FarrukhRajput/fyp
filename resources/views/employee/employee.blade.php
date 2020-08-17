@extends('layouts.app')



@section('content')
<?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>

<a href="{{route('employee.index')}}" class="btn btn-theme mb-3">All Employees</a>

    <div class="row ">
        <div class="col-8">

        @if(session()->has('success'))
            <div class="p-2 mb-2 message">
                {{session()->get('message')}}
            </div>

        @elseif(session()->has('errors'))

        <div class="alert alert-danger  p-2 mb-2  "> 
            @foreach ($errors->all() as $error)
              <li> <?= $error ?></li>
            @endforeach 
           
        </div>



        @endif
        
            <div class="card">

                <form action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
        
                    <input type="hidden" name="id" value="{{@$employee->id}}">
                    
                    <div class="card-body">
                        <h4 class="page-title">{{@$employee->id? 'Edit ' : 'Create '}}Employee</h4>
        
                        <div class="row mt-3 pl-2">
        
                            <div class="col-12 mb-5 d-flex justify-content-between">
                                
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input name="image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label class="fa" for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url({{ @$employee->image ? asset(@$employee->image) :  asset('images/avatar.png')}});">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">

                                    <label for="" class="form-control-label  d-block">Working</label>
                                    <label class="switch" for="status">
                                        <input name="status" id="status" type="checkbox" {{@$employee->status === 1 ? 'checked' :''}}> 
                                        <span class="slider round"></span>
                                    </label>
                                    
                                </div>
                                
                            </div>
        
                            <div class="col-12">

                                <div class="form-row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="">Employee Name</label>
                                            <div class="form-row">
                                                <div class="col-6">
                                                    <input value="{{@$employee->f_name}}" name="f_name" type="text" class="form-control" placeholder="FirstName"  maxlength="15" >
                                                </div>
                
                                                <div class="col-6">
                                                    <input value="{{@$employee->l_name}}" name="l_name" type="text" class="form-control" placeholder="Last Name" maxlength="15" >
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Father Name</label>
                                            <input value="{{@$employee->father_name}}" name="father_name" type="text" class="form-control">
                                        </div>
                                    </div>                              
                                </div>
        
                                
        
                                <div class="form-row">

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">CNIC</label>
                                            <input value="{{@$employee->cnic}}" pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$" name="cnic" type="text"  class="form-control" placeholder="XXXXX-XXXXXXX-X">
                                        </div>
                                    </div>
                       
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Date Of Birth</label>
                                            <input value="{{@$employee->dob}}" name="dob" class="form-control" type="date" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-3   ">
                                        <label class="d-block" for="">Gender</label>

                                        <div class="form-check form-check-inline">
                                            <label for="male">Male</label>
                                            <input class="ml-2"  style="margin-top: -6px;" name="gender" value="male"   {{@$employee->gender === 'male' ? 'checked ': ''}} type="radio" required>
                                        </div>

                                          <div class="form-check form-check-inline">
                                            <label for="female">Female</label>
                                            <input  class="ml-2" style="margin-top: -6px;" name="gender" value="female" {{@$employee->gender === 'female' ? 'checked' : ''}} type="radio" class="" required>
                                          </div>
                                        
                                    </div>


                                   


                                    <div class="col-4">
                                        <div class="form-group">
                                          <label for="">Email</label>
                                          <input value="{{@$employee->email}}" name="email" type="email" class="form-control" >
                                        </div>
                                      </div>
                                      
                                      <div class="col-4">
                                          <div class="form-group">
                                              <label for="">Phone</label>
                                              <input value="{{@$employee->phone}}" name="phone" pattern="^[0-9+]{4}-[0-9+]{7}$" type="text"  class="form-control" placeholder="03XX-XXXXXXX">
                                          </div>
                                      </div>
  
                                      <div class="col-4">
                                          <div class="form-group">
                                              <label for="">Phone (optional)</label>
                                              <input value="{{@$employee->phone_optional}}" name="phone_optional" pattern="^[0-9+]{4}-[0-9+]{7}$" type="text"class="form-control" placeholder="03XX-XXXXXXX">
                                          </div>
                                      </div>


                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Staff Group</label>
                                            <select name="staff_id" id="group" class="form-control">
                                                <option value="0">Choose</option>
                                                @foreach ($groups as $item)
                                                    <option value="{{$item->id}}"  {{@$employee->staff_id == $item->id ? 'selected': ''  }}  >{{$item->title}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                        
                                    <div class="col-3">
                                        
                                        <div class="form-group">
                                            <label for="">Designation </label>
                                            <select name="designation_id" id="designation" class="form-control">
                                                @if(@$employee->designation_id)
                                                    <option value="{{$employee->designation->id}}" selected>{{$employee->designation->title}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        
                                    </div>
    
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Salary</label>
                                            <input value="{{@$employee->salary}}" minlength="0" name="salary" type="number" class="form-control" placeholder="Salary">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Joining Date</label>
                                            <input value="<?php echo $today; ?>"  name="joining_date" class="form-control" type="date" class="form-control" >    
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="">City</label>
                                        <input  name="city" value="{{@$employee->city}}" type="text" class="form-control" >
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Address </label>
                                            <textarea name="address" type="text" class="form-control">{{@$employee->address}}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="">Remarks </label>
                                            <textarea name="remarks" type="text" class="form-control" placeholder="Optional">{{@$employee->remarks}}</textarea>
                                        </div> 
                                    </div>

                                </div>
                                
                            </div>
                        </div>

                        <hr>
        
                        <div class="row mt-3">
                            <div class="offset-10 col-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-100 mr-3">{{@$employee->id? 'Update ' : 'Create '}}</button>
                                @if(@$employee->id)
                                    <a onclick="return confirm('Are Your Sure You Want To Delete &#034; {{ $employee->f_name.' '. $employee->l_name }} &#034; ?')" 
                                        href="{{route('employee.destroy', [ 'id' => $employee->id ] )}}" class="btn btn-danger w-100">Delete</a>
                                @else
                                <button type="reset" class="btn btn-danger w-100">Clear</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

  
   



@section('addJavaScript')
    
<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).ready(
        
        () => {
            $("#group").change(
                () => {
                    var $id = $("#group option:selected").val();
                    var $designation = $("#designation");
                    $designation.removeAttr('disabled');
                   
                    $.ajax(
                        {
                            type: 'GET',
                            url:'/staff-group/getDesignation/'+$id,
                            dataType: 'json',
                            success: function(designations){

                                $designation.empty(); 
                                $.each(designations , function ( i , designation){
                                    $designation.append("<option value="+designation.id+">"+designation.title+"</option>");
                                });
                            }
                        }
                    )
                }
            );

            $("#imageUpload").change(function() {
                readURL(this);
            });

        }
    )

</script>

@endsection





@endsection
