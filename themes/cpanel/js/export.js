function ExportSms()
{
    var username = $("#username").val();
    var month = $("#month").val();
    var year = $("#year").val();
    var start = $("#start").val();
    var end = $("#end").val();
    var page = $("#page").val();
    
    $.ajax({
        type: "POST",
        url: "../report/ExportSms",
        data:({
            username:username
            , month:month
            , year:year
            , start:start
            , end:end
            , page:page
        }),
        dataType: "text",
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Ajax-Request", "true");
        },
        success: function(response) {
            var result = eval( "(" + response + ")" );
            window.location = result.message;    
        },
        error: function(){}
    });
} 

function ExportCard()
{
    var username = $("#username").val();
    var month = $("#month").val();
    var year = $("#year").val();
    var start = $("#start").val();
    var end = $("#end").val();
    var page = $("#page").val();
    
    $.ajax({
        type: "POST",
        url: "../report/ExportCard",
        data:({
            username:username
            , month:month
            , year:year
            , start:start
            , end:end
            , page:page
        }),
        dataType: "text",
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Ajax-Request", "true");
        },
        success: function(response) {
            var result = eval( "(" + response + ")" );
            window.location = result.message;    
        },
        error: function(){}
    });   
}

function Export()
{
    var username = $("#username").val();
    var day = $("#day").val();
    var month = $("#month").val();
    var year = $("#year").val();
    var start = $("#start").val();
    var end = $("#end").val();
    var page = $("#page").val();
    var order = $("#order").val();
    var telco = $("#telco").val();
    
    $.ajax({
        type: "POST",
        url: "../report/export",
        data:({
            username:username
            , day:day
            , month:month
            , year:year
            , start:start
            , end:end
            , page:page
            , order:order
            , telco:telco
        }),
        dataType: "text",
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Ajax-Request", "true");
        },
        success: function(response) {
            var result = eval( "(" + response + ")" );
            window.location = result.message;    
        },
        error: function(){}
    });
}

function ExportPaymentConfirm()
{
    var username = $("#username").val();
    var month = $("#month").val();
    var year = $("#year").val();
    var type = $("#type").val();    
    var currentPage = $("#currentPage").val();
    
    $.ajax({
        type: "POST",
        url: "../paymentConfirm/Export",
        data:({
            username:username
            , month:month
            , year:year
            , type:type            
            , currentPage:currentPage
        }),
        dataType: "text",
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Ajax-Request", "true");
        },
        success: function(response) {
            var result = eval( "(" + response + ")" );
            window.location = result.message;    
        },
        error: function(){}
    });
}