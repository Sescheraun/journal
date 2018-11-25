(($) => { 
    let crudURL = "/journal/php/read.php";
    
    $(document).ready( function() {
        // Load Categories
        $.ajax(
            {
            url: crudURL

            , type:"GET"

            , data: "table=subject"
            
            , beforeSend: function() {
                console.log("Sending ajax reguest");
                console.log(crudURL);
            }

            , success:function(data) {
                // console.log("Data recieved: " + data.data);
                let topics = $('#subjects');
                for(loop = 0; loop < data.data.length; loop++){

                    let ID = (data.data[loop].id);
                    let subject = $("<option>").text(data.data[loop].subject).attr("data-id", ID);

                    console.log(subject.value);

                    subject.appendTo(topics);
                }
            }

            , error:function(xhr, status, error) {
                console.log("ERROR: " + xhr.responseText);
            }

            , complete:function() {
                console.log("Call complete");
            }
        })

        // load all entries
                
        $.ajax(
            {
            url: crudURL

            , type:"GET"
           
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
    })

    







})(jQuery)