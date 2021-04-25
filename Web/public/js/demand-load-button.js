var page_filter = 2
var region_filter = $('#region_filter').val();
var status_filter = $('#status_filter').val();
var current_status = $('#current_status').val();

function click_load(id) {
    
    fetch_data(id, page_filter);
    page_filter++;
}

function fetch_data(id, page) 
{
    let _token   = $('meta[name="csrf-token"]').attr('content');
    var data = null;
    var url = ''
    if(region_filter != '' && typeof region_filter != "undefined"  || status_filter != '' &&  typeof status_filter != "undefined"){
        url = '/pagination-filter-region-status?page='
        data = {
            page: page,
            region_filter: region_filter,
            status_filter: status_filter,
            _token: _token,
        }
    } else if(current_status !== '' && typeof current_status !== "undefined") {
        url = '/pagination-filter-status?page='
        data = {
            page: page,
            current_status: current_status,
            _token: _token,
        }
    } else {
        url = '/pagination?page=';
        data = {
            page: page,
            _token: _token,
        }
    }

    $.ajax({
        url: url+page,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {
            $('.load-container').css('display', 'block');
            $('.load-container').css('visibility', 'visible');
        }
    }).done(function(response){
        $('.load-container').css('display', 'none');
        $('.load-container').css('visibility', 'hidden');
        
        if(isEmpty(response.properties.data) == false) {
            // console.log(response.properties)
            for(var i = 0; i <= (response.properties.data.length - 1); i++) {
                var content = '';
                var url = '/about/'+response.properties.data[i].name;
                // var url = '/about/'+response.properties.data[i].name
                // url = url.replace(':name', response.properties.data[i].name);

                // var base_url = '{{ url("/") }}';
                var base_url = '/';
                var found = false;
                for(var j = 0; j <= ( response.properties.data[i].media.length - 1); j++){
                    if(isEmpty(response.properties.data[i].media) == false) {
                        if(response.properties.data[i].media[j].type == 'imagem capa') {
                            content += '<div class="col-6 col-md-4 col-lg-4 mt-3 position-relative text-center" id="content">'+
                                `<a href="`+url+`">` 
                                if(response.properties.data[i].status == 'lançamento'){
                               content +=        
                                '<div class="row justify-content-center position-absolute w-100" style="z-index: 1; top:6px">' +
                                    '<div class="col-10 col-md-10 col-lg-9 col-sm-11" style="border-radius: 2px; background-color: #4a8600;">'
    
                                   + ` <p class="text-white text-center mb-1" id="status"><b>Lançamento</b></p>
                                    </div>
                                </div> `
                                }else if(response.properties.data[i].status == 'pré-lançamento'){
                                  content +=  
                                `<div class="row justify-content-center position-absolute w-100" style="z-index: 1; top:6px">
                                    <div class="col-10 col-md-10 col-lg-9 col-sm-11" style="border-radius: 2px; background-color: #00b1ff">
    
                                        <p class="text-white text-center mb-1" id="status"><b>Pré-Lançamento</b></p>
                                    </div>
                                </div> `
    
                                }else if(response.properties.data[i].status == 'entregue'){
                                    content+=
                                `<div class="row justify-content-center position-absolute w-100" style="z-index: 1; top:6px">
                                    <div class="col-10 col-md-10 col-lg-9 col-sm-11" style="border-radius: 2px; background-color: #841631;">
    
                                        <p class="text-white text-center mb-1" id="status"><b>Entregue</b></p>
                                    </div>
                                </div>`
                                    
                                }else if(response.properties.data[i].status== 'em construção'){
                                    content+=
                                `<div class="row justify-content-center position-absolute w-100" style="z-index: 1; top:6px">
                                    <div class="col-10 col-md-10 col-lg-9 col-sm-11" style="border-radius: 2px; background-color: #ffad00">
    
                                        <p class="text-white text-center mb-1 " id="status"><b>Em Construção</b></p>
                                    </div>
                                </div> `}
                                content +=
                                '<img src="'+base_url+response.properties.data[i].media[j].path+'" class="img-fluid" alt="">' +
                                '</a>' +
                            '</div>';
                            found = true;
                            $(content).insertAfter($('[id^="content"]').last());
                            break; 
                        } 
                    } 
                }

                if(!found) {
                    content += '<div class="col-6 col-md-4 col-lg-4" id="content">'+
                    '<a href="'+url+'">'+
                      '<img src="https://www.ferramentastenace.com.br/wp-content/uploads/2017/11/sem-foto.jpg" class="mt-3 img-fluid" alt="">'+
                    '</a>'+
                  '</div>'
                   $(content).insertAfter($('[id^="content"]').last());
                }       
            }
        } 
        else {
            $('#'+id).remove();
        }
    })
}


