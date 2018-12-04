(($) => { 
    let readURL = "/journal/php/read.php";
    let postURL = "/journal/php/create.php";
    

    /********************************************************************************
    **                            Get all the subjects                             **
    ********************************************************************************/
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
                let topics = $("#newPostTopic");
                
                for(loop = 0; loop < reply.length; loop++){
                    
                    let category = reply[loop].category;
                    let ID = reply[loop].id;
                    
                    let subject = $("<option>").text(reply[loop].category).attr("data-id", ID);

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

        /********************************************************************************
        **                        Get all the journal entries                          **
        ********************************************************************************/
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
                let entries = {};
                
                for(loop = 0; loop < reply.length; loop++){
                    
                    let categorysubject = reply[loop].subject;
                    let ID = reply[loop].id;
                    
                    let subject = $("<option>").text(reply[loop].category).attr("data-id", ID);

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

        /********************************************************************************
        **                              Post a new emtry                               **
        ********************************************************************************/
        $("#addNewPost").on("click", function() {
            let selectedOption = $("#newPostTopic option:selected");
            let id = selectedOption.attr("data-id");
            let post = $.trim($("#newPostContent").val());

            let postData = "subject=" + id + "&entry=" + post;
            
            $.ajax({ 
                url:postURL
                , method: "POST"
                , data: postData
                , dataType: "JSON"
                , success: function(responseText) {
                    let data = JSON.parse(responseText);
                    console.log(data.data.result);

                    //todo: code needs to go here to put the confirmation on the page
                    //and reset the form to empty.  Maybe a picture of a pony pointing
                    //at the message.

                }, error:function(xhr, status, error) {
                    console.log("ERROR:");
                    console.log(xhr.responseText);
                    console.log(postData);
                    console.log(status);
                    console.log(error);

                    //TODO: put some code here to put the failure on the webpage
                }
    
                , complete:function() {
                    console.log("Call complete");
                }
                
                
                
            })
        })


    })

    







})(jQuery)