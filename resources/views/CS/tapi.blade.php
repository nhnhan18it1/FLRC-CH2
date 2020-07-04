<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('postf') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div style="border: 2.5px solid gray;border-radius: 5px;padding-top: 0;background-color: white;" class="form-group">
            <div class="form-group">

                <label style="background: gray;display: block;" for=""> <strong><i class="far fa-newspaper"></i> Nội dung bài viết</strong></label>
                <textarea style="border:none;border-bottom: 1px solid gray;" placeholder="{{ session()->get('Name') }} ơi? Bạn đang nghĩ gì vậy? Hãy chia sẻ cho bạn bè của mình biết đi." class="form-control" required name="content" id="" rows="3"></textarea>                |
                <div class="file-upload-content">
                    <img style="width: 100px; height: 100px; border: 1px solid gray;" class="file-upload-image" src="#" alt="your image" />
                    <div class="image-title-wrap"></div>
                </div>

                <div style="margin: 0 0 0 0;border-bottom: 1px solid gray;border-top: 1px solid gray;" class="row">
                    <!-- <div style="padding: 0 0 0 0;padding-top: 8px;" class="col-md-1 column-3"></div> -->
                    <input style="" type="file" accept="image/png, image/jpeg, image/jpg" name="file_img" id="file" placeholder="file cua ban" class="custom-file-input" aria-describedby="fileHelpId">
                    <div style="padding: 0 0 0 0;padding-top: 8px;" class="col-md-3 column-2"></div>

                    <div style="padding: 0 0 0 0;" class="col-md-3 column-3"></div>
                    <div style="padding: 0 0 0 0;padding-top: 8px;" class="col-md-3 column-4"><button style="float: left; display: inline-block;" type="submit" class="btn btn-outline-secondary btn-block"><i class="far fa-paper-plane">| Đăng bài</i></button></div>
                </div>

            </div>

        </div>
    </form>

</body>

</html>
