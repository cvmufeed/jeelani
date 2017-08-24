function edit(value,link) {
    var district = document.getElementById('edit_content'+value).innerHTML;
    var edit_string = "&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' value='"+district+"' name='name' form='edit_form'>";
    edit_string = edit_string + "&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' class = 'btn btn-primary' value='Update' form='edit_form'>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick='reload()'>Cancel</a>";
    document.getElementById('edit'+value).innerHTML = edit_string;
    document.edit_form_1.action = "/"+link+"/"+value;
    if (link == "district") {
    	selectStateEdit = $("#select_state_edit");
    	selectStateEdit.prependTo("#edit"+value);
    	selectStateEdit.attr( 'form','edit_form');
    	selectStateEdit.show();
    }
}
function setFormAction(value) {
	document.getElementById('form_add').action = "/district/"+value+"/add-address";
}
function delete_now(id,name,link) {
    if(confirm('Are you sure you want to delete '+name+'?')) {
        window.location.replace('/'+link+'/'+id+'/delete');
    }
}
function reload() {
    location.reload();
}
function dateRangeSelect() {
	var month1 = document.getElementById('month1').value;
	var year1 = Number(document.getElementById('year1').value);
	if (month1>1) {
		document.getElementById('month2').value = month1-1;
		document.getElementById('year2').value = year1+1;
	}
	else {
		document.getElementById('month2').value = 12;
		document.getElementById('year2').value = year1;
	}
}
function dateRangeSelectModal() {
    var month1 = document.getElementById('month_modal1').value;
    var year1 = Number(document.getElementById('year_modal1').value);
    if (month1>1) {
        document.getElementById('month_modal2').value = month1-1;
        document.getElementById('year_modal2').value = year1+1;
    }
    else {
        document.getElementById('month_modal2').value = 12;
        document.getElementById('year_modal2').value = year1;
    }
}
function deleteNow(value) {
	document.getElementById('deleteValue').value = value;
}
function editNow(value) {
	selectDistrict();
	var form = document.forms['edit_form'];
	form.elements['name'].value = document.getElementById('name_'+value).innerHTML;
	form.elements['address'].innerHTML = document.getElementById('address_'+value).value;
	form.elements['city'].value = document.getElementById('city_'+value).innerHTML;
	form.elements['phone'].value = document.getElementById('phone_'+value).innerHTML;
	form.elements['pin'].value = document.getElementById('pin_'+value).innerHTML;
	form.elements['id'].value = value;
	form.elements['start_month'].value = document.getElementById('start_month_'+value).value;
	form.elements['start_year'].value = document.getElementById('start_year_'+value).value;
	form.elements['end_month'].value = document.getElementById('end_month_'+value).value;
	form.elements['end_year'].value = document.getElementById('end_year_'+value).value;
	$("#select_state_edit").val($("#state_id_"+value).val());
	$("#select_district_edit").val($("#district_id_"+value).val());
	
}
function add_now() {
	document.getElementById('modal_title').innerHTML = 'Add Address';
	document.getElementById('modal_submit').innerHTML = 'Add Address';
	document.getElementById('edit_form').action = '/district/{{ $district->id }}/add-address';
	document.getElementById('edit_form').elements['_method'].value = 'post';
}
function selectDistrict() {
	state = $("#select_state_edit").val()
	district = $("#district_list").val();
	district = JSON.parse(district)[$("#select_state_edit").val()];
	$("#select_district_edit").html("");
	
	$.each(district, function(key, value) {
    	$('#select_district_edit').append("<option value='"+value.id+"'>"+value.name+"</option>");
	});
	$('#select_district_edit').trigger("onchange");
}
$( document ).ready(function() {
    console.log("Ready!!!");
});