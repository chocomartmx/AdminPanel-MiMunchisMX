@extends('layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>			
         <li class="breadcrumb-item"><a href= "{!! route('categories') !!}" >{{trans('lang.category_plural')}}</a></li>
        <li class="breadcrumb-item active">{{trans('lang.category_create')}}</li>
			</ol>
		</div>
		</div>

			<div class="card-body">
          
          <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
          <div class="error_top" style="display:none"></div>
          <div class="row restaurant_payout_create">          

            <div class="restaurant_payout_create-inner">
              <fieldset>
              <legend>{{trans('lang.category_create')}}</legend>
              <div class="form-group row width-100">
                <label class="col-3 control-label">{{trans('lang.category_name')}}</label>
                <div class="col-7">
                  <input type="text" class="form-control cat-name">
                  <div class="form-text text-muted">{{ trans("lang.category_name_help") }} </div>
                </div>
              </div>

              <div class="form-group row width-100">
                <label class="col-3 control-label ">{{trans('lang.category_description')}}</label>
                <div class="col-7">
                    <textarea rows="7" class="category_description form-control" id="category_description"></textarea>
                    <div class="form-text text-muted">{{ trans("lang.category_description_help") }}</div>
                </div>
              </div>

              <div class="form-group row width-100">
                <label class="col-3 control-label">{{trans('lang.category_image')}}</label>
                <div class="col-7">
                  <input type="file" id="category_image" onChange="handleFileSelect(event)">
                  <div class="placeholder_img_thumb cat_image"></div> 
                  <div id="uploding_image"></div>
                  <div class="form-text text-muted w-50">{{ trans("lang.category_image_help") }}</div>
                </div>
              </div>
              </fieldset>
            </div>

          </div>

        </div>
        <div class="form-group col-12 text-center btm-btn">
          <button type="button" class="btn btn-primary save_category_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
          <a href="{!! route('categories') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        </div>

	</div>

</div>

</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<script>

  var database = firebase.firestore();
  var ref = database.collection('vendor_categories');
  var photo ="";
  var id_category = "<?php echo uniqid();?>";
  var category_length=1;
  var placeholderImage = '';
  var placeholder = database.collection('settings').doc('placeHolderImage');

  placeholder.get().then( async function(snapshotsimage){
      var placeholderImageData = snapshotsimage.data();
      placeholderImage = placeholderImageData.image;
  })

  $(document).ready(function(){
    jQuery("#data-table_processing").show();
    ref.get().then( async function(snapshots){
      category_length = snapshots.size+1;
      jQuery("#data-table_processing").hide();
    })


  $(".save_category_btn").click(function(){

    var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE',0); ?>";
    if(is_disable_delete == 1){
      alert("Do not alllow to change in demo content !");
      return false;    
    }

    var title = $(".cat-name").val();
    var description = $(".category_description").val();

    if (title == '') {

      $(".error_top").show();
      $(".error_top").html("");
      $(".error_top").append("<p>{{trans('lang.enter_cat_title_error')}}</p>");
        window.scrollTo(0,0);
      }else{

        database.collection('vendor_categories').doc(id_category).set({'id':id_category,'title':title,'description':description,'photo':photo,order:category_length}).then(function(result) { 
          window.location.href = '{{ route("categories")}}';
        });

      }

  });


});

  var storageRef = firebase.storage().ref('images');
  function handleFileSelect(evt) {

    var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE',0); ?>";
    if(is_disable_delete == 1){
      alert("Do not alllow to change in demo content !");
      return false;    
    }
    var f = evt.target.files[0];
    var reader = new FileReader();
    reader.onload = (function(theFile) {
    return function(e) {
        
      var filePayload = e.target.result;
      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
      var val = $('#category_image').val().toLowerCase();
      var ext=val.split('.')[1];
      var docName=val.split('fakepath')[1];
      var filename = $('#category_image').val().replace(/C:\\fakepath\\/i, '')
      var timestamp = Number(new Date());      
      var uploadTask = storageRef.child(filename).put(theFile);
      uploadTask.on('state_changed', function(snapshot){
      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
      }, function(error) {
      }, function() {
        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            jQuery("#uploding_image").text("Upload is completed");
            photo = downloadURL;
            $(".cat_image").empty();
            $(".cat_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');

      });   
    });
    
    };
  })(f);
  reader.readAsDataURL(f);
}   


</script>
@endsection