(($) => { 
    let crudURL = "/journal/php/read.php";
    
    $(document).ready( function() {
        // Load Categories
        $.ajax(
            {
            url: crudURL

            , type:"GET"

            , data: "table=category"
            
            , beforeSend: function() {
                console.log("Sending ajax reguest");
                console.log(crudURL);
            }

            , success:function(data) {
                console.log("Data recieved: " + data);
            }

            , error:function(xhr, status, error) {
                console.log("ERROR: " + xhr.responseText);
            }

            , complete:function() {
                console.log("Call complete");
            }
        })

        // load all entries
       // $.AJAX
    })

    







})(jQuery)