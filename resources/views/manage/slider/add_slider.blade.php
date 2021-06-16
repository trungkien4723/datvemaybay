@extends('manage.layout.app')

@section('title', 'Create flights')

@section('content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Slider
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{route('insert_slider')}}" method="post" enctype="multipart/form-data">
                                
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slide</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Ảnh') }}</label>

                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 40%; height: 40%;"></div>
                                        <div>
                                            <span class="btn btn-outline-primary btn-file">
                                                <span class="fileinput-new">Chọn ảnh</span>
                                                <span class="fileinput-exists">Thay đổi</span>
                                            <input type="file" name="image">
                                            </span>
                                            <a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput">Xóa ảnh</a>
                                        </div>
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả slider</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="descr" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn slider</option>
                                            <option value="1">Hiển thị slider</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection