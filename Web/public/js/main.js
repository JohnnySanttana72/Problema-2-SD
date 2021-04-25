

$('#modal-edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('image_path') 
    var id = button.data('image_id') 

    var modal = $(this)
    modal.find('.modal-body #preview-image2').attr("src",path);
    modal.find('.modal-body #id_image').val(id);
    $('#path').append(path);
})


function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#preview-image1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputImage1").change(function(){
  console.log(this)
    readURL1(this);
});

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
      
        reader.onload = function (e) {
          
          $('#preview-image2').removeAttr('src');
          $('#preview-image2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputImage2").change(function(){
  console.log(this)
    readURL2(this);
});

$('#modal-edit').on('hidden.bs.modal', function () {

    // limpa o caminho da imagem do src
    $('#form2 p').each(function() {
       $(this).empty();
    });
});


// View Midias

// Image Cover
$('#modal-create-cover').on('hidden.bs.modal', function () {
    // limpa o inpute file
    var fileInput = document.getElementById('inputCover1')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

    // limpa o caminho da imagem do src
    $('#form #preview-cover1').each(function() {
       $(this).attr('src', 'https://via.placeholder.com/1400x1800/FFFFFF?text=Selecione uma Imagem de Capa'); 
    });
});

function readURLCover1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
          $('#preview-cover1').removeAttr('src');
          $('#preview-cover1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputCover1").change(function(){
  console.log(this)
    readURLCover1(this);
});

$('#modal-cover').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('file_path') 
    var id = button.data('file_id') 

    var modal = $(this)
    modal.find('.modal-body #preview-cover2').attr("src",path);
    modal.find('.modal-body #id_image').val(id);
    $('#path_cover').append(path);
})

$('#modal-cover').on('hidden.bs.modal', function () {
   var fileInput = document.getElementById('inputCover2')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#form2 #path_cover').each(function() {
       $(this).empty();
  });
});

function readURLCover2(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#form2 #path_cover').each(function() {
             $(this).empty();
        });

        $('#preview-cover2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$("#inputCover2").change(function(){
    readURLCover2(this);
});


// Image Banner
$('#modal-create-banner').on('hidden.bs.modal', function () {
  // limpa o inpute file
  var fileInput = document.getElementById('inputBanner1')
  fileInput.value = ''
  fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#preview-banner1').each(function() {
     $(this).attr('src', 'https://via.placeholder.com/1500x197/FFFFFF?text=Selecione uma Imagem de Banner'); 
      });
});

function readURLBanner1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#preview-banner1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputBanner1").change(function(){
    readURLBanner1(this);
});

$('#modal-banner').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('file_path') 
    var id = button.data('file_id') 

    var modal = $(this)
    modal.find('.modal-body #preview-banner2').attr("src",path);
    modal.find('.modal-body #id_image').val(id);
    $('#path_banner').append(path);
})

$('#modal-banner').on('hidden.bs.modal', function () {
   var fileInput = document.getElementById('inputBanner2')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#form2 #path_banner').each(function() {
       $(this).empty();
  });
});

function readURLBanner2(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#form2 #path_banner').each(function() {
             $(this).empty();
        });

        $('#preview-banner2').removeAttr('src');
        $('#preview-banner2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$("#inputBanner2").change(function(){
    readURLBanner2(this);
});


// Image Plant
$('#modal-create-plant').on('hidden.bs.modal', function () {
    // limpa o inpute file
    var fileInput = document.getElementById('inputPlant1')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

    // limpa o caminho da imagem do src
    $('#preview-plant1').each(function() {
       $(this).attr('src', 'https://via.placeholder.com/3100x1800/FFFFFF?text=Selecione uma Imagem da Planta'); 
    });
});

function readURLPlant1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#preview-plant1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputPlant1").change(function(){
    readURLPlant1(this);
});


$('#modal-plant').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('file_path') 
    var id = button.data('file_id') 

    var modal = $(this)
    modal.find('.modal-body #preview-plant2').attr("src",path);
    modal.find('.modal-body #id_image').val(id);
    $('#path_plant').append(path);
})

$('#modal-plant').on('hidden.bs.modal', function () {
   var fileInput = document.getElementById('inputPlant2')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#form2 #path_plant').each(function() {
       $(this).empty();
  });
});

function readURLPlant2(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#form2 #path_plant').each(function() {
             $(this).empty();
        });

        $('#preview-plant2').removeAttr('src');
        $('#preview-plant2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$("#inputPlant2").change(function(){
    readURLPlant2(this);
});


// Image Certifield
$('#modal-create-certified').on('hidden.bs.modal', function () {
  // limpa o inpute file
  var fileInput = document.getElementById('inputCertified1')
  fileInput.value = ''
  fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#preview-certified1').each(function() {
     $(this).attr('src', '{{asset("certified-test.pdf")}}'); 
      });
});

