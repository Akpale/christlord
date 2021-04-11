    

  

    // Material Select Initialization
$(document).ready(function() {

	   // SideNav Initialization
    $(".button-collapse").sideNav();

    var container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 20
    });
    
    $('.mdb-select').materialSelect();

$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');

$('.stepper').mdbStepper();
});

function someFunction21() {
setTimeout(function () {
$('#horizontal-stepper').nextStep();
}, 2000);
}