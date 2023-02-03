@extends('layouts.app')



@section('content')
        <div class="page-wrapper">

            <!-- ============================================================== -->

            <!-- Bread crumb and right sidebar toggle -->

            <!-- ============================================================== -->

            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-themecolor restaurantTitle">{{trans('lang.food_plural')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.food_plural')}}</li>
                    </ol>

                </div>

                <div>

                </div>

            </div>

      

            <div class="container-fluid">

                <div class="row">

                    <div class="col-12">

                       
                        <?php if($id!=''){ ?>
                          <div class="menu-tab">
                                <ul>
                                    <li >
                                        <a href="{{route('restaurants.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                                    </li>
                                    <li class="active">
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
                                    <li >
                                        <a href="{{route('restaurants.booktable',$id)}}">{{trans('lang.dine_in_future')}}</a>
                                    </li>
                                   <!--  <li>
                                        <a href="{{route('restaurants.coupons',$id)}}">{{trans('lang.tab_coupons')}}</a>
                                    </li> -->
                                </ul>
                          </div>
                      <?php } ?>

                        <div class="card">
                             <div class="card-header">
                              <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                  <li class="nav-item">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.food_table')}}</a>
                                  </li>
                                  <?php if($id!=''){?>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{!! route('foods.create') !!}/{{$id}}"><i class="fa fa-plus mr-2"></i>{{trans('lang.food_create')}}</a>
                                  </li>
                              <?php }else{ ?>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{!! route('foods.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.food_create')}}</a>
                                  </li>
                             <?php  } ?>
 
                              </ul>
                            </div>
                            <div class="card-body">

                            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>


                                <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{trans('lang.title')}}</option>
                                </select>
                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                            </div>
                            </div>
 
                                <div class="table-responsive m-t-10">


                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>
                                                <th>{{trans('lang.food_image')}}</th>
                                                <th>{{trans('lang.food_name')}}</th>
                                                <th>{{trans('lang.food_price')}}</th>
                                                <?php if($id ==''){ ?>
                                                    <th>{{trans('lang.food_restaurant_id')}}</th>
                                                <?php }?> 
                                                
                                                <th>{{trans('lang.food_category_id')}}</th>
                                                <th>{{trans('lang.food_publish')}}</th>
                                                <th>{{trans('lang.actions')}}</th>
                                            </tr>

                                        </thead>

                                        <tbody id="append_list1">


                                        </tbody>

                                    </table>
                                                      <nav aria-label="Page navigation example">
                                         <ul class="pagination justify-content-center">
                                            <li class="page-item ">
                                                <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                            </li>
                                            <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                            </li>
                                        </ul>
                                    </nav>
                </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>



@endsection


@section('scripts')
   <script type="text/javascript">
    
    var database = firebase.firestore();
    var offest=1;
    var pagesize=10; 
    var end = null;
    var endarray=[];
    var start = null;
    var user_number = [];
    var currentCurrency = '';
    var currencyAtRight = false;
    <?php if($id!=''){ ?>
    var ref = database.collection('vendor_products').where('vendorID','==','<?php echo $id; ?>');
    const getStoreName = getStoreNameFunction('<?php echo $id; ?>');

    <?php }else{ ?>
    var ref = database.collection('vendor_products');
    <?php } ?>

    var refCurrency = database.collection('currencies').where('isActive', '==' , true);
    var append_list = '';

    refCurrency.get().then( async function(snapshots){  
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
    }); 

    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then( async function(snapshotsimage){
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })


$(document).ready(function() {

    $(document.body).on('click', '.redirecttopage' ,function(){    
        var url=$(this).attr('data-url');
        window.location.href = url;
    });

    var inx= parseInt(offest) * parseInt(pagesize);
    jQuery("#data-table_processing").show();
  
    append_list = document.getElementById('append_list1');
    append_list.innerHTML='';
    ref.limit(pagesize).get().then( async function(snapshots){  
    html='';
    
    html=buildHTML(snapshots);
    
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length < pagesize){
            jQuery("#data-table_paginate").hide();
        }
        disableClick();
     }
     jQuery("#data-table_processing").hide();
  }); 
 
});


function buildHTML(snapshots){
        var html='';
        var alldata=[];
        var number= [];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });

        var count = 0;
        alldata.forEach((listval) => {
            
            var val=listval;
            
                html=html+'<tr>';
                newdate='';

                var id = val.id;
                var route1 =  '{{route("foods.edit",":id")}}';
                route1 = route1.replace(':id', id);
                
                <?php if($id!=''){ ?>

                    route1 =route1+'?eid={{$id}}';

                <?php }?>
                
                   var caregoryroute =  '{{route("categories.edit",":id")}}';
                caregoryroute = caregoryroute.replace(':id', val.categoryID);

                 var restaurantroute =  '{{route("restaurants.view",":id")}}';
                restaurantroute = restaurantroute.replace(':id', val.vendorID);
                if (val.photo!= '') {
                    html=html+'<td><img class="rounded" style="width:50px" src="'+val.photo+'" alt="image"></td>';

                }else{
                    
                    html=html+'<td><img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image"></td>';
                }
                html=html+'<td data-url="'+route1+'" class="redirecttopage">'+val.name+'</td>';

               /* priceFood = "";
                if(currencyAtRight){
                    priceFood = val.price+""+currentCurrency;
                }else{
                     priceFood = currentCurrency+""+val.price;
                }
                  
                html=html+'<td>'+priceFood+'</td>';*/

                if(val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0' ){
                    if(currencyAtRight){

                        html=html+'<td>'+val.disPrice+''+currentCurrency+'  <s>'+val.price+''+currentCurrency+'</s></td>';
                    }else{
                         html=html+'<td>'+''+currentCurrency+val.disPrice+'  <s>'+currentCurrency+''+val.price+'</s> </td>';
                    }
                    
                }else{    
                
                if(currencyAtRight){
                        html=html+'<td>'+val.price+''+currentCurrency+'</td>';
                    }else{
                         html=html+'<td>'+currentCurrency+''+val.price+'</td>';
                    }
                }


                <?php if($id ==''){ ?>
                    const restaurant = productRestaurant(val.vendorID);
                    html=html+'<td data-url="'+restaurantroute+'" class="redirecttopage restaurant_'+val.vendorID+'"></td>';
                <?php }?> 


                const category = productCategory(val.categoryID);
                html=html+'<td data-url="'+caregoryroute+'" class="redirecttopage category_'+val.categoryID+'"></td>';
                if(val.publish){
                    html=html+'<td><span class="badge badge-success">Yes</span></td>';
                }else{
                    html=html+'<td><span class="badge badge-danger">No</span></td>';
                }
                html=html+'<td class="action-btn"><a href="'+route1+'" class="link-td"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="food-delete" href="javascript:void(0)" class="link-td do_not_delete"><i class="fa fa-trash"></i></a></td>';
                
                html=html+'</tr>';
                count =count +1;
          });
          return html;      
}

