<div class='wrap'>
<h2>Contacts</h2>
<?php
	$contact_rows = "";
		
   if(count($contacts)>0) {
        
      foreach($contacts as $i=>$contact) {
      	if($i%2 == 0) $alternate = "alternate";
         else $alternate = "";
         $date = date('d-m-Y', strtotime($contact->date));
			$to = $contact->email_to;
			$subject = $contact->subject;
			$content = wp_trim_words($contact->content, 20, null);
     
         $contact_rows .= "<tr class='{$alternate}' valign='top'>";
    		$contact_rows .= "		<td>{$date}</td>";
    		$contact_rows .= "		<td>{$to}</td>";
    		$contact_rows .= "		<td>{$subject}</td>";
    		$contact_rows .= "		<td>{$content}</td>";
    		$contact_rows .= "		<td><a class='button-secondary afx_contact_details_view' title='View the full message'>Contact</a></td>";
         $contact_rows .= "</tr>";
            
    }       
    }  
  
?>

<form action='admin.php?page=afx_contact' method='POST' >
<p class="search-box">
	<label class="screen-reader-text" for="post-search-input">Search Contacts:</label>
	<input type="search" id="post-search-input" name="s" value="">
	<input type="submit" name="" id="search-submit" class="button" value="Search Posts">
</p>
</form>


<div class="tablenav top">
<?php if(isset($args['created_from'])) { ?>
<form action='admin.php' method='GET' >
    <div class="alignleft actions">
    <p>
        <b>From</b> <input type='text' class='afx_datepicker' name='from' value='<?php echo $args['created_from'] ?>' /> <b>to</b>
        <input type='text' class='afx_datepicker' name='to' value='<?php echo $args['created_to'] ?>' />
        <input type='submit' class='button' value='Filter' />
        <input type='hidden' name='page' value='afx_contact' />
    </p>       
    </div>
</form>    
<?php } ?>
<br class='clear' />
</div>

<table class="wp-list-table widefat fixed" cellspacing="0">
	<thead>
	<tr>		
		<th scope="col" id="status" class="manage-column" style=""><span>Date</span></th>
		<th scope="col" id="to" class="manage-column" style=""><span>To</span></th>
		<th scope="col" id="subject" class="manage-column column-title" style=""><span>Subject</span></th>
		<th scope="col" id="total_content" class="manage-column column-title" style=""><span>Content</span></th>
		<th scope="col" id="actions" class="manage-column column-title" style="">Actions</th>
    </tr>
	</thead>

	<tfoot>
	<tr>
		<th scope="col" id="status" class="manage-column" style=""><span>Date</span></th>
		<th scope="col" id="to" class="manage-column" style=""><span>To</span></th>
		<th scope="col" id="subject" class="manage-column column-title" style=""><span>Subject</span></th>
		<th scope="col" id="total_content" class="manage-column column-title" style=""><span>Content</span></th>
		<th scope="col" id="actions" class="manage-column column-title" style="">Actions</th>
	</tr>
	</tfoot>

	<tbody id="the-list">
	
	<?php echo $contact_rows ?>
    </tbody>
</table>
</div>