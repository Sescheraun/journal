(($) => { 
    var journalIndex = 0;
    var journal = {};

    let createURL = "/journal/php/create.php";
    let updateURL = "/journal/php/update.php";
    let readURL = "/journal/php/read.php";
    let deleteURL = "/journal/php/delete.php";
    

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
                let updateTopics = $("#updatePostTopic");
                
                for(loop = 0; loop < reply.length; loop++){
                    
                    let category = reply[loop].category;
                    let ID = reply[loop].id;

                    let subject = $("<option>").text(reply[loop].category).attr("data-id", ID);
                    let updateSubject = $("<option>").text(reply[loop].category).attr("data-id", ID);
                    subject.appendTo(topics);
                    updateSubject.appendTo(updateTopics);
                    }
                }
    
                , error:function(xhr, status, error) {
                    console.log("ERROR: " + xhr.responseText);
                }
    
                , complete:function() {
                    
                }
            })

        /********************************************************************************
        **                        Get all the journal entries                          **
        ********************************************************************************/
        pullJournal();


        /********************************************************************************
        **                              Post a new entry                               **
        ********************************************************************************/
        $("#addNewPost").on("click", function() {
            let selectedOption = $("#newPostTopic option:selected");
            let id = selectedOption.attr("data-id");
            let post = $.trim($("#newPostContent").val());

            let postData = "subject=" + id + "&entry=" + post;
            
            $.ajax({ 
                url:createURL
                , method: "POST"
                , data: postData
                , dataType: "JSON"
                , success: function(responseText) {
                    let data = JSON.parse(responseText);
                    console.log(data.data.result);

                    //todo: code needs to go here to put the confirmation on the page
                    //and reset the form to empty.  Maybe a picture of a pony pointing
                    //at the message.
                    pullJournal();

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

    /********************************************************************************
    **                              Update a journal emtry                         **
    ********************************************************************************/
        $("#updatePost").on("click", function() {
            let selectedOption = $("#updatePostTopic option:selected");
            let subjectId = selectedOption.attr("data-id");
            let post = $.trim($("#updatePostContent").val());
            let target = journalIndex + 1;

            let postData = "subject=" + subjectId + "&entry=" + post + "&id=" + target;
            $.ajax({ 
                url:updateURL
                , method: "POST"
                , data: postData
                , dataType: "JSON"
                , success: function(responseText) {
                    let data = JSON.parse(responseText);
                    console.log(data.data.result);

                    //todo: code needs to go here to put the confirmation on the page
                    //and reset the form to empty.  Maybe a picture of a pony pointing
                    //at the message.
                    pullJournal();

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

    /********************************************************************************
     **                              Delete a journal emtry                         **
    ********************************************************************************/
        $("#deletePost").on("click", function() {
            let target = journal[journalIndex].id;
            console.log(target);

            let postData = "id=" + target;
            $.ajax({ 
                url:deleteURL
                , method: "GET"
                , data: postData
                , dataType: "JSON"
                , success: function(responseText) {
                    console.log(deleteURL);
                    console.log(postData);

                    let data = JSON.parse(responseText);
                    console.log(data.data.result);

                    //todo: code needs to go here to put the confirmation on the page
                    //and reset the form to empty.  Maybe a picture of a pony pointing
                    //at the message.
                    pullJournal();

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


    /********************************************************************************
    **                                 Utility Methods                             **
    ********************************************************************************/
        $(".PostLeft").on("click", function() {
            shiftJournal(-1);
        })
    
    
        $(".PostRight").on("click", function() {
            shiftJournal(1);
        })
    }) //The document.ready function ends here.


    /********************************************************************************
    **                         Changes the index of the journal                    **
    **                               based on user input                           **
    ***********************^^********************************************************/


    shiftJournal = (direction) => {
        journalIndex += direction;
        if (journalIndex >= journal.length) journalIndex = 0;
        if (journalIndex < 0) journalIndex = journal.length - 1;
        loadJournal();
    }

    /****************************************************************************/
    /**  Load the elements of journal into the page as the user browses them   **/
    /****************************************************************************/
    loadJournal = () => {
        //Delima, how do I replace the content when I don't know what it will be?
        //There is probably a better way to do this.

        $(".postTopic").empty(journal[journalIndex].subject);
        $(".postTopic").append(journal[journalIndex].subject);

        $("#updatePostTopic").val(journal[journalIndex].subject);
 
        $("#updatePostContent").val(journal[journalIndex].entry);
        // $("#updatePostContent").append(journal[journalIndex].entry);

        $(".postContent").empty(journal[journalIndex].entry);
        $(".postContent").append(journal[journalIndex].entry);
        
        $(".id").empty("ID # " + journal[journalIndex].id);
        $(".id").append("ID # " + journal[journalIndex].id);
    }

    /********************************************************************************
    **                        Get all the journal entries                          **
    ********************************************************************************/
        
    pullJournal = () => {
        $.ajax(
            {
            url: readURL

            , type:"GET"
            
            , beforeSend: function() {
                console.log("Sending ajax reguest to get a fresh set of journal entries");
                console.log(readURL);
            }

            , success:function(response) {
                journal = response.data;
                console.log(journal);
                loadJournal();
            }
            , error:function(xhr, status, error) {
                console.log("ERROR:");
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
            , complete:function() {
                console.log("Call complete");
            }
        })
    }

})(jQuery)