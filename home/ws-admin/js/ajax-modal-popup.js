$(function () {
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
    //we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
    const myModalEl = document.querySelector("#modalPL");

    // $(document).on('click', '.showModalButton', function () {

    //     myModalEl.addEventListener('shown.bs.modal', event => {
    //         $.ajax({
    //             url: $(this).attr('value'),
    //             method: 'GET',
    //             // data: {             // Optional data to send to the server
    //             //     param1: 'value1',
    //             //     param2: 'value2'
    //             // },
    //             success: function (response) { // Callback function to handle successful response
    //                 console.log(response.content);
    //                 const modalContent = myModalEl.querySelector("#modalContent");
    //                 const modalFooter = myModalEl.querySelector('.modal-footer');
                    
    //                 modalContent.innerHTML = response.content;
    //                 modalFooter.innerHTML = response.footer;
    //             },
    //             error: function (xhr, status, error) { // Callback function to handle error
    //                 console.log('Error:', error);
    //             }
    //         });
    //         // document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
    //     });
    //     event.preventDefault();
    // });

    const actionModals = document.querySelectorAll(".showModalButton");
    actionModals.forEach(actionModal => {
        actionModal.addEventListener("click", function(event) {
            const url = actionModal.value;
            $.ajax({
                url: url,
                method: 'GET',
                // data: {             // Optional data to send to the server
                //     param1: 'value1',
                //     param2: 'value2'
                // },
                success: function (response) { // Callback function to handle successful response
                    debugger;
                    console.log(response.content);
                    const modalContent = myModalEl.querySelector("#modalContent");
                    const modalFooter = myModalEl.querySelector('.modal-footer');
                    
                    modalContent.innerHTML = response.content;
                    modalFooter.innerHTML = response.footer;

                    // myModalEl.addEventListener('shown.bs.modal', event => {
                
                        
                    // });
                },
                error: function (xhr, status, error) { // Callback function to handle error
                    console.log('Error:', error);
                }
            });

            myModalEl.addEventListener('hide.bs.modal', event => {
                const modalContent = myModalEl.querySelector("#modalContent");
                modalContent.innerHTML = '<div style="text-align:center"><img src="/pkmukherjee/home/ws-admin/img/Spinning_gear.gif"></div>';
            });

            event.preventDefault();
        });
    });

    // myModalEl.addEventListener('hide.bs.modal', event => {
    //     const modalContent = myModalEl.querySelector("#modalContent");
    //     modalContent.innerHTML = '<div style="text-align:center"><img src="/pkmukherjee/home/ws-admin/img/Spinning_gear.gif"></div>';
    // });
});