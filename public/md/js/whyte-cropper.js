$(function() {
  whyte.imageInput.change(function() {
    if (this.files && this.files[0]) {
      whyte.displayCropper(this);
    }
  });

  whyte.displayCropper = function (input) {
    //Set src of Modal as input Image
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#CropperImage').attr("src", e.target.result);
      whyte.cropperModal.modal({
        backdrop: 'static',
        keyboard: false
      });
    }
    if (input instanceof File) {
      reader.readAsDataURL(input);
    } else {
      reader.readAsDataURL(input.files[0]);
    }
  }

  if(whyte.deleteImage == undefined){
    whyte.deleteImage = function(filename){
      if(!confirm('Are you sure want to delete the image?')) return false;
      $.ajax({
        url: whyte.deleteUrl,
        type: 'DELETE',
        data:{
          filename:filename
        },
        success: function(){
          $('#image-preview-'+filename.slice(0,-4)).remove();
          $('#image-input-'+filename.slice(0,-4)).remove();
        },
        error: function(){
          alert('failed');
        }
      });
    }

  }

  whyte.progress = function(e){
    if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;

        var Percentage = (current * 100)/max;
        $('#ImageLoading .percentage').html(Math.floor(Percentage) + "%");
    }  
 }
  
  whyte.cropperModal.on('shown.bs.modal', function() {
    if(whyte.croperOptions === undefined){
      var croperOptions = {
        aspectRatio: whyte.imageWidth/whyte.imageHeight,
        autoCrop: true,
        autoCropArea: 1.0,
        background: false,
        checkImageOrigin: true,
        dragCrop: false,
        guides: false,
        highlight: false,
        modal: true,
        movable: false,
        mouseWheelZoom: false,
        resizable: false,
        responsive: false,
        strict: true,
        touchDragZoom: false,
        zoomable: false
    };
  }else{
    var croperOptions = whyte.croperOptions;
  }

  whyte.image.cropper(croperOptions);
  }).on('hidden.bs.modal', function() {
    whyte.imageInput.val("");
    whyte.image.cropper('destroy');
  });

  
  $('#ConfirmCrop').on('click', function() {
    var rotator = '<div class="md-preloader pl-size-xs"><svg viewBox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" class="pl-blue" stroke-width="5"></circle></svg></div>'
    var loadingHtml = '<span id="ImageLoading"><span class="percentage lead col-blue">0%</span> '+rotator+' </span>';
    $('#ProgressInfo').html(loadingHtml);
    whyte.saveButton.attr('disabled',true);

    var croppedImage = whyte.image.cropper("getCroppedCanvas", {
      width: Math.min(whyte.imageWidth,whyte.image.cropper('getImageData').naturalWidth),
      height: Math.min(whyte.imageHeight,whyte.image.cropper('getImageData').naturalHeight)
    }).toDataURL();

    $.ajax({
      url : whyte.postUrl,
      type: "POST",
      data:  {
        image: croppedImage
      },
      success:function(data) {
        whyte.imageInput.val("");
        whyte.showImage(data);
      },
      xhr: function() {
        //To show Progress
        var xhr = $.ajaxSettings.xhr();
        if(xhr.upload){
          xhr.upload.addEventListener('progress',whyte.progress, false);
        }
        return xhr;
      },
      error: function(e){
        console.log(e);
        console.log('failed to upload image');
      },
      complete: function(){
        whyte.saveButton.attr('disabled',false);
        $('#ImageLoading').remove();
      }
    });
    whyte.image.cropper('destroy');
    whyte.cropperModal.modal('hide')
  });
});