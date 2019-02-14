document.getElementById("defaultOpen").click();

function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
} 

//test code v1
var dispBlock = '';
$('#btn-ul-r-generate').click(function() {
    var startDate = $('#in-ul-r-dr').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDate =  $('#in-ul-r-dr').data('daterangepicker').endDate.format('YYYY-MM-DD');

    if (startDate != null && endDate != null) {
        $('#s-ul-r-pdf-obj').attr('data', 'php/generatepdf.php?yearA='+ startDate +'&yearB='+ endDate +'&indicator=userlist');
        $('#sT-ul-r-pdf-obj').attr('src', 'php/generatepdf.php?yearA='+ startDate +'&yearB='+ endDate +'&indicator=userlist');
    }        
    textPopUp();
    dispBlock = 'ul';
});

$('#btn-pr-r-generate').click(function() {
    var startDate = $('#in-pr-r-dr').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDate =  $('#in-pr-r-dr').data('daterangepicker').endDate.format('YYYY-MM-DD');

    if (startDate != null && endDate != null) {
        $('#s-pr-r-pdf-obj').attr('data', 'php/generatepdf.php?yearA='+ startDate +'&yearB='+ endDate  +'&indicator=packagesummary');
        $('#sT-pr-r-pdf-obj').attr('src', 'php/generatepdf.php?yearA='+ startDate +'&yearB='+ endDate  +'&indicator=packagesummary');
    }
    textPopUp();
    dispBlock = 'pr';
});

function textPopUp() {
    Swal({ //for popup
      position: 'center',
      showConfirmButton: false,
      html: '<img src="resources/load.gif" height="100px"/>', 
      allowOutsideClick: false,
      timer: 2000
    }).then(function() {
        if (dispBlock == 'ul') {
          $('#s-ul-r-pdf-obj').css('display', 'block');
        } else if (dispBlock == 'pr') {
          $('#s-pr-r-pdf-obj').css('display', 'block');
        }
    });
}

$('.tablinks').click(function() {
    $('#s-ul-r-pdf-obj').css('display', 'none');
    $('#s-ul-r-pdf-obj').attr('data', '');
    $('#sT-ul-r-pdf-obj').attr('src', '');

    $('#s-pr-r-pdf-obj').css('display', 'none');
    $('#s-pr-r-pdf-obj').attr('data', '');
    $('#sT-pr-r-pdf-obj').attr('src', '');
});

$('input[name="daterange"]').daterangepicker({
    opens: 'right',
    drops: 'down',
    autoApply: true,
});