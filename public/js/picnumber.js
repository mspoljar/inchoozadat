$('#picnumber').click(function(){
    count();
    return false;
 });
 
 function count(){
     $.ajax({
        url:'/index/picnumber',
         dataType: 'json',
         type: 'POST',
         success : function(number){
            document.getElementById("pic").innerHTML ='Current number of uploaded pictures is ' + jQuery.parseJSON(number);
           //console.log(number);
           //document.getElementById('pic').innerHTML='A';
           //alert('A');
         },
         error: function(textStatus,errorThrown){
             console.log(textStatus, errorThrown);
         }
     })
    
   // alert('ipjsdhaipfuhds')
 }