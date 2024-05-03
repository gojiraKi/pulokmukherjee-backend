$(function () {
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
    //we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
    const myModalEl = document.querySelector("#modalPL");
    const loading = '<div style="text-align:center"><img src="/pkmukherjee/home/ws-admin/img/Spinning_gear.gif"></div>';

    const actionModals = document.querySelectorAll(".showModalButton");
    actionModals.forEach(actionModal => {
        actionModal.addEventListener("click", function(event) {
            const url = actionModal.value;
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    // console.log(response.content);
                    const modalContent = myModalEl.querySelector("#modalContent");
                    const modalFooter = myModalEl.querySelector('.modal-footer');
                    
                    modalContent.innerHTML = response.content;
                    modalFooter.innerHTML = response.footer;

                    // **********************************
                    // form submission
                    const submitButton = document.querySelector("#submit-btn");

                    submitButton.addEventListener("click", function(event) {
                        event.preventDefault();

                        // Serialize form data
                        const formData = $('#ajax-form').serialize();
                        const action = $('#ajax-form').attr('action');
                        console.log("form data: " + formData);
                        console.log("action: " + action);

                        // refresh modal content
                        modalContent.innerHTML = loading;
                        modalFooter.innerHTML = "";

                        // AJAX call to send form data to the server
                        $.ajax({
                            type: 'POST',
                            url: action,
                            data: formData,
                            success: function(response) {
                                // Handle success response from server
                                // console.log("response: " + JSON.parse(response));
                                modalContent.innerHTML = response.content;
                                modalFooter.innerHTML = response.footer;
                                $.pjax.reload({container:'#datatable-pjax', timeout:false});
                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                console.error(xhr.responseText);
                            }
                        });
                    });
                    // **********************************
                },
                error: function (xhr, status, error) { // Callback function to handle error
                    console.log('Error:', error);
                }
            });

            myModalEl.addEventListener('hide.bs.modal', event => {
                const modalContent = myModalEl.querySelector("#modalContent");
                modalContent.innerHTML = loading;
            });

            event.preventDefault();
        });
    });

    $('#submit-btn').click(function(e){
        alert("ok");
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        const formData = $('#ajax-form').serialize();
        const action = $('#myForm').attr('action');
        console.log("form data: " + formData);
        console.log("action: " + action);

        // AJAX call to send form data to the server
        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            success: function(response) {
                // Handle success response from server
                console.log("response: " + response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});