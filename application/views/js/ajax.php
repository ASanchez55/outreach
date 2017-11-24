<script type="text/javascript">
	function address(val1, val2) 
	{
	    if (val1 == "") 
	    {
	        document.getElementById(val1).innerHTML = "";
	        return;
	    } 
	    else 
	    {
			
			if(val1 == "Address_Province")
			{
				document.getElementById("Address_City").innerHTML = "Barangay";	
			}
			 
	        checker();
	        xmlhttp.onreadystatechange = function() 
	        {
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
	            {
	                document.getElementById(val1).innerHTML = xmlhttp.responseText;
	            }
	        }
	        xmlhttp.open("GET","<?php echo site_url().'/Others/address?type=';?>"+val1+"&value="+val2,true);
	        xmlhttp.send();
	    }
	}//end function address

	function checker()
	{
		if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
        else 
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
	
	}
</script>