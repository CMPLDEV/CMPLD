 shipping = (order_id)=>{  
  if(order_id){
   let url = admin_url+"/order/dimension";
   $.get(url,{order_id:order_id},function(res){
   $('.addedit-user-content').html(res);
   new bootstrap.Modal($('.addedit-user')).show();     
   });
  }   
 }

 getCourierPartners = ()=>{
  let url = admin_url+"/order/couriers";
  let form = $('#user-form')[0];
  let formData = new FormData(form);
  $.ajax({
    url:url,
    type:"POST",
    processData: false,
    contentType: false,
    data:formData,
    beforeSend:function(){
     $('.user-submit').prop('disabled','disabled');   
    },
    success:function(res, textStatus, jqXHR){
       $('.user-submit').prop('disabled',false); 
       if(jqXHR.status==201){ 
        if(res.error.hasOwnProperty('height')){
         notification('error',res.error.height[0]); 
        }if(res.error.hasOwnProperty('breadth')){
         notification('error',res.error.breadth[0]); 
        }if(res.error.hasOwnProperty('length')){
         notification('error',res.error.length[0]); 
        }if(res.error.hasOwnProperty('weight')){
         notification('error',res.error.weight[0]); 
        }if(res.error.hasOwnProperty('order_amount')){
         notification('error',res.error.order_amount[0]); 
        }if(res.error.hasOwnProperty('delivery_postcode')){
         notification('error',res.error.delivery_postcode[0]); 
        }if(res.error.hasOwnProperty('pickup_postcode')){
         notification('error',res.error.pickup_postcode[0]); 
        }if(res.error.hasOwnProperty('payment_mode')){
         notification('error',res.error.payment_mode[0]);  
        }if(res.error.hasOwnProperty('order_id')){
         notification('error',res.error.order_id[0]);   
        }
      }else{
        $('#user-modal').addClass('modal-lg');
        $('.addedit-user-content').html(res);
       }
       
    },error:function(res_code, textStatus, errorThrown){
      console.log(res_code); 
      $('.user-submit').prop('disabled',false); 
    }
   });
 }

 updateTrackingNo = (order_id)=>{
  if(order_id){
   let url = admin_url+"/order/tracking/update";  
   $.get(url,{order_id:order_id},function(res){
     $('.addedit-user-content').html(res);
     new bootstrap.Modal($('.addedit-user')).show();
   });
  }  
 }