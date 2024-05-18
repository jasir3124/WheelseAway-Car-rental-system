$(function () {
  "use strict";

  let carData;
  $.ajax({
    url: "../php-logic/getCarsDataForDashboard.php",
    method: "GET",
    dataType: "json",
    success: function (data) {
      carData = data;
      console.log(data);
      updateCharts();
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });

  function updateCharts() {
    console.log(carData);
    let under100Count = 0;
    let between100And150Count = 0;
    let above150Count = 0;

    carData.forEach(function (car) {

      let costPerDay = parseFloat(car.costPerDay.replace("$", ""));

      if (costPerDay < 100) {
        under100Count++;
      } else if (costPerDay >= 100 && costPerDay <= 150) {
        between100And150Count++;
      } else {
        above150Count++;
      }
    });

    var doughnutPieData = {
      datasets: [
        {
          // data for cars rented, based on price
          data: [under100Count, between100And150Count, above150Count],
          backgroundColor: [
            "rgba(255, 99, 132, 0.5)",
            "rgba(54, 162, 235, 0.5)",
            "rgba(255, 206, 86, 0.5)",
            "rgba(75, 192, 192, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 159, 64, 0.5)",
          ],
          borderColor: [
            "rgba(255,99,132,1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
        },
      ],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: ["Under 100$", "100$ - 150$", "150$ - 200$ +"],
    };

    var doughnutPieOptions = {
      responsive: true,
      animation: {
        animateScale: true,
        animateRotate: true,
      },
    };

    if ($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: "doughnut",
        data: doughnutPieData,
        options: doughnutPieOptions,
      });
    }



// chart for cars by year
    let carFrom2021 = 0
    let carFrom2022 = 0
    let carFrom2023 = 0

    carData.forEach(car => {
      let carYear = car.car_year
      if (carYear == 2021) {
        carFrom2021++;
      } else if (carYear == 2022) {
        carFrom2022++;
      } else {
        carFrom2023++;
      }
    });
    var data = {
      labels: ["2021", "2022", "2023"],
      datasets: [
        {
          label: "Cars",
          data: [carFrom2021, carFrom2022, carFrom2023],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255,99,132,1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
          fill: false,
        },
      ],
    };

    var options = {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
            gridLines: {
              color: "rgba(204, 204, 204,0.1)",
            },
          },
        ],
        xAxes: [
          {
            gridLines: {
              color: "rgba(204, 204, 204,0.1)",
            },
          },
        ],
      },
      legend: {
        display: false,
      },
      elements: {
        line: {
          tension: 0.5,
        },
        point: {
          radius: 0,
        },
      },
    };
    // Define 'options' here or pass it as an argument to the function where it's needed.

    if ($("#barChart").length) {
      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var barChart = new Chart(barChartCanvas, {
        type: "bar",
        data: data,
        options: options, // Ensure 'options' is defined or passed correctly
      });
    }
  }
});
