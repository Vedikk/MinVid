@extends ('layouts.app')

@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 video_adding_cont">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload Your video!</div>
                    <div class="panel-body">



                        <form class="form-horizontal" role="form" method="POST" action="{{ route('videoStore') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="video_name" class="col-md-4 control-label">Name of video</label>

                                <div class="col-md-6">
                                    <input id="video_name" type="text" class="form-control" name="video_name"
                                           placeholder="Name of video"  autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="upload_video_path" class="col-md-4 control-label">Video</label>


                                <div id="video_add_div" class="col-md-6">
                                    <label for="inputFile" class="btn btn-default btn-file" id="inputFileLabel">
                                        Browse
                                    </label>
                                    <input type="file"  name="path" id="inputFile" accept="video/*">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection