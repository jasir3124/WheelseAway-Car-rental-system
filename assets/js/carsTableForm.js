// delete cars
$("#delete-cars").click(function () {
    var selectedCars = [];
    $(".user-checkbox:checked").each(function () {
        var carData = {
            carId: $(this).data("car-id"),
        };
        selectedCars.push(carData);
    });

    if (selectedCars.length > 0) {
        $.ajax({
            url: "../php-logic/deleteCar.php",
            type: "POST",
            data: { cars: JSON.stringify(selectedCars) },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert("Cars processed successfully.");
                    // Remove the rows from the table
                    setTimeout(function() {
                        selectedCars.forEach(function(car) {
                            let rowId = "#user-row-" + car.carId;
                            console.log("Removing row with ID:", rowId); // Debugging: Log the row ID
                            $(rowId).remove();
                        });
                    }, 100); // 100ms delay
                    console.log(response.message);
                } else {
                    alert("Failed to process cars.");
                    console.log(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error);
                alert("Error processing cars.");
            }
        });
    } else {
        alert("No cars selected.");
    }
});