$(document).ready(function() {
	
	$.validate({
	    modules : 'location, date, security, file',
	    onModulesLoaded : function() {
	      $('#country').suggestCountry();
	    }
  	});

    setTimeout(function() {
      $("#successMessage").hide('blind', {}, 500)
    }, 7000);


  	$('.cancel').on('click', function() {
  		window.location.href=$(this).attr('rel');
  	})

  	$('.selAll').on('click', function () {
  		$obj = $(this);
  		if($obj.is(':checked')){
  			$obj.parents('thead').siblings('tbody').find('input[name="selData"]').prop('checked', true);;
  		} else {
  			$obj.parents('thead').siblings('tbody').find('input[name="selData"]').removeAttr('checked');
  		}
  	});

  	$('body').on('click', '.delSelected', function() {
  		$obj = $(this);
  		$tabClass = $obj.attr('rel');
  		$base_url = $obj.attr('data-base-url');
  		$arr = [];
  		$('#cnfrm_delete').find('.modal-body').find('input[name="ids"]').remove();
  		$('table.' + $tabClass).find('tbody').find('input[name="selData"]').each(function() {
  			$inpObj = $(this);
  			if($inpObj.is(':checked')){
  				$arr.push($inpObj.val());
  			}
  		});
  		if($arr.length > 0) {
  			//console.log($arr);
  			$('#cnfrm_delete').find('.yes-btn').attr('href', $base_url+$arr.join('-'));
  			$('#cnfrm_delete').modal('show');
  		}
  	});

  /* Script for profile page start here */

  $("#fileUpload").on('change', function () {
    if (typeof (FileReader) != "undefined") {
      var image_holder = $("#image-holder");
      image_holder.empty();
      var reader = new FileReader();
      reader.onload = function (e) {
        $("<img />", {
          "src": e.target.result,
          "class": "thumb-image setpropileam"
        }).appendTo(image_holder);
      }
      image_holder.show();
      reader.readAsDataURL($(this)[0].files[0]);
    } else {
      alert("This browser does not support FileReader.");
    }
  });


  $('#profileSubmit').on('click', function() {
    $res = 1;
    $('div.form-group').each(function() {
      if($(this).hasClass('has-error')){
        $res = 0;
      }
    });
    if($res == 1) {
      $('form').submit();
    }
  })

  $('#profileEmail').bind('change keyup', function() {
    $obj = $(this);
    $obj.parents('div.form-group')
        .removeClass('has-error')
        .find('span.text-red').remove();
    var email = $obj.val();
    var uId = $('[name="id"]').val();
    $.ajax({
      url:  $('body').attr('data-base-url') + 'user/checEmailExist',
      method:'post',
      data:{
        email :email,
        uId : uId
      }
    }).done(function(data) {
      if(data == 0) {
        $obj
        .after('<span class="text-red">This Email Already Exist...</span>')
        .parents('div.form-group')
        .addClass('has-error');
      }
    })
  })

  /* Script for profile page End here */

  /* Script for user page start here */
  $('.InviteUser').on('click', function() {
    $('#nameModal_user').find('.box-title').text('Invite People');
    $('#nameModal_user').find('.modal-body').html('<div class="row">'+
        '<div class="col-md-12 m-t-20 form-horizontal">'+
          '<label for="sEmail" class="">Enter Email Address</label>'+
          '<textarea name="emails" id="" rows="5" class="form-control"></textarea>'+
          '<span class="help-text">Enter Valid Emails Saperated by comma (,)</span>'+
          '<p>'+
            '<button class="btn btn-primary pull-right send-btn">Send</button>'+
          '</p>'+
        '</div>'+
      '</div>');
    $('#nameModal_user').modal('show');
  });

  $('.modal-body').on('click', '.send-btn', function() {
    $obj = $(this);
    $obj.html('<i class="fa fa-cog fa-spin"></i> Send');
    $obj.parents('div.row').find('.msg-div').remove();
    $emails = $obj.parents('.modal-body').find('textarea').val();
    if($emails != ''){
      $.ajax({
        url: $('body').attr('data-base-url') + 'user/InvitePeople',
        method:'post',
        data: {
          emails: $emails
        },
        dataType: 'json'
      }).done(function(data){
        if(data) {
          var part = '';
          if(data.noTemplate != 0){
            part = '<p><strong>Info:</strong> '+data.noTemplate+'</p>';
          }
          $obj.parents('div.row').prepend('<div class="col-md-12 m-t-20 msg-div"><div class="alert alert-info" role="alert">'+
          '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'+
          '<div class="msg-p">'+
          '<p><strong>Success:</strong> '+data.seccessCount+' Invitation Sent successfully</p>'+
          '<p><strong>Info:</strong> '+data.existCount+' Emails Alredy present in database</p>'+
          '<p><strong>Info:</strong> '+data.invalidEmailCount+' Invalid Emails Found</p>'+part+
          '</div>'+
          '</div>'+
        '</div>');
          $obj.html('Send');
        }
      });            
    } else {
      alert('Enter Email First');
    }
  });   

  $(".content-wrapper").on("click",".modalButtonUser", function(e) {
    $.ajax({
      url : $('body').attr('data-base-url') + 'user/get_modal',
      method: 'post', 
      data : {
        id: $(this).attr('data-src')
      }
    }).done(function(data) {
      $('#nameModal_user').find('.modal-body').html(data);
      $('#nameModal_user').modal('show'); 
    })
  });

/*  $("#nameModal_user").on("hidden.bs.modal", function(){
    $(this).find("iframe").html("");
    $(this).find("iframe").attr("src", "");
    });*/
  /* Script for user page end here */

  /* Script for Templates Starts here */
    $('.box-body').on('click', '.view_template', function() {
      $obj = $(this);
      $tmp_id = $obj.attr('data-src');
      $.ajax({
        url: $('body').attr('data-base-url') + "templates/preview",
        method:'post',
        data:{
          template_id: $tmp_id
        }
      }).done(function(data) {
        $('#previewModal').find('div.modal-body').html(data);
        $('#previewModal').modal('show');
        $('#previewModal').find('a').attr('href', 'javascript:;');
      });
    });

  $(".content-wrapper").on("click",".templateModalButton", function(e) {  
    $.ajax({
      url : $('body').attr('data-base-url') + "templates/modal_form",
      method: "post", 
      data : {
      id: $(this).attr("data-src")
      }
      }).done(function(data) {
      $("#nameModal_Templates").find(".modal-body").html(data);
      $("#nameModal_Templates").modal("show"); 
    })
  });
  /* Script for Templates End here */
});

