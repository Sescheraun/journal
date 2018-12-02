(($) => { 
    let readURL = "/journal/php/read.php";
    
    $(document).ready( function() {
        // Load Categories
        $.ajax(
            {
            url: readURL

            , type:"GET"

            , data: "table=subject"
            
            , beforeSend: function() {
                console.log("Sending ajax reguest");
                console.log(readURL);
            }

            , success:function(response) {
                // console.log(response);
                let reply = {};
                reply = response.data;
                let topics = $("#topics");
                
                for(loop = 0; loop < reply.length; loop++){
                    
                    let category = reply[loop].category;
                     let ID = reply[loop].id;
                     console.log (ID);
                     console.log(category);

                    let subject = $("<option>").text(reply[loop].category).attr("data-id", ID);

                //     console.log(subject.value);

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

        // // load all entries
                
        // $.ajax(
        //     {
        //     url: readURL

        //     , type:"GET"
           
        //     , beforeSend: function() {
        //         console.log("Sending ajax reguest");
        //         console.log(readURL);
        //     }

        //     , success:function(data) {
        //         console.log("Data recieved: " + data);
        //     }

        //     , error:function(xhr, status, error) {
        //         console.log("ERROR: " + xhr.responseText);
        //     }

        //     , complete:function() {
        //         console.log("Call complete");
        //     }
        // })
    })

    







})(jQuery)