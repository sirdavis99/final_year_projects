// main.js
// Author :: Friday David
var scripts = [];

function alert_notify(msg, bg="info", icon="travel_info"){
    $.notify({
    	icon: "now-ui-icons "+icon,
    	message: msg

    },{
        type: bg,
        timer: 4000,
        placement: {
            from: "top",
            align: "right"
        }
    });
}
//------------------------------
//asyncronous requests
//------------------------------
function post(forms){
    progress_load();
    var form = document.getElementById(forms);
    var action = 'demon/r/'+forms+'';
    var form_data = new FormData(form);
    for([key, value] of form_data.entries()){
//	   console.log(key + ':'+  value);
    }
    disable_inputs('button, form#'+forms+' :input');
    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
//    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var result = xhr.responseText;
            // console.log(result);
            disable_inputs('button, form#'+forms+' :input');
            validatefromData(result, forms);
            progress_load('stop');
        }
    };
    xhr.send(form_data);
}

function posts(forms){
    var action = $('form#'+forms).attr("act");
    form_data = get_form_data(forms),
    address = localaddr+action+"/"+forms;
    // console.log(form_data);
    // progress_load();
    $.ajax({
       url : address,
       type: 'POST',
       data: form_data,
       success:function(data){
           console.log(data);
           validatefromData(data, forms);
           // progress_load('stop');
       }
    });
}

function getscope(address, place=false){
    progress_load();
    $.get('?'+address+'', function(data){
       console.log(data);
        validatefromData(data, place);
        refresh_all_scripts();
        progress_load('stop');
    });

}
//------------------------------
//form functions
//------------------------------
function disable_inputs(elements){
    var element = $(elements);
    if(element.attr('disabled')){
        element.attr('disabled', 'disabled');
    }else{
        element.removeAttr('disabled');
    }
}

function alert_manager(){
  $('#alert-manager').ready(function(){
    // console.log('alert-manager-loaded');
    // alert timeout to hide after {5000}
    setTimeout(function(){ 
        $("div.alert-timeout").fadeOut();
    }, 10000);

    let form = $('.alert').attr('manager-form'),
        form_target = $('.alert').attr('manager-target'),
        inputs = form_target.split(",");
    
    // reset form if success
    if($('.alert').hasClass('alert-success')){ 
        // console.log("success");
        $("#"+form+" [name]").val('');
        // .html(''); 
    }

    // toggle invalid input if exists
    toogleinvalidinput(form, inputs);
    
  });

}

function toogleinvalidinput(forms, field){
    function show_input(input){
//        console.log(input.parent().children('.input-group-text'));
        input.parent().find('.input-group-text').addClass("border-danger");
        input.addClass('border-danger is-invalid');
        input.change(function(e){
            $(this).removeClass('border-danger is-invalid');
        });
        // $('html, body').animate({
        //     scrollTop: input.offset().top
        // }, 2000);

    }

    if(typeof(field) === "object"){
        var query = "", index = 0,field_length = field.length - 1;
        field.forEach(function(value){
            query = query + 'form#'+forms+' :input[name="'+value+'"]';
            if(index < field_length){
                query = query + ', ';
            }else{
                query = query + ' ';
            }
            index++;
        });
//        console.log(query);
        var query_construct = $(query);
        show_input(query_construct);
    }else{
        var query_construct = $('form#'+forms+' :input[name="'+field+'"]');
        show_input(query_construct);
    }
}

function get_form_data(forms){

    var form = $("form#"+forms),
        data = {};

    form.find('[name]').each(function(index, value){
        var name = $(this).attr('name');
        data[name] = $(this).val();
    });
    return data;
}

function copyclip(){
    $("[copy-clip]").click(function(e){

        var copyElement = $(this).attr("copy-clip"),
            copyText = document.getElementById(copyElement);

        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied to Clipboard");

    });
    
}

function check_file_data(){
    $('form :input[type="file"]').change(function(e){
       var next = $(this).next();
       var vall = this.value.split("\\");
       console.log(vall);
       next.html(vall.pop());
    });
}

function theSame(){
    function auth(pass, element){
        if($(element).val() === $('[data-valid='+pass+']').val()){
           $(element).parent().find('.input-group-text').addClass('border_success valid').removeClass('border-danger is-invalid');
           $(element).removeClass('border-danger is-invalid').addClass('border_success is_valid');
           $('button').removeAttr('disabled');
       }else{
          $(element).parent().find('.input-group-text').removeClass('border_success valid').addClass('border-danger is-invalid');
          $(element).removeClass('border_success is_valid').addClass('border-danger is-invalid');
          $('button').attr('disabled', 'disabled');
       }
    }
    $('[data-pass]').on('input', function(){
       var pass = $(this).attr('data-pass');
       auth(pass, this);
    });
    $('[data-valid]').change(function(){
       var pass = $(this).attr('data-valid');
       var element = $('[data-pass='+pass+']');
       auth(pass, element);
    });
}
//------------------------------
//other  functions
//------------------------------
function makeblur(){
    $('[blurthis]').mouseenter(function(){
        var target = $(this).attr('blurthis');
        $(target).toggleClass('bg-blur');
    });
    $('[blurthis]').mouseleave(function(){
        var target = $(this).attr('blurthis');
        $(target).toggleClass('bg-blur');
    });
}

