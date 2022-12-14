@extends('layouts.master')

@section('styles')
<link rel="stylesheet" href="{{asset('css/filebrowser.css')}}">
@endsection

@section('scripts')
<script src="{{asset('js/file-browser.js')}}"></script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 id='filterHeader' class="panel-title pull-left" style="padding-top: 12px;">Documents</h3>
                <div class= 'input-group search'>
                    <input id='search' type='search' style='width:25%' class="form-control pull-right" placeholder="Find a File...">
                    <div class='input-group-addon'>
                    <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="filemanager">

                    <div class="breadcrumbs"></div>

                    <ul class="data"></ul>

                    <div class="nothingfound">
                        <div class="nofiles"></div>
                        <span>No files here.</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="fileModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times-circle fa-lg " ></i></button>
                <h4 class="modal-title">Add a File</h4>
            </div>
            <form action="{{route('document.uploadFile')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">


                    <div class='row'>
                        <div class="col-xs-12">

                            <div>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                        </div>
                    </div>
                    <input class='form-control' type="hidden" name="path" id="path" >

                </div>
                <div class="modal-footer">
                    <input class=' btn btn-primary' type="submit" value="Upload File" name="submit">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="folderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times-circle fa-lg " ></i></button>
                <h4 class="modal-title">Add a Folder</h4>
            </div>
            <form action="{{route('document.createFolder')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">

                    <div class='row'>
                        <div class="col-xs-12">
                            <label id='folderToCreateLabel' for="folderToCreate" class=" control-label"></label>
                            <div>
                                <input class='form-control' type="text" name="folderToCreate" id="folderToCreate">
                            </div>
                            <span class="help-block">
                                <strong>Folder names cannot contain spaces or special characters.</strong>
                            </span>
                        </div>
                    </div>
                    <input class='form-control' type="hidden" name="folderPath" id="folderPath" >

                </div>
                <div class="modal-footer">
                    <input class=' btn btn-primary' type="submit" value="Create Folder" name="submit">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
$(function(){
    var isAdmin = {{ Auth::user()->isAdmin() }}
    fileBrowser(isAdmin);

});

$('#fileModal').on('shown.bs.modal', function() {
    var path =  $('.breadcrumbs').text();
    path = path.replace(/\s/g, '');
    path = path.replace(/[\u2192]/g,'/' );
    $('input[name="path"]').val(path);
});

$('#folderModal').on('shown.bs.modal', function() {
    var path =  $('.breadcrumbs').text();
    path = path.replace(/\s/g, '');
    path = path.replace(/[\u2192]/g,'/' );
    $('input[name="folderPath"]').val(path);
    $('#folderToCreateLabel').append('Folder Path: ' + path + '/');

});






</script>

@endsection
