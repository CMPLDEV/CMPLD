$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });  
//SET NOTIFICATION POSITION
 alertify.set('notifier','position', 'top-right');
    
});

 notification = (type,msg,callback=null)=>{
  if(type){
   alertify.notify(msg, type, 2, callback);
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

 checkboxValidation = ()=>{
  if(confirm("Do you really want to continue?")==false){
    return false;
  }else{
  if($("[id='ids[]']:checked").length <= 0){
    notification('error',"Please select at least one !");  
    return false;
  }}}

 subadminModal = (id=null)=>{
  let url = admin_url+"/subadmin/add";
  $.get(url,{id:id},function(res){
   $('.addedit-user-content').html(res);
   new bootstrap.Modal($('.addedit-user')).show();
   $('.selectpicker').selectpicker();
  });
 }

 createSubadmin = (id)=>{ 
  var url = (id==0) ? admin_url+"/subadmin/create" : admin_url+"/subadmin/update";
  var fdata = $('#user-form').serialize();
  $.ajax({
    url:url,
    type:"POST",
    data:fdata,
    beforeSend:function(){
     $('.user-submit').prop('disabled','disabled');   
    },
    success:function(res, textStatus, jqXHR){
       $('.user-submit').prop('disabled',false); 
       if(jqXHR.status==201){ 
       if(res.error.hasOwnProperty('roles')){
        notification('error',res.error.roles[0]);  
       }if(res.error.hasOwnProperty('password') && id===0){
        notification('error',res.error.password[0]);  
       }if(res.error.hasOwnProperty('mobile')){
        notification('error',res.error.mobile[0]);  
       }if(res.error.hasOwnProperty('email')){
        notification('error',res.error.email[0]); 
       }if(res.error.hasOwnProperty('name')){
        notification('error',res.error.name[0]);
       }
      }else{
       
       notification('success',res.success,function(){
        window.location.reload();
       }); 
     }
       
    },error:function(res_code, textStatus, errorThrown){
     console.log(res_code); 
     $('.user-submit').prop('disabled',false); 
    }
   });
 }


 userAddressModal = (id,type)=>{ 
  $('#user-modal').addClass('modal-lg');
  let url = admin_url+"/user/address/view";
  $.get(url,{id:id,type:type},function(res){
    $('.addedit-user-content').html(res);
    new bootstrap.Modal($('.addedit-user')).show();
    $('.selectpicker').selectpicker();
  });
 }

 userAddAddressModal = (id,type,user_id='')=>{ 
  $('#user-modal').addClass('modal-lg');
  let url = admin_url+"/user/address/add";
  $.get(url,{id:id,type:type,user_id:user_id},function(res){
    $('.addedit-user-content').html(res);
    $('.selectpicker').selectpicker();
  });
 }

 createUserAddress = (type)=>{
  var url = (type=='add') ? admin_url+"/user/address/create" : admin_url+"/user/address/update";
  var fdata = $('#user-form').serialize();
  $.ajax({
    url:url,
    type:"POST",
    data:fdata,
    beforeSend:function(){
     $('.user-submit').prop('disabled','disabled');   
    },
    success:function(res, textStatus, jqXHR){
       $('.user-submit').prop('disabled',false); 
       if(jqXHR.status==201){ 
       if(res.error.hasOwnProperty('pincode')){
        notification('error',res.error.pincode[0]);   
       }if(res.error.hasOwnProperty('state')){
        notification('error',res.error.state[0]);   
       }if(res.error.hasOwnProperty('country')){
        notification('error',res.error.country[0]);   
       }if(res.error.hasOwnProperty('address')){
        notification('error',res.error.address[0]);   
       }if(res.error.hasOwnProperty('city')){
        notification('error',res.error.city[0]);   
       }if(res.error.hasOwnProperty('email')){
        notification('error',res.error.email[0]);   
       }if(res.error.hasOwnProperty('mobile')){
        notification('error',res.error.mobile[0]); 
       }if(res.error.hasOwnProperty('name')){
        notification('error',res.error.name[0]); 
       }
      }else{
        
        notification('success',res.success,function(){
          window.location.reload();
        }); 

       }
       
    },error:function(res_code, textStatus, errorThrown){
      console.log(res_code); 
      $('.user-submit').prop('disabled',false); 
    }
   });
 }

 userModal = (id=null)=>{
  let url = admin_url+"/user/add";
  $.get(url,{id:id},function(res){
    $('.addedit-user-content').html(res);
    new bootstrap.Modal($('.addedit-user')).show();
    $('.selectpicker').selectpicker();
  });
 }

 createUser = (id)=>{
  var url = (id==0) ? admin_url+"/user/create" : admin_url+"/user/update";
  var fdata = $('#user-form').serialize();
  $.ajax({
    url:url,
    type:"POST",
    data:fdata,
    beforeSend:function(){
     $('.user-submit').prop('disabled','disabled');   
    },
    success:function(res, textStatus, jqXHR){
       $('.user-submit').prop('disabled',false); 
       if(jqXHR.status==201){ 
       if(res.error.hasOwnProperty('password') && id==0){
        notification('error',res.error.password[0]);   
       }if(res.error.hasOwnProperty('mobile')){
        notification('error',res.error.mobile[0]);   
       }if(res.error.hasOwnProperty('email')){
        notification('error',res.error.email[0]); 
       }if(res.error.hasOwnProperty('name')){
        notification('error',res.error.name[0]);   
       }
      }else{
        
        notification('success',res.success,function(){
          window.location.reload();
        }); 

       }
       
    },error:function(res_code, textStatus, errorThrown){
      console.log(res_code); 
      $('.user-submit').prop('disabled',false); 
    }
   });
 }

 deleteUser = (id)=>{
  var url=admin_url+"/user/delete";
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
       $.ajax({
         url:url,
         type:"GET",
         data: {id:id},
         success:function(data){
          notification('success','Deleted successfully.',function(){ 
            window.location.reload(); 
          });
         }
       });
      }
    })
  }
  
   
  categoryModal = (id=null)=>{
    $('#user-modal').addClass('modal-lg');
    let url = admin_url+"/category/add";
    $.get(url,{id:id},function(res){
      $('.addedit-user-content').html(res);
      new bootstrap.Modal($('.addedit-user')).show();
      $('.selectpicker').selectpicker();
    });
   }
  
  createCategory = (id)=>{
    var url = (id==0) ? admin_url+"/category/create" : admin_url+"/category/update";
    var form = $('#user-form')[0];
    var formData = new FormData(form);
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
         if(res.error.hasOwnProperty('catalog')){
          notification('error',res.error.catalog[0]); 
         }
         if(res.error.hasOwnProperty('image')){
          notification('error',res.error.image[0]); 
         }if(res.error.hasOwnProperty('parent_id')){
          notification('error',res.error.parent_id[0]);   
         }if(res.error.hasOwnProperty('name')){
          notification('error',res.error.name[0]); 
         }
        }else{
          
          notification('success',res.success,function(){
            window.location.reload();
          }); 
  
         }
         
      },error:function(res_code, textStatus, errorThrown){
        console.log(res_code); 
        $('.user-submit').prop('disabled',false); 
      }
     });
   }

  deleteCategory = (id)=>{
    var url=admin_url+"/category/delete";
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
         $.ajax({
           url:url,
           type:"GET",
           data: {id:id},
           success:function(data){
            notification('success','Deleted successfully.',function(){ 
              window.location.reload(); 
            });
           }
         });
        }
      })
  
    }
    
 brandModal = (id=null)=>{
    $('#user-modal').addClass('modal-lg');
    let url = admin_url+"/brand/add";
    $.get(url,{id:id},function(res){
      $('.addedit-user-content').html(res);
      new bootstrap.Modal($('.addedit-user')).show();
      $('.selectpicker').selectpicker();
    });
   }
  
 createBrand = (id)=>{
    var url = (id==0) ? admin_url+"/brand/create" : admin_url+"/brand/update";
    var form = $('#user-form')[0];
    var formData = new FormData(form);
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
         if(res.error.hasOwnProperty('catalog')){
          notification('error',res.error.catalog[0]); 
         }if(res.error.hasOwnProperty('image')){
          notification('error',res.error.image[0]); 
         }if(res.error.hasOwnProperty('parent_id')){
          notification('error',res.error.parent_id[0]);   
         }if(res.error.hasOwnProperty('name')){
          notification('error',res.error.name[0]); 
         }
        }else{
          
          notification('success',res.success,function(){
            window.location.reload();
          }); 
  
         }
         
      },error:function(res_code, textStatus, errorThrown){
        console.log(res_code); 
        $('.user-submit').prop('disabled',false); 
      }
     });
   }    

    marketplaceModal = (id=null)=>{
      let url = admin_url+"/marketplace/add";
      $.get(url,{id:id},function(res){
        $('.addedit-user-content').html(res);
        new bootstrap.Modal($('.addedit-user')).show();
        $('.selectpicker').selectpicker();
      });
     }
    
     createMarketplace = (id)=>{
      var url = (id==0) ? admin_url+"/marketplace/create" : admin_url+"/marketplace/update";
      var form = $('#user-form')[0];
      var formData = new FormData(form);
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
           if(res.error.hasOwnProperty('parent_id')){
            notification('error',res.error.parent_id[0]); 
           }if(res.error.hasOwnProperty('name')){
            notification('error',res.error.name[0]);  
           }
          }else{
            
            notification('success',res.success,function(){
              window.location.reload();
            }); 
    
           }
           
        },error:function(res_code, textStatus, errorThrown){
          console.log(res_code); 
          $('.user-submit').prop('disabled',false); 
        }
       });
     }
  
     deleteMarketplace = (id)=>{
      var url=admin_url+"/marketplace/delete";
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
           $.ajax({
             url:url,
             type:"GET",
             data: {id:id},
             success:function(data){
              notification('success','Deleted successfully.',function(){ 
                window.location.reload(); 
              });
             }
           });
          }
        })
    
      }


    sliderModal = (id=null)=>{
      $('#user-modal').addClass('modal-lg');
      let url = admin_url+"/slider/add";
      $.get(url,{id:id},function(res){
        $('.addedit-user-content').html(res);
        new bootstrap.Modal($('.addedit-user')).show();
        $('.selectpicker').selectpicker();
      });
     }
    
     createSlider = (id)=>{
      var url = (id==0) ? admin_url+"/slider/create" : admin_url+"/slider/update";
      var form = $('#user-form')[0];
      var formData = new FormData(form);
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
           if(res.error.hasOwnProperty('link')){
            notification('error',res.error.link[0]);   
           }
           if(res.error.hasOwnProperty('image')){
            notification('error',res.error.image[0]);   
           }
          }else{
            
            notification('success',res.success,function(){
              window.location.reload();
            }); 
    
           }
           
        },error:function(res_code, textStatus, errorThrown){
          console.log(res_code); 
          $('.user-submit').prop('disabled',false); 
        }
       });
     }
  
     deleteSlider = (id)=>{
      var url=admin_url+"/slider/delete";
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
           $.ajax({
             url:url,
             type:"GET",
             data: {id:id},
             success:function(data){
              notification('success','Deleted successfully.',function(){ 
                window.location.reload(); 
              });
             }
           });
          }
        })
    
      }

 changeSubadminPassword = (id)=>{
  let new_password,confirm_password="";
  var url=admin_url+"/subadmin/change-password";
  Swal.mixin({
    input: 'password',
    confirmButtonText: 'Next &rarr;',
    showCancelButton: true,
    progressSteps: ['1', '2'],
    inputValidator: (value) => {
      return !value && "you can't leave this field blank!"
    }
  }).queue([
    {
      title: 'Change Password',
      text: 'Enter New Password'
    },
    {
      title: 'Change Password',
      text: 'Enter Confirm Password'
    }
  ]).then((result) => {
    if (result.value) {
      const answers = JSON.stringify(result.value)
      var data = answers.replace(/[&\/\\#+()$~%.'":*?<>[\]{}]/g, '');
      data = data.split(',');

      // START AJAX
      $.ajax({
        url:url,
        type:"POST",
        dataType:"text",
        data: {id:id,new_password:data[0],confirm_password:data[1]},
        success:function(data){

          if(data==0){
           notification('warning','Invalid format for Old Password');
          }else if(data==1){
           notification('error','Your Old Password is Invalid');
          }else if(data==2){
           notification('error','Invalid format for New Password')
          }else if(data==3){
           notification('error',"Old & New Password can't be same");
          }else if(data==4){
           notification('error',"Invalid format for Confirm Password");
          }else if(data==5){
           notification('error',"New & Confirm Password does'nt match");
          }else if(data==6){
           notification('success',"Password changed successfully.");
          }
        }
      });

    }
  })
 }


 deleteSubadmin = (id)=>{
  var url=admin_url+"/delete-user";
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
       $.ajax({
         url:url,
         type:"GET",
         data: {id:id},
         success:function(data){
          notification('success','Deleted successfully.',function(){ 
            window.location.reload(); 
          });
         }
       });
      }
    })

  }


  viewRoles = (id)=>{
    $.ajax({
      url:admin_url+"/roles",
      type:"GET",
      data:{id:id},
      success:function(res){
          Swal.fire({
          title: 'Roles Access:',
          html:"<font style='color:green'>"+res+"</font>"
        })
      },error:function(res){
        console.log(res);  
      }
    });
   }

   profile = ()=>{
    var url = admin_url+"/subadmin/profile";
    $.ajax({
     url:url,
     type:"GET",
     success:function(res){
       $('.profile-content').html(res);
       new bootstrap.Modal($('.myprofile')).show();
     },error:function(res){
       console.log(res);  
     }
    });
   }

  getStates = (id)=>{ 
    let url = site_url+"/get-states";
    if(id!=0){
    $.ajax({
      type:"GET",
      url:url,
      dataType:"json",
      data:{id:id}, 
      success:function(res){       
        $("#state").empty();
        $("#state").append('<option value="">Choose state</option>');
        if(res){
        $.each(res,function(key,value){
          $("#state").append('<option value="'+key+'">'+value+'</option>');
        });
      }
    },error:function(res){
      console.log(res);
    }
    });
    }
   }

   showPerPage = (column,per_page)=>{
    if(per_page!=""){ 
     let url = admin_url+"/show-per-page";
      $.get(url,{column:column,per_page:per_page},function(res){
       window.location.reload();
     });
    }
   }

   exportProduct = ()=>{
    var ids = document.getElementsByName('ids[]');
	  var ids_array = ""; 
    if($("[id='ids[]']:checked").length <= 0){
     notification("error","Please select at least one !");
    return false;
    }else{
     for (var i=0, n=ids.length;i<n;i++) 
	 { if (ids[i].checked){
	   ids_array += ","+ids[i].value;}}
	 if (ids_array) ids_array = ids_array.substring(1);
	  $('#product_ids').val(ids_array);
	  $('#export-form').submit();
    } 
  }

  importProduct = ()=>{
    new bootstrap.Modal($('#importProduct')).show();
  }

  exportUser = ()=>{
    var ids = document.getElementsByName('ids[]');
	  var ids_array = ""; 
    if($("[id='ids[]']:checked").length <= 0){
     notification("error","Please select at least one !");
    return false;
    }else{
     for (var i=0, n=ids.length;i<n;i++) 
	 { if (ids[i].checked){
	   ids_array += ","+ids[i].value;}}
	 if (ids_array) ids_array = ids_array.substring(1);
	  $('#user_ids').val(ids_array);
	  $('#export-form').submit();
    } 
  }

  importUser = ()=>{
    new bootstrap.Modal($('#importUser')).show();
  }


  categoryIsBrand = (is_brand)=>{ 
    if(is_brand == "0"){
     $('#additional_row').fadeIn();
    }else{
     $('#additional_row').fadeOut();
    }
   }

   cancelNoteSubmit = (order_id)=>{
    let cancel_note = $('#cancel_note'+order_id).val();
    if(cancel_note){   
      let url = admin_url+"/order/cancel";
      $.ajax({
        url: url,
        type: "post",
        dataType: "json",
        data: {order_id:order_id,cancel_note:cancel_note},
        success:function(res){
         notification('success','Action completed',function(){
          window.location.reload();
         });
        },error:function(res){
          console.log(res);  
        }
      });
    }
   }
   
   shipping = (order_id)=>{
    $('#user-modal').addClass('modal-sm');   
    if(order_id){
     let url = admin_url+"/order/shipping";
     $.get(url,{order_id:order_id},function(res){
       $('.addedit-user-content').html(res);
       new bootstrap.Modal($('.addedit-user')).show();     
     });
    }   
   }
   
   addAttribute = ()=>{
    let html = '<div class="row element"><input type="hidden" name="id[]" value="0" /><div class="col-sm-4"><div class="form-floating mb-3"><input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key"><label for="floatingInput">Key</label></div></div><div class="col-sm-7"><div class="form-floating mb-3"><input type="text" class="form-control" id="floatingInput" name="value[]" placeholder="Value"><label for="floatingInput">Value</label></div></div><div class="col-sm-1 mt-3"><a href="javascript:void(0)" data-toggle="tooltip" title="Remove this" class="text-danger" onClick="removeElement(this);"><i class="fas fa-minus-circle"></i></a></div></div>';
    $('#more_attributes').append(html);
   }
   
   removeElement = (node)=>{
    node.closest('.element').remove();
   }
   
   removeCategoryAttribute = (id)=>{
    if(id){
     let url = admin_url+"/category/attribute/remove";
     $.get(url,{id:id},function(res){
           
     });
    }   
   }
   
   assignTicket  = ()=>{
    let admin_id = $('#admin_id').val();
    if(admin_id == ""){
     notification('error','Please choose user.');
     return false;
    }
    
    let ids = document.getElementsByName('ids[]');
	let ids_array = ""; 
    if($("[id='ids[]']:checked").length <= 0){
     notification("error","Please select at least one !");
     return false;
    }
    
    for (var i=0, n=ids.length;i<n;i++){ 
    if (ids[i].checked){
	 ids_array += ","+ids[i].value;}}
	  if (ids_array) ids_array = ids_array.substring(1);
    
    let url = admin_url+"/ticket/assign";
    $.get(url,{admin_id:admin_id, ids:ids_array},function(res){
     notification('success','Assigned successfully',function(){
      window.location.reload();     
     });    
    });
   }
   
   categoryForm = (category_id)=>{
    if(category_id){
     let url = admin_url+"/product/attribute-form";   
     $.get(url,{category_id:category_id},function(res){
      $('#more_attributes').html(res);        
     });
    }   
   }
   
   importIdentifyProduct = ()=>{
    new bootstrap.Modal($('#importIdentifyProduct')).show();
   }
   
   exportIdentifyProduct = ()=>{
    let ids = document.getElementsByName('ids[]');
	let ids_array = ""; 
    if($("[id='ids[]']:checked").length <= 0){
     notification("error","Please select at least one !");
     return false;
    }
    
    for (var i=0, n=ids.length;i<n;i++){ 
    if (ids[i].checked){
	 ids_array += ","+ids[i].value;}}
	  if (ids_array) ids_array = ids_array.substring(1); 
	 
	 let url = admin_url+"/identify-product/export";
	 $.ajax({
	  url: url,
	  data:{ids:ids_array},
	   cache: false,
        xhrFields:{
         responseType: 'blob'
        },
        success: function(data){
          const d = new Date();
          let time = d.getTime();    
          var link = document.createElement('a');
          link.href = window.URL.createObjectURL(data);
          link.download = "product-warranty-"+time+'.xlsx';
          link.click();
        }
	 });
    }
    
  productBySKU = ()=>{
   let fetch_btn = $('#fetch_btn');   
   fetch_btn.html('<div class="col-md-6 text-center"><div class="spinner-border text-muted custom-spinner"></div></div>');
   let sku = $('#sku');
   if(sku.val() == ""){
    notification("error","Please provide SKU No.");
    sku.focus();
    fetch_btn.html("Fetch");
    return false;
   }
   let url = admin_url+"/identify-product/product-data";
   $.get(url, {sku:sku.val()}, function(response){
    fetch_btn.html("Fetch");   
    if(response.success == false){
     notification('error',response.message);  
     sku.focus();
     return false;
    }   
    $('#asin').val(response.data.asin);
    $('#product_name').val(response.data.name);
   });
   
  }
  
  addMembershipAttribute = ()=>{
    var html = '<div class="row form-group element"><div class="col-12 col-md-5"><div class="form-floating mb-3"><input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Enter Attribute Name"><label for="floatingInput">Name</label></div></div><div class="col-12 col-md-5"><div class="form-floating mb-3"><input type="text" class="form-control" id="floatingInput" name="value[]" placeholder="Enter Attribute Value" min="0"><label for="floatingInput">Value</label></div></div><div class="col-12 col-md-1 mt-3"><a href="javascript:void(0)" data-toggle="tooltip" title="Remove this" class="text-danger" onClick="removeRow(this);"><i class="fas fa-minus-circle"></i></a></div></div> ';   
   $('.identify_product_attributes').append(html);
  }
   
  removeRow = (node)=>{
   node.closest('.element').remove();
  }
  
  exportOrder = ()=>{
   if($("[id='ids[]']:checked").length <= 0){
    notification("error", "Please select at least one!");
    return false;
   } 
   let ids_array = $("input[name='ids[]']:checked").map(function(_, element){
     return $(element).val().trim();  
   }).get();
   let ids = JSON.stringify(ids_array);
   let url = admin_url + "/order/export";
   $.ajax({
    url: url,
    data: {ids:ids},
    cache: false,
    xhrFields:{ responseType: 'blob' },
    success: function(response){
     let time = new Date().getTime();
     let link = document.createElement("a");
     link.href = window.URL.createObjectURL(response);
     link.download = "order-report"+time+".xlsx";
     link.click();
    }
   });
  }
  
  stateModal = (id=null)=>{
     let url = admin_url+"/location/add";
      $.get(url,{id:id},function(res){
       $('.addedit-user-content').html(res);
       new bootstrap.Modal($('.addedit-user')).show();
      });
     }
    
   createState = (id)=>{
      var url = (id==0) ? admin_url+"/location/create" : admin_url+"/location/update";
      var form = $('#user-form')[0];
      var formData = new FormData(form);
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
         if(jqXHR.status==201){ 
          $('.user-submit').prop('disabled',false);      
          if(res.error.hasOwnProperty('name')){
           notification('error',res.error.name[0]);  
          }
         }else{
          notification("success",res.success,function(){
           window.location.reload();    
           });
         }
        },error:function(res_code, textStatus, errorThrown){
          console.log(res_code); 
          $('.user-submit').prop('disabled',false); 
        }
       });
      }

   districtModal = (state_id,id=null)=>{
     let url = admin_url+"/location/district/add";
      $.get(url,{state_id:state_id, id:id},function(res){
       $('.addedit-user-content').html(res);
       new bootstrap.Modal($('.addedit-user')).show();
      });
     }
    
   createDistrict = (id)=>{
      var url = (id==0) ? admin_url+"/location/district/create" : admin_url+"/location/district/update";
      var form = $('#user-form')[0];
      var formData = new FormData(form);
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
         if(jqXHR.status==201){ 
          $('.user-submit').prop('disabled',false);          
          if(res.error.hasOwnProperty('pincode')){
           notification('error',res.error.pincode[0]);  
          }
         }else{
          notification("success",res.success,function(){
           window.location.reload();    
           });
         }
        },error:function(res_code, textStatus, errorThrown){
          console.log(res_code); 
          $('.user-submit').prop('disabled',false); 
        }
       });
      }
      
    updateRefundStatus = (id,status)=>{
     if(id){
      let url = site_url+"/admin/return-refund/update-status"; 
      $.get(url, {id:id, status:status}, function(response){
      window.location.reload();    
     });
     }      
    }
   
