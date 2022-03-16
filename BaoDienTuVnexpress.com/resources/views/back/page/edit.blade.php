@extends('back.template.master')
@section('title', 'Quản lý Trang')
@section('heading', 'chỉnh sữa trang')
@section('page', 'active')
@section('content')
    
<div class="col-md-12">
              <div class="card-header">
                <a class="btn btn-block btn-danger ad_add" href="{{url('admin/page/list')}}" title="Thêm">
                  Quay lại
                </a>
              </div>
            <!-- general form elements -->
            <div class="card card-primary">          
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('admin/page/edit/'.$Page->RowID)}}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                {!! csrf_field() !!}

                  <div class="form-group">
                    <select class="form-control" name="Status"> 
                      <option value="1" @if($Page->Status == 1) selected ="" @endif>
                       Trạng thái: Bật
                      </option>
                       <option value="0" @if($Page->Status == 0) selected ="" @endif>
                       Trạng thái: Tắt
                      </option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên trang <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="Name" value="{{$Page->Name}}" id="title" onkeyup="ChangeToSlug();">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Đường dẫn </label>
                    <input type="text" class="form-control" name="Alias" id="slug" value="{{$Page->Alias}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Ảnh đại diện </label>
                    @if($Page->Images != NULL)
                    <br/>
                    <img src="{{url('images/page/'.$Page->Images)}}" alt="Avatar" />
                    @endif
                    <input type="file" name="Images" class="form-control"/>        
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Font </label>
                    <input type="text" class="form-control" name="Font" value="{{$Page->Font}}">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Sắp xếp </label>
                    <input type="number" class="form-control" name="Sort" value="{{$Page->Sort}}">
                  </div> 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Thẻ meta title </label>
                    <textarea name="MetaTitle" rows="2" class="form-control">{{$Page->MetaTitle}}</textarea>
                  </div>       

                  <div class="form-group">
                    <label for="exampleInputEmail1"> Thẻ Meta Description </label>
                    <textarea name="MetaDescription" rows="6" class="form-control">{{$Page->MetaDescription}}</textarea>               
                  </div>       

                  <div class="form-group">
                    <label for="exampleInputEmail1">Thẻ Meta Keyword </label>
                    <textarea name="MetaKeyword" rows="3" class="form-control">{{$Page->MetaKeyword}}</textarea>  
                  </div> 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả tin tức <span class="color_red">*</span></label>
                    <textarea name="Description" rows="8" class="form-control" id="ckeditor">{{$Page->Description}}</textarea>
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