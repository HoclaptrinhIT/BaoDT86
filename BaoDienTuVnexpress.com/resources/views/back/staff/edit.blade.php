@extends('back.template.master')
@section('title', 'Quản lý nhân viên')
@section('heading', 'chỉnh sữa nhân viên')
@section('content')
    
<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
           
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('admin/staff/edit/'.$User->id)}}" method="POST">
                <div class="card-body">
                {!! csrf_field() !!}

                   <div class="form-group">
                    <select class="form-control" name="label">
                      @if(isset($Userlevel) && count($Userlevel) > 0)
                      @foreach($Userlevel as $k => $v)
                      <option value="{{$v->id}}" @if($v->id == $User->level ) selected ="" @endif>
                        Cấp bậc: {{$v->name}}
                      </option>
                      @endforeach
                      @endif
                     
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="status">
                     
                      <option value="1" @if($User-> status == 1) selected ="" @endif> 
                        Trạng thái: Bật
                      </option>
                      <option value="0" @if($User-> status == 0) selected ="" @endif> 
                        Trạng thái: Tắt
                      </option>
                     
                    </select>
                  </div>
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">Họ và tên <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="fullmane" value="{{$User->fullmane}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email <span class="color_red">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{$User->email}}">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại <span class="color_red">*</span></label>
                    <input type="phone" class="form-control" name="phone" value="{{$User->phone}}">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <input type="address" class="form-control" name="address" value="{{$User->address}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Tài khoản <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="username" value="{{$User->username}}" disabled="" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu <span class="color_red">*</span> </label>
                    <input type="password" class="form-control" name="password">
                    <p class="ad_note_password"> Nhập vào mục password nếu muốn đổi mật khẩu </p>
                   

                  </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

     



@stop