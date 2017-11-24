
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
        <p>First Name <input type="text" name="fname" value="<?php echo set_value('fname', $fname ); ?>"  /> </p>
        <p>Birth Date <input type="date" name="birth_date" value="<?php echo set_value('birth_date', $birth_date ); ?>"  /> </p>
        <p>Gender <?php echo $gender; ?></p>
        <p>Date Registered <input type="date" name="date_registered" value="<?php echo set_value('date_registered', $date_registered ); ?>"  /> </p>
        
        <p> <input type="submit"/> </p> 
        
        </form>
      
     </div>
	</div>
                                
     
</div>
</div>




