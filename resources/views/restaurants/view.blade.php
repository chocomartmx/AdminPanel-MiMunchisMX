@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.restaurant_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('restaurants') !!}" >{{trans('lang.restaurant_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.restaurant_details')}}</li>
            </ol>
        </div>
    
  </div>
 
   <div class="container-fluid">
   	<div class="row">
   		<div class="col-12">

    <div class="resttab-sec">
      	<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
      <div class="menu-tab">
      	<?php /* ?>	<ul>
      			<li class="active">
      					<a href="#">Basic</a>
      			</li>
      			<li>
      					<a href="{{route('restaurants.foods',$id)}}">Foods</a>
      			</li>
      			<li>
      					<a href="{{route('restaurants.orders',$id)}}">Orders</a>
      			</li>
      			<li>
      					<a href="{{route('restaurants.reviews',$id)}}">Reviews</a>
      			</li>
      			<li>
      					<a href="{{route('restaurants.promos',$id)}}">Promos</a>
      			<li>
      					<a href="{{route('restaurants.payout',$id)}}">Payouts</a>
      			</li>
      		</ul> <?php */ ?>
          <ul>
            <li class="active">
                <a href="{{route('restaurants.view',$id)}}">{{trans('lang.tab_basic')}}</a>
            </li>
            <li>
                <a href="{{route('restaurants.foods',$id)}}">{{trans('lang.tab_foods')}}</a>
            </li>
            <li>
                <a href="{{route('restaurants.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
            </li>
            <li>
                <a href="{{route('restaurants.reviews',$id)}}">{{trans('lang.tab_reviews')}}</a>
            </li>
            <li>
                <a href="{{route('restaurants.coupons',$id)}}">{{trans('lang.tab_promos')}}</a>
            <li>
                <a href="{{route('restaurants.payout',$id)}}">{{trans('lang.tab_payouts')}}</a>
              </li>
              <li>
                <a href="{{route('restaurants.booktable',$id)}}">{{trans('lang.dine_in_future')}}</a>
            </li>
            <!-- <li>
                <a href="{{route('restaurants.coupons',$id)}}">{{trans('lang.tab_coupons')}}</a>
            </li> -->
        </ul>

      </div>
      <div class="row daes-top-sec mb-3">
      			
            <div class="col-lg-3 col-md-6">

                  <div class="card">

                      <div class="flex-row">

                          <div class="p-10 bg-info col-md-12 text-center">

                              <h3 class="text-white box m-b-0"><i class="mdi mdi-cart"></i></h3></div>

                          <div class="align-self-center pt-3 col-md-12 text-center">

                              <h3 class="m-b-0 text-info" id="total_orders">0</h3>

                              <h5 class="text-muted m-b-0">Total Order</h5>

                          </div>

                      </div>

                  </div>

            </div>

            <div class="col-lg-3 col-md-6">

                  <div class="card">

                      <div class="flex-row">

                          <div class="p-10 bg-info col-md-12 text-center">

                              <h3 class="text-white box m-b-0"><i class="mdi mdi-bank"></i></h3></div>

                          <div class="align-self-center pt-3 col-md-12 text-center">

                              <h3 class="m-b-0 text-info" id="total_earnings">0</h3>

                              <h5 class="text-muted m-b-0">Total Earning</h5>

                          </div>

                      </div>

                  </div>

            </div>

            <div class="col-lg-3 col-md-6">

                  <div class="card">

                      <div class="flex-row">

                          <div class="p-10 bg-info col-md-12 text-center">

                              <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>

                          <div class="align-self-center pt-3 col-md-12 text-center">

                              <h3 class="m-b-0 text-info" id="total_payment">0</h3>

                              <h5 class="text-muted m-b-0">Total Payment</h5>

                          </div>

                      </div>

                  </div>

            </div>

            <div class="col-lg-3 col-md-6">

                  <div class="card">

                      <div class="flex-row">

                          <div class="p-10 bg-info col-md-12 text-center">

                              <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>

                          <div class="align-self-center pt-3 col-md-12 text-center">

                              <h3 class="m-b-0 text-info" id="remaining_amount">0</h3>

                              <h5 class="text-muted m-b-0">Remaining Payment</h5>

                          </div>

                      </div>

                  </div>

            </div>

      </div>

     
      <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.restaurant_details')}}</legend>

              <div class="form-group row width-50 restaurant_image">
              	<div class="col-7">
                	<span class="restaurant_image" id="restaurant_image"></span>
              	</div>
               <div class="col-7 align-items-center justify-content-center d-flex review-box mt-3 mb-3">
              	<div class="reviewhtml"></div>
                <div class="review_count">Reviews<span id="restaurant_reviewcount"></span></div>
                </div>
            	</div>
              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.restaurant_name')}}</label>
               	<div class="col-7">
                	<span class="restaurant_name"></span>
              	</div>
            	</div>

            	<div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.restaurant_phone')}}</label>
               	<div class="col-7">
                	<span class="restaurant_phone"></span>
              	</div>
            	</div>

            	<div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.restaurant_address')}}</label>
               	<div class="col-7">
                	<span class="restaurant_address"></span>
              	</div>
            	</div>

            	<div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.restaurant_description')}}</label>
               	<div class="col-7">
                	<span class="restaurant_description"></span>
              	</div>
            	</div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.restaurant_cuisines')}}</label>
                <div class="col-7">
                  <span class="restaurant_cuisines"></span>
                </div>
              </div>
              

            </fieldset>
          </div>
        </div>

        
        <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.gallery')}}</legend>

              <div class="form-group row width-50 restaurant_image">
                <div class="">
                    <div id="photos"></div>
                </div>
              </div>
            </fieldset>
          </div>
      </div>

        <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.vendor_details')}}</legend>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.name')}}</label>
               	<div class="col-7">
                	<span class="vendor_name"></span>
              	</div>
            	</div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.email')}}</label>
                <div class="col-7">
                  <span class="vendor_email"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.restaurant_status')}}</label>
                <div class="col-7">
                  <span class="vendor_avtive"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.restaurant_phone')}}</label>
                <div class="col-7">
                  <span class="vendor_phoneNumber"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.dine_in_future')}}</label>
                <div class="col-7">
                  <span class="dine_in_future"></span>
                </div>
              </div>


            </fieldset>
          </div>
      </div>

      <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.timing')}}</legend>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                <div class="col-7">
                  <span class="opentime"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                <div class="col-7">
                  <span class="closetime"></span>
                </div>
              </div>

            </fieldset>
          </div>
      </div>

      <div class="row restaurant_payout_create restaurant_details">
        <div class="restaurant_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.services')}}</legend>

              <div class="form-group row width-100">
                <div class="col-7" id="filtershtml">
                    
                </div>
              </div>
            </fieldset>
          </div>
      </div>

      
   </div>


