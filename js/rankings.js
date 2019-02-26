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

const toast = Swal.mixin({ //for popup
  position: 'center', 
  showConfirmButton: false
});

$(document).ready(function() {
    $('#dr-gen-subs').click(function() {
        var startDate = $('#dr-subs').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate =  $('#dr-subs').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var Arr = returnRankType($(this).val());
        $('#p-subs').html('');
        $('#p-subs').html('As of ' + $('#dr-subs').data('daterangepicker').startDate.format('MMM, DD YYYY') + ' to ' + $('#dr-subs').data('daterangepicker').startDate.format('MMM, DD YYYY'));
        retrieveData(Arr['newId'], Arr['subsVal'], startDate, endDate);
    });

     $('#dr-gen-v').click(function() {
        var startDate = $('#dr-v').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate =  $('#dr-v').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var Arr = returnRankType($(this).val());
        $('#p-views').html('');
        $('#p-views').html('As of ' + $('#dr-v').data('daterangepicker').startDate.format('MMM, DD YYYY') + ' to ' + $('#dr-v').data('daterangepicker').endDate.format('MMM, DD YYYY'));
        retrieveData(Arr['newId'], Arr['subsVal'], startDate, endDate);
    });

    $('#dr-gen-r').click(function() {
        var startDate = $('#dr-r').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate =  $('#dr-r').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var Arr = returnRankType($(this).val());
        $('#p-rates').html('');
        $('#p-rates').html('As of ' + $('#dr-r').data('daterangepicker').startDate.format('MMM, DD YYYY') + ' to ' + $('#dr-r').data('daterangepicker').endDate.format('MMM, DD YYYY'));
        retrieveData(Arr['newId'], Arr['subsVal'], startDate, endDate);
    });

    $(document).on('click', 'button b', function() {
    var today = new Date().toISOString().slice(0, 10);
        switch($(this).html()) {
            case 'SUBSCRIPTIONS':
                $('#p-subs').html('');
                $('#SubsRankContainer').html('');
                retrieveData('#SubsRankContainer', 'SUBSCRIPTIONS', today, today); 
                $('#p-subs').html('As of ' + formatDate(today) + ' to ' + formatDate(today));
                break;
            case 'VIEWERS':
                $('#p-views').html('');
                $('#ViewsRankContainer').html('');
                retrieveData('#ViewsRankContainer', 'VIEWERS', today, today);
                $('#p-views').html('As of ' + formatDate(today) + ' to ' + formatDate(today)); 
                break;
            case 'RATINGS':
                $('#p-rates').html('');
                $('#RatesRankContainer').html('');
                retrieveData('#RatesRankContainer', 'RATINGS', today, today);
                $('#p-rates').html('As of ' + formatDate(today) + ' to ' + formatDate(today)); 
                break;
            }
        });
    });

    function returnRankType(valType) {
        var newArr = [];
        switch(valType) {
            case 'SUBSCRIPTIONS':
                newArr['newId'] = '#SubsRankContainer';
                newArr['subsVal'] = 'SUBSCRIPTIONS';
                break;
            case 'VIEWERS':
                newArr['newId'] = '#ViewsRankContainer';
                newArr['subsVal'] = 'VIEWERS';
                break;
            case 'RATINGS':
                newArr['newId'] = '#RatesRankContainer';
                newArr['subsVal'] = 'RATINGS';
                break;
        }
        return newArr;
    }

    function retrieveData(newId, subsVal, startDate, endDate) {
        $.ajax({
            url: "php/rankings.php",
            type: "post",
            data: {
                Subs: subsVal,
                stDate: startDate,
                enDate: endDate
            },
            dataType: "json",
            beforeSend: function() {
                toast({ html: '<img src="resources/load.gif" height="100px"/>'})
            },
            success: function(data) { 
                $(newId).html('');
                if(data.length != 5) {
                    for(var i=0; i<5; i++) {
                        if(data[i] == null || data[i] == '' || data[i]['User'] == null) {
                            $(newId).append('<tr><td style="width: 40%;">'+ (i+1) +'. Empty Slot</td><td style="width: 20%; text-align: center;"> - </td><td style="width: 40%; text-align: center;"> 0 </td></tr>');
                        } else {
                            $(newId).append('<tr><td style="width: 40%;">'+ (i+1) +'. '+ data[i]['User'] +'</td><td style="width: 20%; text-align: center;"> - </td><td style="width: 40%; text-align: center;"> '+ data[i]['Count'] +' </td></tr>');  
                        }
                    }
                } else {
                    for(var i=0; i<data.length; i++) {
                        $(newId).append('<tr><td style="width: 40%;">'+ (i+1) +'. Empty Slot</td><td style="width: 20%; text-align: center;"> - </td><td style="width: 40%; text-align: center;"> 0 </td></tr>');
                    }
                }
                Swal.close();
            }
        })
    }

    var today = new Date().toISOString().slice(0, 10);
    retrieveData('#SubsRankContainer', 'SUBSCRIPTIONS', today, today); 
    $('#p-subs').html('As of ' + formatDate(today) + ' to ' + formatDate(today));
    retrieveData('#ViewsRankContainer', 'VIEWERS', today, today);
    $('#p-views').html('As of ' + formatDate(today) + ' to ' + formatDate(today));
    retrieveData('#RatesRankContainer', 'VIEWERS', today, today);
    $('#p-rates').html('As of ' + formatDate(today) + ' to ' + formatDate(today));  

    function formatDate(date) {
        var fDate = new Date(date);
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = fDate.getDate();
        var monthIndex = fDate.getMonth();
        var year = fDate.getFullYear();

        return monthNames[monthIndex] + ', ' + day + ' ' + year;
    }
    
    $('input[name="daterange"]').daterangepicker({
        opens: 'right',
        drops: 'down',
        autoApply: true,
    });