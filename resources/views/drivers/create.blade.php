@extends('layouts.app')

@section('content')
<div class="page-wrapper">
  <div class="row page-titles">
    <div class="col-md-5 align-self-center">
      <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>
    </div>

    <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href= "{!! route('drivers') !!}" >{{trans('lang.driver_plural')}}</a></li>
        <li class="breadcrumb-item active">{{trans('lang.driver_edit')}}</li>
      </ol>
    </div>
    <div>

      <div class="card-body">
        
        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
        <div class="error_top"></div>

          <div class="row restaurant_payout_create">
              <div class="restaurant_payout_create-inner">
                <fieldset>
                  <legend>{{trans('lang.driver_details')}}</legend>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                          <div class="col-7">                  
                            <input type="text" class="form-control user_first_name">
                            <div class="form-text text-muted">{{trans('lang.first_name_help')}}</div>
                          </div>
                        </div>
                       
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                          <div class="col-7">
                            <input type="text" class="form-control user_last_name">
                            <div class="form-text text-muted">{{trans('lang.last_name_help')}}</div>
                          </div>                
                        </div>   

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.email')}}</label>
                          <div class="col-7">
                            <input type="email" class="form-control user_email">
                            <div class="form-text text-muted">{{trans('lang.user_email_help')}}</div>
                          </div>    
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.password')}}</label>
                          <div class="col-7">
                            <input type="password" class="form-control user_password">
                            <div class="form-text text-muted">{{trans('lang.user_password_help')}}</div>
                          </div>    
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                          <div class="col-7">
                            <input type="text" class="form-control user_phone">
                            <div class="form-text text-muted">
                            {{trans('lang.user_phone_help')}}</div>
                          </div> 
                        </div>

                        <div class="form-group row width-100">
                          <div class="col-12">
                            <h6>{{ trans("lang.know_your_cordinates") }}<a target="_blank" href="https://www.latlong.net/">{{ trans("lang.latitude_and_longitude_finder") }}</a></h6>
                          </div>
                        </div>
                      

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.user_latitude')}}</label>
                          <div class="col-7">
                            <input type="number" class="form-control user_latitude">
                            <div class="form-text text-muted">{{trans('lang.user_latitude_help')}}</div>
                          </div> 
                        </div>              

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.user_longitude')}}</label>
                          <div class="col-7">
                            <input type="number" class="form-control user_longitude">
                            <div class="form-text text-muted">{{trans('lang.user_longitude_help')}}</div>
                          </div> 
                        </div>

                        <div class="form-group row width-100">
                          <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                          <div class="col-7">
                            <input type="file" onChange="handleFileSelect(event)" class="">
                            <div class="form-text text-muted">{{trans('lang.profile_image_help')}}</div>
                          </div>
                          <div class="placeholder_img_thumb user_image"></div>
                          <div id="uploding_image"></div>
                        </div>

                        

                       <div class="form-check width-100">
                          <input type="checkbox" class="col-7 form-check-inline user_active" id="user_active">
                          <label class="col-3 control-label" for="user_active">{{trans('lang.available')}}</label>
                       </div> 
                     </fieldset>

                     <fieldset>
                        <legend>{{trans('driver')}} {{trans('lang.active_deactive')}}</legend>
                      <div class="form-group row">
                          
                          <div class="form-group row width-50">
                              <div class="form-check width-100">
                                <input type="checkbox" id="is_active">
                                <label class="col-3 control-label" for="is_active">{{trans('lang.active')}}</label>
                              </div>
                          </div>

                        </div>
                    </fieldset>

                      <fieldset>
                        <legend>{{trans('lang.car_details')}}</legend>
                          <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.car_number')}}</label>
                          <div class="col-7">
                            <input type="text" class="form-control car_number">
                            <div class="form-text text-muted">{{trans('lang.car_number_help')}}</div>
                          </div> 
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                          <div class="col-7">
                            <input type="text" class="form-control car_name">
                            <div class="form-text text-muted">{{trans('lang.car_name_help')}}</div>
                          </div> 
                        </div>
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                          <div class="col-7">
                            <input type="file" onChange="handleFileSelectcar(event)" class="">
                            <div class="form-text text-muted">{{trans('lang.car_image_help')}}</div>
                          </div>
                            <div class="placeholder_img_thumb car_image">  
                                    </div> 
                            <div id="uploding_image_car"></div>
                        </div>

                      </fieldset>
                   </div>              
              </div>
          </div>

          <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_driver_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
            <a href="{!! route('drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
          </div>

  </div>

</div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>


var database = firebase.firestore();

