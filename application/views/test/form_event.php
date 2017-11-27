<div>

</div>

<div class="container pagecont">
  <div class="row"> 	
    
    <br>
    <br>
    
      <div class="card text-center" style="width: 100%;">
     <div class="card-body"> <br>
      <div class="pull-right">
     
      </div>
                                         
   
        <h3> Add Event</h3>
        <p> <?php echo validation_errors(); ?> </p>
        
        
        <form action="" method="post">
        <p>Event Name <input type="text" name="event_name" value="<?php echo set_value('event_name', $event_name ); ?>"  /> </p>
        <p>Event Date <input type="date" name="date" value="<?php echo set_value('date', $date ); ?>"  /> </p>
        <p> <input type="submit"/> </p> 
        </form>
      
     </div>
	</div>
                                
     
</div>
</div>