async function productRestaurant(restaurant) {
var productRestaurant='';
await database.collection('vendors').where("id","==",restaurant).get().then( async function(snapshotss){
                  var restaurantroute =  '{{route("restaurants.edit",":id")}}';
                restaurantroute = restaurantroute.replace(':id', restaurant);

            if(snapshotss.docs[0]){
                var restaurant_data = snapshotss.docs[0].data();
                productRestaurant = restaurant_data.title;

                jQuery(".restaurant_"+restaurant).html(productRestaurant);
            }else{
                jQuery(".restaurant_"+restaurant).html('');
            } 
});
return productRestaurant;
} 

  async function getStoreNameFunction(vendorId){
     var vendorName = '';
        await database.collection('vendors').where('id', '==', vendorId).get().then(async function (snapshots) {
        var vendorData = snapshots.docs[0].data();

        vendorName = vendorData.title;
        $('.restaurantTitle').html('{{trans('lang.food_plural')}} - ' + vendorName);
        
        if(vendorData.dine_in_active==true){
            $(".dine_in_future").show();
        }
        
    });

    return vendorName;

}

async function productCategory(category) {
var productCategory='';
await database.collection('vendor_categories').where("id","==",category).get().then( async function(snapshotss){
                var caregoryroute =  '{{route("categories.edit",":id")}}';
                caregoryroute = caregoryroute.replace(':id', category);
            if(snapshotss.docs[0]){
                var category_data = snapshotss.docs[0].data();
                productCategory = category_data.title;
                console.log(productCategory);
                jQuery(".category_"+category).html(productCategory);
            }else{
                jQuery(".category_"+category).html('');
            } 
});
return productCategory;
} 

function prev(){
    if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];  
  if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();
                 if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

                    listener=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();
                }else{
                    listener = ref.startAt(end).limit(pagesize).get();
                }
                
                listener.then((snapshots) => {
                html='';
                html=buildHTML(snapshots);
                jQuery("#data-table_processing").hide();
                if(html!=''){
                    append_list.innerHTML=html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    console.log(start);
                    endarray.splice(endarray.indexOf(endarray[endarray.length-1]),1);

                    if(snapshots.docs.length < pagesize){ 
   
                        jQuery("#users_table_previous_btn").hide();
                    }
                    
                }
            });
  }
}


function next(){
  if(start!=undefined || start!=null){
        jQuery("#data-table_processing").hide();

          if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

                listener=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();
            }else{
                listener = ref.startAfter(start).limit(pagesize).get();
            }
          listener.then((snapshots) => {
            
                html='';
                html=buildHTML(snapshots);

                jQuery("#data-table_processing").hide();
                if(html!=''){
                    append_list.innerHTML=html;
                    start = snapshots.docs[snapshots.docs.length - 1];

                    if(endarray.indexOf(snapshots.docs[0])!=-1){
                        endarray.splice(endarray.indexOf(snapshots.docs[0]),1);
                    }
                    endarray.push(snapshots.docs[0]);
                }
            });
    }
}

function searchclear(){
    jQuery("#search").val('');
    searchtext();
}

function searchtext(){
  var offest=1;
  jQuery("#data-table_processing").show();
  
  append_list.innerHTML='';  

   if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

     wherequery=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

   } else{

    wherequery=ref.limit(pagesize).get();
  }
  
  wherequery.then((snapshots) => {
    html='';
    html=buildHTML(snapshots);
    jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length < pagesize){ 
   
            jQuery("#data-table_paginate").hide();
        }else{

            jQuery("#data-table_paginate").show();
        }
    }
}); 

}

$(document).on("click","a[name='food-delete']", function (e) {
        var id = this.id;

    database.collection('vendor_products').doc(id).delete().then(function(result){
        window.location.href = '{{ url()->current() }}';
    }); 



});

     function disableClick(){
    var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE'); ?>";
    if(is_disable_delete == 1){
        jQuery("a.do_not_delete").removeAttr("name");
        jQuery("a.do_not_delete").attr("name","alert_demo");       
    }
}


$(document).on("click","a[name='alert_demo']", function (e) {
    alert(doNotDeleteAlert);
});


</script>


@endsection
