(($) => { 
    let crudURL = "/journal/php/crud.php";
    
    $(document).ready( function() {
        // Load Categories
        $.ajax(
            {
            url: crudURL

            , type:"GET"

            , data: "table=category"
            
            , beforeSend: function() {
                console.log("Sending ajax reguest")
            }

            , success:function(data) {
                console.log("Data recieved: " + data);
            }

            , error:function(response) {
                console.log("error: " + response);
            }

            , complete:function() {
                console.log("Call complete");
            }
        })

        // load all entries
       // $.AJAX
    })

    







})(jQuery)