function readURLCertified1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#preview-certified1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputCertified1").change(function(){
    readURLCertified1(this);
});


$('#modal-certified').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('file_path') 
    var id = button.data('file_id') 

    var modal = $(this)
    modal.find('.modal-body #preview-certified2').attr("src",path);
    modal.find('.modal-body #id_image').val(id);
    $('#path_certified').append(path);
})

$('#modal-certified').on('hidden.bs.modal', function () {
   var fileInput = document.getElementById('inputCertified2')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#form2 #path_certified').each(function() {
       $(this).empty();
  });
});

function readURLCertified2(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#form2 #path_certified').each(function() {
             $(this).empty();
        });

        $('#preview-certified2').removeAttr('src');
        $('#preview-certified2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$("#inputCertified2").change(function(){
    readURLCertified2(this);
});


// Image Video
$('#modal-create-video').on('hidden.bs.modal', function () {
  // limpa o inpute file
  var fileInput = document.getElementById('inputImage')
  fileInput.value = ''
  fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#preview-image').each(function() {
     $(this).attr('src', 'https://via.placeholder.com/600x500/FFFFFF?text=Selecione uma Imagem'); 
    });
});

function readImageName(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputImage1").change(function(){
    readImageName(this);
});


$('#modal-video').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('file_path') 
    var id = button.data('file_id') 

    var modal = $(this)
    modal.find('.modal-body #preview-video2').attr("src",path);
    modal.find('.modal-body #id_image').val(id);

    if(!path.match('youtube')) {
      modal.find('.modal-body #preview-image-edit').attr("src",path);
    } else {
      modal.find('.modal-body #preview-image-edit').attr("src",'https://via.placeholder.com/600x500/FFFFFF?text=Selecione uma Imagem');
    }
})

$('#modal-video').on('hidden.bs.modal', function () {
   var fileInput = document.getElementById('inputImage2')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

    // limpa o caminho da imagem do src
    // $('#preview-image-edit').each(function() {
    //     $(this).attr('src', 'https://via.placeholder.com/600x500/FFFFFF?text=Selecione uma Imagem'); 
    // });
});

function readURLVideo2(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#form2 #path_video').each(function() {
            $(this).empty();
        });

        $('#preview-image-edit').removeAttr('src');
        $('#preview-image-edit').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$("#inputImage2").change(function(){
    readURLVideo2(this);
});


//link Youtube
$('#modal-create-video').on('hidden.bs.modal', function () {
  // limpa o inpute file
  var videoUrl = document.getElementById('inputVideo1')
  videoUrl.value = ''
  // fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#preview-video1').each(function() {
     $(this).attr('src', 'https://www.youtube.com/embed/C0DPdy98e4c'); 
  });
});

function getId(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);

    return (match && match[2].length === 11)
      ? match[2]
      : null;
}
    
$("#inputVideo1").on('input', function(event){
    var code = getId($('#url-name').text() + this.value)

    $('#preview-video1').attr('src', 'https://www.youtube.com/embed/'+ code);

    $(this).val('https://www.youtube.com/embed/'+ code);
    
});


$('#modal-video').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('file_path') 
    var id = button.data('file_id') 

    var modal = $(this)
    if(path.match('youtube')) {
      modal.find('.modal-body #preview-video2').attr("src",path);
    } else {
      modal.find('.modal-body #preview-video2').attr("src",'https://www.youtube.com/embed/C0DPdy98e4c');
    }
    
    modal.find('.modal-body #id_image').val(id);
    $('#path_video').append(path);
})

$('#modal-video').on('hidden.bs.modal', function () {
   var fileInput = document.getElementById('inputVideo2')
    fileInput.value = ''

  // limpa o caminho da imagem do src
  $('#form2 #path_video').each(function() {
       $(this).empty();
  });
});

$("#inputVideo2").on('input', function(event){
    var code = getId($('#url-name').text() + this.value)

    $('#preview-video2').attr('src', 'https://www.youtube.com/embed/'+ code);

    $(this).val('https://www.youtube.com/embed/'+ code);  
});


// Image Map
$('#modal-create-map').on('hidden.bs.modal', function () {
    // limpa o inpute file
    var fileInput = document.getElementById('inputMap1')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

    // limpa o caminho da imagem do src
    $('#preview-map1').each(function() {
       $(this).attr('src', 'https://via.placeholder.com/3100x1800/FFFFFF?text=Selecione a Imagem do Mapa'); 
    });
});

function readURLMap1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#preview-map1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputMap1").change(function(){
    readURLMap1(this);
});