$(document).ready(function(){
    var page_question = 2

    $(document).on('click', '#paginate-question', function(){
        fetch_data_question(page_question);
        page_question++;
    })

    function fetch_data_question(page) {
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/pagination-question?page='+page,
            type: 'POST',
            data: {
                page: page,
                _token: _token,
            },
            dataType: 'json',
            beforeSend: function() {
                $('.load-container').css('display', 'block');
                $('.load-container').css('visibility', 'visible');
            }
        }).done(function(response){
            $('.load-container').css('display', 'none');
            $('.load-container').css('visibility', 'hidden');

            if(isEmpty(response.questions.data) == false) {
                
                for(var i = 0; i <= (response.questions.data.length - 1); i++) {

                    var content_question = '<div class="card card-style-layer mt-1" id="card">' +
                                '<div class="card-header card-style-header" id="heading'+ response.questions.data[i].id +'">' +
                                    '<h5 class="mb-0">' +
                                        '<a data-toggle="collapse" id="'+response.questions.data[i].id+'" onclick="changeIcon(this.id)" data-target="#collapse'+ response.questions.data[i].id +'" aria-expanded="false" aria-controls="collapse'+ response.questions.data[i].id +'">' +
                                            '<button class="btn btn-link title-questions" data-toggle="collapse" data-target="#collapse'+ response.questions.data[i].id +'" aria-expanded="false" aria-controls="collapse'+ response.questions.data[i].id +'">' +
                                                response.questions.data[i].title +
                                            '</button>'+
                                            '<i class="fas fa-plus float-right mt-lg-3"></i>'+
                                        '</a>'+
                                    '</h5>'+
                                '</div>'+
                                '<div id="collapse'+ response.questions.data[i].id +'" class="collapse" aria-labelledby="heading'+ response.questions.data[i].id +'" data-parent="#accordion">' +
                                    '<div class="card-body">' +
                                         '<p class="asnwer-questions">'+ response.questions.data[i].response +'</p>'+
                                    '</div>'+
                                '</div>' +
                            '</div>';

                    $(content_question).insertAfter($('[id^="card"]').last());
                                   
                }
            } 
            else {
                $('#paginate-question').remove();
            }
        })
    }

})


// const Item = ({ month, data_type }) => ;


var page_stage = 2
var current_status = $('#current_status').val();
function click_load_stage(id) {
    fetch_data_stage(id, page_stage);
    page_stage++;
}


