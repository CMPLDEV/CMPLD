
addCart = (product_id, is_buynow=0)=>{ 
 if(product_id){
  let url = site_url+"/add-cart";
  let qty = ($('#qty').val() == undefined) ? 1 : $('#qty').val();
  
  $.ajax({
    url: url,
    type: "post",
    dataType: "json",
    data: {product_id:product_id, qty:qty},
    success:function(res){
     if(res.status==1){
      if(is_buynow){
       window.location.href = "checkout.html";   
      }else{     
       $('.cart-item').html(res.cart_count);
       notification('success',res.msg);
      }
     }else{
      notification('success',res.msg);
     }  
    },error:function(res){
      console.log(res);  
    }
  });  
 }
}

miniCart = ()=>{
 let url = site_url+"/mini-cart";
 $.get(url,function(res){
   $('#mini-cart').html(res)
 });
}

addWishlist = (product_id)=>{
  if(product_id){
   let url = site_url+"/add-wishlist";
   $.ajax({
    url:url,
    type:"post",
    dataType:"json",
    data:{product_id:product_id},
    success:function(response){
      if(response.status==0){
        notification('error','At first please login.');
      }else if(response.status==1){
        $('#total-wishlist').html(response.total);
        notification('success','Product added in wishlist.');
      }else if(response.status==2){
        notification('warning','Product already added in wishlist.');
      }
    },error:function(response){
      console.log(response);
    }
  }); 
  }
}

 incrementQty = (cart_id=0)=>{ 
  if(cart_id == 0){
   let qty = $('#qty').val();
   qty++;
   $('#qty').val(qty);
  }else{
   let qty = $('#qty'+cart_id).val();
   qty++;
   $('#qty'+cart_id).val(qty);
   updateCartQty(cart_id,qty);
  }
 }
 
 decrementQty = (cart_id=0)=>{
   if(cart_id == 0){
    let qty = $('#qty').val();
    if(qty > 1){
     qty--;
    }
    $('#qty').val(qty);
   }else{
    let qty = $('#qty'+cart_id).val();
    if(qty > 1){
     qty--;
     $('#qty'+cart_id).val(qty);
     updateCartQty(cart_id,qty);
    }
   }
  }

 updateCartQty = (cart_id,qty)=>{
  let url = site_url+"/update-cart";
  $.get(url,{cart_id:cart_id,qty:qty},function(res){
    if(res){
      notification('success',"Cart updated.",function(){
        window.location.reload();
      });
    }
  });
 }