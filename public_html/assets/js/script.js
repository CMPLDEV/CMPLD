$(document).ready(function(){
 $.ajaxSetup({
  headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
 });  
 //SET NOTIFICATION POSITION
 alertify.set('notifier','position', 'top-right');
 
 $('#is_shipping').click(function(){
  if($(this).is(':checked')){
   $('#shipping-address').removeClass('d-none');      
  }else{
   $('#shipping-address').addClass('d-none');
  } 
 });
 
 autocomplete();
});

autocomplete = ()=>{
 let url = site_url+"/autocomplete";
 let xhr;
  $('input[name="search_keyword"]').autoComplete({
   menuClass:'autocomplete-class',
   source: function(term, response){
   try { xhr.abort(); } catch(e){}
    xhr = $.getJSON(url, { q: term }, function(data){ response(data); });
   },onSelect(event, term, item){ 
    $('input[name="search_keyword"]').val(term);    
    $('.search-form').submit();
   }
  }); 
}

 notification = (type,msg,callback=null)=>{
  if(type){
   alertify.notify(msg, type, 3, callback);
  }
 }
 
 confirmation = (e,title,id)=>{
  e.preventDefault();
  alertify.confirm("Do you want to continue?",title,
   function(){
    window.location = $('#'+id).attr('href');
   },function(){
    //nothing to do
  });
 }

   getStates = (id, column='state')=>{
    let url = site_url+"/get-states";
    if(id!=0){
    $.ajax({
      type:"GET",
      url:url,
      dataType:"json",
      data:{id:id}, 
      success:function(res){       
        $("#"+column).empty();
        $("#"+column).append('<option value="">Choose state</option>');
        if(res){
        $.each(res,function(key,value){
          $("#"+column).append('<option value="'+key+'">'+value+'</option>');
        });
      }
    },error:function(res){
      console.log(res);
    }
    });
    }
   }

   setDefaultAddress = (address_id)=>{
    if(address_id){
      let url = site_url+"/user/set-default-address";
      $.get(url,{address_id:address_id},function(res){
        notification('success','Default address selected.',function(){
        window.location.reload();  
       });
      });
     }
    }

   subscription = ()=>{
     let email = $('.subscription_email');
     let url = site_url+"/send-subscription-verification-request";
     if(email.val()){
      if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.val())){
       notification('error','Please provide valid email.');
       email.focus();
      }else{
        $.ajax({
         url:url,
         type:"get",
         data:{email:email.val()},
         success:function(res){
          if(res){
           notification('success','A verification mail sent to you.');
           email.val("");
          }else{
           notification('error','You are already a subscriber.');           
          } 
         },error:function(response){
           console.log(response);
         }
       });
      }
     }else{
      notification('error','Please provide email.');
      email.focus();
     } 
   }
   
   disablePlaceOrder = (element)=>{
    setTimeout(function(){
     element.innerHTML = "Loading...";
     element.setAttribute('disabled',true);
    },1000); 
   }
   
   quickView = (product_id)=>{
    if(product_id){
     let url = site_url+"/quick-view";
     $.get(url,{product_id:product_id},function(res){
      $('#ajax-content').html(res);
      new bootstrap.Modal($('#ajaxModal')).show();
     });
    }
   }

   getRating = (rate)=>{
    document.getElementById("rating").value=rate; 
   }
 
   submitRating = ()=>{
     let url = site_url+"/submit-rating";
     var fdata = $('#rating-form').serialize();
     $.ajax({
       url:url,
       type:"POST",
       data:fdata,
       beforeSend:function(){
        $('.submit-rating').prop('disabled','disabled');   
       },
       success:function(res, textStatus, jqXHR){
        $('.submit-rating').prop('disabled',false); 
        if(jqXHR.status==201){ 
         if(res.error.hasOwnProperty('product_id')){
          notification('error',res.error.product_id[0]); 
         }if(res.error.hasOwnProperty('rating')){
          notification('error',res.error.rating[0]);  
         }
        }else{
         notification('success',"Rated successfully",function(){
          window.location.reload();
         }); 
        }
       },error:function(res_code, textStatus, errorThrown){
        if(res_code.status==401){
         notification('error',"At first please login.");
        } 
        $('.submit-rating').prop('disabled',false); 
       }
      });
     }

   addCompare = (id)=>{
    if(id){
      let url = site_url+"/add-compare";
      $.get(url,{id:id},function(res){
       let type;
       let message; 
  
       if(res==0){
        type = 'warning';
        message = "Compare list is full.";
       }else if(res==1){
        type = 'success';
        message = "Product added in compare list.";
       }else if(res==2){
        type = 'warning';
        message = "Product is already exist in compare list.";
       }else if(res==3){
        type = 'success';
        message = "Product added in compare list.";
       }
  
       notification(type,message);
  
      });  
     }
    }
   
 raiseTicket = ()=>{
  let serial_no = $('#serial_no');
  let url = site_url+"/user/raise-ticket";
   if(serial_no.val() == ""){
    notification('error','Please provide serial no.');
    serial_no.focus();
    return false;   
   }
   $.ajax({
    url : url,
    type: "GET",
    data: {serial_no:serial_no.val()},
    success: function(response, textStatus, jqXHR){
     if(jqXHR.status==201){ 
      notification("error",response.msg);        
     }else{ 
      $('.addedit-user-content').html(response);
      new bootstrap.Modal($('.addedit-user')).show();    
     }   
    }
   });
 }
 
 createTicket = ()=>{
  let url = site_url+"/user/submit-ticket";
  let form = $('#ajax-form')[0];
  let formData = new FormData(form);
  $.ajax({
    url: url,
    type: "POST",
    processData: false,
    contentType: false,
    data:formData,
    beforeSend:function(){
     $('.ajax-btn').prop('disabled','disabled');    
    },
    success:function(res, textStatus, jqXHR){
     $('.ajax-btn').prop('disabled',false); 
      if(jqXHR.status==201){ 
       if(res.error.hasOwnProperty('attachment')){
        notification('error',res.error.attachment[0]); 
       }if(res.error.hasOwnProperty('content')){
        notification('error',res.error.content[0]); 
       }if(res.error.hasOwnProperty('subject')){
        notification('error',res.error.subject[0]);
       }
      }else{
       bootstrap.Modal.getOrCreateInstance($('.addedit-user')).hide();
        notification('success',res.message,function(){
         window.location.reload();
        }); 
       }
    },error:function(res_code, textStatus, errorThrown){
      console.log(res_code); 
      $('.ajax-btn').prop('disabled',false); 
    }
  });
 }
 
 viewTicket = (ticket_id)=>{
  let url = site_url+"/user/view-ticket";
  $.get(url,{ticket_id:ticket_id},function(res){
   $('.addedit-user-content').html(res);
   new bootstrap.Modal($('.addedit-user')).show();     
  });
 }
 
   $('.sub_type').click(function(){
    let url = site_url+"/checkout/payment_type";
    $.get(url, {sub_type:$(this).val()}, function(res){
     $('#sub-type').html(res);    
    });
   });
 
   productNegotiation = (product_id)=>{
    if(product_id){
     let url = site_url+"/product-negotiation";    
     $.get(url, {product_id:product_id}, function(response){
      $('#ajax-content').html(response);
      new bootstrap.Modal($('#ajaxModal')).show();
     });    
    }    
   }
   
   submitProductNegotiation = ()=>{
    let url = site_url+"/product-negotiation/submit";
    let form = $('#negotiation-form')[0];
    let formData = new FormData(form);
    $.ajax({
      url:url,
      type:"POST",
      processData: false,
      contentType: false,
      data:formData,
      beforeSend:function(){
       $('.ajax-btn').prop('disabled','disabled');   
      },
      success:function(res, textStatus, jqXHR){
       $('.ajax-btn').prop('disabled',false); 
       if(jqXHR.status==201){ 
        if(res.error.hasOwnProperty('price')){
         notification('error',res.error.price[0]);  
        }if(res.error.hasOwnProperty('product_found_on')){
         notification('error',res.error.product_found_on[0]);  
        }if(res.error.hasOwnProperty('mobile')){
         notification('error',res.error.mobile[0]);  
        }if(res.error.hasOwnProperty('email')){
         notification('error',res.error.email[0]);  
        }if(res.error.hasOwnProperty('product_id')){
         notification('error',res.error.product_id[0]); 
        }
       }else{
        notification('success',res.message,function(){
         window.location.reload();
        }); 
       }
      },error:function(res_code, textStatus, errorThrown){
       $('.ajax-btn').prop('disabled',false); 
      }
     });
    }

  cancelOrder = (id)=>{
   if(id){
    let url = site_url+"/user/order/cancel";
    $.get(url, {id:id}, function(res){
     $('#ajax-content').html(res);  
     new bootstrap.Modal($('#ajaxModal')).show();
    });
   }      
  }

  checkPincodeAvailability = ()=>{
   let pincode = $('#delivery_pincode');
   //HANDLE ERROR
   if(pincode.val() === ''){
    notification('error','Please provide pincode.');
    pincode.focus();
    return false;
   }
   $('.ajax-btn').html('<div class="col-md-12 mt-1 text-center"><div class="spinner-border text-muted"></div></div>');
   let url = site_url+"/check-pincode-availability";
   $.get(url, {pincode:pincode.val()}, function(res){
    $('#pincode_response').html(res.msg);  
    $('.ajax-btn').html("Check Pincode");
   });
  }
  
  checkPincode = (pincode)=>{
   if(pincode === ''){
    notification('error','Please provide pincode.');
    return false;
   }
   if(pincode.length === 6){
   let url = site_url+"/check-pincode";
   $.get(url, {pincode:pincode}, function(response){
    if(response.is_delivery){
     $('#ord-btn').remove();  
     $('#error_span').remove();
     createOrderBtn();   
    }else{
     $('#ord-btn').remove(); 
     $('#error_span').remove();
     let error = document.createElement("span");
     error.innerHTML = "Delivery not available at this pincode.";
     error.setAttribute("class","text-danger fw-bold");
     error.setAttribute("id","error_span");
     document.getElementsByClassName("order-button-payment")[0].appendChild(error);
    }
   });
   }
  }
  
  createOrderBtn = ()=>{
   let button = document.createElement("button");
   button.setAttribute("type","submit");
   button.setAttribute("id","ord-btn");
   button.setAttribute("class","s-btn s-btn-2");
   button.innerHTML = "Place Order";
   button.addEventListener('click', ()=>{
    disablePlaceOrder(button);   
   });
   document.getElementsByClassName("order-button-payment")[0].appendChild(button);
  }
  
  returnRequest = (order_detail_id)=>{
   if(order_detail_id){
    $('.ajax-modal-dialog').addClass('modal-lg');   
    let url = site_url+"/user/order/return-refund/request";
    $.get(url, {order_detail_id:order_detail_id}, function(response){
     $('#ajax-content').html(response);
     new bootstrap.Modal($('#ajaxModal')).show();
    });
   }      
  }
  
  submitReturnRequest = ()=>{
   let url = site_url+"/user/order/return-refund/request";
   let form = $('#ajax-form')[0];
   let formData = new FormData(form);
   $.ajax({
     url: url,
     type: "POST",
     processData: false,
     contentType: false,
     data: formData,
     beforeSend:function(){ 
      $('.ajax-btn').html('<div style="text-align: center;"><div class="spinner-border spinner-size"></div></div>').prop('disabled','disabled');   
      },
      success:function(res, textStatus, jqXHR){
       $('.ajax-btn').html('Submit Request').prop('disabled',false); 
       if(jqXHR.status==201){ 
        if(res.error.hasOwnProperty('description')){
         notification('error',res.error.description[0]); 
        }if(res.error.hasOwnProperty('image')){
         notification('error',res.error.image[0]); 
        }if(res.error.hasOwnProperty('reason')){
         notification('error',res.error.reason[0]);
        }
       }else{
        notification('success',res.success,function(){
         window.location.reload();
        }); 
       }
      },error:function(res_code, textStatus, errorThrown){
        $('.ajax-btn').prop('disabled',false); 
      }
   });   
  }
  
  displayShowcase = (offset)=>{
   let i = 0;    
   let url = site_url+"/showcase";    
   $.get(url, {offset:offset}, function(response){
    $('#showcase').append(response);  
     $(".top-selling-active-2").owlCarousel({
      loop: true,
      margin: 10,
      autoplay: true,
      autoPlayTimeout:1000,
      autoplaySpeed:3000, 
      items: 5,
      navText: [
       '<i class="fa fa-angle-left"></i>',
       '<i class="fa fa-angle-right"></i>',
      ],
      nav: false,
      dots: false,
      responsive: {
       0: {
        items:2,
       },
       550: {
        items: 2,
        margin: 10,
       },
       767: {
        items: 3,
        margin: 10, 
       },
       900: {
        items: 3,
       },
       1200: {
        items: 4,
        margin: 30,
       },
       1600: {
        items: 5,
        margin: 30,
       },
      },
     }); 
    });
  }
  


 