$('#modal-map').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var path = button.data('file_path') 
    var id = button.data('file_id') 

    var modal = $(this)
    modal.find('.modal-body #preview-map2').attr("src",path);
    modal.find('.modal-body #id_image').val(id);
    $('#path_map').append(path);
})

$('#modal-map').on('hidden.bs.modal', function () {
   var fileInput = document.getElementById('inputMap2')
    fileInput.value = ''
    fileInput.dispatchEvent(new Event('change'))

  // limpa o caminho da imagem do src
  $('#form2 #path_map').each(function() {
       $(this).empty();
  });
});

function readURLMap2(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#form2 #path_map').each(function() {
             $(this).empty();
        });

        $('#preview-map2').removeAttr('src');
        $('#preview-map2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

$("#inputMap2").change(function(){
    readURLMap2(this);
});


$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#inputImage").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
        console.log(filesLength)
        $("#preview_images").empty();
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          console.log(f)
          $("<div class='col-sm-3 pip'>" +
            "<img class='img-fluid mb-2' src=\"" + e.target.result + "\" title=\"" + file.name + "\" />" +
            "<div class=\" btn-group\">" +
            "</div>").appendTo("#preview_images");
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

$(document).on("click",".remove", function(e){
    //     e.preventDefault();
    var input = document.getElementById('inputImage');

    var fileName
    $( ".pip .img-fluid" ).click(function() {
      fileName = $(this).attr('title')
      console.log(fileName)
    });
});

function click_button(id) {
    event.preventDefault();
    console.log(id)
    let phone = $("#input-"+id + " input[name=phone]").val();
    let _token   = $('meta[name="csrf-token"]').attr('content');

    if(phone.length == 15 || phone.length == 14 || phone.length == 0){
      $.ajax({
          url: "/speak_broker",
          type: 'POST',
          data: {
              phone: phone,
              _token: _token
          },
          dataType: 'JSON',
          beforeSend: function() {
            console.log(id)
            $('#load-input-'+id).css('display', 'block');
            $('#load-input-'+id).css('visibility', 'visible');
          },
          success: function(data){
              $('#load-input-'+id).css('display', 'none');
              $('#load-input-'+id).css('visibility', 'hidden');

              if(data.error == "invalid-field") {
                  $("#input-"+id).before('<div class="alert alert-danger alert-block" style="padding: .1rem 0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button><strong>'+
                    '<i class="fa fa-times-circle"></i> Erro. É necessário preencher o campo!</strong></div>')

                  $("#input-one input").val("");
                  $("#input-two input").val("");
                  $("#input-three input").val("");

              } else if(data.success == "successfully") {
                  $("#input-"+id).before('<div class="alert alert-sucess alert-block" style="padding: .1rem 0.2rem;color: #155724;background-color: #d4edda;border-color: #c3e6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button><strong>'+
                    '<i class="fa fa-check-circle"></i> Mensagem enviada com sucesso!</strong></div>')
                  
                  $("#input-one input").val("");
                  $("#input-two input").val("");
                  $("#input-three input").val("");
              } else if(data.error == "error-send-email") {
                $("input[name=name]").before(
                    '<div class="alert alert-danger alert-block" style="padding: .1rem '+
                    '0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-times-circle"></i> Erro. Houve um problema'+
                    'no envio da mensagem!</strong></div>'
                )
    
                $("#input-one input").val("");
                $("#input-two input").val("");
                $("#input-three input").val("");
            }
          }
      });

      return false;

    } else{
      $("#input-"+id).before('<div class="alert alert-warning alert-block" style="padding: .1rem 0.2rem;color: #856404;background-color: #fff3cd;border-color: #ffeeba;">'+
        '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button><strong>'+
        '<i class="fa fa-info-circle"></i> Número de Telefone inválido</strong></div>')
    }

}

function sendEmail(){
    event.preventDefault();

    let name = $("input[name=name]").val();
    let telephone = $("input[name=telephone]").val();
    let email = $("input[name=email]").val();
    let message = $("input[name=message]").val();
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/contact_form",
        type: 'POST',
        data: {
            name: name,
            telephone: telephone,
            email: email,
            message: message,
            _token: _token
        },
        dataType: 'JSON',
        beforeSend: function() {
          $('.load-content').css('display', 'block');
          $('.load-content').css('visibility', 'visible');
        },
        success: function(data){
            $('.load-content').css('display', 'none');
            $('.load-content').css('visibility', 'hidden');

            if(data.error == "invalid-fields") {
                $("input[name=name]").before(
                    '<div class="alert alert-danger alert-block" style="padding: .1rem '+
                    '0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-times-circle"></i> Erro. É necessário preencher '+
                    'todos os campos!</strong></div>'
                )
    
                $("input[name=name]").val("");
                $("input[name=telephone]").val("");
                $("input[name=email]").val("");
                $("input[name=message]").val("");
            } else if(data.success == "successfully") {
                $("input[name=name]").before(
                    '<div class="alert alert-sucess alert-block" style="padding: .1rem '+
                    '0.2rem;color: #155724;background-color: #d4edda;border-color: #c3e6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-check-circle"></i> Sua mensagem '+
                    'foi enviada com sucesso!</strong></div>'
                )
            
                $("input[name=name]").val("");
                $("input[name=telephone]").val("");
                $("input[name=email]").val("");
                $("input[name=message]").val("");
            } else if(data.error == "invalid-email") {
                $("input[name=name]").before(
                    '<div class="alert alert-danger alert-block" style="padding: .1rem '+
                    '0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-times-circle"></i> Erro. Insira um  '+
                    'email válido!</strong></div>'
                )
    
                $("input[name=email]").val("");
            } else if(data.error == "error-send-email") {
                $("input[name=name]").before(
                    '<div class="alert alert-danger alert-block" style="padding: .1rem '+
                    '0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-times-circle"></i> Erro. Houve um problema'+
                    'no envio da mensagem!</strong></div>'
                )
    
                $("input[name=email]").val("");
            }
        }
    });
    
    return false;
}

