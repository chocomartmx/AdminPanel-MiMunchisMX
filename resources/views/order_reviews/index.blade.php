@extends('layouts.app')

<?php 

error_reporting(E_ALL ^ E_NOTICE); 
 ?>

@section('content')
        <div class="page-wrapper">

            <!-- ============================================================== -->

            <!-- Bread crumb and right sidebar toggle -->

            <!-- ============================================================== -->

            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-themecolor restaurantTitle">{{trans('lang.order_review')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                        <li class="breadcrumb-item active">{{trans('lang.order_review_table')}}</li>

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
                                    <li >
                                        <a href="{{route('restaurants.foods',$id)}}">{{trans('lang.tab_foods')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('restaurants.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                                    </li>
                                    <li class="active">
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

                            <div class="card-body">
                                
                                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                                
                            <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="order_id">{{ trans('lang.order_id')}}</option>
                                </select>

                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{ trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{ trans('lang.clear')}}</button>
                            </div>
                            </div>

                                <div class="table-responsive m-t-10">

                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>{{trans('lang.order_id')}}</th>

                                                <th class="address-list">{{ trans('lang.order_review')}}</th>
                                                
                                                <th>{{ trans('lang.food_review_rate')}}</th>
                                                
                                                <th>{{ trans('lang.food_review_user_id')}}</th>

                                                <?php if($id ==''){ ?>
                                                    <th>{{trans('lang.restaurant')}}</th>
                                                <?php }?> 

                                                <th>{{trans('lang.actions')}}</th>

                                            </tr>

                                        </thead>

                                        <tbody id="append_list1">

                                        </tbody>

                                    </table>
                                    <div id="data-table_paginate">
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
    </div>



@endsection

@section('scripts')
  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-database.js"></script>
    <script type="text/javascript">@include('vendor.notifications.init_firebase')</script> -->

<script type="text/javascript">
 
 var database = firebase.firestore();

    var offest=1;
    var pagesize=10; 
    var end = null;
    var endarray=[];
    var start = null;
    var user_number = [];
    //var ref = database.collection('foods_review');
       <?php if($id!=''){ ?>
    var ref = database.collection('foods_review').where('VendorId','==','<?php echo $id; ?>');
     const getStoreName = getStoreNameFunction('<?php echo $id; ?>');

    <?php }else{ ?>
    var ref = database.collection('foods_review');
    <?php } ?>

    var append_list = '';

$(document).ready(function() {
    
    $(document.body).on('click', '.redirecttopage' ,function(){    
        var url=$(this).attr('data-url');
        window.location.href = url;
    });  

    jQuery("#data-table_processing").show();  
    append_list = document.getElementById('append_list1');
    append_list.innerHTML='';
    ref.limit(pagesize).get().then( async function(snapshots){  
    html=''; 
    html=buildHTML(snapshots);
    jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length<pagesize){
            jQuery("#data-table_paginate").hide();
        }
        disableClick();
     }
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
                

           /* alldata.sort(function(a, b) {
                console.log(a);
              var keyA = a.createdAt,
               keyB = b.createdAt;
                 console.log(keyA);
              if (keyA < keyB) return -1;
              if (keyA > keyB) return 1;
              return 0;
        }); */
        var count = 0;
        alldata.forEach((listval) => {
            
                var val=listval;
                html=html+'<tr>';
                newdate='';
                var reviewId = val.Id;
                var route1 =  '{{route("orderReview.edit",":id")}}';
                route1 = route1.replace(':id', reviewId);

                var route_orderid =  '{{route("orders.edit",":id")}}';
                route_orderid = route_orderid.replace(':id', val.orderid);
                
                var route_user =  '{{route("users.edit",":id")}}';
                route_user = route_user.replace(':id', val.CustomerId);

                var route_restaurants =  '{{route("restaurants.view",":id")}}';
                route_restaurants = route_restaurants.replace(':id', val.VendorId);
                
                <?php if($id!=''){ ?>
                    route1 =route1+'?eid={{$id}}';
                    route_orderid =route_orderid+'?eid={{$id}}';
                <?php }?>

                html=html+'<td data-url="'+route_orderid+'" class="redirecttopage">'+val.orderid+'</td>';

                html=html+'<td class="address-list">'+val.comment+'</td>';
                
                // if(val.hasOwnProperty("rating") && val.rating > 0){
                // var rate = val.rating.toFixed(1)*10;
                // var rating = "stars-container stars-"+rate;
                // html=html+"<td><div><span class='"+rating+"' style='width:auto'>★★★★★</span></div></td>";
                // }else{
                //   html=html+"<td></td>";
                // }
                html=html + '<td><ul class="rating" data-rating="'+val.rating+'"><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li></ul></td>';



                const user_name=userName(val.CustomerId);
                html=html+'<td class="name_'+val.CustomerId+' redirecttopage" data-url="'+route_user+'"></td>';

                <?php if($id ==''){ ?>
                    const vendor_name = vendorName(val.VendorId);
                    html=html+'<td class="food_'+val.VendorId+' redirecttopage" data-url="'+route_restaurants+'"></td>';
                <?php }?>

                

                // if(val.hasOwnProperty("createdAt")){
                //   var date = val.createdAt.toDate().toDateString();
                // var day = val.createdAt.toDate().toLocaleTimeString('en-US');
                // html = html+'<td>'+day+ ' '+date+'</td>';
                // }else{
                // html = html+'<td></td>';
                // }
                


                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.Id+'" name="food-review-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
                
                            

                html=html+'</tr>';
                count =count +1;
          });
          return html;      
}

  async function getStoreNameFunction(vendorId){
     var vendorName = '';
        await database.collection('vendors').where('id', '==', vendorId).get().then(async function (snapshots) {
        var vendorData = snapshots.docs[0].data();

        vendorName = vendorData.title;
        $('.restaurantTitle').html('{{trans('lang.order_review')}} - ' + vendorName);
        
        if(vendorData.dine_in_active==true){
            $(".dine_in_future").show();
        }
        
    });

    return vendorName;

}

function prev(){
    if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];
  
  if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();
                 if(jQuery("#selected_search").val()=='order_id' && jQuery("#search").val().trim()!=''){

                  listener=ref.orderBy('Id').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

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
          // listener = ref.startAfter(start).limit(pagesize).get();

          if(jQuery("#selected_search").val()=='order_id' && jQuery("#search").val().trim()!=''){

              listener=ref.orderBy('Id').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

              }else{
                listener = ref.startAfter(start).limit(pagesize).get();
            }
          listener.then((snapshots) => {
            
                html='';
                html=buildHTML(snapshots);
                console.log(snapshots);
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

  /* var offest=1;
  var pagesize=10;
  var start = null;
  var end = null;
  var endarray=[];
  var inx= parseInt(offest) * parseInt(pagesize); */
  jQuery("#data-table_processing").show();
  
  append_list.innerHTML='';  

   if(jQuery("#selected_search").val()=='order_id' && jQuery("#search").val().trim()!=''){

     wherequery=ref.orderBy('orderid').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

   }else{

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
        /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
        if(snapshots.docs.length < pagesize){ 
   
            jQuery("#data-table_paginate").hide();
        }else{

            jQuery("#data-table_paginate").show();
        }
    }
}); 

}

async function userName(userID) {
var userName='';
await database.collection('users').where("id","==",userID).get().then( async function(snapshotss){
  
            if(snapshotss.docs[0]){
                var user = snapshotss.docs[0].data();
                userName = user.firstName+" "+user.lastName;
                console.log(userName);
                jQuery(".name_"+userID).html(userName);
                
            }else{
                jQuery(".name_"+userID).html('');

            } 
});
return userName;
} 


async function vendorName(vendorID) {
var vendorName ='';
await database.collection('vendors').where("id","==",vendorID).get().then( async function(snapshotss){
  
            if(snapshotss.docs[0]){
                var vendor = snapshotss.docs[0].data();
                vendorName = vendor.title;

                jQuery(".food_"+vendorID).html(vendorName);
                
            }else{
                jQuery(".food_"+vendorID).html('');

            } 
});
return vendorName;
} 

$(document).on("click","a[name='food-review-delete']", function (e) {
    var id = this.id;
     database.collection('foods_review').doc(id).delete().then(function(result) {
        window.location.href = '{{ route("orderReview")}}';
    })


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