</div>
      <div class="form-group col-12 text-center btm-btn">
         <a href="{!! route('restaurants') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
      </div>

    </div>
  </div>
</div>


 @endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
 <script>
	var id = "<?php echo $id;?>";
	var database = firebase.firestore();
	var ref = database.collection('vendors').where("id","==",id);
	var photo ="";
	var restaurantOwnerId = "";
	var restaurantOwnerOnline = false;

  var placeholderImage = '';
  var placeholder = database.collection('settings').doc('placeHolderImage');
 
  placeholder.get().then( async function(snapshotsimage){
    var placeholderImageData = snapshotsimage.data();
    placeholderImage = placeholderImageData.image;
  })

	$(document).ready(async function(){
		  var orders= await getTotalOrders();
      var earnings= await getTotalEarnings();
		  var payment=await getTotalpayment();
		  var remaining=earnings-payment;
		  $("#remaining_amount").text(remaining);
  		jQuery("#data-table_processing").show();
  		ref.get().then( async function(snapshots){
			var restaurant = snapshots.docs[0].data();
			$(".restaurant_name").text(restaurant.title);
      var rating=0;
      if( restaurant.hasOwnProperty('reviewsCount') && restaurant.reviewsCount!=0 ){
        //console.log(parseFloat(restaurant.reviewsSum) +''+ parseInt(restaurant.reviewsCount) )
          rating = Math.round(parseFloat(restaurant.reviewsSum)/parseInt(restaurant.reviewsCount)); 
      }else{
        rating =0;
      }

      const getStoreName = getStoreNameFunction('<?php echo $id; ?>');

      //console.log('rating'+rating);
			var review='<ul class="rating" data-rating="'+rating+'">';
        review=review+'<li class="rating__item"></li>';
        review=review+'<li class="rating__item"></li>';
        review=review+'<li class="rating__item"></li>';
        review=review+'<li class="rating__item"></li>';
        review=review+'<li class="rating__item"></li>';
      review=review+'</ul>';
      $("#restaurant_reviewcount").text(restaurant.reviewsCount);
      
      if(restaurant.reststatus==true){
          $(".vendor_avtive").text("Open");
          $(".vendor_avtive").addClass("open");
        }else{
          $(".vendor_avtive").text("Closed");
          $(".vendor_avtive").addClass("closed");
      }

      var photos='';
      restaurant.photos.forEach((photo) => {
            photos=photos+'<span class="image-item"><img width="100px" id="" height="auto" src="'+photo+'"></span>';
      })
      if(photos){
        $("#photos").html(photos);
      }else{
        $("#photos").html('<p>photos not available.</p>');
      }

      var image="";
      if (restaurant.photo) {
        image='<img width="200px" id="" height="auto" src="'+restaurant.photo+'">';
      }else{
        image='<img width="200px" id="" height="auto" src="'+placeholderImage+'">';
      }
			$("#restaurant_image").html(image);
			$(".reviewhtml").html(review);

      filtershtml='';
      for (var key in restaurant.filters) {
          filtershtml=filtershtml+'<li>'+key+': '+restaurant.filters[key]+'</li>';
      }

      $("#filtershtml").html(filtershtml);
      

      await database.collection('vendor_categories').get().then( async function(snapshots){
          snapshots.docs.forEach((listval) => {
                var data = listval.data();
                if(data.id == restaurant.categoryID){
                  $(".restaurant_cuisines").text(data.title);
                }
            })
      }); 


      $(".opentime").text(restaurant.opentime);
      $(".closetime").text(restaurant.closetime);
      

			$(".restaurant_address").text(restaurant.location);
			$(".restaurant_latitude").text(restaurant.latitude);
			$(".restaurant_longitude").text(restaurant.longitude);
			$(".restaurant_description").text(restaurant.description);
      if(restaurant.hasOwnProperty('enabledDiveInFuture') &&  restaurant.enabledDiveInFuture == true){
        $(".dine_in_future").html("ON");  
      }else{
        $(".dine_in_future").html("OFF");
      }
      
      restaurantOwnerOnline = restaurant.isActive;
	   		photo = restaurant.photo;
	    	restaurantOwnerId = restaurant.author;
	 		await database.collection('users').where("id","==",restaurant.author).get().then( async function(snapshots){
	   			snapshots.docs.forEach((listval) => {
	            var user = listval.data();
				        $(".vendor_name").html(user.firstName+" "+user.lastName);
                $(".vendor_email").html(user.email);
                

                $(".vendor_phoneNumber").html(user.phoneNumber);


	          })
			});

			await database.collection('vendor_categories').get().then( async function(snapshots){
	   			snapshots.docs.forEach((listval) => {
	            	var data = listval.data();
	            	if(data.id == restaurant.categoryID){
	                	$('#restaurant_cuisines').append($("<option selected></option>")
	                    	.attr("value", data.id)
	                    	.text(data.title));
	            	}else{
	                	$('#restaurant_cuisines').append($("<option></option>")
	                    	.attr("value", data.id)
	                    	.text(data.title));
			    	}
	          	})

			});  
	    
	    	if(restaurant.hasOwnProperty('phonenumber')){
	     		$(".restaurant_phone").text(restaurant.phonenumber);
	    	}
	  		jQuery("#data-table_processing").hide();
  		})


  
		$(".save_restaurant_btn").click(function(){
		  	var restaurantname = $(".restaurant_name").val();
			var cuisines = $("#restaurant_cuisines option:selected").val();
			var address = $(".restaurant_address").val();	
			var latitude = parseFloat($(".restaurant_latitude").val());
			var longitude = parseFloat($(".restaurant_longitude").val());
			var description = $(".restaurant_description").val();
			var phonenumber = $(".restaurant_phone").val();
			var categoryTitle = $( "#restaurant_cuisines option:selected" ).text();

		    database.collection('vendors').doc(id).update({'title':restaurantname,'description':description,'latitude':latitude,
		      'longitude':longitude,'location':address,'photo':photo,'categoryID':cuisines,'phonenumber':phonenumber,'categoryTitle':categoryTitle}).then(function(result) {
		                window.location.href = '{{ route("restaurants")}}';
		             }); 
		})

	})

	var storageRef = firebase.storage().ref('images');
	function handleFileSelect(evt) {
  		var f = evt.target.files[0];
  		var reader = new FileReader();
	  	reader.onload = (function(theFile) {
		    return function(e) {
		        
		      var filePayload = e.target.result;
		      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
		        var val =f.name;       
		      var ext=val.split('.')[1];
		      var docName=val.split('fakepath')[1];
		      var filename = (f.name).replace(/C:\\fakepath\\/i, '')

		      var timestamp = Number(new Date());      
		      var uploadTask = storageRef.child(filename).put(theFile);
		      console.log(uploadTask);
		      uploadTask.on('state_changed', function(snapshot){

		      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
		      console.log('Upload is ' + progress + '% done');
		      jQuery("#uploding_image").text("Image is uploading...");
		    }, function(error) {
		    }, function() {
		        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
		            jQuery("#uploding_image").text("Upload is completed");
		            photo = downloadURL;

		      });   
		    });
	    
	    };
	  })(f);
  reader.readAsDataURL(f);
}   

  async function getStoreNameFunction(vendorId){
     var vendorName = '';
        await database.collection('vendors').where('id', '==', vendorId).get().then(async function (snapshots) {
        var vendorData = snapshots.docs[0].data();

        vendorName = vendorData.title;
        $('.restaurantTitle').html('{{trans('lang.restaurant_plural')}} - ' + vendorName);
        
        if(vendorData.dine_in_active==true){
            $(".dine_in_future").show();
        }
        
    });

    return vendorName;

}

