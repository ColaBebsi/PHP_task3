$(document).ready(() => {
    // Load users
    $.ajax({
        url: 'http://localhost/projects/bank_app/public/api/readUser.php',
        success: data => {
            let userList = data.data;
            
            // Loop through userList and append properties
            for (const user of userList) {
                $('#select_user').append(`<option value="${user.account_id}">${user.firstName} ${user.lastName}</option>`);
                $('#to_account').append(`<option value="${user.account_id}">${user.account_id}, ${user.firstName} ${user.lastName}</option>`);
                console.log(user.account_id, user.firstName, user.balance);
            } 

            // Get user ID 
            $("#select_btn").click(() => {
                let accountId = document.querySelector("#select_user").value;
                getSingleUser(accountId);
            })
        }
    })

    // Populate balance and account ID
    function getSingleUser(accountId) {
        $.ajax({
            url: `http://localhost/projects/bank_app/public/api/readSingleUser.php?account_id=${accountId}`,
            success: data => {
                // Remove balance id 
                $('#balance').empty();
                
                // Append property
                $('#balance').append('<h3>Kontobalans: </h3>');
                $('#balance').append(`<h6">${data.balance} SEK</h6>`)

                // Get current value
                $('#balance').val(`${data.balance}`);
                $('#from_account').val(`${data.account_id}`);
            }
        })
    }

    // Create transaction 
    $("#send_btn").click(() => {
        // event.preventDefault();

        // Get current values 
        let fromAccountId = document.querySelector("#from_account").value;
        let toAccountId = document.querySelector("#to_account").value;
        let amount = document.querySelector("#amount").value

        // Parse values to int 
        let currentValues = {
            from_amount: parseInt(amount),
            from_account: parseInt(fromAccountId),
            to_amount: parseInt(amount),
            to_account: parseInt(toAccountId)
        };

        // Convert currentValues objects to JSON string
        let json = JSON.stringify(currentValues);

        $.ajax({
            type: "POST",
            url: "http://localhost/projects/bank_app/public/api/createTransaction.php",
            data: json,
            success: data => {
                // $('#send_msg').html('<div class="alert alert-success">Transfer successful!</div>');
                alert("Transaction successful!");
            },
            // Error handling
            error: (e, errorStatus, errorThrown) => {
                // alert('Error creating transaction!');
                // console.log(`error: ${e}, errorStatus: ${errorStatus}, errorThrown: ${errorThrown}`);
                alert(e.responseText);
            }
        })
    })
});