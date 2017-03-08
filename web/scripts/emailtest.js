$(document).ready(function(){
    console.log("Entro");
    $(".email").blur(function(){
       var email = this.value;
        console.log("Entro");
       $.ajax({
          url: URL+'/email-test',
          data: { email: email},
          type: 'POST',
          success: function(response){
              if(response == "Usado"){
                  $(".email").css("border", "1px solid red");
              }else{
                  $(".email").css("border", "1px solid green");
              }
          }
       });
    });
});