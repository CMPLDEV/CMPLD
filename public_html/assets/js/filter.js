let filters = {};

 filterProduct = (attribute, value, type, type_value, sort_by, category_id)=>{
  filters = $('input[class="product_attribute"]:checked').map(function(_, el){
       return $(el).val().trim();
      }).get();
   if(filters == ""){
    document.getElementsByClassName('rm-filter')[0].style.display="none";   
   }else{
    document.getElementsByClassName('rm-filter')[0].style.display="block";
   }      
  $('#filter_data').val(JSON.stringify(filters, null, 2)); 
  loadProducts(type, type_value, sort_by, category_id);
 };
 
 loadProducts = (type, type_value, sort_by, category_id)=>{
  let filter_data = $('#filter_data').val();
  sort_by = $('#sort_by').val();
  $.ajax({
   url: site_url+"/load-products",
   type: "GET",
   beforeSend:function(){
    $('#ajax-product').html('<div class="col-md-6 offset-md-3 text-center mb-4"><div class="spinner-border text-muted"></div></div>');
    $('#load-more-btn').fadeOut('fast');  
   },
   data:{type:type, type_value:type_value, sort_by:sort_by, category_id:category_id, filter_data:filter_data},
   success:function(res){
    $('#load-more-btn').fadeIn('fast'); 
    resetPage(); 
    $('#ajax-product').html(res);
   },error:function(res){
    $('#load-more-btn').fadeIn('fast');  
    $('#product-loader').fadeOut('fast'); 
    console.log(res); 
   }
  });
 };