var photo ="";
var carPictureURL ="";
var user_active_deactivate =false;
$(document).ready(function(){

  jQuery("#data-table_processing").show();

  jQuery("#data-table_processing").hide();

  
$(".save_driver_btn").click(function(){
 
  var userFirstName = $(".user_first_name").val();
  var userLastName = $(".user_last_name").val();
  var email = $(".user_email").val();
  var password = $(".user_password").val();
  var userPhone = $(".user_phone").val();
  var active = $(".user_active").is(":checked");
  user_active_deactivate =false;
  if($("#is_active").is(':checked')){
    user_active_deactivate =true;
  }
  var carName = $(".car_name").val();
  var carNumber = $(".car_number").val();
  var latitude = parseFloat($(".user_latitude").val());
  var longitude = parseFloat($(".user_longitude").val());
  var location = {'latitude': latitude, 'longitude': longitude};
  var id = "<?php echo uniqid(); ?>";

    if(userFirstName == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.enter_owners_name_error')}}</p>");
        window.scrollTo(0, 0);

    }else if(email == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.enter_owners_email')}}</p>");
        window.scrollTo(0, 0);
      }
    else if(userPhone == '' ){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.enter_owners_phone')}}</p>");
        window.scrollTo(0, 0);
      }
    else if(carName == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.car_name_error')}}</p>");
        window.scrollTo(0, 0);
      }
      else if(carNumber == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.car_number_error')}}</p>");
        window.scrollTo(0, 0);
      }else{

        firebase.auth().createUserWithEmailAndPassword(email, password)
            .then(function (firebaseUser) {
          id=firebaseUser.user.uid;
          database.collection('users').doc(id).set({'id':id,'firstName':userFirstName,'lastName':userLastName,'email':email,'phoneNumber':userPhone,'isActive':active,'profilePictureURL':photo,'carName':carName,'carNumber':carNumber,
            'location':location,'carPictureURL':carPictureURL,'role':'driver','active':user_active_deactivate}).then(function(result) {
                
                window.location.href = '{{ route("drivers")}}';

             }); 

        }) .catch(function (error) {
              
              $(".error_top").show();
              $(".error_top").html("");
              $(".error_top").append("<p>"+error+"</p>");
              window.scrollTo(0, 0);
        });

      }
   
})


})
var storageRef = firebase.storage().ref('images');
function handleFileSelect(evt) {
  var f = evt.target.files[0];
  var reader = new FileReader();

  reader.onload = (function(theFile) {
    return function(e) {
        
      var filePayload = e.target.result;
      // Generate a location that can't be guessed using the file's contents and a random number
      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
      //var f = new Firebase(firebaseRef + 'pano/' + hash + '/filePayload');
      //spinner.spin(document.getElementById('spin'));
      // Set the file payload to Firebase and register an onComplete handler to stop the spinner and show the preview
           
      //var val = $('input[type=file]').val().toLowerCase();
      //var val = "categorytestpng";
        var val =f.name;       
      var ext=val.split('.')[1];
      var docName=val.split('fakepath')[1];
      var filename = (f.name).replace(/C:\\fakepath\\/i, '')

      var timestamp = Number(new Date());    
      var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;  
      var uploadTask = storageRef.child(filename).put(theFile);
      console.log(uploadTask);
      uploadTask.on('state_changed', function(snapshot){
      // Observe state change events such as progress, pause, and resume
      // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
      console.log('Upload is ' + progress + '% done');
      jQuery("#uploding_image").text("Image is uploading...");
      // switch (snapshot.state) {
      //   case firebase.storage.TaskState.PAUSED: // or 'paused'
      //     console.log('Upload is paused');
      //     break;
      //   case firebase.storage.TaskState.RUNNING: // or 'running'
      //     console.log('Upload is running');
      //     jQuery("#uploding_image").text("Upload is running");
      //     break;
      // }
    }, function(error) {
      // Handle unsuccessful uploads
    }, function() {
        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            //spinner.stop();
            jQuery("#uploding_image").text("Upload is completed");
            //jQuery("#photo").val(downloadURL);
            photo = downloadURL;
            $(".user_image").empty();
            $(".user_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');

      });   
    });
    
    };
  })(f);
  reader.readAsDataURL(f);
}   
var storageRefcar = firebase.storage().ref('images');
function handleFileSelectcar(evt) {
  var f = evt.target.files[0];
  var reader = new FileReader();

  reader.onload = (function(theFile) {
    return function(e) {
        
      var filePayload = e.target.result;
      // Generate a location that can't be guessed using the file's contents and a random number
      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
      //var f = new Firebase(firebaseRef + 'pano/' + hash + '/filePayload');
      //spinner.spin(document.getElementById('spin'));
      // Set the file payload to Firebase and register an onComplete handler to stop the spinner and show the preview
           
      //var val = $('input[type=file]').val().toLowerCase();
      //var val = "categorytestpng";
        var val =f.name;       
      var ext=val.split('.')[1];
      var docName=val.split('fakepath')[1];
      var filename = (f.name).replace(/C:\\fakepath\\/i, '')

      var timestamp = Number(new Date());      
      var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
      var uploadTask = storageRefcar.child(filename).put(theFile);
      console.log(uploadTask);
      uploadTask.on('state_changed', function(snapshot){
      // Observe state change events such as progress, pause, and resume
      // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
      console.log('Upload is ' + progress + '% done');
      jQuery("#uploding_image_car").text("Image is uploading...");
      // switch (snapshot.state) {
      //   case firebase.storage.TaskState.PAUSED: // or 'paused'
      //     console.log('Upload is paused');
      //     break;
      //   case firebase.storage.TaskState.RUNNING: // or 'running'
      //     console.log('Upload is running');
      //     jQuery("#uploding_image").text("Upload is running");
      //     break;
      // }
    }, function(error) {
      // Handle unsuccessful uploads
    }, function() {
        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            //spinner.stop();
            jQuery("#uploding_image_car").text("Upload is completed");
            //jQuery("#photo").val(downloadURL);
            carPictureURL = downloadURL;
             $(".car_image").empty();
            $(".car_image").append('<img class="rounded" style="width:50px" src="'+carPictureURL+'" alt="image">');

      });   
    });
    
    };
  })(f);
  reader.readAsDataURL(f);
}   
</script>
@endsection