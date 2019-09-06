//-------- add balance
$(".joma-btn").click(function(event) {
	event.preventDefault();

    $(event.target).hide();
    $(event.target.nextElementSibling).removeClass("d-none");
});

$(".add-balance-submit").on('click',function(event){
	var eventRoot = event.target.parentNode.parentNode;
	
	$(eventRoot).addClass("d-none");
	$(eventRoot.previousElementSibling).show();
});

$(".add-balance-close").on('click',function(event){
	var eventRoot = event.target.parentNode;
	
	$(eventRoot).addClass("d-none");
	$(eventRoot.previousElementSibling).show();
});

//-------- edit extra
$(".edit-extra-btn").click(function(event) {
	event.preventDefault();

    $(event.target).hide();
    $(event.target.nextElementSibling).removeClass("d-none");
});

$(".edit-extra-submit").on('click',function(event){
	var eventRoot = event.target.parentNode.parentNode;
	
	$(eventRoot).addClass("d-none");
	$(eventRoot.previousElementSibling).show();
});

$(".edit-extra-close").on('click',function(event){
	var eventRoot = event.target.parentNode;
	
	$(eventRoot).addClass("d-none");
	$(eventRoot.previousElementSibling).show();
});

//-------- edit bazar
$(".edit-bazar-btn").click(function(event) {
	event.preventDefault();

    $(event.target).hide();
    $(event.target.nextElementSibling).removeClass("d-none");
});

$(".edit-bazar-submit").on('click',function(event){
	var eventRoot = event.target.parentNode.parentNode;
	
	$(eventRoot).addClass("d-none");
	$(eventRoot.previousElementSibling).show();
});

$(".edit-bazar-close").on('click',function(event){
	var eventRoot = event.target.parentNode;
	
	$(eventRoot).addClass("d-none");
	$(eventRoot.previousElementSibling).show();
});

//-------------------- delete balance below
$(".single-taka-ammount").on('click',function(event){
	event.preventDefault();
});

$(".single-taka-ammount").popover({
	placement: 'top',
	html: true
});


//-------------------- edit bazar below
$(document).on("click", ".edit-bazar-expend-single", function(event) {
	event.preventDefault();
});


//---------------------- meal add

$(".meal-date").popover({
    placement: 'top',
    html : true
});

//------------------- bazar expend edited popover
$(".bazar-expend-item").popover({
	placement: 'top',
	html: true
});

$(document).on("click", ".bazar-expend-item", function(event) {
	event.preventDefault();
});

//------------------- extra expend edited popover
$(".extra-expend-item").popover({
	placement: 'top',
	html: true
});

$(document).on("click", ".extra-expend-item", function(event) {
	event.preventDefault();
});

/*
//---- this "click" function need for popover_inside_btn event listening
$(document).on("click", ".add-meal-date", function(event) {
	event.preventDefault();

    alert('it works!');
});
*/
