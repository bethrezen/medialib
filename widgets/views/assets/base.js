var base_link = "/medialib/json/";
var upload_link = "/medialib/picture/upload";
var catid = 0;
var p = parent;



$(function (){

var myDropzone = new Dropzone(".dzone", {url: upload_link, clickable: false, createImageThumbnails: false, paramName: "Picture[file]"});
myDropzone.on("success", function(file, response) {
  console.log(response);
   var info = jQuery.parseJSON(response);
           if(info.success == false)
           {
              alert("Ошибка загрузки файла");
           }
           else
           {
               load_cat(catid);
           }
           $(".dzone").hide();
  });


$('.content').on(
    'dragover',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
         $(".dzone").hide();
    }
);
$('.content').on(
    'dragenter',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(".dzone").css("width", $(".content").width());
         $(".dzone").show();
    }
);
/*
$('.content').on(
    'drop',
    function(e){
        if(e.originalEvent.dataTransfer){
            if(e.originalEvent.dataTransfer.files.length) {
                e.preventDefault();
                e.stopPropagation();
                /*UPLOAD FILES HERE*/
          /*     
            }   
        }
    }
);
*/

$(".dzone").hide();

$.get(base_link + "catalog",
    function (response) {
       var data = jQuery.parseJSON(response);
       console.log(data);
       for(var i = 0; i < data.length; i++){

        var item = "<div class='rootcat' rel='" + data[i].id + "'>" + data[i].title + "</div>";
        if(data[i].items)
        {
          //console.log(data);
        var list = "";
        for(var j = 0; j < data[i].items.length; j++)
        {
          list += '<div class="subcat" rel="' + data[i].items[j].id + '">' + data[i].items[j].title + '</div>';
        }

          load_cat(data[i].id);
          item = "<div class='rootcat' rel='" + data[i].id + "'> + " + data[i].title + "</div> <div style='display:block' class='subcats" + data[i].id + "'>" + list + "</div>";

        }

        $(".leftpart").append(item);
        
       }
       $(".rootcat").first().addClass("selected");
       catid = $(".rootcat").first().attr("rel");

});



$(".sendfile").click(function(){
  if(catid != 0)
  {
      load_file();
  }
  else
  {
    alert("Выберите категорию");
  }
 });

//$(".fancybox").fancybox();


});

$( "body" ).load(function() {

    $(".leftpart").css("height", $(window).height() - 30);
    $(".content").css("height", $(window).height() - 30);
    $(".content").css("width", $(window).width() - $(".leftpart").width() - 60);

    $(".dzone").css("width", $(window).width() - $(".leftpart").width() - 60);
    $(".dzone").css("height", $(window).height() - 40)

});


$(document).on('mouseenter', '.masterTooltip', function(){
    var title = $(this).attr('title');
    $(this).data('tipText', title).removeAttr('title');
    $('<p class="tooltip"></p>')
    .html(title)
    .appendTo('body')
    .fadeIn('slow');
});

$(document).on('mousemove', '.masterTooltip', function(e){
    var mousex = e.pageX + 20; //Get X coordinates
    var mousey = e.pageY + 10; //Get Y coordinates
    $('.tooltip')
    .css({ top: mousey, left: mousex });
});

$(document).on('mouseleave', '.masterTooltip', function(e){
    $(this).attr('title', $(this).data('tipText'));
    $('.tooltip').remove();
});


$(document).on('click', '.rootcat', function(){
     
      
      var id = $(this).attr("rel");
      catid = id;
      $(".catid").val(catid);
      load_cat(id);
     // $(".subcats" + id).
    //  $(".subcats" + id).show();
      $(".subcat").removeClass("selected");
      $(".rootcat").each(function(){
          $(this).removeClass("selected");
      });
    $(this).addClass("selected");

});


$(document).on('click', '.subcat', function(){
      var id = $(this).attr("rel");
      catid = id;
      $(".catid").val(catid);
      load_cat(id);
      $(this).addClass("selected");
      
      $(".subcat").each(function () {
        console.log($(this).attr("class"));
        var currentId = $(this).attr("rel");
        if(currentId != id)
        {
          $(this).removeClass("selected");
        }
    });
      $(".rootcat").each(function(){
          $(this).removeClass("selected");
      })
});

$(document).on('click', '.image', function(){
  var id = $(this).attr("rel");
  parent.callback(id);
});

function load_cat(id)
{
    $.get(base_link + "items?catid=" + id,
      function(response){
      var data = jQuery.parseJSON(response);
      console.log(data);
      
      $(".content h3").html(data.title);
      $(".descr").html(data.more);

      if(data.items)
      {
        var list = "";
        for(var i = 0; i < data.items.length; i++)
        {
          //data.items[i].title = "Демоdf asdfa sdfa sd fsd" + i;
          var title = data.items[i].title;
          if(title)
          {
            if(data.items[i].title.length > 12)
            {
              title = data.items[i].title.slice(0, 12) + "...";
            }

             data.items[i].title += "<br/>";
          }
          else
          {
            data.items[i].title = "";
            title= "";
          }
            
          list += '<div class="image"  rel="' + data.items[i].id + '"><img title="' + data.items[i].title + 'Размер: ' +  data.items[i].size +  '" class="masterTooltip" src="' + data.items[i].img + '" /><div class="title">' + title + '</div></div>';
        }
        
      }
      $('.imglist').html(list);
    });
}

function load_file()
{

    var file_data = $('.ufile').prop('files')[0];   
    var form_data = new FormData();          
    if(file_data)
    {        
      form_data.append('Picture[file]', '');
      form_data.append('Picture[file]', file_data);
    }
    if($('.customUrl').val() != "")
      form_data.append('Picture[url]', $('.customUrl').val());   
    form_data.append('catid', $('.catid').val());
                             
    $.ajax({
        url: upload_link, // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
           var info = jQuery.parseJSON(php_script_response);
           if(info.success == false)
           {
              alert("Ошибка загрузки файла");
           }
           else
           {
             load_cat(catid);
             $(".ufile").val("");
             $(".customUrl").val("");
           }
        }
     });
}