function hovershow(){
    function hovers(x, view=1){
//        console.log(typeof($(x).attr('flowtarget')));
        if($(x).attr('flowtarget')){
            var target = $(x).attr('flowtarget');
            if(view === 1){
                $(target).fadeIn('slow').toggleClass('d-none');
            }else{
                $(target).fadeOut('slow').toggleClass('d-none');
            }
        }else{
            alerts('Please refresh this page', 'info');
        }
    }
    $('[flowshow=true]').mouseenter(function(){
        hovers(this);
    });
    $('[flowshow=true]').mouseleave(function(){
        hovers(this, 0.2);
    });
}

function progress_load(load = 'load'){
    if(load === 'load'){
        var percentage = 0;
        $('#firstprogress').css('display', 'flex');
        var timer = setInterval(function(){
            percentage = percentage + 5;
            if(percentage <= 90){
                $('#firstprogress .progress-bar').css('width', percentage + '%');
            }else{
                // $('.progress').css('display', 'none');
                clearInterval(timer);
            }
        }, 700);
    }else{
        $('#firstprogress .progress-bar').css('width', 100 + '%');
        $('#firstprogress').fadeOut('slow');
        clearInterval(timer);
    }

}

function autosettoType(){
    $('.modal-dialog>div').css('margin-top', 200);
    // btns.attr('type', 'button');
}

function Goto(address, wait){
    setTimeout(function(event){
        window.location = address;
    }, wait);
}

function datapost(){
    $('[data-post]').on('click', function(e){
        if($(this).attr('data-post') !== ""){
            var form = $(this).attr('data-post');
            if($(this).attr('data-file')){ post(form); }
            else{ posts(form); }
        }
    });
}

function load_pages(){
    $('[data-get]').on('click', function(){
        if($(this).attr('data-get') !== "" && $(this).attr('data-view') !== ""){
            var reqs = $(this).attr('data-get');
            var view = $(this).attr('data-view');
            getscope(reqs, view);
        }else{
            alert_notify('Refresh this page now .... ', 'info');
        }
    });
}

function ModalWork(){
    $('[data-modal]').on('click', function(){
        if($(this).attr('data-modal') !== ""){
            $('.modal-header .title, .modal-header p.category, .modal-footer').html('');
            $('.modal-body').html(
                '<p class="p-3 text-center text-secondary loader-modal"><span class="spinner-border spinner-border-sm"></span>&nbsp;Loading...</p>'
                );
            $query = $(this).attr('data-modal');
            getscope($query);
        }else{
            alert_notify('Refresh this page now .... ', 'info');
        }
    });
}

function specialgets(){
    $('[data-confirm-get]').on('click', function(){
        if(confirm('Confirm Action?')){
            var link = $(this).attr('data-confirm-get');
            getscope(link);
        }
    });
}

function setheights(){
    var winheight = $(window).height();
    var winwidth = $(window).width();
    var headheight = $('header').height();
    var footheight = $('footer').height();
    var mainheight = winheight - (headheight);
    if(winwidth > 600){
            $('.sena').height(mainheight-80);
            $('.rightpanel').height(mainheight);
    }
}

function charts(){
    var chartData = {
            labels: ['The Wooday', 'Avalance Night', 'KillerTunes'],
            datasets : [{
                borderColor: "#0000ff",
                pointBorderColor: "#fff",
                pointBackgroundColor: "#0000ff",
                backgroundColor: "linear-gradient(to bottom, rgba(33, 6, 8, 0.5) 0%, (33, 6, 8, 0.5) 100%)",
                data : [0, 0, 0]
            },
            {
                borderColor: "#6610f2",
                pointBorderColor: "#fff",
                pointBackgroundColor: "linear-gradient(to bottom, rgba(249, 99, 50, 0.5) 0%, rgba(249, 99, 50, 0.5) 100%)",
                backgroundColor: "#fff",
                data : [0, 0, 0]
            }]
    };

    var chLine = document.getElementById("small_sales_chart");
    if (chLine) {
        new Chart(chLine, {
                type: 'line',
                data: chartData,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                    beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
        });
    }
}


function togdisabled(){
    $('[togdis]').on('click', function(){
        var target = $(this).attr('togdis');
        if($(target).attr('disabled') === 'disabled'){
            $(target).removeAttr('disabled');
        }else{
           $(target).attr('disabled', 'disabled');
        }
    });
}

