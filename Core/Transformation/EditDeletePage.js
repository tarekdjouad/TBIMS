$(document).ready(function()
{
$(".delete").live('click',function()
{
var id = $(this).attr('id');
var b=$(this).parent().parent();
var dataString = 'id='+ id;
if(confirm("Do you wont to delete it!"))
{
	$.ajax({
type: "POST",
url: "EditLoadTransformation.php?pm=5",
data: dataString,
cache: false,
success: function(e)
{
b.hide();
e.stopImmediatePropagation();
}
		   });
	return false;
}
});
			

$(".edit_tr").live('click',function()
{
var ID=$(this).attr('id');

$("#one_"+ID).hide();
$("#two_"+ID).hide();
$("#three_"+ID).hide();
$("#four_"+ID).hide();
$("#five_"+ID).hide();


$("#one_input_"+ID).show();
$("#two_input_"+ID).show();
$("#three_input_"+ID).show();
$("#four_input_"+ID).show();
$("#five_input_"+ID).show();


}).live('change',function(e)
{
var ID=$(this).attr('id');

var one_val=$("#one_input_"+ID).val();
var two_val=$("#two_input_"+ID).val();
var three_val=$("#three_input_"+ID).val();
var four_val=$("#four_input_"+ID).val();
var five_val=$("#five_input_"+ID).val();

var dataString = 'id='+ ID +'&name='+one_val+'&category='+two_val+'&price='+three_val+'&discount='+four_val+'&add='+five_val;
if(one_val.length>0&& two_val.length>0 && three_val.length>0 && four_val.length>0 && five_val.length>0)
{

$.ajax({
type: "POST",
url: "EditLoadTransformation.php?pm=6",
data: dataString,
cache: false,
success: function(e)
{

$("#one_"+ID).html(one_val);
$("#two_"+ID).html(two_val);
$("#three_"+ID).html(three_val);
$("#four_"+ID).html(four_val);
$("#five_"+ID).html(five_val);

e.stopImmediatePropagation();

}
});
}
else
{
//alert('Enter something.');
}

});

// Edit input box click action
$(".editbox").live("mouseup",function(e)
{
e.stopImmediatePropagation();
});

// Outside click action
$(document).mouseup(function()
{

$(".editbox").hide();
$(".text").show();
});
			
			
//Pagination			
function loading_show(){
$('#loading').html("<img src=''/>").fadeIn('fast');
}
function loading_hide(){
$('#loading').fadeOut('fast');
}                
function loadData(page){
loading_show();                    
$.ajax
({
type: "POST",
url: "EditLoadTransformation.php?pm=7",
data: "page="+page,
success: function(msg)
{
$("#container").ajaxComplete(function(event, request, settings)
{
loading_hide();
$("#container").html(msg);
});
}
});
}
loadData(1);  // For first time page load default results
$('#container .pagination li.active').live('click',function(){
var page = $(this).attr('p');
loadData(page);
});           
$('#go_btn').live('click',function(){
var page = parseInt($('.goto').val());
var no_of_pages = parseInt($('.total').attr('a'));
if(page != 0 && page <= no_of_pages){
loadData(page);
}else{
alert('Enter a PAGE between 1 and '+no_of_pages);
$('.goto').val("").focus();
return false;
}
});
});