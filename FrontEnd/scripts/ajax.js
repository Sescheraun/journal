(($) => { 
    let crudURL = "localhost/journal/php/crud.php";
    
    $(document).ready( function() {
        alert("in the function");
        alert(crudURL);
        // Load Categories
        $.ajax({
            "url": crudURL
            , "method":"GET"

            , "success":function(result) {
                alert(result);
            }
            , "error":function() {
                alert("error");
            }
            , "complete":function() {
                alert("Call complete");
            }
        })

        // load all entries
       // $.AJAX
    })

    







})(jQuery)