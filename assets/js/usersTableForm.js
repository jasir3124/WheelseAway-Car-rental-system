// delete users
$("#delete-users").click(function () {
    var selectedUsers = [];
    $(".user-checkbox:checked").each(function () {
        var userData = {
            userId: $(this).data("user-id"),
            email: $(this).data("email"),
            has_rented: $(this).data("has-rented"),
        };
        selectedUsers.push(userData);
    });

    if (selectedUsers.length > 0) {
        $.ajax({
            url: "../php-logic/deleteUser.php",
            type: "POST",
            data: { users: JSON.stringify(selectedUsers) },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert("Users processed successfully.");
                    // // Remove the rows from the table
                    console.log("Selected Users:", selectedUsers);

                    // Remove the rows from the table
                    setTimeout(function() {
                        selectedUsers.forEach(function(user) {
                            let rowId = "#user-row-" + user.userId;
                            console.log("Removing row with ID:", rowId); // Debugging: Log the row ID
                            $(rowId).remove();
                        });
                    }, 100); // 100ms delay
                } else {
                    alert("Failed to process users.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error);
                alert("Error processing users.");
            }
        });
    } else {
        alert("No users selected.");
    }
});