
<div>

</div>

<div class="container pagecont">
  <div class="row"> 	
    <h3>/Title</h3>
    <br>
    <br>
    
         <div class="card text-center" style="width: 100%;">
         <div class="card-body"> <br>
      <div class="pull-right">
      sample 1
      </div>
                                         
   
        <h3> Create Family</h3>
        <p> <?php echo validation_errors(); ?> </p>
        <p><?php //echo $msg; ?></p>

        <form action="" method="post">
        <p>Family Name <input type="text" name="family_name" value="<?php echo set_value('family_name', $family_name ); ?>"  /> </p>
        <p>Province <?php echo $province_list; ?> </p>
        <p><div id="Address_Province"><b>City</b></div></p>
        <p><div id="Address_City"><b>Barangay</b></div></p>
        <p>Complete Address <input type="text" name="comp_add" value="<?php echo set_value('comp_add', $comp_add ); ?>"  /> </p>
        <p> <input type="submit"/> </p> 
        
        </form>
      
     </div>
	</div>
                                
     
</div>
</div>




