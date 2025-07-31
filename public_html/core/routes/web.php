<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\LoginController as AuthUser;
use App\Http\Controllers\Admin\MarketplaceController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\OurClientController;
use App\Http\Controllers\Admin\OurPartnerController;
use App\Http\Controllers\Admin\ShowcaseController;
use App\Http\Controllers\Admin\OurAssociatesController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ReturnRefundController;
use App\Http\Controllers\Admin\ProductNegotiationController;
use App\Http\Controllers\Admin\IdentifyProductController;
use App\Http\Controllers\Admin\UserController as User;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('command',function(){
 Artisan::call("config:cache");
 return 'Run';
});

Auth::routes();

//IF REGISTRATION SESSION EXIST
Route::group(['middleware'=>'regSessionExist'],function(){
 Route::get('register/otp', [RegisterController::class, 'otpForm'])->name('register.otp');
 Route::get('register/otp/resend', [RegisterController::class, 'resendOTP'])->name('register.otp.resend');
 Route::post('register/otp/verify', [RegisterController::class, 'verifyOTP'])->name('register.otp.verify');
});

Route::prefix('admin')->group(function(){
 //AUTHENTICATION ROUTES   
  Route::get('login',[LoginController::class, 'loginForm']);
  Route::post('login',[LoginController::class, 'login'])->name('admin.login');  
  Route::get('logout',[LoginController::class, 'logout'])->name('admin.logout');

 //BASIC ROUTES  
 Route::get('',[HomeController::class, 'index'])->name('admin');
 Route::get('roles',[SettingController::class,'roles']);
 Route::get('delete-user',[SettingController::class,'deleteSubadmin']);
 Route::get('show-per-page',[SettingController::class,'showPerPage']);
 
   //DASHBOARD ORDER ANALYTIC START
  Route::get('order-analytic/today', [HomeController::class, 'orderAnalyticToday']);
  Route::get('order-analytic/yesterday', [HomeController::class, 'orderAnalyticYesterday']);
  Route::get('order-analytic/weekly', [HomeController::class, 'orderAnalyticWeekly']);
  Route::get('order-analytic/monthly', [HomeController::class, 'orderAnalyticMonthly']);
  Route::get('order-analytic/yearly', [HomeController::class, 'orderAnalyticYearly']);
 //DASHBOARD ORDER ANALYTIC END
 
  //DASHBOARD SALES ANALYTIC START
  Route::get('sales-analytic/today', [HomeController::class, 'salesAnalyticToday']);
  Route::get('sales-analytic/yesterday', [HomeController::class, 'salesAnalyticYesterday']);
  Route::get('sales-analytic/weekly', [HomeController::class, 'salesAnalyticWeekly']);
  Route::get('sales-analytic/monthly', [HomeController::class, 'salesAnalyticMonthly']);
  Route::get('sales-analytic/yearly', [HomeController::class, 'salesAnalyticYearly']);
 //DASHBOARD SALES ANALYTIC END
 
 //DASHBOARD TOP SELLING ANALYTIC START
  Route::get('top-selling-analytic/today', [HomeController::class, 'topSellingAnalyticToday']);
  Route::get('top-selling-analytic/yesterday', [HomeController::class, 'topSellingAnalyticYesterday']);
  Route::get('top-selling-analytic/weekly', [HomeController::class, 'topSellingAnalyticWeekly']);
  Route::get('top-selling-analytic/monthly', [HomeController::class, 'topSellingAnalyticMonthly']);
  Route::get('top-selling-analytic/yearly', [HomeController::class, 'topSellingAnalyticYearly']);
 //DASHBOARD TOP SELLING ANALYTIC END

 Route::group(['middleware'=>'role1'],function(){
  Route::prefix('setting')->group(function(){
  Route::get('',[SettingController::class, 'index'])->name('setting'); 
  Route::post('update',[SettingController::class, 'updateSetting'])->name('update-setting');
  Route::get('remove-image/{img_type}',[SettingController::class, 'removeImage'])->name('remove-image');
  });  
 });

 Route::group(['middleware'=>'role2'],function(){
    Route::prefix('subadmin')->group(function(){
     Route::get('',[SettingController::class,'subadmins'])->name('subadmin');
     Route::get('update-status/{id}/{status}',[SettingController::class,'updateStatus'])->name('subadmin.update.status');   
     Route::get('add',[SettingController::class,'addSubadmin']);
     Route::post('create',[SettingController::class,'createSubadmin']);
     Route::post('update',[SettingController::class,'updateSubadmin']);
     Route::post('change-password',[SettingController::class,'changeSubadminPassword']);
     Route::any('search',[SettingController::class,'searchSubadmin'])->name('search-subadmin');
     Route::get('profile',[SettingController::class,'profile']);
     Route::put('profile/update',[SettingController::class,'updateProfile'])->name('update-profile');
     Route::get('profile/remove',[SettingController::class,'removePic'])->name('remove-pic');
    });
   });

 Route::group(['middleware'=>'role3'],function(){
  Route::get('change-password', [SettingController::class, 'changePasswordForm'])->name('change.my.password');
  Route::post('change-password', [SettingController::class, 'changePassword'])->name('change.my.password');
 });

 Route::group(['middleware'=>'role4'],function(){
  Route::prefix('user')->group(function(){
   Route::get('',[User::class,'index'])->name('user');
   Route::get('update-status/{id}/{status}',[User::class,'updateStatus'])->name('user.update.status');   
   Route::get('add',[User::class,'add']);
   Route::post('create',[User::class,'create']);
   Route::post('update',[User::class,'update']);
   Route::get('delete',[User::class,'delete']);
   Route::any('search',[User::class,'search'])->name('user.search');
   Route::get('address/view',[User::class,'viewAddress']);
   Route::get('address/add',[User::class,'addAddress']);
   Route::post('address/create',[User::class,'createAddress']);
   Route::post('address/update',[User::class,'updateAddress']);
   Route::get('address/remove/{id}',[User::class,'removeAddress'])->name('user.address.remove');
   Route::get('bottom-action', [User::class, 'bottomAction'])->name('user.bottom.action');
   Route::get('export', [User::class, 'export'])->name('user.export');
   Route::post('import', [User::class, 'import'])->name('user.import');
  });
 });

 Route::group(['middleware'=>'role5'],function(){
  Route::prefix('category')->group(function(){
   Route::get('',[CategoryController::class,'index'])->name('admin.category');
   Route::get('update-status/{id}/{status}',[CategoryController::class,'updateStatus'])->name('category.update.status');   
   Route::get('add',[CategoryController::class,'add']);
   Route::post('create',[CategoryController::class,'create']);
   Route::post('update',[CategoryController::class,'update']);
   Route::get('delete',[CategoryController::class,'delete']);
   Route::get('bottom-action', [CategoryController::class, 'bottomAction'])->name('category.bottom.action');
   Route::get('remove-image/{id}/{column}', [CategoryController::class, 'removeImage'])->name('category.remove.image');
   Route::get('search', [CategoryController::class, 'search'])->name('category.search');
   
   Route::post('attribute/create', [CategoryController::class, 'createAttribute'])->name('category.attribute.create');
   Route::get('attribute/remove', [CategoryController::class, 'removeAttribute']);
   Route::get('attribute/{category_id}', [CategoryController::class, 'attributes'])->name('category.attribute');
  });
  
  Route::prefix('brand')->group(function(){
   Route::get('',[BrandController::class,'index'])->name('admin.brand');
   Route::get('update-status/{id}/{status}',[BrandController::class,'updateStatus'])->name('brand.update.status');   
   Route::get('add',[BrandController::class,'add']);
   Route::post('create',[BrandController::class,'create']);
   Route::post('update',[BrandController::class,'update']);
   Route::get('delete',[BrandController::class,'delete']);
   Route::get('bottom-action', [BrandController::class, 'bottomAction'])->name('brand.bottom.action');
   Route::get('remove-image/{id}/{column}', [BrandController::class, 'removeImage'])->name('brand.remove.image');
  });
  
  //BRANDS SOFTWARE 
  Route::prefix('software')->group(function(){
   Route::get('add/{brand_id}', [BrandController::class, 'addSoftware'])->name('brand.software.add');
   Route::post('create', [BrandController::class, 'createSoftware'])->name('brand.software.create');
   Route::get('edit/{brand_id}/{id}', [BrandController::class, 'editSoftware'])->name('brand.software.edit');
   Route::put('update', [BrandController::class, 'updateSoftware'])->name('brand.software.update');
   Route::get('bottom-action', [BrandController::class, 'softwareBottomAction'])->name('brand.software.bottom.action');
   Route::get('{brand_id}',[BrandController::class,'software'])->name('brand.software');
   Route::get('update-status/{id}/{status}',[BrandController::class,'updateSoftwareStatus'])->name('brand.software.update.status');
  });
  
 });

 Route::group(['middleware'=>'role6'],function(){
  Route::prefix('product')->group(function(){
   Route::get('',[ProductController::class,'index'])->name('product');  
   Route::get('add',[ProductController::class,'add'])->name('product.add');
   Route::post('create',[ProductController::class,'create'])->name('product.create');
   Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
   Route::post('update/{id}',[ProductController::class,'update'])->name('product.update');
   Route::get('update-status/{id}/{status}',[ProductController::class,'updateStatus'])->name('product.update.status'); 
   Route::get('remove-image/{id}/{column}', [ProductController::class, 'removeImage'])->name('product.remove.image');
   Route::post('bottom-action', [ProductController::class, 'bottomAction'])->name('product.bottom.action');
   Route::get('search', [ProductController::class, 'search'])->name('product.search');
   Route::post('export', [ProductController::class, 'export'])->name('product.export');
   Route::post('import', [ProductController::class, 'import'])->name('product.import');
   Route::get('remove-more-image/{id}', [ProductController::class, 'removeMoreImages'])->name('product.remove.moreimg');
   Route::get('remove-more-banner/{id}', [ProductController::class, 'removeMoreBanners'])->name('product.remove.morebanner');
   Route::get('attribute-form', [ProductController::class, 'attributeForm']);
   Route::get('category-wise/{id}', [ProductController::class, 'categoryProduct'])->name('product.category');
   Route::get('copy/{id}', [ProductController::class, 'copy'])->name('product.copy');
   
   Route::prefix('offer')->group(function(){
    Route::get('bottom-action', [ProductController::class, 'offerBottomAction'])->name('product.offer.bottom.action');   
    Route::get('{product_id}', [ProductController::class, 'offer'])->name('product.offer');
    Route::get('add/{product_id}', [ProductController::class, 'addOffer'])->name('product.offer.add');
    Route::post('create', [ProductController::class, 'createOffer'])->name('product.offer.create');
    Route::get('edit/{product_id}/{id}', [ProductController::class, 'editOffer'])->name('product.offer.edit');
    Route::put('update', [ProductController::class, 'updateOffer'])->name('product.offer.update');
   });
   
 });
});

Route::group(['middleware'=>'role7'],function(){
  Route::prefix('page')->group(function(){
   Route::get('',[PageController::class,'index'])->name('page');  
   Route::get('add',[PageController::class,'add'])->name('page.add');
   Route::post('create',[PageController::class,'create'])->name('page.create');
   Route::get('edit/{id}', [PageController::class, 'edit'])->name('page.edit');
   Route::post('update/{id}',[PageController::class,'update'])->name('page.update');
   Route::get('update-status/{id}/{status}',[PageController::class,'updateStatus'])->name('page.update.status'); 
   Route::get('remove-image/{id}/{column}', [PageController::class, 'removeImage'])->name('page.remove.image');
   Route::get('bottom-action', [PageController::class, 'bottomAction'])->name('page.bottom.action');
 });
});

Route::group(['middleware'=>'role8'],function(){
  Route::prefix('slider')->group(function(){
   Route::get('',[SliderController::class,'index'])->name('slider');
   Route::get('update-status/{id}/{status}',[SliderController::class,'updateStatus'])->name('slider.update.status');   
   Route::get('add',[SliderController::class,'add']);
   Route::post('create',[SliderController::class,'create']);
   Route::post('update',[SliderController::class,'update']);
   Route::get('delete',[SliderController::class,'delete']);
   Route::get('remove-image/{id}/{column}', [SliderController::class, 'removeImage'])->name('slider.remove.image');
   Route::get('bottom-action', [SliderController::class, 'bottomAction'])->name('slider.bottom.action');
  });
 });

 Route::group(['middleware'=>'role9'],function(){
  Route::prefix('blog')->group(function(){
   Route::get('',[BlogController::class,'index'])->name('admin.blog');  
   Route::get('add',[BlogController::class,'add'])->name('blog.add');
   Route::post('create',[BlogController::class,'create'])->name('blog.create');
   Route::get('edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
   Route::post('update/{id}',[BlogController::class,'update'])->name('blog.update');
   Route::get('update-status/{id}/{status}',[BlogController::class,'updateStatus'])->name('blog.update.status'); 
   Route::get('remove-image/{id}/{column}', [BlogController::class, 'removeImage'])->name('blog.remove.image');
   Route::get('bottom-action', [BlogController::class, 'bottomAction'])->name('blog.bottom.action');
 });
});

 Route::group(['middleware'=>'role10'],function(){
  Route::prefix('marketplace')->group(function(){
   Route::get('',[MarketplaceController::class,'index'])->name('marketplace');
   Route::get('update-status/{id}/{status}',[MarketplaceController::class,'updateStatus'])->name('marketplace.update.status');   
   Route::get('add',[MarketplaceController::class,'add']);
   Route::post('create',[MarketplaceController::class,'create']);
   Route::post('update',[MarketplaceController::class,'update']);
   Route::get('delete',[MarketplaceController::class,'delete']);
  });
 });

 Route::group(['middleware'=>'role11'],function(){
  Route::prefix('product-seo')->group(function(){
  Route::get('',[SettingController::class, 'productSEO'])->name('productseo'); 
  Route::post('update',[SettingController::class, 'updateProductSEO'])->name('productseo.update');
  });  
 });

 Route::group(['middleware'=>'role12'],function(){
  Route::prefix('enquiry')->group(function(){
   Route::get('',[EnquiryController::class,'index'])->name('enquiry');  
   Route::get('add',[EnquiryController::class,'add'])->name('enquiry.add');
   Route::post('create',[EnquiryController::class,'create'])->name('enquiry.create');
   Route::get('edit/{id}', [EnquiryController::class, 'edit'])->name('enquiry.edit');
   Route::post('update/{id}',[EnquiryController::class,'update'])->name('enquiry.update');
   Route::get('bottom-action', [EnquiryController::class, 'bottomAction'])->name('enquiry.bottom.action');
 });
});

Route::group(['middleware'=>'role13'],function(){
  Route::prefix('coupon')->group(function(){
   Route::get('',[CouponController::class,'index'])->name('admin.coupon');  
   Route::get('add',[CouponController::class,'add'])->name('coupon.add');
   Route::post('create',[CouponController::class,'create'])->name('coupon.create');
   Route::get('edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
   Route::post('update/{id}',[CouponController::class,'update'])->name('coupon.update');
   Route::get('update-status/{id}/{status}',[CouponController::class,'updateStatus'])->name('coupon.update.status'); 
   Route::get('remove-image/{id}/{column}', [CouponController::class, 'removeImage'])->name('coupon.remove.image');
   Route::get('bottom-action', [CouponController::class, 'bottomAction'])->name('coupon.bottom.action');
 });
});

Route::group(['middleware'=>'role14'],function(){
  Route::prefix('order')->group(function(){
   Route::get('',[OrderController::class,'index'])->name('admin.order');  
   Route::get('detail/{id}', [OrderController::class, 'orderDetail'])->name('order.detail');
   Route::get('generate-invoice/{id}', [OrderController::class, 'generateInvoice'])->name('order.generateinvoice');
   Route::get('view-invoice/{id}', [OrderController::class, 'viewInvoice'])->name('order.viewinvoice');
   Route::get('remove-invoice/{id}', [OrderController::class, 'removeInvoice'])->name('order.removeinvoice');
   Route::post('cancel', [OrderController::class, 'cancelNoteSubmit'])->name('order.cancelnote.submit');
   Route::get('bottom-action', [OrderController::class, 'bottomAction'])->name('order.bottom.action');
   Route::get('search', [OrderController::class, 'search'])->name('order.search');
   Route::get('export', [OrderController::class, 'export']);
   Route::get('dimension', [OrderController::class, 'dimension']);
   Route::post('couriers', [OrderController::class, 'courierPartners']);
   Route::post('create-shipment', [OrderController::class, 'createShipment'])->name('order.shipment.create');
   Route::get('tracking/update', [OrderController::class, 'updateTrackingForm']);
   Route::put('tracking/update', [OrderController::class, 'updateTracking'])->name('order.shipment.update');
 });
});

Route::group(['middleware'=>'role15'],function(){
  Route::prefix('subscription')->group(function(){
   Route::get('',[SubscriptionController::class,'index'])->name('admin.subscription');  
   Route::get('bulk', [SubscriptionController::class,'bulk'])->name('subscription.bulk');
   Route::get('add-bulk', [SubscriptionController::class,'addBulk'])->name('subscription.bulk.add');
   Route::post('bulk', [SubscriptionController::class,'createBulk'])->name('subscription.bulk.create'); 
   Route::get('bulk-bottom-action', [SubscriptionController::class, 'bulkBottomAction'])->name('subscription.bulk.bottom.action');
   Route::get('bottom-action', [SubscriptionController::class, 'bottomAction'])->name('subscription.bottom.action');
 });
});

 Route::group(['middleware'=>'role16'],function(){
  Route::prefix('advance-setting')->group(function(){
  Route::get('',[SettingController::class, 'advanceSetting'])->name('setting.advance'); 
  Route::post('update',[SettingController::class, 'updateAdvanceSetting'])->name('advancesetting.update');
  });  
 });

Route::group(['middleware'=>'role17'],function(){
  Route::prefix('gallery')->group(function(){
   Route::get('',[GalleryController::class,'index'])->name('admin.gallery');  
   Route::get('add',[GalleryController::class,'add'])->name('gallery.add');
   Route::post('create',[GalleryController::class,'create'])->name('gallery.create');
   Route::get('edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
   Route::put('update',[GalleryController::class,'update'])->name('gallery.update');
   Route::get('update-status/{id}/{status}',[GalleryController::class,'updateStatus'])->name('gallery.update.status'); 
   Route::get('bottom-action', [GalleryController::class, 'bottomAction'])->name('gallery.bottom.action');
 });
});

 Route::group(['middleware'=>'role18'],function(){
  Route::prefix('ticket')->group(function(){
   Route::get('',[TicketController::class,'index'])->name('ticket');  
   Route::get('detail/{id}', [TicketController::class, 'detail'])->name('ticket.detail');
   Route::post('update/comment', [TicketController::class, 'updateComment'])->name('ticket.update.comment');
   Route::get('bottom-action', [TicketController::class, 'bottomAction'])->name('ticket.bottom.action');
   Route::get('search', [TicketController::class, 'search'])->name('ticket.search');
   Route::get('assign', [TicketController::class, 'assign']);
 });
});

 Route::group(['middleware'=>'role19'],function(){
  Route::prefix('identify-product')->group(function(){
   Route::get('',[IdentifyProductController::class,'index'])->name('admin.identify.product');  
   Route::get('add',[IdentifyProductController::class,'add'])->name('identify.product.add');
   Route::post('create',[IdentifyProductController::class,'create'])->name('identify.product.create');
   Route::get('edit/{id}', [IdentifyProductController::class, 'edit'])->name('identify.product.edit');
   Route::put('update',[IdentifyProductController::class,'update'])->name('identify.product.update');
   Route::get('update-status/{id}/{status}',[IdentifyProductController::class,'updateStatus'])->name('identify.product.update.status'); 
   Route::get('bottom-action', [IdentifyProductController::class, 'bottomAction'])->name('identify.product.bottom.action');
   Route::post('import', [IdentifyProductController::class, 'import'])->name('identify.product.import');
   Route::get('export', [IdentifyProductController::class, 'export']);
   
   Route::get('product-data', [IdentifyProductController::class, 'getProductData']);
   
  });
 });
 
 Route::group(['middleware'=>'role20'],function(){
  Route::prefix('product-negotiation')->group(function(){
   Route::get('',[ProductNegotiationController::class,'index'])->name('product.negotiation');  
   Route::get('add',[ProductNegotiationController::class,'add'])->name('product.negotiation.add');
   Route::get('bottom-action', [ProductNegotiationController::class, 'bottomAction'])->name('product.negotiation.bottom.action');
 });
});

 Route::group(['middleware'=>'role21'],function(){
  Route::prefix('our-client')->group(function(){
   Route::get('',[OurClientController::class,'index'])->name('our.client');  
   Route::get('add',[OurClientController::class,'add'])->name('our.client.add');
   Route::post('create',[OurClientController::class,'create'])->name('our.client.create');
   Route::get('edit/{id}',[OurClientController::class,'edit'])->name('our.client.edit');
   Route::put('update',[OurClientController::class,'update'])->name('our.client.update');
   Route::get('bottom-action',[OurClientController::class, 'bottomAction'])->name('our.client.bottom.action');
  });
 });
 
 Route::group(['middleware'=>'role22'],function(){
  Route::prefix('our-partner')->group(function(){
   Route::get('',[OurPartnerController::class,'index'])->name('our.partner');  
   Route::get('add',[OurPartnerController::class,'add'])->name('our.partner.add');
   Route::post('create',[OurPartnerController::class,'create'])->name('our.partner.create');
   Route::get('edit/{id}',[OurPartnerController::class,'edit'])->name('our.partner.edit');
   Route::put('update',[OurPartnerController::class,'update'])->name('our.partner.update');
   Route::get('bottom-action',[OurPartnerController::class, 'bottomAction'])->name('our.partner.bottom.action');
  });
 });
 
Route::group(['middleware'=>'role23'],function(){
 Route::prefix('offer')->group(function(){
  Route::get('',[OfferController::class,'index'])->name('admin.offer');  
  Route::get('add',[OfferController::class,'add'])->name('offer.add');
  Route::post('create',[OfferController::class,'create'])->name('offer.create');
  Route::get('edit/{id}',[OfferController::class,'edit'])->name('offer.edit');
  Route::put('update',[OfferController::class,'update'])->name('offer.update');
  Route::get('bottom-action', [OfferController::class, 'bottomAction'])->name('offer.bottom.action');
  Route::get('update-status/{id}/{status}', [OfferController::class, 'updateStatus'])->name('offer.update.status');
 });
});

 Route::group(['middleware'=>'role24'],function(){
  Route::prefix('product-reviews')->group(function(){
   Route::get('',[ReviewController::class,'index'])->name('admin.product.reviews');  
   Route::get('detail/{product_id}', [ReviewController::class, 'detail'])->name('admin.product.review.detail');
   Route::get('bottom-action', [ReviewController::class, 'bottomAction'])->name('product.review.detail.bottom.action');
  });
 });
 
 Route::group(['middleware'=>'role25'],function(){
  Route::prefix('location')->group(function(){
   
   /* STATES ROUTES START */      
   Route::get('',[LocationController::class,'states'])->name('admin.location'); 
   Route::get('add',[LocationController::class,'addState']);
   Route::post('create',[LocationController::class,'createState'])->name('location.create');
   Route::put('update',[LocationController::class,'updateState']);
   Route::get('bottom-action', [LocationController::class, 'bottomActionState'])->name('location.bottom.action');
   Route::get('search', [LocationController::class, 'searchState'])->name('location.search');
   /* STATES ROUTES END */
   
 /* DISTRICT ROUTES START */
  Route::get('district/add',[LocationController::class,'addDistrict']);
  Route::post('district/create', [LocationController::class, 'createDistrict']);
  Route::put('district/update', [LocationController::class, 'updateDistrict']);
  Route::get('district/search', [LocationController::class, 'searchDistrict'])->name('district.search');
  Route::get('district/bottom-action', [LocationController::class, 'bottomActionDistrict'])->name('district.bottom.action');
  Route::get('district/{state_id}',[LocationController::class,'districts'])->name('district');
 /* DISTRICT ROUTES END */
   
  });
 });
 
 Route::group(['middleware'=>'role26'],function(){
  Route::prefix('testimonial')->group(function(){
   Route::get('',[TestimonialController::class,'index'])->name('admin.testimonial');  
   Route::get('add',[TestimonialController::class,'add'])->name('testimonial.add');
   Route::post('create',[TestimonialController::class,'create'])->name('testimonial.create');
   Route::get('edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
   Route::post('update/{id}',[TestimonialController::class,'update'])->name('testimonial.update');
   Route::get('update-status/{id}/{status}',[TestimonialController::class,'updateStatus'])->name('testimonial.update.status'); 
   Route::get('remove-image/{id}', [TestimonialController::class, 'removeImage'])->name('testimonial.remove.image');
   Route::get('bottom-action', [TestimonialController::class, 'bottomAction'])->name('testimonial.bottom.action');
 });
});

 Route::group(['middleware'=>'role27'],function(){
  Route::prefix('return-refund')->group(function(){
   Route::get('',[ReturnRefundController::class,'index'])->name('admin.return.refund');  
   Route::get('bottom-action', [ReturnRefundController::class, 'bottomAction'])->name('return.refund.bottom.action');
   Route::get('update-status', [ReturnRefundController::class, 'updateRefundStatus']);
  });
 });
 
 Route::group(['middleware'=>'role28'],function(){
  Route::prefix('our-associates')->group(function(){
   Route::get('',[OurAssociatesController::class,'index'])->name('our.associates');
   Route::get('add',[OurAssociatesController::class,'add'])->name('our.associates.add');
   Route::post('create',[OurAssociatesController::class,'create'])->name('our.associates.create');
   Route::get('edit/{id}',[OurAssociatesController::class,'edit'])->name('our.associates.edit');
   Route::put('update',[OurAssociatesController::class,'update'])->name('our.associates.update');
   Route::get('bottom-action',[OurAssociatesController::class, 'bottomAction'])->name('our.associates.bottom.action');
  });
 });
 
 Route::group(['middleware'=>'role29'],function(){
   Route::prefix('showcase')->group(function(){
    Route::get('',[ShowcaseController::class,'index'])->name('showcase');  
    Route::get('add',[ShowcaseController::class,'add'])->name('showcase.add');
    Route::post('create',[ShowcaseController::class,'create'])->name('showcase.create');
    Route::get('edit/{id}', [ShowcaseController::class, 'edit'])->name('showcase.edit');
    Route::put('update',[ShowcaseController::class,'update'])->name('showcase.update');
    Route::get('update-status/{id}/{status}',[ShowcaseController::class,'updateStatus'])->name('showcase.update.status'); 
    Route::get('remove-image/{id}/{column}', [ShowcaseController::class, 'removeImage'])->name('showcase.remove.image');
    Route::get('bottom-action', [ShowcaseController::class, 'bottomAction'])->name('showcase.bottom.action');
   });

  Route::prefix('showcase/product')->group(function(){
   Route::get('bottom-action', [ShowcaseController::class, 'bottomActionShowcaseProduct'])->name('showcase.product.bottom.action');
   Route::get('company-products', [ShowcaseController::class, 'companyProducts']);
   Route::post('create', [ShowcaseController::class, 'createShowcaseProduct'])->name('showcase.product.create');
   Route::get('{showcase_id}', [ShowcaseController::class, 'showcaseProducts'])->name('showcase.product');
   Route::get('{showcase_id}/add', [ShowcaseController::class, 'addShowcaseProduct'])->name('showcase.product.add');
   Route::get('update-status/{id}/{status}', [ShowcaseController::class, 'updateShowcaseProductStatus'])->name('showcase.product.update.status');
   });
  });
  
 Route::group(['middleware'=>'role30'],function(){
  Route::prefix('faq')->group(function(){
   Route::get('',[FaqController::class,'index'])->name('admin.faq');
   Route::get('add',[FaqController::class,'add'])->name('faq.add');
   Route::post('create',[FaqController::class,'create'])->name('faq.create');
   Route::get('edit/{id}',[FaqController::class,'edit'])->name('faq.edit');
   Route::put('update',[FaqController::class,'update'])->name('faq.update');
   Route::get('bottom-action',[FaqController::class, 'bottomAction'])->name('faq.bottom.action');
   Route::get('update-status/{id}/{status}',[FaqController::class,'updateStatus'])->name('faq.update.status');
  });
 });
 
 Route::group(['middleware'=>'role31'],function(){
  Route::prefix('log')->group(function(){
   Route::get('', [LogController::class, 'index'])->name('log');  
   Route::get('search', [LogController::class, 'search'])->name('log.search');
  });     
 });
 
 Route::group(['middleware'=>'role32'],function(){
  Route::prefix('certificate')->group(function(){
   Route::get('',[CertificateController::class,'index'])->name('admin.certificate');  
   Route::get('add',[CertificateController::class,'add'])->name('certificate.add');
   Route::post('create',[CertificateController::class,'create'])->name('certificate.create');
   Route::get('edit/{id}', [CertificateController::class, 'edit'])->name('certificate.edit');
   Route::post('update/{id}',[CertificateController::class,'update'])->name('certificate.update');
   Route::get('update-status/{id}/{status}',[CertificateController::class,'updateStatus'])->name('certificate.update.status'); 
   Route::get('remove-image/{id}/{column}', [CertificateController::class, 'removeImage'])->name('certificate.remove.image');
   Route::get('bottom-action', [CertificateController::class, 'bottomAction'])->name('certificate.bottom.action');
  });
 });

});


//#############################################################################

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('about-us.html', [SiteController::class, 'aboutUs'])->name('about-us');
Route::get('blog.html', [SiteController::class, 'blog'])->name('blog');
Route::get('our-client.html', [SiteController::class, 'ourClient'])->name('our-client');
Route::get('our-partner.html', [SiteController::class, 'ourPartner'])->name('our-partner');
Route::get('all-categories.html', [SiteController::class, 'categories'])->name('all-categories');
Route::get('brands.html', [SiteController::class, 'brands'])->name('brands');
Route::get('support.html', [SiteController::class, 'support'])->name('support');
Route::get('all-products.html', [SiteController::class, 'allProducts'])->name('all-products'); 
Route::get('contact-us.html', [SiteController::class, 'contactUs'])->name('contact-us');
Route::get('faq.html', [SiteController::class, 'faq'])->name('faq');
Route::get('buy-with-confidence.html', [SiteController::class, 'buyWithConfidence'])->name('buy.with.confidence');
Route::get('buy-with-confidence/{certificate}', [SiteController::class, 'viewCertificate']);

Route::get('sitemap.html', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('gallery.html', [SiteController::class, 'gallery'])->name('gallery');
Route::get('terms-conditions.html', [SiteController::class, 'termsConditions'])->name('terms-conditions');
Route::get('privacy-policy.html', [SiteController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('shipping-policy.html', [SiteController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('refund-return-policy.html', [SiteController::class, 'refundReturnPolicy'])->name('refund-return-policy');
Route::post('submit-enquiry', [SiteController::class, 'submitEnquiry'])->name('enquiry.submit')->middleware('throttle:2,1');
Route::get('compare', [SiteController::class, 'compare'])->name('compare');
Route::get('search', [SiteController::class, 'search'])->name('search');
Route::get('warranty', [SiteController::class, 'warranty'])->name('warranty');
Route::get('support/search', [SiteController::class, 'supportSearch'])->name('support.search');
Route::get('software-driver.html', [SiteController::class, 'softwareDriver'])->name('software-driver');
Route::get('gift-offer.html', [SiteController::class, 'giftOffer'])->name('gift-offer');

//LOGIN WITH GOOGLE
Route::get('{provider}/redirect', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');

Route::get('unsubscribe/{email}', [SiteController::class, 'unsubscribe'])->name('subscription.unsubscribe');
Route::get('product-review/{id}', [SiteController::class, 'productReview'])->name('product.review');

Route::get('sitemap.xml', [SitemapController::class, 'sitemap']);

//AJAX ROUTES START
Route::get('get-states', [AjaxController::class, 'getStates']);
Route::get('autocomplete', [AjaxController::class, 'autocomplete']);
Route::get('load-products', [AjaxController::class, 'loadProducts']);
Route::get('quick-view', [AjaxController::class, 'quickView']);
Route::post('submit-rating', [AjaxController::class, 'submitRating']);
Route::get('add-compare', [AjaxController::class, 'addCompare']);
Route::get('check-pincode-availability', [AjaxController::class, 'checkPincodeAvailability']);
Route::get('check-pincode', [AjaxController::class, 'checkPincode']);
Route::get('product-negotiation', [AjaxController::class, 'productNegotiation']);
Route::post('product-negotiation/submit', [AjaxController::class, 'submitProductNegotiation']);
Route::get('showcase', [AjaxController::class, 'showcase']);
Route::get('checkout/payment_type', [AjaxController::class, 'paymentType']);

//CART RELATED ROUTES
Route::get('cart.html', [CartController::class, 'index'])->name('cart');
Route::post('add-cart', [CartController::class, 'addCart']);
Route::get('mini-cart', [CartController::class, 'miniCart']);
Route::get('remove-cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('update-cart', [CartController::class, 'updateCart']);

//WISHLIST RELATED ROUTES
Route::post('add-wishlist', [CartController::class, 'addWishlist']);
Route::get('wishlist', [CartController::class, 'wishlistList'])->name('wishlist');
Route::get('remove-wishlist/{id}', [CartController::class, 'removeWishlist'])->name('wishlist.remove');

Route::get('send-subscription-verification-request', [SiteController::class, 'sendSubscriptionVerificationRequest']);
Route::get('subscription-verification/{email}/{token}', [SiteController::class, 'subscriptionVerification'])->name('subscription-verification');

//COUPON RELATED ROUTES
Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('coupon.apply');
Route::get('remove-coupon/{id}', [CartController::class, 'removeCoupon'])->name('coupon.remove');

Route::get('checkout.html', [CheckoutController::class, 'index'])->name('checkout');
Route::post('generate-order', [CheckoutController::class, 'generateOrder'])->name('checkout.generate.order');

Route::get('payment/razorpay', [CheckoutController::class, 'requestRazorpay'])->name('checkout.razorpay');
Route::post('payment/razorpay', [CheckoutController::class, 'responseRazorpay'])->name('checkout.razorpay.proceed');

Route::get('payment/payu', [CheckoutController::class, 'requestPayu'])->name('checkout.payu');
Route::post('payment/payu', [CheckoutController::class, 'responsePayu'])->name('checkout.payu.proceed');
Route::post('payment/payu/cancel', [CheckoutController::class, 'payuCancel'])->name('payu.cancel');

Route::get('success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('{slug}.htm', [SiteController::class, 'products'])->name('products');
Route::get('{slug}.html', [SiteController::class, 'productDetail'])->name('product.detail');
Route::get('blog/{slug}', [SiteController::class, 'blogDetail'])->name('blog.detail');
Route::get('brand/{slug}.html', [SiteController::class, 'brandDetail'])->name('brand.detail');
Route::get('category-wise-brand/{category_slug}/{brand_slug}.htm', [SiteController::class, 'categoryWiseBrand'])->name('category.wise.brand');

/* USER PANEL ROUTES */

Route::prefix('user')->group(function(){
 Route::get('', [UserController::class, 'index'])->name('userpanel'); 
 Route::get('profile', [UserController::class, 'profile'])->name('userpanel.profile'); 
 Route::post('profile/update', [UserController::class, 'updateProfile'])->name('userpanel.profile.update');
 Route::get('change-password', [UserController::class, 'changePassword'])->name('userpanel.changepassword');
 Route::post('change-password/update', [UserController::class, 'updateChangePassword'])->name('userpanel.changepassword.update');  
 Route::get('address', [UserController::class, 'address'])->name('userpanel.address');
 Route::get('address/add', [UserController::class, 'addAddress'])->name('userpanel.address.add');
 Route::post('address/create', [UserController::class, 'createAddress'])->name('userpanel.address.create');
 Route::get('address/edit/{id}', [UserController::class, 'editAddress'])->name('userpanel.address.edit');
 Route::post('address/update', [UserController::class, 'updateAddress'])->name('userpanel.address.update');
 Route::get('address/remove/{id}', [UserController::class, 'removeAddress'])->name('userpanel.address.remove');
 Route::get('order', [UserController::class, 'orders'])->name('userpanel.order');
 Route::get('order/cancel', [UserController::class, 'orderCancelModal'])->name('userpanel.order.cancel');
 Route::get('order/invoice/view/{id}', [UserController::class, 'viewInvoice'])->name('userpanel.order.viewinvoice');
 Route::get('ticket', [UserController::class, 'tickets'])->name('userpanel.ticket');
 Route::get('search-ticket', [UserController::class, 'searchTicket'])->name('userpanel.ticket.search');
 Route::get('raise-ticket', [UserController::class, 'raiseTicket']);
 Route::post('submit-ticket', [UserController::class, 'submitTicket']);
 Route::get('view-ticket', [UserController::class, 'viewTicket']);
 Route::get('close-ticket/{ticket_id}', [UserController::class, 'closeTicket'])->name('userpanel.ticket.close');
 Route::get('order/detail/{id}', [UserController::class, 'orderDetail'])->name('userpanel.order.detail');
 Route::post('order/cancel', [UserController::class, 'orderCancel'])->name('userpanel.order.cancel');
 
 //RETURN & REFUND ORDER
  Route::get('order/return-refund', [UserController::class, 'returnRefund'])->name('userpanel.order.return');
  Route::get('order/return-refund/request', [UserController::class, 'returnRefundRequestPopup']);
  Route::post('order/return-refund/request', [UserController::class, 'returnRefundRequest']);
 
 Route::get('set-default-address', [UserController::class, 'setDefaultAddress'])->name('user.setdefaultaddress');
});
    
/* MARKET AREA ROUTES */
Route::get('{market_area}', [SiteController::class, 'index']);
Route::get('{market_area}/{slug}.htm', [SiteController::class, 'category']);
Route::get('{market_area}/{slug}.html', [SiteController::class, 'productDetail'])->name('product.detail');