$(".chosen-select").chosen();

$(".content-wrapper").on("click",".modalButtonEncuesta", function(e) {
  $.ajax({
    url : $('body').attr('data-base-url') + 'encuesta/get_modal',
    method: 'post', 
    data : {
      id: $(this).attr('data-src')
    }
  }).done(function(data) {
    $('#nameModal_encuesta').find('.modal-body').html(data);
    $('#nameModal_encuesta').modal('show'); 
    editMode = $('[name="id"]').val();
    if (editMode) {
      $.ajax({
        url: $('body').attr('data-base-url') + 'encuesta/get_encuesta'+'/'+editMode,
        method: 'get',
        dataType: 'json'
      }).done(function(data) {
        const { carrera, sede } = data;
        makeSelectSede(carrera, sede);
        makeSelectMaterias(carrera, sede, editMode);
      })
    }
  })
});


$(".modal-body").on("change", '[name="carrera"]', function(e) {
  var codigo = $(this).val();
  makeSelectSede(codigo, null);
})

$(".box-body").on("change", '[name="carrera"]', function(e) {
  var codigo = $(this).val();
  makeSelectSede(codigo, null);
})

$(".modal-body").on("change", '[name="sede"]', function(e) {
  let sede = $(this).val();
  let carrera = $('[name="carrera"]').val();
  $('[type="submit"]').prop('disabled', true);
  $.ajax({
    url: $('body').attr('data-base-url') + 'materia/pensum/'+sede+'/'+carrera, 
    method:'post',
    data: { sede, carrera }
  }).done(function(data) {
    if (data) {
      const resp = JSON.parse(data);
      if (resp.cod_respuesta == "1") {
        let { materias } = resp;
        $('#materias').find('option[value]').remove();
        materias.forEach(function(item) {
          $('#materias').append(`<option value="${item}">${item}</option>`);
        });
      }
    }
  }).always(function() {
    $('[type="submit"]').prop('disabled', false);
  })
})

function makeSelectSede(carrera, sede) {
  $.ajax({
    url: $('body').attr('data-base-url') + 'sede/get_sedes',
    method:'post',
    data: { codigo: carrera },
  }).done(function(data) {
    $('#sede').find('option[value]').remove();
    $('#sede').append('<option value="">Seleccione</option>');
    if (data) {
      JSON.parse(data).forEach(function(item) {
        $('#sede').append(`<option value="${item.codigo}" ${sede == item.codigo ? 'selected' : ''}>${item.sede}</option>`);
      });
    }
  });
}

function makeSelectMaterias(carrera, sede, encuesta) {
  $('[type="submit"]').prop('disabled', true);
  $.ajax({
    url: $('body').attr('data-base-url') + 'materia/pensum/'+sede+'/'+carrera, 
    method:'post',
    data: { sede, carrera }
  }).done(function(data) {
    if (data) {
      const resp = JSON.parse(data);
      if (resp.cod_respuesta == "1") {
        let { materias } = resp;
        $('#materias').find('option[value]').remove();
        $.ajax({
          url: $('body').attr('data-base-url') + 'encuesta/get_materias'+'/'+encuesta,
          method: 'get',
          dataType: 'json'
        }).done(function(data) {
          if (data) {
            materias.forEach(function(item) {
              const selected = data.find(x => x.materia == item);
              $('#materias').append(`<option ${selected ? 'selected' : ''} value="${item}">${item}</option>`);
            });
          }
        })
      }
    }
  }).always(function() {
    $('[type="submit"]').prop('disabled', false);
  })
}

function setId(id, module) {
  var url =  $('body').attr('data-base-url');
  $("#cnfrm_delete").find("a.yes-btn").attr("href",url+"/"+ module +"/delete/"+id);
}

function resizeIframe(obj) { 
  obj.style.height = obj.contentWindow.document.body.scrollHeight + "px";
}