$(document).ready(() => {
    $.ajax({
        // URL
        url: 'http://localhost/projects/bank_app/public/api/readuser.php',
        // function(userData)
        success: userData => {
            let userObj = [];
            let userId = [];

            // Loop through data
            for (let i = 0; i < userData.data.length; i++) {
                userObj = userData.data[i];
                userId[userObj.account_id] = userObj;
                
                // Append data to select_user
                $('#select_user').append(`<option value="${userObj.account_id}">${userObj.firstName} ${userObj.lastName}</option>`);
                $('#to_account').append(`<option value="${userObj.account_id}">${userObj.firstName} ${userObj.lastName}</option>`);
                
                console.log(userObj.account_id, userObj.firstName, userObj.balance);
            }


            $('#select_btn').click(() => {
                let user = document.querySelector('#select_user').value;
                userObj = userId[user];
                console.log(userObj);
                
                $('#balance').empty();
                $('#balance').append('<h3>Kontobalans: </h3>');
                $('#balance').append(`<h6>${userObj.balance} SEK</h6>`)
                $('#from_account').val(`${userObj.account_id}`);
                    
            }) 
        }


    })
})

