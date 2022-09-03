@extends('layouts.userapp')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Haber Düzenle</h4>
            {{-- <p class="card-description">
              Basic form elements
            </p> --}}
            <form method="POST" action="{{route('postupdate')}}" class="forms-sample" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="postid" value="{{$post->id}}">
              <div class="form-group">
                <label for="exampleInputName1">Başlık</label>
                <input name="title" type="text" value="{{$post->title}}" class="form-control" id="title" >
              </div>
              <div class="form-group">
                <label for="exampleTextarea1">İçerik</label>
             <textarea name="body" class="form-control" name="editor" id="editor" id="body" rows="6">{!! $post->body !!}</textarea>
               
              </div>
              {{-- <div class="form-group">
                <label for="exampleInputPassword4">Url</label>
                <input type="text" name="slug" class="form-control" id="exampleInputPassword4" placeholder="Slug">
              </div> --}}
              {{-- <div class="form-group">
                <label for="exampleSelectGender">Gender</label>
                  <select class="form-control" id="exampleSelectGender">
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div> --}}
              <div class="form-group">
                <label>Fotoğraf</label>
                
                <div class="input-group col-xs-12">
                  <input type="file" name="image" class="form-control file-upload-info" >

                  {{-- <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                  </span> --}}
                </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">Kaydet</button>
              <button class="btn btn-light">İptal</button>
            </form>
          </div>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor',{
  uiColor: '#CCEAEE',
  removeButtons: 'PasteFromWord',
  removePlugins: 'about',
 language:'tr',
 filebrowserUploadUrl :  "{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
 filebrowserUploadMethod:'form'
 });
</script>
@endsection