    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> place updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
	  
	   <script>
	   var quit=false;
	  function change() 
		{
			var value ="<?php echo $this->session->userdata['order']; ?>";
			var divv = document.getElementById("control-group1");
			var div2 = document.getElementById("control-group2");
				if (value == "hospital") 
				{
					toAppend = "<label for=\"inputError\" class=\"control-label\">Type</label><div class=\"controls\"><input type='text' name='type' placeholder='Homeopathic' value='<?php if(isset($place[0]['type'])){ echo $place[0]['type']; } ?>'></div>"; 
					divv.innerHTML = toAppend;
					div2.innerHTML = "";
					return;
				}
				if (value == 'hotel') 
				{
					toAppend = "<label for=\"inputError\" class=\"control-label\">Type</label><div class=\"controls\"><input type='text' name='type' placeholder='Veg or Non-veg or Both' value='<?php if(isset($place[0]['type'])){ echo $place[0]['type']; } ?>'></div>";
					divv.innerHTML = toAppend;  
					toAppend = "<label for=\"inputError\" class=\"control-label\">Food-Type</label><div class=\"controls\"><input type='text' name='foodtype' placeholder='Chinese' value='<?php if(isset($place[0]['foodtype'])){ echo $place[0]['foodtype']; }?>'></div>";
					div2.innerHTML = toAppend;
					return;
				}
				if (value == 'cinema') 
				{
					toAppend = "";
					divv.innerHTML = toAppend;
					div2.innerHTML = "";
					return;
				}
				if (value == 'food') 
				{
					toAppend = "<label for=\"inputError\" class=\"control-label\">Food-Type</label><div class=\"controls\"><input type='text' name='foodtype' placeholder='Veg or Non-veg or Fast Food' value='<?php if(isset($place[0]['foodtype'])){ echo $place[0]['foodtype']; }?>'></div>";
					divv.innerHTML = toAppend; 
					toAppend = "<label for=\"inputError\" class=\"control-label\">Drink-Type</label><div class=\"controls\"><input type='text' name='drinktype' placeholder='Soda, Cold drink etc' value='<?php if(isset($place[0]['drinktype'])){ echo $place[0]['drinktype']; } ?>'></div>";
					div2.innerHTML = toAppend;
					return;
				}
				if (value == 'education') 
				{
					toAppend = "<label for=\"inputError\" class=\"control-label\">Field</label><div class=\"controls\"><input type='text' name='field' placeholder='' value='<?php if(isset($place[0]['field'])){ echo $place[0]['field']; }?>'></div>";
					divv.innerHTML = toAppend;  
					toAppend = "<label for=\"inputError\" class=\"control-label\">Type</label><div class=\"controls\"><input type='text' name='type' placeholder='' value='<?php if(isset($place[0]['type'])){ echo $place[0]['type']; }?>'></div>";
					div2.innerHTML = toAppend;
					return;
				}
				if (value == 'transport') 
				{
					toAppend = "<label for=\"inputError\" class=\"control-label\">Type</label><div class=\"controls\"><input type='text' name='type' placeholder='Bus or AutoRikshaw or Travel' value='<?php if(isset($place[0]['type'])){ echo $place[0]['type']; } ?>'></div>";
					divv.innerHTML = toAppend;  
					div2.innerHTML = "";
					return;
				}
				if (value == 'bank') 
				{
					toAppend = "";
					divv.innerHTML = toAppend;  
					div2.innerHTML = "";
					return;
				}
				if (value == 'atm') 
				{
					toAppend = "<label for=\"inputError\" class=\"control-label\">Bank Name</label><div class=\"controls\"><input type='text' name='bankname' placeholder='SBI ICICI etc' value='<?php if(isset($place[0]['bankname'])){ echo $place[0]['bankname']; } ?>' ></div>";
					divv.innerHTML = toAppend;  
					div2.innerHTML = "";
					return;
				}
				if (value == 'sport') 
				{
					toAppend = "";
					divv.innerHTML = toAppend;  
					div2.innerHTML = "";
					return;
				}
				if (value == 'garden') 
				{
					toAppend = "";
					divv.innerHTML = toAppend;  
					div2.innerHTML = "";
					return;
				}
				if (value == 'petrol') 
				{
					toAppend = "";
					divv.innerHTML = toAppend;  
					div2.innerHTML = "";
					return;
				}
				if (value == 'medical')
				{
					divv.innerHTML = "";
					div2.innerHTML = "";
					return;
				}
		}
	 
	</script>
	
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();

      echo form_open('admin/places/update/'.$this->uri->segment(4).'', $attributes);
      ?>
	  <div style="width: 850px; margin: 0 auto;">
	  <div style="width: 400px; height: 400px; float: left;">
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo $place[0]['name']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
		  
		   <div class="control-group">
            <label for="inputError" class="control-label">Address</label>
            <div class="controls">
             <input type='text' name='addr' value="<?php echo $place[0]['addr']; ?>" required><font color='red'> *</font>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>

		<div class="control-group">
            <label for="inputError" class="control-label">Contact</label>
            <div class="controls">
             <input type='text' name='contact' value="<?php echo $place[0]['contact']; ?>" placeholder='02572239191'>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
			
		<div class="control-group">
            <label for="inputError" class="control-label">Latitude</label>
            <div class="controls">
             <input type='text' name='latitude' id='lat' value="<?php echo $place[0]['latitude']; ?>" placeholder='21.015902' required><font color='red'> *</font>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
			
		<div class="control-group">
            <label for="inputError" class="control-label">Longitude</label>
            <div class="controls">
           <input type='text' name='longitude' id='long' value="<?php echo $place[0]['longitude']; ?>" placeholder='75.560670' required><font color='red'> *</font>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
			
		<div class="control-group">
            <label for="inputError" class="control-label">Search Tags</label>
            <div class="controls">
             <input type='text' name='search' value="<?php echo $place[0]['search']; ?>" placeholder='Separated by comma' required><font color='red'> *</font>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
			
		<div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
            <input type='text' name='description' value="<?php echo $place[0]['description']; ?>" placeholder='Optional'>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
		  
		  <div class="control-group" id="control-group1">
            
          </div>
		  
		<div class="control-group" id="control-group2">
            
        </div>
		  
		 <script>quit=true;
		 change();</script> 
		 </div>
		
		 <div id="map" style="width: 400px; background: #ffffff; height: 400px; margin-left: 450px;"> </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
		 </div>
		 
		 <script type="text/javascript">
		var map;
		var myLatLng = {lat: parseFloat(document.getElementById("lat").value), lng: parseFloat(document.getElementById("long").value)};

		function initMap() 
		{
 			 map = new google.maps.Map(document.getElementById('map'), {center: myLatLng,zoom: 14});
  			 var marker=new google.maps.Marker({position: myLatLng , map: map});
  	
  			map.addListener("click", function(e){marker.setMap(null);marker = new google.maps.Marker({position: e.latLng, map: map});
			document.getElementById("lat").value=e.latLng.lat();
			document.getElementById("long").value=e.latLng.lng();
  			});
		}

    	   </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp7JJPxjSnW_pOpRO7MfucjeZ10spcWDg&callback=initMap">
    </script>
      <?php echo form_close(); ?>

    </div>
     