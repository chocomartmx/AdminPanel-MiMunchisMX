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

                    <h3 class="text-themecolor restaurantTitle">{{trans('lang.coupon_plural')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                        <li class="breadcrumb-item active">{{trans('lang.coupon_table')}}</li>

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
                                <li>
                                    <a href="{{route('restaurants.foods',$id)}}">{{trans('lang.tab_foods')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('restaurants.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('restaurants.reviews',$id)}}">{{trans('lang.tab_reviews')}}</a>
                                </li>
                                <li class="active">
                                    <a href="{{route('restaurants.coupons',$id)}}">{{trans('lang.tab_promos')}}</a>
                                <li>
                                    <a href="{{route('restaurants.payout',$id)}}">{{trans('lang.tab_payouts')}}</a>
                                </li>
                                <li >
                                        <a href="{{route('restaurants.booktable',$id)}}">{{trans('lang.dine_in_future')}}</a>
                                    </li>
                                <!-- <li class="active">
                                    <a href="{{route('restaurants.coupons',$id)}}">{{trans('lang.tab_coupons')}}</a>
                                </li> -->
                            </ul>
                        </div>
                        <?php } ?>

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                    <li class="nav-item">
                                      <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.coupon_table')}}</a>
                                    </li>
                                    <?php if($id!=''){?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{!! route('coupons.create') !!}/{{$id}}"><i class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                                    </li>
                                    <?php }else{ ?>
                                    <li class="nav-item">
                                      <a class="nav-link" href="{!! route('coupons.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                                    </li>
                                    <?php  } ?>                                    
                              </ul>
                            </div>
                            <div class="card-body">

                                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                            <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                        <option value="code">{{trans('lang.coupon_code')}}</option>
                                        <option value="description">{{trans('lang.coupon_description')}}</option>
                                </select>

                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{ trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{ trans('lang.clear')}}</button>
                            </div>
                            </div>

                                <div class="table-responsive m-t-10">

                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>{{trans('lang.coupon_code')}}</th>
                                                
                                                <th >{{trans('lang.coupon_discount')}}</th>
                                                
                                                <th >{{trans('lang.coupon_description')}}</th>
                                                
                                                <th >{{trans('lang.coupon_expires_at')}}</th>
                                                
                                                <th >{{trans('lang.coupon_enabled')}}</th>
                                                
                                                <th >{{trans('lang.actions')}}</th>

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
    //var ref = database.collection('coupons');
    <?php if($id!=''){ ?>
    var ref = database.collection('coupons').where('resturant_id','==','<?php echo $id; ?>');
    const getStoreName = getStoreNameFunction('<?php echo $id; ?>');

    <?php }else{ ?>
    var ref = database.collection('coupons');
    <?php } ?>

    var currentCurrency = '';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==' , true);
    refCurrency.get().then( async function(snapshots){  
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
    }); 

    var append_list = '';

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
    jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length < pagesize){
            jQuery("#data-table_paginate").hide();
        }
        
     }
  }); 
 
});

 async function getStoreNameFunction(vendorId){
     var vendorName = '';
        await database.collection('vendors').where('id', '==', vendorId).get().then(async function (snapshots) {
        var vendorData = snapshots.docs[0].data();

        vendorName = vendorData.title;
        $('.restaurantTitle').html('{{trans('lang.coupon_plural')}} - ' + vendorName);
        
        if(vendorData.dine_in_active==true){
            $(".dine_in_future").show();
        }
        
    });

    return vendorName;

}

function buildHTML(snapshots){
        var html='';
        var alldata=[];
        var number= [];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });
                

        //     alldata.sort(function(a, b) {
                
        //       var keyA = a.createdAt.seconds,
        //         keyB = b.createdAt.seconds;
                
        //       if (keyA < keyB) return -1;
        //       if (keyA > keyB) return 1;
        //       return 0;
        // });
        var count = 0;
        alldata.forEach((listval) => {
            
            var val=listval;
            
                html=html+'<tr>';
                newdate='';
                if(currencyAtRight){
                    if (val.discountType =='Percent' || val.discountType =='Percentage') {
                        discount_price = val.discount+"%";
                    }else{
                        discount_price = val.discount+""+currentCurrency;
                    }
                }else{
                    if (val.discountType =='Percent' || val.discountType == 'Percentage') {
                        discount_price = val.discount+"%";
                    }else{
                        discount_price = currentCurrency+""+val.discount;
                    }
                }
                var id = val.id;

                var route1 =  '{{route("coupons.edit",":id")}}';
                route1 = route1.replace(':id', id);
                <?php if($id!=''){ ?>
                    route1 =route1+'?eid={{$id}}';
                <?php }?>
               // console.log('val'+JSON.stringify(val));
                html=html+'<td  data-url="'+route1+'"  class="redirecttopage">'+val.code+'</td>';
                html=html+'<td>'+discount_price+'</td>';
                html=html+'<td>'+val.description+'</td>';
                var date = '';
                var time = '';
                if(val.hasOwnProperty("expiresAt")){

                    try {
                      date =  val.expiresAt.toDate().toDateString();
                      time = val.expiresAt.toDate().toLocaleTimeString('en-US');
                    }catch(err) {

                    }
                  html = html+'<td>'+date+'</td>';
                }else{
                  html = html + '<td></td>';
                }
                if(val.isEnabled){
                  html=html+'<td><span class="badge badge-success">Yes</span></td>';
                }else{                
                  html=html+'<td><span class="badge badge-danger">No</span></td>';
                }

                // if(val.hasOwnProperty("updatedAt")){
                //   var date =  val.updatedAt.toDate().toDateString();
                //   var time = val.updatedAt.toDate().toLocaleTimeString('en-US');
                //   html = html+'<td>'+time+' '+date+'</td>';
                // }else{
                //   html = html + '<td></td>';
                // }

                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="coupon_delete_btn" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
                
                            

                html=html+'</tr>';
                count =count +1;
          });
          return html;      
}

  function prev(){
      if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];
  
  if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();
                 
            if(jQuery("#selected_search").val()=='code' && jQuery("#search").val().trim()!=''){

                  listener=ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();
              } else if(jQuery("#selected_search").val()=='description' && jQuery("#search").val().trim()!=''){

              listener=ref.orderBy('description').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

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

          if(jQuery("#selected_search").val()=='code' && jQuery("#search").val().trim()!=''){

                listener=ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();
            } else if(jQuery("#selected_search").val() =='description' && jQuery("#search").val().trim()!=''){
              //console.log("Dsecription");
                listener=ref.orderBy('description').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();
            } else{
                listener = ref.startAfter(start).limit(pagesize).get();
            }
          listener.then((snapshots) => {
            
                html='';
                html=buildHTML(snapshots);
                //console.log(snapshots);
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

   if(jQuery("#selected_search").val()=='code' && jQuery("#search").val().trim()!=''){

     wherequery=ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

   } else if(jQuery("#selected_search").val()=='description' && jQuery("#search").val().trim()!=''){

     wherequery=ref.orderBy('description').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

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
        /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
        if(snapshots.docs.length < pagesize){ 
   
            jQuery("#data-table_paginate").hide();
        }else{

            jQuery("#data-table_paginate").show();
        }
    }
}); 

}

$(document).on("click","a[name='coupon_delete_btn']", function (e) {
        var id = this.id;

    var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE',0); ?>";
    if(is_disable_delete == 1){
      alert("Do not alllow to change in demo content !");
      return false;    
    }
    
     database.collection('coupons').doc(id).delete().then(function(){

      window.location = "{{! url()->current() }}";
    });


});


</script>

@endsection
