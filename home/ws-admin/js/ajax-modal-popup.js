$(function () {
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
    //we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
    const myModalEl = document.querySelector("#modalPL");
    const loading = '<div style="text-align:center"><img src="/pkmukherjee/home/ws-admin/img/Spinning_gear.gif"></div>';
    // const actionModals = document.querySelectorAll(".showModalButton");

    $(document).on('click', '.showModalButton', function (e) {
        e.preventDefault();
        const url = this.value;
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                // console.log(response.content);
                const modalContent = myModalEl.querySelector("#modalContent");
                const modalFooter = myModalEl.querySelector('.modal-footer');

                // if (response.content === undefined) {
                //     alert("chongu");
                //     return;
                // }
                // const resultData = JSON.parse(response);
                // console.log(response);
                // modalContent.innerHTML = response.content;
                $('#modalContent').html(response.content)
                modalFooter.innerHTML = response.footer;

                // **********************************
                // form submission
                const submitButton = document.querySelector("#submit-btn");

                if (submitButton !== null) {
                    submitButton.addEventListener("click", function (event) {
                        event.preventDefault();
    
                        // Serialize form data
                        // console.log(document.querySelector('#form-name'))
                        const formName = document.querySelector('#form-name').value;
                        const formData = jQuery('#ajax-form').serialize();
                        const action = jQuery('#ajax-form').attr('action');

                        // const formData = $(`#${formName}`).serialize();
                        // const action = $(`#${formName}`).attr('action');
                        // console.log("form data: " + formData);
                        // console.log("action: " + action);
    
                        // refresh modal content
                        modalContent.innerHTML = loading;
                        modalFooter.innerHTML = "";
    
                        // AJAX call to send form data to the server
                        $.ajax({
                            type: 'POST',
                            url: action,
                            data: formData,
                            success: function (response) {
                                // Handle success response from server
                                // $.pjax.reload({ container: '#datatable-pjax', timeout: false });
                                $.pjax.reload({ container: `#${formName}`, timeout: false });
                                modalContent.innerHTML = response.content;
                                modalFooter.innerHTML = response.footer;
                            },
                            error: function (xhr, status, error) {
                                // Handle error response
                                console.error(xhr.responseText);
                                modalContent.innerHTML = `<h4>Error! Status: ${xhr.status} | Message: ${xhr.statusText}</h4>`
                            }
                        });
                    });
                }

                // **********************************
            },
            error: function (xhr, status, error) { // Callback function to handle error
                console.dir(xhr);
                modalContent.innerHTML = `<h4>Error! Status: ${xhr.status} | Message: ${xhr.statusText}</h4>`
            }
        });

        myModalEl.addEventListener('hide.bs.modal', event => {
            const modalContent = myModalEl.querySelector("#modalContent");
            modalContent.innerHTML = loading;
        });

        // e.preventDefault();

    });
});