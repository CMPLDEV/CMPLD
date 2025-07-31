$(document).ready(function(){
 todayOrder();  
 todaySales();
 todayTopSelling();
});

//################ ORDER ANALYTICS FUNCTIONS START ######################
orderAnalytic = (filter)=>{
 if(filter == 'today'){
  todayOrder();   
 }else if(filter == 'yesterday'){
  yesterdayOrder();    
 }else if(filter == 'weekly'){
  weeklyOrder();    
 }else if(filter == 'monthly'){
  monthlyOrder();    
 }else if(filter == 'yearly'){
  yearlyOrder();    
 }    
}

todayOrder = ()=>{
 $('#order_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>'); 
 $('#order_title').html("Today's Orders");
 let url = admin_url+"/order-analytic/today";
 $.get(url,function(res){
 $('#order_chart').empty();     
 $('#total_order').html(res.total_order);     
 var options = {
 chart: {
  type: 'line',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
series: [{
  name: 'Orders',
  data: [res.order_12_am, res.order_3_am, res.order_6_am, res.order_9_am, res.order_12_pm, res.order_3_pm, res.order_6_pm, res.order_9_pm]
}],
xaxis: {
  categories: ['12:00 AM','03:00 AM','06:00 AM','09:00 AM','12:00 PM','03:00 PM','06:00 PM','09:00 PM','12:00 PM']
},
yaxis: {
  min: 0,
  max: res.order_y_axis,
  tickAmount: 5
}
}
 var chart = new ApexCharts(document.querySelector("#order_chart"), options);
  chart.render();     
 });
}

yesterdayOrder = ()=>{
 $('#order_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>'); 
 $('#order_title').html("Yesterday's Orders");
 let url = admin_url+"/order-analytic/yesterday";
 $.get(url,function(res){
 $('#order_chart').empty();     
 $('#total_order').html(res.total_order);     
 var options = {
 chart: {
  type: 'line',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
series: [{
  name: 'Orders',
  data: [res.order_12_am, res.order_3_am, res.order_6_am, res.order_9_am, res.order_12_pm, res.order_3_pm, res.order_6_pm, res.order_9_pm]
}],
xaxis: {
  categories: ['12:00 AM','03:00 AM','06:00 AM','09:00 AM','12:00 PM','03:00 PM','06:00 PM','09:00 PM','12:00 PM']
},
yaxis: {
  min: 0,
  max: res.order_y_axis,
  tickAmount: 5
}
}
 var chart = new ApexCharts(document.querySelector("#order_chart"), options);
  chart.render();     
 });
}

weeklyOrder = ()=>{
 $('#order_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#order_title').html("Weekly Orders");
 let url = admin_url+"/order-analytic/weekly";
 $.get(url,function(res){
 $('#order_chart').empty();     
 $('#total_order').html(res.total_order);     
 var options = {
 chart: {
  type: 'line',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
series: [{
  name: 'Orders',
  data: res.data
}],
xaxis: {
  categories: res.days
},
yaxis: {
  min: 0,
  max: res.order_y_axis,
  tickAmount: 5
}
}
 var chart = new ApexCharts(document.querySelector("#order_chart"), options);
  chart.render();     
 });
}

monthlyOrder = ()=>{
 $('#order_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');   
 $('#order_title').html("Monthly Orders");
 let url = admin_url+"/order-analytic/monthly";
 $.get(url,function(res){
 $('#order_chart').empty();     
 $('#total_order').html(res.total_order);     
 var options = {
 chart: {
  type: 'line',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
series: [{
  name: 'Orders',
  data: res.data
}],
xaxis: {
  type: 'datetime'
},
yaxis: {
  min: 0,
  max: res.order_y_axis,
  tickAmount: 5
}
}
 var chart = new ApexCharts(document.querySelector("#order_chart"), options);
  chart.render();     
 });
}

yearlyOrder = ()=>{
 $('#order_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');   
 $('#order_title').html("Yearly Orders");
 let url = admin_url+"/order-analytic/yearly";
 $.get(url,function(res){
 $('#order_chart').empty();     
 $('#total_order').html(res.total_order);    
 var options = {
 chart: {
  type: 'area',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
 dataLabels: {
  enabled: false
 },
 markers: {
  size: 0,
},
series: [{
        name: 'Orders',
        data: res.data
      }],
 xaxis: {
  type: 'datetime',
 },
 fill: {
  type: 'gradient',
  gradient: {
  shadeIntensity: 1,
  inverseColors: false,
  opacityFrom: 0.5,
  opacityTo: 0,
  stops: [0, 90, 100]
 },
},
yaxis: {
 min: 0,
 max: res.order_y_axis,
 tickAmount: 5
}
}
 var chart = new ApexCharts(document.querySelector("#order_chart"), options);
  chart.render();     
 });
}
//################ ORDER ANALYTICS FUNCTIONS END ######################


//################ SALES ANALYTICS FUNCTIONS START #####################
salesAnalytic = (filter)=>{
 if(filter == 'today'){
  todaySales();   
 }else if(filter == 'yesterday'){
  yesterdaySales();    
 }else if(filter == 'weekly'){
  weeklySales();    
 }else if(filter == 'monthly'){
  monthlySales();    
 }else if(filter == 'yearly'){
  yearlySales();    
 }    
}

todaySales = ()=>{
 $('#sales_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#sales_title').html("Today's Sales");
 let url = admin_url+"/sales-analytic/today";
 $.get(url,function(res){
 $('#sales_chart').empty();     
 $('#total_sales').html(res.total_sales);   
var options = {
chart: {
  type: 'bar',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
plotOptions: {
  bar: {
    columnWidth: "40%"
  },
},
series: [{
  name: 'Sales',
  data: [res.gateway_sales, res.upi_sales, res.dbt_sales]
}],
xaxis: {
  categories: ['GATEWAY','UPI','DIRECT BANK TRANSFER']
},
yaxis: {
  min: 0,
  max: parseInt(res.y_axis),
  tickAmount: 5
}
}
var chart = new ApexCharts(document.querySelector("#sales_chart"), options);
chart.render();    
 });
}

yesterdaySales = ()=>{
 $('#sales_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#sales_title').html("Yesterday's Sales");
 let url = admin_url+"/sales-analytic/yesterday";
 $.get(url,function(res){
 $('#sales_chart').empty();     
 $('#total_sales').html(res.total_sales);   
var options = {
chart: {
  type: 'bar',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
plotOptions: {
  bar: {
    columnWidth: "40%"
  },
},
series: [{
  name: 'Sales',
  data: [res.gateway_sales, res.upi_sales, res.dbt_sales]
}],
xaxis: {
  categories: ['GATEWAY','UPI','DIRECT BANK TRANSFER']
},
yaxis: {
  min: 0,
  max: parseInt(res.y_axis),
  tickAmount: 5
}
}
var chart = new ApexCharts(document.querySelector("#sales_chart"), options);
chart.render();    
 });
}

weeklySales = ()=>{
 $('#sales_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#sales_title').html("Weekly Sales");
 let url = admin_url+"/sales-analytic/weekly";
 $.get(url,function(res){
 $('#sales_chart').empty();     
 $('#total_sales').html(res.total_sales);   
var options = {
chart: {
  type: 'bar',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
plotOptions: {
 bar: {
   columnWidth: "100%",
 },
},
 dataLabels: {
   enabled: true,
   enabledOnSeries: [-1]
 },
series: [{
  name: 'GATEWAY',
  type: 'column',
  data: res.gateway_sales
}, {
  name: 'UPI',
  type: 'column',
  data: res.upi_sales
}, {
  name: 'DIRECT BANK TRANSFER',
  type: 'column',
  data: res.dbt_sales
}],
xaxis: {
  categories: res.days
},
yaxis: {
  min: 0,
  max: parseInt(res.y_axis),
  tickAmount: 5
},
 stroke: {
    colors: ["transparent"],
    width: 10
  }
}
var chart = new ApexCharts(document.querySelector("#sales_chart"), options);
chart.render();    
 });
}

monthlySales = ()=>{
 $('#sales_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#sales_title').html("Monthly Sales");
 let url = admin_url+"/sales-analytic/monthly";
 $.get(url,function(res){ 
 $('#sales_chart').empty();      
 $('#total_sales').html(res.total_sales);   
var options = {
chart: {
  type: 'bar',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
plotOptions: {
 bar: {
   columnWidth: "100%",
 },
},
 dataLabels: {
   enabled: true,
   enabledOnSeries: [-1]
 },
series: [{
  name: 'GATEWAY',
  type: 'column',
  data: res.gateway_data
}, {
  name: 'UPI',
  type: 'column',
  data: res.upi_data
}, {
  name: 'DIRECT BANK TRANSFER',
  type: 'column',
  data: res.dbt_data
}],
xaxis: {
  type: 'datetime'
},
yaxis: {
  min: 0,
  max: parseInt(res.y_axis),
  tickAmount: 5
},
 stroke: {
    colors: ["transparent"],
    width: 10
  }
}
var chart = new ApexCharts(document.querySelector("#sales_chart"), options);
chart.render();    
 });
}

yearlySales = ()=>{
 $('#sales_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');    
 $('#sales_title').html("Yearly Sales");
 let url = admin_url+"/sales-analytic/yearly";
 $.get(url,function(res){
 $('#sales_chart').empty();     
 $('#total_sales').html(res.total_sales);   
var options = {
chart: {
  type: 'bar',
  height: 250,
  stacked: !1,
  offsetY: -5,
  toolbar: {
   show: !1
  }
},
plotOptions: {
 bar: {
   columnWidth: "100%",
 },
},
 dataLabels: {
   enabled: true,
   enabledOnSeries: [-1]
 },
series: [{
  name: 'GATEWAY',
  type: 'column',
  data: res.gateway_data
}, {
  name: 'UPI',
  type: 'column',
  data: res.upi_data
}, {
  name: 'DIRECT BANK TRANSFER',
  type: 'column',
  data: res.dbt_data
}],
xaxis: {
  type: 'datetime'
},
yaxis: {
  min: 0,
  max: parseInt(res.y_axis),
  tickAmount: 5
},
 stroke: {
    colors: ["transparent"],
    width: 10
  }
}
var chart = new ApexCharts(document.querySelector("#sales_chart"), options);
chart.render();    
 });
}

//################ SALES ANALYTICS FUNCTIONS END ######################

//################ TOP SELLING ANALYTICS FUNCTIONS START #####################
topSellingAnalytic = (filter)=>{
 $('#top_selling_chart').empty();      
 if(filter == 'today'){
  todayTopSelling();   
 }else if(filter == 'yesterday'){
  yesterdayTopSelling();     
 }else if(filter == 'weekly'){
  weeklyTopSelling();    
 }else if(filter == 'monthly'){
  monthlyTopSelling();    
 }else if(filter == 'yearly'){
  yearlyTopSelling();    
 }    
}

todayTopSelling = ()=>{
$('#top_selling_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#top_selling_title').html("Today's Top-5");
 let url = admin_url+"/top-selling-analytic/today";
 $.get(url,function(res){
 $('#top_selling_chart').empty();    
var options = {
  series: [{
  name: 'Sold Qty',      
  data: res.item_qty
}],
  chart: {
  type: 'bar',
  height: 250,
  toolbar: {
   show: false
  }
},
plotOptions: {
  bar: {
    borderRadius: 4,
    horizontal: true,
  }
},
dataLabels: {
  enabled: true
},
xaxis: {
  categories: res.item_name,
},
yaxis: {
  max: res.y_axis,
   labels: {
     show: true,
     trim: false
   }
  }
};

var chart = new ApexCharts(document.querySelector("#top_selling_chart"), options);
chart.render();
 });
}

yesterdayTopSelling = ()=>{
$('#top_selling_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#top_selling_title').html("Yesterday's Top-5");
 let url = admin_url+"/top-selling-analytic/yesterday";
 $.get(url,function(res){
 $('#top_selling_chart').empty();    
var options = {
  series: [{
  name: 'Sold Qty',      
  data: res.item_qty
}],
  chart: {
  type: 'bar',
  height: 250,
  toolbar: {
   show: false
  }
},
plotOptions: {
  bar: {
    borderRadius: 4,
    horizontal: true,
  }
},
dataLabels: {
  enabled: true
},
xaxis: {
  categories: res.item_name,
},
yaxis: {
  max: res.y_axis,
   labels: {
     show: true,
     trim: false
   }
  }
};

var chart = new ApexCharts(document.querySelector("#top_selling_chart"), options);
chart.render();
 });
}

weeklyTopSelling = ()=>{
$('#top_selling_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#top_selling_title').html("Weekly Top-5");
 let url = admin_url+"/top-selling-analytic/weekly";
 $.get(url,function(res){
 $('#top_selling_chart').empty();    
var options = {
  series: [{
  name: 'Sold Qty',      
  data: res.item_qty
}],
  chart: {
  type: 'bar',
  height: 250,
  toolbar: {
   show: false
  }
},
plotOptions: {
  bar: {
    borderRadius: 4,
    horizontal: true,
  }
},
dataLabels: {
  enabled: true
},
xaxis: {
  categories: res.item_name,
},
yaxis: {
  max: res.y_axis,
   labels: {
     show: true,
     trim: false
   }
  }
};

var chart = new ApexCharts(document.querySelector("#top_selling_chart"), options);
chart.render();
 });
}

monthlyTopSelling = ()=>{
$('#top_selling_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#top_selling_title').html("Monthly Top-5");
 let url = admin_url+"/top-selling-analytic/monthly";
 $.get(url,function(res){
 $('#top_selling_chart').empty();    
var options = {
  series: [{
  name: 'Sold Qty',      
  data: res.item_qty
}],
  chart: {
  type: 'bar',
  height: 250,
  toolbar: {
   show: false
  }
},
plotOptions: {
  bar: {
    borderRadius: 4,
    horizontal: true,
  }
},
dataLabels: {
  enabled: true
},
xaxis: {
  categories: res.item_name,
},
yaxis: {
  max: res.y_axis,
   labels: {
     show: true,
     trim: false
   }
  }
};

var chart = new ApexCharts(document.querySelector("#top_selling_chart"), options);
chart.render();
 });
}

yearlyTopSelling = ()=>{
$('#top_selling_chart').html('<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>');
 $('#top_selling_title').html("Yearly Top-5");
 let url = admin_url+"/top-selling-analytic/yearly";
 $.get(url,function(res){
 $('#top_selling_chart').empty();    
var options = {
  series: [{
  name: 'Sold Qty',      
  data: res.item_qty
}],
  chart: {
  type: 'bar',
  height: 250,
  toolbar: {
   show: false
  }
},
plotOptions: {
  bar: {
   borderRadius: 4,
   horizontal: true,
  }
},
dataLabels: {
  enabled: true
},
xaxis: {
  categories: res.item_name,
},
yaxis: {
  max: res.y_axis,
   labels: {
    show: true,
    trim: false
   }
  }
};

var chart = new ApexCharts(document.querySelector("#top_selling_chart"), options);
chart.render();
 });
}

//################ TOP SELLING ANALYTICS FUNCTIONS END ######################