function sendEmailProperty(){
    event.preventDefault();

    let name = $("input[name=name]").val();
    let telephone = $("input[name=telephone]").val();
    let email = $("input[name=email]").val();
    let message = $("input[name=message]").val();
    let propertyName = $("input[name=property_name]").val();
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/contact_form",
        type: 'POST',
        data: {
            name: name,
            telephone: telephone,
            email: email,
            message: message,
            propertyName: propertyName,
            _token: _token
        },
        dataType: 'JSON',
        beforeSend: function() {
          $('.load-content').css('display', 'block');
          $('.load-content').css('visibility', 'visible');
        },
        success: function(data){
            $('.load-content').css('display', 'none');
            $('.load-content').css('visibility', 'hidden');
            
            if(data.error == "invalid-fields") {
                $("input[name=name]").before(
                    '<div class="alert alert-danger alert-block" style="padding: .1rem '+
                    '0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-times-circle"></i> Erro. É necessário preencher '+
                    'todos os campos!</strong></div>'
                )
    
                $("input[name=name]").val("");
                $("input[name=telephone]").val("");
                $("input[name=email]").val("");
                $("input[name=message]").val("");
            } else if(data.success == "successfully") {
                $("input[name=name]").before(
                    '<div class="alert alert-sucess alert-block" style="padding: .1rem '+
                    '0.2rem;color: #155724;background-color: #d4edda;border-color: #c3e6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-check-circle"></i> Sua mensagem '+
                    'foi enviada com sucesso!</strong></div>'
                )
            
                $("input[name=name]").val("");
                $("input[name=telephone]").val("");
                $("input[name=email]").val("");
                $("input[name=message]").val("");
            } else if(data.error == "invalid-email") {
                $("input[name=name]").before(
                    '<div class="alert alert-danger alert-block" style="padding: .1rem '+
                    '0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-times-circle"></i> Erro. Insira um  '+
                    'email válido!</strong></div>'
                )
    
                $("input[name=email]").val("");
            } else if(data.error == "error-send-email") {
                $("input[name=name]").before(
                    '<div class="alert alert-danger alert-block" style="padding: .1rem '+
                    '0.2rem;color: #975057;background-color: #f8d7da;border-color: #f5c6cb;">'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                    '<span aria-hidden="true">×</span></button><strong><i class="fa fa-times-circle"></i> Erro. Houve um problema'+
                    'no envio da mensagem!</strong></div>'
                )
    
                $("input[name=email]").val("");
            }
        }
    });
    
    return false;
}

$(document).ready(function() {
    $('.navbar-nav>li>a').on('click', function(){
        $('.navbar-collapse').collapse('hide');
    });
});

$("input[name=phone]").mask("(99) 9999-99999").focusout(function (event) {  
    var target, phone, element;  
    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
    phone = target.value.replace(/\D/g, '');
    element = $(target);  
    element.unmask();  
    if(phone.length > 10) {  
        element.mask("(99) 99999-9999");  
    } else {  
        element.mask("(99) 9999-9999");  
    }  
});

$("input[name=telephone]").mask("(99) 9999-99999").focusout(function (event) {  
    var target, phone, element;  
    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
    phone = target.value.replace(/\D/g, '');
    element = $(target);  
    element.unmask();  
    if(phone.length > 10) {  
        element.mask("(99) 99999-9999");  
    } else {  
        element.mask("(99) 9999-9999");  
    }  
});