async function getTotalOrders(){
       
        await database.collection('restaurant_orders').where('vendorID','==','<?php echo $id; ?>').where('status','in',["Order Completed"]).get().then(async function(orderSnapshots){
            var paymentData = orderSnapshots.docs;
            //console.log(paymentData.length);                      
            $("#total_orders").text(paymentData.length);        		
        })
}

async function getTotalEarnings(){
        var totalEarning = 0;
        var adminCommission=0;
        await database.collection('restaurant_orders').where('vendorID','==','<?php echo $id; ?>').where('status','in',["Order Completed"]).get().then(async function(orderSnapshots){
            var paymentData = orderSnapshots.docs;
            paymentData.forEach((order)=>{
                var orderData = order.data();
                var price = 0;
                if(orderData.adminCommission!=undefined){
                    var commission = parseInt(orderData.adminCommission);
                    adminCommission = commission + adminCommission;
                }
                orderData.products.forEach((product)=> {

                    if(product.price && product.quantity != 0){
                        var productTotal = parseInt(product.price)*parseInt(product.quantity);
                        price = price + productTotal;
                    }
                })
                totalEarning = totalEarning + price;
            })
            
            $("#total_earnings").text(totalEarning);
            
        })
     return totalEarning;
}


async function getTotalpayment(driverID){
  var paid_price = 0;
  var total_price = 0;
  var remaining = 0;
  await database.collection('payouts').where('vendorID','==','<?php echo $id; ?>').get().then( async function(payoutSnapshots){   
       payoutSnapshots.docs.forEach((payout)=>{
          var payoutData = payout.data();
          if(payoutData.amount && parseFloat(payoutData.amount)!=undefined && parseFloat(payoutData.amount)!='' && parseFloat(payoutData.amount)!=NaN){
          		paid_price = parseFloat(paid_price) + parseFloat(payoutData.amount);
          }
          
        })
});
$("#total_payment").text(paid_price);
return paid_price; 
}

</script>
@endsection