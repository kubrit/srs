//  for select / deselect all
$('document').ready(function()
{
	//select all checkboxes
	$(".select-all").change(function(){  //"select all" change
		var status = this.checked; // "select all" checked status
		$('.checkbox').each(function(){ //iterate all listed checkbox items
			this.checked = status; //change ".checkbox" checked status
		});
	});

	$('.checkbox').change(function(){ //".checkbox" change
		//uncheck "select all", if one of the listed checkbox item is unchecked
		if(this.checked == false){ //if this item is unchecked
			$(".select-all")[0].checked = false; //change "select all" checked status to false
		}

		//check "select all" if all checkbox items are checked
		if ($('.checkbox:checked').length == $('.checkbox').length ){
			$(".select-all")[0].checked = true; //change "select all" checked status to true
		}
	});
});


//  page redirect on user click edit/delete
function edit_records() 
{
	document.frm.action = "shipments.php?shipments=all&action=edit";
	document.frm.submit();		
}

function delete_records() 
{
		var result = confirm("Are you sure?");
		if (result) {
			document.frm.action = "shipments.php?shipments=all&action=delete";
			document.frm.submit();
		} else {
			document.frm.action = "shipments.php?shipments=all";
			document.frm.submit();
		}
}