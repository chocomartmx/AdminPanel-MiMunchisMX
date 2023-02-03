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
            <h3 class="text-themecolor">{{trans('lang.languages')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.languages')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.languages')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('settings.app.languages.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.language_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        
                        <div class="table-responsive m-t-10">
                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{trans('lang.name')}}</th>
                                        <th >{{trans('lang.slug')}}</th>
                                        <th>{{trans('lang.active')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="append_list1">
                                </tbody>
                            </table>
                            
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
    var languages=[];
// var ref=[];
    //var refData = database.collection('users').where("role","in",["customer"]);
    var ref = database.collection('settings').doc('languages');
    var placeholderImage = '';
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
        ref.get().then( async function(snapshots){  
        html='';
        snapshots=snapshots.data();
        if(snapshots){
        snapshots=snapshots.list;
        languages=snapshots;
        html=buildHTML(snapshots);
        if(html!=''){
            append_list.innerHTML=html;
         }
        }
        jQuery("#data-table_processing").hide();
      }); 
     
    });


    function buildHTML(snapshots){
        var html='';
        var alldata=[];
        var number= [];
        if(snapshots.length){
        snapshots.forEach((listval) => {
            var datas=listval;
            datas.id=listval.id;
            alldata.push(datas);
        });
        var count = 0;
        alldata.forEach((listval) => {    
            var val=listval;
                html=html+'<tr>';
                newdate='';
                var id = val.slug;
                var route1 =  '{{route("settings.app.languages.edit",":id")}}';
                route1 = route1.replace(':id', id);

                html = html + '<td data-url="' + route1 + '" class="redirecttopage">'+val.title+'</td>';

                html=html+'<td>'+val.slug+'</td>';
        
                if(val.isActive){
                  html=html+'<td><span class="badge badge-success">Yes</span></td>';
                }else{
                  html=html+'<td><span class="badge badge-danger">No</span></td>';
                }

                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.slug+'" class="do_not_delete" name="lang-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
                
                html=html+'</tr>';
                count =count +1;
          });
        }
          return html;      
    }

$(document).on("click","a[name='lang-delete']", function (e) {
            var id = this.id;
            var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE'); ?>";
            if(is_disable_delete == 1){
                alert(doNotDeleteAlert);
                return false;
            }
            var newlanguage=[];
            languages.forEach((language) => {
                if(id!=language.slug){
                    newlanguage.push(language);
                }
            });
            jQuery("#data-table_processing").show();
            database.collection('settings').doc('languages').update({'list':newlanguage}).then(function(result) {
                jQuery("#data-table_processing").hide();
                window.location.href = '{{ route("settings.app.languages") }}';
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
    
    //alert("This is for demo, We can not allow to delete");
    alert(doNotDeleteAlert);
}); 


</script>

@endsection