function fetch_data_stage(id, page) {
    let _token   = $('meta[name="csrf-token"]').attr('content');
    var data = null;
    var url = ''

    if(current_status !== '' && typeof current_status !== "undefined") {
        url = '/pagination-filter-stage?page='
        data = {
            page: page,
            status: current_status,
            _token: _token,
        }
    } else {
        url = '/pagination-stage?page=';
        data = {
            page: page,
            _token: _token,
        }
    }

    $.ajax({
        url: url+page,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {
            $('.load-container').css('display', 'block');
            $('.load-container').css('visibility', 'visible');
        }
    }).done(function(response){
        $('.load-container').css('display', 'none');
        $('.load-container').css('visibility', 'hidden');
        // console.log(response)
        if(isEmpty(response.months) == false) {
            var content_stage = ``
            for(var i in response.months) {
                if(i % 2 == 0) {
                       content_stage += `<section id="section-details" class="bg-gray-primary">`
                } else {
                   content_stage += `<section id="section-details" class="bg-gray-secondary">`
                }

                content_stage += `<div class="container-fluid pt-3 pt-lg-5">
                                    <div class="row">
                                        <div class="col-12 col-lg-10 offset-lg-1 d-lg-flex text-center align-self-center">
                                            <span class="title-section-steps ">` + response.months[i].property.name + `</span>` 
                                        
                if (response.months[i].property.status == 'lançamento') {
                    content_stage += `<div class="box-status ml-lg-3 align-self-center">
                            <h3 class="text-desc-status mb-1 p-2 p-lg-2 pt-lg-1">Lançamento (Garanta esta oportunidade)</h3>
                    </div>`
                }
                else if(response.months[i].property.status == 'entregue') {
                    content_stage += `<div class="box-status ml-lg-3 align-self-center">
                        <h3 class="text-desc-status mb-1 p-2 p-lg-1 pt-lg-1">Entregue (Pronto para construir)</h3>
                    </div>`
                }
                
                else if(response.months[i].property.status == 'pré-lançamento') {
                    content_stage += `<div class="box-status ml-lg-3 align-self-center">
                        <h3 class="text-desc-status mb-1 p-2 p-lg-1 pt-lg-1">Pré-lançamento</h3>
                    </div>`
                }
                
                else {
                    content_stage += `<div class="box-status ml-lg-3 align-self-center">
                        <h3 class="text-desc-status mb-1 p-2 p-lg-1 pt-lg-1">Em construção</h3>
                    </div>`
                }

                content_stage += `</div>
                            </div>
                        </div>
                        <div class="container mt-3 mt-lg-4">

                            <div class="row justify-content-center">
                                <div class="col-8 col-lg-4">
                                    <h4 class="steps-index ml-2">PERCENTUAL DE REALIZAÇÃO</h4>
                                </div>

                                <div class="col-4 col-lg-4 offset-lg-4 align-self-center align-self-lg-start text-right">
                                    <h4 id="percent-text`+response.months[i].property_id+`" class="percent-step">`+ response.months[i].percentage +`%</h4>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="progress" style="height: 50px; border-radius: 130px;">
                                    <div id="percent-bar`+response.months[i].property_id+`" class="progress-bar bg-warning progress-bar-status" role="progressbar" style="width: `+ response.months[i].percentage +`%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2 mt-lg-0 ml-lg-1 mt-lg-3" id="buttonMonth`+response.months[i].property_id+`">
                                <div class="col-3 col-md-12 col-lg-1 ml-md-1 pr-0 pl-lg-0 pr-lg-0  text-left">
                                    <button class="btn btn-year" id="year`+response.months[i].property_id+`">`+response.months[i].year+`</button>
                                </div>`

                for (var j in response.data_type) {
                    if (response.data_type.hasOwnProperty(j)) {
                        for(k in response.data_type[j]) {
                            if (response.data_type[j].hasOwnProperty(k)) {
                                if(response.months[i].property_id == response.data_type[j][k].property_id) {
                                    var buttonId = `'buttonMonth${response.months[i].property_id}'`
                                        // console.log(response.data_type[j].length)
                                        if(k == 0) {
                                           content_stage += `<div class="col-2 col-md-1 col-lg-1 ml-md-3 ml-lg-0 mr-1 mr-md-3 mt-md-1 mt-lg-0 mr-lg-0 pl-0 pr-0 pl-md-1 pl-lg-1 pr-lg-0">
                                                               <button class="btn btn-months active btn-secondary" id="`+response.data_type[j][k].id+`" onclick="requestData(`+response.data_type[j][k].id+`, `+buttonId+`)">` + response.data_type[j][k].title + `</button>
                                                            </div>`
                                        } else if (k == (response.data_type[j].length - 1)) {
                                           content_stage += `<div class="col-2 col-md-1 col-lg-1 ml-md-2 ml-lg-1 pl-md-0 mr-1 mr-md-3 mt-md-1 mt-lg-0 mr-lg-0 pl-0 pr-0 pl-md-1 pl-lg-1 pr-lg-0">
                                                               <button class="btn btn-months btn-secondary" id="`+response.data_type[j][k].id+`" onclick="requestData(`+response.data_type[j][k].id+`, `+buttonId+`)">` + response.data_type[j][k].title + `</button>
                                                            </div>`     
                                        } else {
                                            content_stage += `<div class="col-2 col-md-1 col-lg-1 mr-1 mr-md-3 mt-md-1 mt-lg-0 mr-lg-0 pl-0 pr-0 pl-md-1 pl-lg-1 pr-lg-0">
                                                                <button class="btn btn-months" id="`+response.data_type[j][k].id+`" onclick="requestData(`+response.data_type[j][k].id+`, `+buttonId+`)">`+response.data_type[j][k].title+`</button>
                                                              </div>`

                                        }
                                }
                            }
                        }
                    }
                }
            
                content_stage += `</div>
                    <div class="row justify-content-center mt-3">
                    <div class="col-10">
                        <div id="carouselExampleControls`+response.months[i].id+`" class="carousel slide" data-ride="carousel">
                            <div class="load-container2 load5"><div class="loader">Loading...</div></div>
                            <div class="carousel-inner text-center" id="carousel-step`+response.months[i].property_id+`">`
                if(isEmpty(response.months[i].images)) {
                        content_stage += `<img src="https://www.ferramentastenace.com.br/wp-content/uploads/2017/11/sem-foto.jpg" class="img-fluid" alt="First slide">`
                    } else {
                        for (var l in response.months[i].images) {
                            if (response.months[i].images.hasOwnProperty(l)) {
                                if(l == 0) {
                                    content_stage += `<div class="carousel-item active" id="carousel-itens">`
                                } else {
                                    content_stage += `<div class="carousel-item" id="carousel-itens">`
                                }
                            content_stage += `<img class="d-block w-100" src="/`+response.months[i].images[l].path+`" class="img-fluid" alt="First slide">
                            </div>`
                            }
                        }
                    }
                                
                content_stage += `</div>
                            <a class="carousel-control-prev" href="#carouselExampleControls`+response.months[i].id+`" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-circle-left chevron-circle"></i></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls`+response.months[i].id+`" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-circle-right chevron-circle"></i></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

                    <div class="row justify-content-center pt-3">
                        <div class="col-10">
                        <p id="description`+response.months[i].property_id+`" class="text-desc-image pb-lg-3">`+response.months[i].description+`</p>
                        </div>
                    </div>
                </div>
            </section>`;
            }

            $(content_stage).insertAfter($('[id^="section-details"]').last());
 
        } 
        else {
            $('#'+id).remove();
        }
    })
}

function isEmpty(obj) {
    for(var prop in obj) {
        if(obj.hasOwnProperty(prop))
            return false;
    }
    
    return true;
}