// function loadable_buttons(){
//     $('[data-post]').on('click', function(e){
//       var btn = $(this);
//       var val = btn.html();
//       btn.html('<span class="spinner-border spinner-border-sm"></span>&nbsp;&nbsp;Loading...');
//       var observer = new MutationObserver(function(mutations, observer) {
//           btn.html(val);
// //        console.log(mutations, observer);
//      });
//       observer.observe(document, {
//         subtree: true,
//         attributes: true
//             //...
//       });
//     });
// }

function viewndhide(){
    $('[vnh]').click(function(){
        var place1 = $(this).attr('vnh');
        var place2 = $(this).attr('vhtarget');
        $(place1).toggleClass('d-none');
        $(place2).toggleClass('d-none');
    });
}

function confirm_navigate(){
    $('[confirm]').click(function(e){
        e.preventDefault;
        let msg = $(this).attr("confirm"),
            addr= $(this).attr("confirm-href");


        if(confirm(msg)){
            window.location = addr;
        }
    });
}

function quickToggleClass(){
    $('[class-toggle]').click(function(){
        let tog_class = $(this).attr('class-toggle'),
            tog_target = $(this).attr('data-target');

        $(tog_target).toggleClass(tog_class);
    });
}

function solveprice(){
    $('[p-loaders]').change(function(){
       $(this).attr('p-loaders', $(this).val());
       var amm = $(this).attr('p-loaders');
       var add = $($(this).attr('p-catalyst')).val();
       var total = amm * add;
//       console.log(total);
       $($(this).attr('p-endpoint')).html(total);
    });
}

function viewer(){
    $('[show]').click(function(){
        var target = $(this).attr('show');
        $(target).toggleClass('d-none');
    });
}

function fixNavScroll(){
    window.onscroll = function(){
        if(document.body.scrollTop >50 || document.documentElement.scrollTop > 50){
            $('.sela-nav').removeClass('navbar-transparent').addClass('position-fixed shadow bg-primary');
        }else{
            $('.sela-nav').addClass('navbar-transparent').removeClass('position-fixed shadow bg-primary');
        }
    };
}

function add_extra(element, choice){
    $('button').attr('disabled', 'disabled');
    $('#'+element).append('<div class="loadbar text-secondary"><i class="spinner-border spinner-border-sm"></i>&nbsp;&nbsp;Loading...</div>');
    getscope(choice, element);
}

function delCell(element){
    var cell = $(element).parent();
    if(confirm('You are about to Delete this Cell?')){
        cell.remove();
    }

}

function datepicker(){
    if($(".datepicker").length != 0){
      $('.datepicker').datetimepicker({
         format: 'YYYY/MM/DD',
         icons: {
             time: "now-ui-icons tech_watch-time",
             date: "now-ui-icons ui-1_calendar-60",
             up: "fa fa-chevron-up",
             down: "fa fa-chevron-down",
             previous: 'now-ui-icons arrows-1_minimal-left',
             next: 'now-ui-icons arrows-1_minimal-right',
             today: 'fa fa-screenshot',
             clear: 'fa fa-trash',
             close: 'fa fa-remove'
         }
      });
    }
}

function ChangeMode() {
    $('#change-mode').on('click', function(e){
        e.preventDefault();
        // $(this).toggleClass('white text-dark btn-outline-black');
        $('footer, .card , .wrapper-ul').toggleClass('dark-card-admin');

        $('.card-body-cascade').toggleClass('dark-card-bg');
        $('body, .navbar, main').removeClass('bg-white').toggleClass('white-skin navy-blue-skin');
        $('body, .dropdown-menu').toggleClass('dark-bg-admin');
        $('h2, h3, h4, h6, .card, p, td, th, i, li a, input, label').not(
          '#slide-out i, #slide-out a, .dropdown-item i, .dropdown-item').toggleClass('text-white');
        $('.dropdown-item').toggleClass('text-white');
        $('.btn-dash').toggleClass('grey blue').toggleClass('lighten-3 darken-3');
        $('.gradient-card-header').toggleClass('white black lighten-4');
        $('.list-panel a').toggleClass('navy-blue-bg-a text-white').toggleClass('list-group-border');
        $('.card-transparent').toggleClass('dark-mode-card-transparent');
        $('.lighten-3').toggleClass('darken-4');
    });
}

//------------------------------
//startup functions
//------------------------------
function Startups(){
    $('title').html($('#titler').attr('tic-title'));
    startupFnx();
}

function startupFnx(){
    //startup some functions
    ChangeMode();
    alert_manager();
    // ModalWork();
    // datepicker();
    // makeblur();
    load_pages();
    // specialgets();
    // datapost();
    // autosettoType();
    // quickToggleClass()
    // hovershow();
    // viewer();
    // viewndhide();
    // solveprice();
    togdisabled();
    // loadable_buttons();
    // fixNavScroll();
    copyclip();
    confirm_navigate();
}
//------------------------------
//validator functions
//------------------------------

//------------------------------
//other scripts
//------------------------------
$(document).ready(function(){
   startupFnx();
});
